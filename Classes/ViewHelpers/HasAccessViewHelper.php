<?php
/***************************************************************
*  Copyright notice
*
*  (c) 2010 Daniel Lienert <daniel@lienert.cc>, Michael Knoll <mimi@kaktusteam.de>
*  All rights reserved
*
*
*  This script is part of the TYPO3 project. The TYPO3 project is
*  free software; you can redistribute it and/or modify
*  it under the terms of the GNU General Public License as published by
*  the Free Software Foundation; either version 2 of the License, or
*  (at your option) any later version.
*
*  The GNU General Public License can be found at
*  http://www.gnu.org/copyleft/gpl.html.
*
*  This script is distributed in the hope that it will be useful,
*  but WITHOUT ANY WARRANTY; without even the implied warranty of
*  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
*  GNU General Public License for more details.
*
*  This copyright notice MUST APPEAR in all copies of the script!
***************************************************************/
 
/**
 * Class implements an access viewhelper for RBAC
 * 
 * = Examples =
 *
 * <code title="Basic usage">
 * <rbac:hasAccess [optional]feUser="{feUser}" object="rbac_object_name" action="rbac_action_name">
 *   This is being shown in case user has access to action on object
 * </rbac:hasAccess>
 * </code>
 *
 * Everything inside the <rbac:access> tag is being displayed if the frontend user has access to action on object.
 * If no user is given, the currently logged in fe user will be used. 
 *
 * <code title="hasAccess / access / noAccess">
 * <rbac:hasAccess [optional]feUser="{feUser}" object="rbac_object_name" action="rbac_action_name">
 *   <f:then>
 *     This is being shown in case the user has access.
 *   </f:then>
 *   <f:else>
 *     This is being displayed in case the user has NO access.
 *   </f:else>
 * </rbac:hasAccess>
 * </code>
 *
 * The action can be a single action or a string concatenated with '||'. "action1 || action2" will be evaluated as "User has Access to action1 OR action2 on this object.
 * <rbac:hasAccess object="rbac_object_name" action="action1 || action2">
 * ....
 * </rbac:hasAccess>
 * 
 *
 * Everything inside the "access" tag is displayed if the user has access to action on object.
 * Otherwise, everything inside the "noAccess"-tag is displayed.
 *
 * <code title="inline notation">
 * {rbac:hasAccess(feUser: feUser, object: 'objectName', action: 'actionName' then: 'user has access', else: 'access is denied')}
 * </code>
 *
 * The value of the "then" attribute is displayed if access is granted for user on object and action.
 * Otherwise, the value of the "else"-attribute is displayed.
 *
 * @package ViewHelpers
 * @author Michael Knoll <mimi@kaktusteam.de>
 * @author Daniel Lienert <daniel@lienert.cc>
 */
class Tx_Rbac_ViewHelpers_HasAccessViewHelper extends Tx_Fluid_Core_ViewHelper_AbstractConditionViewHelper {
	
	/**
	 * @var Tx_Rbac_Domain_AccessControllService
	 */
	protected $accessControllService;
	
	
	/**
	 * Initialize arguments
	 */
    public function initializeArguments() {
        $this->registerArgument('feUser', 'Tx_Extbase_Domain_Model_FrontendUser', 'Frontend-User to check access rights for', FALSE);
        $this->registerArgument('object', 'string', 'Object to check if user has access rights for,', TRUE);
        $this->registerArgument('action', 'string', 'Action(s) to check if user has access rights for.', TRUE);
        
        if ($this->arguments['feUser'] === null) {
			$feUser = $this->getLoggedInFrontendUser();
		} else {
			$feUser = $this->arguments['feUser'];
		}
		
		$this->accessControllService = Tx_Rbac_Domain_AccessControllServiceFactory::getInstance($feUser);
    }

    
    
	/**
	 * Renders hasAccess viewhelper
	 * 
	 * @return string Rendered hasAccess ViewHelper
	 */
	public function render() {		
    	if ($this->checkAccess($this->arguments['object'], $this->arguments['action'])) {
			return $this->renderThenChild();
		} else {
			return $this->renderElseChild();
		}
	}
	
	
	/**
	 * Check if the user has the rigth to do an action on an object
	 * 
	 * @param unknown_type $object
	 * @param unknown_type $actionString
	 */
	protected function checkAccess($object, $actionString) {
		$access = false;
		$actions = explode('||', $actionString);
		
		foreach($actions as $action) {
			if($this->accessControllService->loggedInUserHasAccess($object, trim($action))) {
				$access = true;
			}
		}
		
		return $access;
	}
	
	
	/**
	 * Returns user object of logged in user
	 *
	 * @return Tx_Extbase_Domain_Model_FrontendUser
	 */
	protected function getLoggedInFrontendUser() {
		// TODO put this into pt_extbase
	    $feUser = null;
		$feUserUid = $GLOBALS['TSFE']->fe_user->user['uid'];
        $feUserRepository = t3lib_div::makeInstance('Tx_Extbase_Domain_Repository_FrontendUserRepository'); /* @var $feUserRepository Tx_Extbase_Domain_Repository_FrontendUserRepository */
        $query = $feUserRepository->createQuery();
        $query->getQuerySettings()->setRespectStoragePage(FALSE);
        $queryResult = $query->matching($query->equals('uid', $feUserUid))->execute();
        if (count($queryResult) > 0) {
            $feUser = $queryResult[0];
        }
        return $feUser;
	}

}
 
?>
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
<<<<<<< HEAD
 * <rbac:hasAccess user="{user}" object="rbac_object_name" action="rbac_action_name">
=======
 * <rbac:hasAccess [optional]feUser="{feUser}" object="rbac_object_name" action="rbac_action_name">
>>>>>>> aac898ba004322cc78a8f76f4a08bfdc086df3ea
 *   This is being shown in case user has access to action on object
 * </rbac:hasAccess>
 * </code>
 *
<<<<<<< HEAD
 * Everything inside the <rbac:access> tag is being displayed if the user has access to action on object. 
 * Remind, that user has to be a Tx_Rbac_Domain_Model_User object, whereas object and action are strings.
 *
 * <code title="hasAccess / access / noAccess">
 * <rbac:hasAccess user="{user}" object="rbac_object_name" action="rbac_action_name">
=======
 * Everything inside the <rbac:access> tag is being displayed if the frontend user has access to action on object.
 * If no user is given, the currently logged in fe user will be used. 
 *
 * <code title="hasAccess / access / noAccess">
 * <rbac:hasAccess [optional]feUser="{feUser}" object="rbac_object_name" action="rbac_action_name">
>>>>>>> aac898ba004322cc78a8f76f4a08bfdc086df3ea
 *   <f:then>
 *     This is being shown in case the user has access.
 *   </f:then>
 *   <f:else>
 *     This is being displayed in case the user has NO access.
 *   </f:else>
 * </rbac:hasAccess>
 * </code>
 *
 * Everything inside the "access" tag is displayed if the user has access to action on object.
 * Otherwise, everything inside the "noAccess"-tag is displayed.
 *
 * <code title="inline notation">
<<<<<<< HEAD
 * {rbac:hasAccess(user: user, 'object': object, action: 'action' then: 'user has access', else: 'access is denied')}
 * </code>
 *
 * The value of the "access" attribute is displayed if access is granted for user on object and action.
 * Otherwise, the value of the "noAccess"-attribute is displayed.
=======
 * {rbac:hasAccess(feUser: feUser, object: 'objectName', action: 'actionName' then: 'user has access', else: 'access is denied')}
 * </code>
 *
 * The value of the "then" attribute is displayed if access is granted for user on object and action.
 * Otherwise, the value of the "else"-attribute is displayed.
>>>>>>> aac898ba004322cc78a8f76f4a08bfdc086df3ea
 *
 * @package ViewHelpers
 * @author Michael Knoll <mimi@kaktusteam.de>
 */
class Tx_Rbac_ViewHelpers_HasAccessViewHelper extends Tx_Fluid_Core_ViewHelper_AbstractConditionViewHelper {
	
	/**
<<<<<<< HEAD
	 * Renders hasAccess viewhelper
	 *
	 * @param Tx_Rbac_Domain_Model_User $user
	 * @param string $object
	 * @param string $action
	 * @return string Rendered hasAccess ViewHelper
	 */
	public function render(Tx_Rbac_Domain_Model_User $user = null, $object, $action) {
		$accessControllService = Tx_Rbac_Domain_AccessControllServiceFactory::getInstance();
		if (!is_null($user) && $accessControllService->hasAccess($user->getUid(), $object, $action)) {
=======
	 * Initialize arguments
	 */
    public function initializeArguments() {
        $this->registerArgument('feUser', 'Tx_Extbase_Domain_Model_FrontendUser', 'Frontend-User to check access rights for', FALSE);
        $this->registerArgument('object', 'string', 'Object to check if user has access rights for', TRUE);
        $this->registerArgument('action', 'string', 'Action to check if user has access rights for', TRUE);
    }

    
    
	/**
	 * Renders hasAccess viewhelper
	 * 
	 * @return string Rendered hasAccess ViewHelper
	 */
	public function render() {
		if ($this->arguments['feUser'] === null) {
			$feUser = $this->getLoggedInFrontendUser();
		} else {
			$feUser = $this->arguments['feUser'];
		}
    	$accessControllService = Tx_Rbac_Domain_AccessControllServiceFactory::getInstance($feUser);
		if ($accessControllService->loggedInUserHasAccess($this->arguments['object'], $this->arguments['action'])) {
>>>>>>> aac898ba004322cc78a8f76f4a08bfdc086df3ea
			return $this->renderThenChild();
		} else {
			return $this->renderElseChild();
		}
	}
<<<<<<< HEAD
=======
	
	
	
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
>>>>>>> aac898ba004322cc78a8f76f4a08bfdc086df3ea

}
 
?>
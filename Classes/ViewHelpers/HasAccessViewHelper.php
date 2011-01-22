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
 * <rbac:hasAccess user="{user}" object="rbac_object_name" action="rbac_action_name">
 *   This is being shown in case user has access to action on object
 * </rbac:hasAccess>
 * </code>
 *
 * Everything inside the <rbac:access> tag is being displayed if the user has access to action on object. 
 * Remind, that user has to be a Tx_Rbac_Domain_Model_User object, whereas object and action are strings.
 *
 * <code title="hasAccess / access / noAccess">
 * <rbac:hasAccess user="{user}" object="rbac_object_name" action="rbac_action_name">
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
 * {rbac:hasAccess(user: user, 'object': object, action: 'action' then: 'user has access', else: 'access is denied')}
 * </code>
 *
 * The value of the "access" attribute is displayed if access is granted for user on object and action.
 * Otherwise, the value of the "noAccess"-attribute is displayed.
 *
 * @package ViewHelpers
 * @author Michael Knoll <mimi@kaktusteam.de>
 */
class Tx_Rbac_ViewHelpers_HasAccessViewHelper extends Tx_Fluid_Core_ViewHelper_AbstractConditionViewHelper {
	
	/**
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
			return $this->renderThenChild();
		} else {
			return $this->renderElseChild();
		}
	}

}
 
?>
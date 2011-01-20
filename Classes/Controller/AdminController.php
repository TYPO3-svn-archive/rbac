<?php
/***************************************************************
*  Copyright notice
*
*  (c) 2010 Michael Knoll <mimi@kaktusteam.de>
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
 * Controller for administrating RBAC settings.
 *
 * @package Controller
 * @author Michael Knoll <mimi@kaktusteam.de>
 */
class Tx_Rbac_Controller_AdminController extends Tx_Rbac_Controller_AbstractController {

	/**
	 * Shows index action
	 * 
	 * @return Rendered index action
	 */
	public function indexAction() {
		// Simply render template here
	}
	
	
	
	/**
	 * Shows index action
	 * 
	 * @return string Rendered index action
	 */
	public function actionListAction() {
	    $actionList = $this->getListDataByListIdentifier('adminActionList');
	    $this->view->assign('actionList', $actionList);
	}
	
	
	
	/**
	 * Shows list of objects
	 *
	 * @return string rendered object list action
	 */
	public function objectListAction() {
		$objectList = $this->getListDataByListIdentifier('adminObjectList');
		$this->view->assign('objectList', $objectList);
	}
	
	
	
	/**
	 * Shows list of domains
	 *
	 * @return string Rendered domain list
	 */
	public function domainListAction() {
		$domainList = $this->getListDataByListIdentifier('adminDomainList');
		$this->view->assign('domainList', $domainList);
	}
	
	
	
	/**
	 * Shows list of privileges
	 *
	 * @return string Rendered privilege list
	 */
	public function privilegeListAction() {
		$privilegeList = $this->getListDataByListIdentifier('adminPrivilegeList');
		$this->view->assign('privilegeList', $privilegeList);
	}
	
	
	
	/**
	 * Shows list of roles
	 *
	 * @return string Rendered role list
	 */
	public function roleListAction() {
		$roleList = $this->getListDataByListIdentifier('adminRoleList');
		$this->view->assign('roleList', $roleList);
	}
	
	
	
	/**
	 * Shows list of users
	 *
	 * @return string Rendered user list
	 */
	public function userListAction() {
		$userList = $this->getListDataByListIdentifier('adminUserList');
		$this->view->assign('userList', $userList);
	}
	
	
	
	/**
	 * Shows list of extensions
	 *
	 * @return string Rendered extension list
	 */
	public function extensionListAction() {
		$extensionList = $this->getListDataByListIdentifier('adminExtensionList');
		$this->view->assign('extensionList', $extensionList);
	}
	
	
	
	/**
	 * Edit action for user
	 *
	 * @return string Rendered edit action
	 */
	public function editUserAction(Tx_Rbac_Domain_Model_User $user) {
		$extlistBackend = Tx_PtExtlist_Utility_ExternalPlugin::getDataBackendByCustomConfiguration($this->settings['extlist']['lists']['adminUserRoleList'], 'adminUserRoleList');
		$extlistBackend->getFilterboxCollection()->getFilterboxByFilterboxIdentifier('filterbox1')->getFilterByFilterIdentifier('rolesFilter')->setUserUid($user->getUid());
        $listData = Tx_PtExtlist_Utility_ExternalPlugin::getListByDataBackend($extlistBackend);
        $rendererChain = Tx_PtExtlist_Domain_Renderer_RendererChainFactory::
            getRendererChain($extlistBackend->getConfigurationBuilder()->buildRendererChainConfiguration());
        $userRolesList = $rendererChain->renderList($listData->getListData());
        
        $roles = t3lib_div::makeInstance(Tx_Rbac_Domain_Repository_RoleRepository)->findAll();
        
        $this->view->assign('roles', $roles);
		$this->view->assign('user', $user);
		$this->view->assign('userRoles', $userRolesList);
	}
	
	
	
	/**
	 * Adds Role to User
	 *
	 * @param Tx_Rbac_Domain_Model_User $user
	 * @param Tx_Rbac_Domain_Model_Role $role
	 */
	public function addRoleToUserAction(Tx_Rbac_Domain_Model_User $user, Tx_Rbac_Domain_Model_Role $role) {
		$user->addRole($role);
		t3lib_div::makeInstance(Tx_Rbac_Domain_Repository_UserRepository)->update($user);
		t3lib_div::makeInstance(Tx_Extbase_Persistence_Manager)->persistAll();
		$this->flashMessages->add('Role ' . $role->getName() . ' has been added to user.');
		$this->forward('editUser');
	}
	
	
	
	/**
	 * Removes Role from User
	 *
	 * @param Tx_Rbac_Domain_Model_User $user
	 * @param Tx_Rbac_Domain_Model_Role $role
	 */
	public function removeRoleFromUserAction(Tx_Rbac_Domain_Model_User $user, Tx_Rbac_Domain_Model_Role $role) {
		$user->removeRole($role);
        t3lib_div::makeInstance(Tx_Rbac_Domain_Repository_UserRepository)->update($user);
        t3lib_div::makeInstance(Tx_Extbase_Persistence_Manager)->persistAll();
        $this->flashMessages->add('Role ' . $role->getName() . ' has been removed from user.');
        $this->forward('editUser');
	}
	
	
	
	/**
	 * Renders a list and returns rendered list for given list identifier
	 *
	 * @param string $listIdentifier
	 * @return Tx_PtExtlist_Domain_Model_List_ListData
	 */
	protected function getListDataByListIdentifier($listIdentifier) {
		$extlistBackend = Tx_PtExtlist_Utility_ExternalPlugin::getDataBackendByCustomConfiguration($this->settings['extlist']['lists'][$listIdentifier], $listIdentifier);
        $listData = Tx_PtExtlist_Utility_ExternalPlugin::getListByDataBackend($extlistBackend);
        $rendererChain = Tx_PtExtlist_Domain_Renderer_RendererChainFactory::
            getRendererChain($extlistBackend->getConfigurationBuilder()->buildRendererChainConfiguration());
        $list = $rendererChain->renderList($listData->getListData());
        return $list;
	}
	
}
 
?>
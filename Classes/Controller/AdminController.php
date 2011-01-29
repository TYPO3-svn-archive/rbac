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
     * Holds an instance of rbac extension repository
     *
     * @var Tx_Rbac_Domain_Repository_ExtensionRepository
     */
    protected $extensionRepository;
    
    
    
    /**
     * Holds an instance of rbac user repository
     *
     * @var Tx_Rbac_Domain_Repository_UserRepository
     */
    protected $userRepository;
    
    
    
    /**
     * Holds an instance of fe user repository
     *
     * @var Tx_Extbase_Domain_Repository_FrontendUserRepository
     */
    protected $feUserRepository;
    
    
    
    /**
     * Holds an instance of rbac user repository
     *
     * @var Tx_Rbac_Domain_Repository_RoleRepository
     */
    protected $roleRepository;
    
    
    
    /**
     * Initializes controller before actions are executed
     */
    protected function initializeAction() {
        $this->extensionRepository = t3lib_div::makeInstance('Tx_Rbac_Domain_Repository_ExtensionRepository');
        $this->userRepository = t3lib_div::makeInstance('Tx_Rbac_Domain_Repository_UserRepository');
        $this->roleRepository = t3lib_div::makeInstance('Tx_Rbac_Domain_Repository_RoleRepository');
        $this->feUserRepository = t3lib_div::makeInstance('Tx_Extbase_Domain_Repository_FrontendUserRepository');
    }
    
    
	
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
	 * Setup for RBAC. Sets up all rbac settings for this extension
	 *
	 * @return string Rendered setup action
	 */
	public function setupRbacAction() {
		// Get extension object for RBAC extension
		$extension = $this->extensionRepository->findOrCreateExtension('tx_yag');
        $rbacTsImporter = Tx_Rbac_Domain_TsImporterFactory::getInstanceByExtension($extension);
		
		// Import TS-Setup for RBAC
		$tsArray = $this->settings['rbac'];
		$rbacTsImporter->importTsArray($tsArray);

		// Find fe users and rbac roles
		$feUsersQuery = $this->feUserRepository->createQuery();
		$feUsersQuery->getQuerySettings()->setRespectStoragePage(FALSE);
		$feUsers = $feUsersQuery->execute();
		$roles = $this->roleRepository->findAll();
		
		// Render Form for adding RBAC admin user
		$this->view->assign('tsImported', 1);
		$this->view->assign('feUsers', $feUsers);
		$this->view->assign('roles', $roles);
	}
	
	
	
	/**
	 * Adds a new rbac user for given feUser and role
	 *
	 * @param Tx_Extbase_Domain_Model_FrontendUser $feUser
	 * @param Tx_Rbac_Domain_Model_Role $role
	 */
	public function addRbacUserAction(Tx_Extbase_Domain_Model_FrontendUser $feUser, Tx_Rbac_Domain_Model_Role $role) {
		// Make sure, only one rbac user exists for feUser
		$rbacUser = null;
		if (count($this->userRepository->findByFeUser($feUser)) > 0) {
<<<<<<< HEAD
			print_r('user bereits angelegt, wird geladen');
=======
>>>>>>> aac898ba004322cc78a8f76f4a08bfdc086df3ea
			$rbacUsers = $this->userRepository->findByFeUser($feUser);
			$rbacUser = $rbacUsers[0];
            $rbacUser->setFeUser($feUser);
            $rbacUser->addRole($role);
			$this->userRepository->update($rbacUser);
		} else {
<<<<<<< HEAD
			print_r('neuer User wird angelegt');
=======
>>>>>>> aac898ba004322cc78a8f76f4a08bfdc086df3ea
		    $rbacUser = new Tx_Rbac_Domain_Model_User();
			$rbacUser->setFeUser($feUser);
			$rbacUser->addRole($role);
		    $this->userRepository->add($rbacUser);
		}
		
		// Give some feedback
		$this->view->assign('feUser', $feUser);
		$this->view->assign('role', $role);
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
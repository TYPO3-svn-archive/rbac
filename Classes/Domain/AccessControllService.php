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
 * Class implements an access-controll service for
 * Role-Based Access Controll
<<<<<<< HEAD
=======
 * 
 * Please mind convention: IF WE ARE IN BACKEND MODE - WE HAVE ACCESS TO EVERYTHING!
>>>>>>> aac898ba004322cc78a8f76f4a08bfdc086df3ea
 *
 * @package Domain
 * @author Michael Knoll <mimi@kaktusteam.de>
 */
class Tx_Rbac_Domain_AccessControllService implements Tx_PtExtlist_Domain_StateAdapter_SessionPersistableInterface {

    /**
     * Holds an array of settings for rbac
     * 
     * @var array
     */
    protected $settings;
    
    
    
    /**
     * Holds an instance of an ExtBase repository
     *
     * @var Tx_Extbase_Persistence_Repository
     */
    protected $repository;
    
    
    
    /**
<<<<<<< HEAD
=======
     * Holds an instance of rbac user repository
     *
     * @var Tx_Rbac_Domain_Repository_UserRepository
     */
    protected $rbacUserRepository;
    
    
    
    /**
>>>>>>> aac898ba004322cc78a8f76f4a08bfdc086df3ea
     * Holds an array of cached access rights which is
     * persisted to session after access controll service shuts down.
     * 
     * array has structure
     * array( $user => array( $object => array ($action => true/false) ) ) so you get cached access right via
     * $this->accessCache[$user][$object][$action]
     *
     * @var array
     */
    protected $accessCache;
    
    
<<<<<<< HEAD
=======
    
    /**
     * Holds fe user object of logged in user
     *
     * @var Tx_Extbase_Domain_Model_FrontendUser
     */
    protected $feUser = null;
    
    
    
    /**
     * Holds rbac user for logged in fe user
     *
     * @var Tx_Rbac_Domain_Model_User
     */
    protected $rbacUser = null;
    
    
    
    /**
     * Holds an instance of extbase reflection service
     *
     * @var Tx_Extbase_Reflection_Service
     */
    protected $reflectionService;
    
    
>>>>>>> aac898ba004322cc78a8f76f4a08bfdc086df3ea
	
	/**
	 * @see Tx_PtExtlist_Domain_StateAdapter_IdentifiableInterface::getObjectNamespace()
	 *
	 * @return String
	 */
	public function getObjectNamespace() {
		return 'Tx_Rbac_Domain_AccessControllService';
	}
	
	
	
	/**
	 * @see Tx_PtExtlist_Domain_StateAdapter_SessionPersistableInterface::injectSessionData()
	 *
	 * @param array $sessionData
	 */
	public function injectSessionData(array $sessionData) {
		$this->accessCache = $sessionData['accessCache'];
	}
	
	
	
	/**
<<<<<<< HEAD
=======
	 * Injector for fe user
	 *
	 * @param Tx_Extbase_Domain_Model_FrontendUser $feUser
	 */
	public function injectFeUser(Tx_Extbase_Domain_Model_FrontendUser $feUser) {
		$this->feUser = $feUser;
		$this->rbacUser = $this->rbacUserRepository->findByFeUser($feUser);
	}
	
	
	
	/**
>>>>>>> aac898ba004322cc78a8f76f4a08bfdc086df3ea
	 * @see Tx_PtExtlist_Domain_StateAdapter_SessionPersistableInterface::persistToSession()
	 *
	 */
	public function persistToSession() {
		return array('accessCache' => $this->accessCache);
	}
    
    
    
    /**
<<<<<<< HEAD
     * Returns true, if a given user has access to given object's action
=======
     * Returns true, if a given rbac user uid has access to given object's action
>>>>>>> aac898ba004322cc78a8f76f4a08bfdc086df3ea
     *
     * @param int $userUid Uid of RBAC! user (not fe_user!!!) to request access rights for
     * @param string $object Object to request access rights for
     * @param string $action Action to request access rights for
     * @return bool True, if given user has access to given object and action
     */
<<<<<<< HEAD
    public function hasAccess($user, $object, $action) {
        if (!isset($this->accessCache[$user][$object][$action])) {
        	// We have no cached access right for requested user, object and action so we create one
        	$this->accessCache[$user][$object][$action] = $this->getAccessRightFromDatabase($user,$object,$action);
        }
        
        // We have cached access right, so we can return from cache
        if ($this->accessCache[$user][$object][$action]) {
=======
    public function userUidHasAccess($userUid, $objectName, $actionName) {
    	#print_r("in uiserUIdHasAccess $userUid - objectName: $objectName - actionName: $actionName");
        if (TYPO3_MODE === 'BE') {
            return TRUE;
        }
        if (!isset($this->accessCache[$userUid][$objectName][$actionName])) {
        	// We have no cached access right for requested user, object and action so we create one
        	$this->accessCache[$userUid][$objectName][$actionName] = $this->getAccessRightFromDatabase($userUid,$objectName,$actionName);
        }
        
        // We have cached access right, so we can return from cache
        if ($this->accessCache[$userUid][$objectName][$actionName]) {
>>>>>>> aac898ba004322cc78a8f76f4a08bfdc086df3ea
            return TRUE;	
        } else {
        	return FALSE;
        }
    }
    
    
    
    /**
<<<<<<< HEAD
=======
     * Returns true, if a given rbac user has access to given object and action
     *
     * @param Tx_Rbac_Domain_Model_User $rbacUser
     * @param string $objectName Name of object
     * @param string $actionName Name of action
     * @return bool True, if given user has access to given object and action
     */
    public function rbacUserHasAccess(Tx_Rbac_Domain_Model_User $rbacUser, $objectName, $actionName) {
        if (TYPO3_MODE === 'BE') {
            return TRUE;
        }
    	return $this->userUidHasAccess($rbacUser->getUid(), $objectName, $actionName);
    }
    
    
    
    /**
     * Returns true, if currently logged in user has access to given object and action
     *
     * @param string $objectName
     * @param string $actionName
     * @return bool True, if logged in user has access to given object and action
     */
    public function loggedInUserHasAccess($objectName, $actionName) {
        if (TYPO3_MODE === 'BE') {
            return TRUE;
        }
    	if ($this->feUser !== null) {
    	   return $this->userUidHasAccess($this->rbacUser->getUid(), $objectName, $actionName);
    	} elseif(false) {
    		// implement backend case!
    	} 
    	return false;
    }
    
    
    
    /**
     * Returns true, if logged in user has access to given controller and action
     *
     * @param string $controllerName Name of controller to check access rights for
     * @param string $actionName Name of action to check access rights for
     * @return bool True, if logged in user has access to given action on controller
     */
    public function loggedInUserHasAccessToControllerAndAction($controllerName, $actionName) {
        if (TYPO3_MODE === 'BE') {
            return TRUE;
        }
    	$methodTags = $this->reflectionService->getMethodTagsValues($controllerName, $actionName);
    	if (array_key_exists('rbacNeedsAccess', $methodTags)) {
            if ($this->rbacUser) {
                $rbacObject = $methodTags['rbacObject'][0];
                $rbacAction = $methodTags['rbacAction'][0];
                return $this->userUidHasAccess($this->rbacUser->getUid(), $rbacObject, $rbacAction);
            } else {
            	// Access restrictions and no user --> return false
            	return false;
            }
    	} 
    	// No access restrictions --> return true
    	return true;
    }
    
    
    
    /**
>>>>>>> aac898ba004322cc78a8f76f4a08bfdc086df3ea
     * Executes a SQL-query to gather access-information from database
     *
     * @param int $userUid Uid of RBAC! user (not fe_user!!!) to request access rights for
     * @param string $object Object to request access rights for
     * @param string $action Action to request access rights for
     * @return bool True, if given user has access to given object and action
     */
    protected function getAccessRightFromDatabase($user, $object, $action) {
    	$sql = "
            SELECT is_allowed, t2.name AS privilege, t2.is_singular AS is_privilege_singular, 
                   t4.name AS action, t5.name AS domain, t5.is_singular AS is_domain_singular, 
                   t7.name AS object, t8.name as role, t8.importance 
            FROM tx_rbac_domain_model_privilegeondomain AS t1
                -- Privileges Joins --
                INNER JOIN tx_rbac_domain_model_privilege AS t2 ON t2.uid = t1.privilege
                -- Perhaps you have to change foreign and local -- 
                INNER JOIN tx_rbac_privilege_action_mm AS t3 ON t3.uid_local = t2.uid
                INNER JOIN tx_rbac_domain_model_action AS t4 ON t4.uid = t3.uid_foreign
                -- Domain Joins --
                INNER JOIN tx_rbac_domain_model_domain AS t5 ON t5.uid = t1.domain
                INNER JOIN tx_rbac_domain_object_mm AS t6 ON t6.uid_local = t5.uid
                INNER JOIN tx_rbac_domain_model_object AS t7 ON t7.uid = t6.uid_foreign
                -- Roles to user Joins --
                INNER JOIN tx_rbac_domain_model_role AS t8 ON t8.uid = t1.role
                INNER JOIN tx_rbac_user_role_mm AS t9 ON t9.uid_foreign = t8.uid
            WHERE t9.uid_local = $user AND t4.name = '$action' AND t7.name = '$object'
            ORDER BY t8.importance DESC, t8.name
            ";
            
        #var_dump($sql);
        
        $query = $this->repository->createQuery();
        $query->getQuerySettings()->setReturnRawQueryResult(true);
        $result = $query->statement($sql)->execute();
        
        if (count($result) > 0) {
            foreach($result as $row) {
               if ($row['is_allowed'] == 1) {
                   return true;
               }
            }
        }
        return false;
    }
    
    
    
    /**
     * Injects a repository to create queries with
     *
     * @param Tx_Extbase_Persistence_RepositoryInterface $repository
     */
    public function injectRepository(Tx_Extbase_Persistence_Repository $repository) {
    	$this->repository = $repository;
    }
    
    
    
    /**
     * Returns repository associated with this service
     *
     * @return Tx_Extbase_Persistence_Repository
     */
    public function getRepository() {
    	return $this->repository;
    }
<<<<<<< HEAD
=======
    
    
    
    /**
     * Injector for rbac user repository
     *
     * @param Tx_Rbac_Domain_Repository_UserRepository $rbacUserRepository
     */
    public function injectRbacUserRepository(Tx_Rbac_Domain_Repository_UserRepository $rbacUserRepository) {
    	$this->rbacUserRepository = $rbacUserRepository;
    }
    
    
    
    /**
     * Injector for reflection service
     *
     * @param Tx_Extbase_Reflection_Service $reflectionService
     */
    public function injectReflectionService(Tx_Extbase_Reflection_Service $reflectionService) {
    	$this->reflectionService = $reflectionService;
    }
>>>>>>> aac898ba004322cc78a8f76f4a08bfdc086df3ea

}
 
?>
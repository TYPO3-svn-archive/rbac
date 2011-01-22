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
	public function injectSessionData(array $sessionData = array()) {
		$this->accessCache = $sessionData['accessCache'];
	}
	
	
	
	/**
	 * @see Tx_PtExtlist_Domain_StateAdapter_SessionPersistableInterface::persistToSession()
	 *
	 */
	public function persistToSession() {
		return array('accessCache' => $this->accessCache);
	}
    
    
    
    /**
     * Returns true, if a given user has access to given object's action
     *
     * @param int $userUid Uid of RBAC! user (not fe_user!!!) to request access rights for
     * @param string $object Object to request access rights for
     * @param string $action Action to request access rights for
     * @return bool True, if given user has access to given object and action
     */
    public function hasAccess($user, $object, $action) {
        if (!isset($this->accessCache[$user][$object][$action])) {
        	// We have no cached access right for requested user, object and action so we create one
        	$this->accessCache[$user][$object][$action] = $this->getAccessRightFromDatabase($user,$object,$action);
        }
        
        // We have cached access right, so we can return from cache
        if ($this->accessCache[$user][$object][$action]) {
            return TRUE;	
        } else {
        	return FALSE;
        }
    }
    
    
    
    /**
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

}
 
?>
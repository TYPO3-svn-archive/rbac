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
 * Class for importing rbac settings from TypoScript
 *
 * @package Domain
 * @subpackage Import
 * @author Michael Knoll <mimi@kaktusteam.de>
 */
class Tx_Rbac_Domain_TsImporter {

	/**
	 * Extension that ts importer is working upon
	 *
	 * @var Tx_Rbac_Domain_Model_Extension
	 */
	protected $extension;
	
	
	
	/**
	 * Holds instance of actionRepository
	 *
	 * @var Tx_Rbac_Domain_Repository_ActionRepository
	 */
	protected $actionRepository;
	
	
	
	/**
	 * Holds instance of domain repository
	 *
	 * @var Tx_Rbac_Domain_Repository_DomainRepository
	 */
	protected $domainRepository;
	
	
	
	/**
	 * Holds instance of extension repository
	 *
	 * @var Tx_Rbac_Domain_Repository_ExtensionRepository
	 */
	protected $extensionRepository;
	
	
	
	/**
	 * Holds instance of object repository
	 *
	 * @var Tx_Rbac_Domain_Repository_ObjectRepository
	 */
	protected $objectRepository;
	
	
	
	/**
	 * Holds an instance of privilege repository
	 *
	 * @var Tx_Rbac_Domain_Repository_PrivilegeRepository
	 */
	protected $privilegeRepository;
	
	
	
	/**
	 * Holds instance of privilege-on-domain repository
	 *
	 * @var Tx_Rbac_Domain_Repository_PrivilegeOnDomainRepository
	 */
	protected $privilegeOnDomainRepository;
	
	
	
	/**
	 * Holds instance of role repository
	 *
	 * @var Tx_Rbac_Domain_Repository_RoleRepository
	 */
	protected $roleRepository;
	
	
	
	/**
	 * Holds instance of user repository
	 *
	 * @var Tx_Rbac_Domain_Repository_UserRepository
	 */
	protected $userRepository;
	
	
	
	/**
	 * Constructor for ts importer. Uses given extension for import namespace
	 *
	 * @param Tx_Rbac_Domain_Model_Extension $extension
	 */
	public function __construct(Tx_Rbac_Domain_Model_Extension $extension) {
		$this->extension = $extension;
	}
	
	
	
	/**
	 * Imports all TS settings given by TS array
	 *
	 * @param array $tsArray
	 */
	public function importTsArray($tsArray) {
		$persistenceManager = t3lib_div::makeInstance('Tx_Extbase_Persistence_Manager');
		$this->importActionsByTsArray($tsArray['actions']);
		$persistenceManager->persistAll();
		$this->importObjectsByTsArray($tsArray['objects']);
		$persistenceManager->persistAll();
		$this->importDomainsByTsArray($tsArray['domains']);
		$persistenceManager->persistAll();
		$this->importPrivilegesByTsArray($tsArray['privileges']);
		$persistenceManager->persistAll();
		$this->importRolesByTsArray($tsArray['roles']);
		$persistenceManager->persistAll();
	}
	
	
	
	/**
	 * Imports all actions given in TS array
	 *
	 * @param array $actions
	 */
	protected function importActionsByTsArray($actions) {
		foreach ($actions as $actionName => $actionArray) {
			$this->importActionByNameAndTsArray($actionName, $actionArray);
		}
	}
	
	
	
	/**
	 * Imports all objects given in TS array
	 *
	 * @param array $objects
	 */
	protected function importObjectsByTsArray($objects) {
		foreach ($objects as $objectName => $objectArray) {
			$this->importObjectByNameAndTsArray($objectName, $objectArray);
		}
	}
	
	
	
	/**
	 * Imports all domains given in TS array
	 *
	 * @param array $domains
	 */
	protected function importDomainsByTsArray($domains) {
	    foreach ($domains as $domainName => $domainArray) {
	    	$this->importDomainByNameAndTsArray($domainName, $domainArray);	
	    }
	}
	
	
	
	/**
	 * Imports all privileges given in TS array
	 *
	 * @param array $privileges
	 */
	protected function importPrivilegesByTsArray($privileges) {
	    foreach ($privileges as $privilegeName => $privilegeArray) {
	    	$this->importPrivilegeByNameAndTsArray($privilegeName, $privilegeArray);	
	    }
	}
	
	
	
	/**
	 * Imports all roles given in TS array
	 *
	 * @param array $roles
	 */
	protected function importRolesByTsArray($roles) {
	    foreach ($roles as $roleName => $roleArray) {
	    	$this->importRoleByNameAndTsArray($roleName, $roleArray);
	    }
	}
	
	
	
	/**
	 * Imports an action by its name and a given tsArray
	 *
	 * @param string $objectName
	 * @param array $tsArray
	 */
	public function importActionByNameAndTsArray($actionName, $tsArray) {
		// TODO make sure, action is not inserted twice (by the same name)
		$actionObject = new Tx_Rbac_Domain_Model_Action();
		$actionObject->setName($actionName);
		$actionObject->setDescription($tsArray['description']);
		$this->actionRepository->add($actionObject);
	}
	
	
	
	/**
	 * Imports an object by its name and given tsArray
	 *
	 * @param string $objectName
	 * @param array $tsArray
	 */
	public function importObjectByNameAndTsArray($objectName, $tsArray) {
		// TODO make sure, object is not inserted twice (for the same extension)
		$objectObject = new Tx_Rbac_Domain_Model_Object();
		$objectObject->setName($objectName);
		$objectObject->setDescription($tsArray['description']);
		$objectObject->setExtension($this->extension);
		$this->extension->addObject($objectObject);
		$this->objectRepository->add($objectObject);
	}
	
	
	
	/**
	 * Imports a domain by its name and given tsArray
	 *
	 * @param string $domainName
	 * @param array $tsArray
	 */
	public function importDomainByNameAndTsArray($domainName, $tsArray) {
		// TODO make sure, domain is not inserted twice (for the same extension)
		$domainObject = new Tx_Rbac_Domain_Model_Domain();
		$domainObject->setName($domainName);
		$domainObject->setDescription($tsArray['description']);
		$domainObject->setExtension($this->extension);
		$objectNames = explode(',', $tsArray['objects']);
		foreach ($objectNames as $objectName) {
			$object = $this->objectRepository->findByExtensionAndName($this->extension, trim($objectName)); /* @var $object Tx_Rbac_Domain_Model_Object */
			$domainObject->addObject($object);
			$object->addDomain($domainObject);
		}
		$domainObject->setIsSingular(count($objectNames) > 1 ? false : true);
		$this->extension->addDomain($domainObject);
		$this->domainRepository->add($domainObject);
	}
	
	
	
	/**
	 * Imports a privilege by its name and given tsArray
	 *
	 * @param string $privilegeName
	 * @param array $tsArray
	 */
	public function importPrivilegeByNameAndTsArray($privilegeName, $tsArray) {
		// TODO make sure, privilege is not inserted twice (perhaps we need to add an extension?)
		$privilegeObject = new Tx_Rbac_Domain_Model_Privilege();
		$privilegeObject->setName($privilegeName);
		$actionNames = explode(',', $tsArray['actions']);
		foreach ($actionNames as $actionName) {
			$action = $this->actionRepository->findSingleInstanceByName(trim($actionName));
			$privilegeObject->addAction($action);
		}
		$privilegeObject->setIsSingular(count($actionNames) > 1 ? false : true);
		$this->privilegeRepository->add($privilegeObject);
	}
	
	
	
	/**
	 * Imports a role by its name and given tsArray
	 *
	 * @param string $roleName
	 * @param array $tsArray
	 */
	public function importRoleByNameAndTsArray($roleName, $tsArray) {
		// TODO make sure, role is not inserted twice
		$roleObject = new Tx_Rbac_Domain_Model_Role();
		$roleObject->setName($roleName);
		$roleObject->setDescription($tsArray['description']);
		$roleObject->setImportance($tsArray['importance']);
		foreach ($tsArray['privileges'] as $privilege) {
			$this->importPrivilegeOnDomainByRoleAndTsArray($roleObject, $privilege);
		}
		$this->roleRepository->add($roleObject);
	}
	
	
	
	/**
	 * Imports a privilege on domain object for a given role and ts array
	 *
	 * @param Tx_Rbac_Domain_Model_Role $role
	 * @param array $tsArray
	 * @return Tx_Rbac_Domain_Model_PrivilegeOnDomain
	 */
	protected function importPrivilegeOnDomainByRoleAndTsArray(Tx_Rbac_Domain_Model_Role $role, $tsArray) {
		$privilegeOnDomainObject = new Tx_Rbac_Domain_Model_PrivilegeOnDomain();
		$privilegeOnDomainObject->setIsAllowed($tsArray['isAllowed'] == '1');
		$privilegeOnDomainObject->setRole($role);
		$privilegeOnDomainObject->setPrivilege($this->privilegeRepository->findSingleInstanceByName($tsArray['privilege']));
		$privilegeOnDomainObject->setDomain($this->domainRepository->findByExtensionAndName($this->extension, $tsArray['domain']));
		$this->privilegeOnDomainRepository->add($privilegeOnDomainObject);
		return $privilegeOnDomainObject;
	}
	
	
	
	/**
	 * @return Tx_Rbac_Domain_Repository_ActionRepository
	 */
	public function getActionRepository() {
		return $this->actionRepository;
	}
	
	
	
	/**
	 * @param Tx_Rbac_Domain_Repository_ActionRepository $actionRepository
	 */
	public function injectActionRepository($actionRepository) {
		$this->actionRepository = $actionRepository;
	}
	
	
	
	/**
	 * @return Tx_Rbac_Domain_Repository_DomainRepository
	 */
	public function getDomainRepository() {
		return $this->domainRepository;
	}
	
	
	
	/**
	 * @param Tx_Rbac_Domain_Repository_DomainRepository $domainRepository
	 */
	public function injectDomainRepository($domainRepository) {
		$this->domainRepository = $domainRepository;
	}
	
	
	
	/**
	 * @return Tx_Rbac_Domain_Repository_ExtensionRepository
	 */
	public function getExtensionRepository() {
		return $this->extensionRepository;
	}
	
	
	
	/**
	 * @param Tx_Rbac_Domain_Repository_ExtensionRepository $extensionRepository
	 */
	public function injectExtensionRepository($extensionRepository) {
		$this->extensionRepository = $extensionRepository;
	}
	
	
	
	/**
	 * @return Tx_Rbac_Domain_Repository_ObjectRepository
	 */
	public function getObjectRepository() {
		return $this->objectRepository;
	}
	
	
	
	/**
	 * @param Tx_Rbac_Domain_Repository_ObjectRepository $objectRepository
	 */
	public function injectObjectRepository($objectRepository) {
		$this->objectRepository = $objectRepository;
	}
	
	
	
	/**
	 * @return Tx_Rbac_Domain_Repository_PrivilegeRepository
	 */
	public function getPrivilegeRepository() {
		return $this->privilegeRepository;
	}
	
	
	
	/**
	 * @param Tx_Rbac_Domain_Repository_PrivilegeRepository $privilegeRepository
	 */
	public function injectPrivilegeRepository($privilegeRepository) {
		$this->privilegeRepository = $privilegeRepository;
	}

	
	
	/**
	 * @return Tx_Rbac_Domain_Repository_PrivilegeOnDomainRepository
	 */
	public function getPrivilegeOnDomainRepository() {
		return $this->privilegeOnDomainRepository;
	}
	
	
	
	/**
	 * @param Tx_Rbac_Domain_Repository_PrivilegeOnDomainRepository $privilegeOnDomainRepository
	 */
	public function injectPrivilegeOnDomainRepository($privilegeOnDomainRepository) {
		$this->privilegeOnDomainRepository = $privilegeOnDomainRepository;
	}
	
	
	
	/**
	 * @return Tx_Rbac_Domain_Repository_RoleRepository
	 */
	public function getRoleRepository() {
		return $this->roleRepository;
	}
	
	
	
	/**
	 * @param Tx_Rbac_Domain_Repository_RoleRepository $roleRepository
	 */
	public function injectRoleRepository($roleRepository) {
		$this->roleRepository = $roleRepository;
	}
	
	
	
	/**
	 * @return Tx_Rbac_Domain_Repository_UserRepository
	 */
	public function getUserRepository() {
		return $this->userRepository;
	}
	
	
	
	/**
	 * @param Tx_Rbac_Domain_Repository_UserRepository $userRepository
	 */
	public function injectUserRepository($userRepository) {
		$this->userRepository = $userRepository;
	}
	
	
	
	/**
	 * Returns extension
	 *
	 * @return Tx_Rbac_Domain_Model_Extension
	 */
	public function getExtension() {
		return $this->extension;
	}
		
}
 
?>
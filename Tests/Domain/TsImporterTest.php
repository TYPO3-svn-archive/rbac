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
 * Testcase for 
 *
 * @package rbac
 * @subpackage Tests
 * @author Michael Knoll <mimi@kaktusteam.de>
 */
class Tx_Rbac_Tests_Domain_TsImporterTest extends Tx_Extbase_BaseTestCase  {
     
	/**
	 * Holds an array of sample data for testing
	 *
	 * @var array
	 */
	protected $sampleData;
	
	
	
	/**
	 * Holds an instance of TsImporter
	 *
	 * @var Tx_Rbac_Domain_TsImporter
	 */
	protected $tsImporter;
	
	
	
	protected $extension;
	
	
	
	/**
	 * Set up testcase
	 */
	public function setup() {
		$sampleTsFile = t3lib_div::getFileAbsFileName('EXT:rbac/Tests/Domain/SampleData/setup.ts');
		$sampleTsFileContent = file_get_contents($sampleTsFile);
		$typoScriptParser = t3lib_div::makeInstance('t3lib_TSparser'); /* @var $typoScriptParser t3lib_TSparser */
        $typoScriptParser->parse($sampleTsFileContent);
        $this->sampleData = Tx_Extbase_Utility_TypoScript::convertTypoScriptArrayToPlainArray($typoScriptParser->setup);
        
        $extension = new Tx_Rbac_Domain_Model_Extension();
        $extension->setName('tx_rbac');
        $this->extension = $extension;
        $this->tsImporter = new Tx_Rbac_Domain_TsImporter($this->extension);
	}
	
	
	
	/**
	 * @test
	 */
	public function classExists() {
	    $this->assertTrue(class_exists(Tx_Rbac_Domain_TsImporter));	
	}
	
	
	
	/**
	 * @test
	 */
	public function getExtensionReturnsExtensionInjectedViaConstructor() {
		$extensionMock = $this->getMock('Tx_Rbac_Domain_Model_Extension', array(), array(), '', FALSE);
		$tsImporter = new Tx_Rbac_Domain_TsImporter($extensionMock);
		$this->assertEquals($tsImporter->getExtension(), $extensionMock);
	}
	
	
	
	/**
	 * @test
	 */
	public function importActionByNameAndTsArrayAddsNewActionObjectToActionRepository() {
		$actions = $this->sampleData['plugin']['tx_rbac']['settings']['extSettings']['yag']['actions'];
		$viewAction = $actions['view'];
		$dummyRepository = $this->getDummyRepository();
		$this->tsImporter->injectActionRepository($dummyRepository);
		$this->tsImporter->importActionByNameAndTsArray('view', $viewAction);
		$this->assertEquals($dummyRepository->getDummyValue()->getName(), 'view');
		$this->assertEquals($dummyRepository->getDummyValue()->getDescription(), 'View action');
	}
	
	
	
	/**
	 * @test
	 */
	public function importObjectByNameAndTsArrayAddsNewObjectToObjectRepository() {
		$objects = $this->sampleData['plugin']['tx_rbac']['settings']['extSettings']['yag']['objects'];
		$albumObject = $objects['Album'];
		$dummyRepository = $this->getDummyRepository();
		$this->tsImporter->injectObjectRepository($dummyRepository);
        $this->tsImporter->importObjectByNameAndTsArray('Album', $albumObject);
        $this->assertEquals($dummyRepository->getDummyValue()->getName(), 'Album');
        $this->assertEquals($dummyRepository->getDummyValue()->getDescription(), 'Album class in yag');
        $this->assertEquals($dummyRepository->getDummyValue()->getExtension(), $this->extension);
        $this->assertTrue($dummyRepository->getDummyValue()->getExtension()->getObjects()->contains($dummyRepository->getDummyValue()));
	}
	
	

	/**
	 * @test
	 */
	public function importDomainByNameAndTsArrayAddsNewDomainToDomainRepository() {
		$domains = $this->sampleData['plugin']['tx_rbac']['settings']['extSettings']['yag']['domains'];
		$txYagAllObjectsDomain = $domains['tx_yag_all_objects'];
		$dummyRepository = $this->getDummyRepository();
		$dummyObjectRepository = new Tx_Rbac_Tests_Domain_TsImporterTest_DummyObjectRepository();
		$this->tsImporter->injectDomainRepository($dummyRepository);
		$this->tsImporter->injectObjectRepository($dummyObjectRepository);
		$this->tsImporter->importDomainByNameAndTsArray('tx_yag_all_objects', $txYagAllObjectsDomain);
		$this->assertEquals($dummyRepository->getDummyValue()->getName(), 'tx_yag_all_objects');
		$this->assertTrue($dummyRepository->getDummyValue()->getExtension()->getDomains()->contains($dummyRepository->getDummyValue()));
		$this->assertTrue(count($dummyRepository->getDummyValue()->getObjects()) == 4);
		$this->assertTrue(!$dummyRepository->getDummyValue()->getIsSingular());
	}
	
	

	/**
	 * @test
	 */
	public function importPrivilegeByNameAndTsArrayAddsNewPrivilegeToPrivilegeRepository() {
		$privileges = $this->sampleData['plugin']['tx_rbac']['settings']['extSettings']['yag']['privileges'];
        $allActionsPrivilege = $privileges['all_actions'];
        $dummyRepository = $this->getDummyRepository();
        $this->tsImporter->injectPrivilegeRepository($dummyRepository);
        $this->tsImporter->injectActionRepository(new Tx_Rbac_Tests_Domain_TsImporterTest_DummyActionRepository());
        $this->tsImporter->importPrivilegeByNameAndTsArray('all_actions', $allActionsPrivilege);
        $this->assertEquals($dummyRepository->getDummyValue()->getName(), 'all_actions');
        $this->assertEquals(count($dummyRepository->getDummyValue()->getActions()), 5);
        $this->assertTrue(!$dummyRepository->getDummyValue()->getIsSingular());
	}
	
	

	/**
	 * @test
	 */
	public function importRoleByNameAndTsArrayAddsNewRoleToRoleRepository() {
		$roles = $this->sampleData['plugin']['tx_rbac']['settings']['extSettings']['yag']['roles'];
		$administratorRole = $roles['administrator'];
		$dummyRepository = $this->getDummyRepository();
		$this->tsImporter->injectRoleRepository($dummyRepository);
		$privilegeOnDomainRepository = $this->getDummyRepository();
		$this->tsImporter->injectPrivilegeRepository(new Tx_Rbac_Tests_Domain_TsImporterTest_DummyPrivilegeRepository());
		$this->tsImporter->injectDomainRepository(new Tx_Rbac_Tests_Domain_TsImporterTest_DummyDomainRepository());
		$this->tsImporter->injectPrivilegeOnDomainRepository($privilegeOnDomainRepository);
		
		$this->tsImporter->importRoleByNameAndTsArray('administrator', $administratorRole);
		$role = $dummyRepository->getDummyValue();
		$this->assertEquals($role->getName(), 'administrator');
		$this->assertEquals($role->getDescription(), 'Role for all administrators having full access to all functions on all objects');
		$this->assertEquals($role->getImportance(), 100);
		
		$privilegeOnDomain = $privilegeOnDomainRepository->getDummyValue();
		$this->assertEquals($privilegeOnDomain->getDomain()->getName(), 'tx_yag_all_objects');
		$this->assertEquals($privilegeOnDomain->getPrivilege()->getname(), 'all_actions');
		$this->assertEquals($privilegeOnDomain->getRole()->getName(), 'administrator');
		$this->assertEquals($privilegeOnDomain->getIsAllowed(), true);
	}
	
	
	
	/**
	 * @test
	 */
	public function gettersReturnInjectedRepositories() {
		$repositories = array(
		    'Tx_Rbac_Domain_Repository_ActionRepository',
		    'Tx_Rbac_Domain_Repository_DomainRepository',
		    'Tx_Rbac_Domain_Repository_ExtensionRepository',
		    'Tx_Rbac_Domain_Repository_ObjectRepository',
		    'Tx_Rbac_Domain_Repository_PrivilegeRepository',
		    'Tx_Rbac_Domain_Repository_PrivilegeOnDomainRepository',
		    'Tx_Rbac_Domain_Repository_RoleRepository',
		    'Tx_Rbac_Domain_Repository_UserRepository'
		);
		
		foreach($repositories as $repositoryClass) {
			$repositoryMock = $this->getRepositoryMock($repositoryClass);
			$injectorName = 'inject' . substr($repositoryClass, 26);
			$getterName = 'get' . substr($repositoryClass, 26);
			$this->tsImporter->$injectorName($repositoryMock);
			$this->assertEquals($this->tsImporter->$getterName(), $repositoryMock);
		}
	}
	
	
	
	/**
	 * Returns mock for given repository class
	 *
	 * @param string $repositoryClass
	 * @return mixed Mock for given repository class
	 */
	protected function getRepositoryMock($repositoryClass) {
		return $this->getMock($repositoryClass, array(), array(), '', FALSE);
	}
	
	
	
	/**
	 * Returns true, if 2 domain objects have equal properties exported via getters
	 *
	 * @param mixed $object1
	 * @param mixed $object2
	 * @param bool $dontRespectUid If set to true, value of UID is not compared
	 * @return bool True, if both models are equal concerning their properties exported by getters
	 */
	protected function modelsAreEqual($object1, $object2, $dontRespectUid = true) {
		foreach(get_class_methods($object1) as $method) {
			if ($dontRespectUid && $method == 'getUid') {
				next;
			}
			if (substr($method, 0, 3) == 'get') {
				if (method_exists($object2, $method)) {
					if ($object1->$method() === $object2->$method()) {
						return true;
					}
				}
			}
		}
		return false;
	}
	
	
	
	/**
	 * Returns an instance of a dummy repository for testing
	 * added values
	 * 
	 * @return Tx_Rbac_Tests_Domain_TsImporterTest_DummyRepository
	 */
	protected function getDummyRepository() {
		return new Tx_Rbac_Tests_Domain_TsImporterTest_DummyRepository();
	}
	
}



class Tx_Rbac_Tests_Domain_TsImporterTest_DummyRepository {
	
	protected $dummyValue;
	
	
	public function add($object) {
		$this->dummyValue = $object;
	}
	
	
	
	public function getDummyValue() {
		return $this->dummyValue;
	}
	
}



class Tx_Rbac_Tests_Domain_TsImporterTest_DummyObjectRepository {
	
	public function findByExtensionAndName($extension, $name) {
		$object = new Tx_Rbac_Domain_Model_Object();
		$object->setExtension($extension);
		$object->setName($name);
		return $object;
	}
	
}



class Tx_Rbac_Tests_Domain_TsImporterTest_DummyDomainRepository {
    
    public function findByExtensionAndName($extension, $name) {
        $domain = new Tx_Rbac_Domain_Model_Domain();
        $domain->setExtension($extension);
        $domain->setName($name);
        return $domain;
    }
    
}



class Tx_Rbac_Tests_Domain_TsImporterTest_DummyActionRepository {
    
    public function findByName($name) {
        $action = new Tx_Rbac_Domain_Model_Action();
        $action->setName($name);
        return $action;
    }
    
}



class Tx_Rbac_Tests_Domain_TsImporterTest_DummyPrivilegeRepository {
    
    public function findByName($name) {
        $privilege = new Tx_Rbac_Domain_Model_Privilege();
        $privilege->setName($name);
        return $privilege;
    }
    
}

?>
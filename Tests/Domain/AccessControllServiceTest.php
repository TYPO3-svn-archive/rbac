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
 * Testcase for access controll service
 *
 * @package Tests
 * @subpackage Domain
 * @author Michael Knoll <mimi@kaktusteam.de>
 */
class Tx_Rbac_Tests_Domain_AccessControllServiceTest extends Tx_Extbase_BaseTestCase {
     
	/**
	 * Holds an example resultset for SQL query
	 *
	 * @var unknown_type
	 */
	protected $exampleResultset = array(
	   array(
		   'is_allowed' => '1', 
		   'privilege' => 'sample_privilege', 
		   'is_privilege_singular' => 0, 
	       'action' => 'sample_action', 
		   'domain' => 'sample_domain', 
		   'is_domain_singular' => 0, 
	       'object' => 'sample_object', 
		   'role' => 'sample_role', 
		   'importance' => 100
	   )
	);

	
	
	/**
	 * @test
	 */
	public function classExistsAndCanBeLoaded() {
		$this->assertTrue(class_exists(Tx_Rbac_Domain_AccessControllService));
	}
	
	
	
	/**
	 * @test
	 */
	public function getRepositoryReturnsInjectedRepository() {
		$repositoryMock = $this->getMock('Tx_Extbase_Persistence_Repository',array(), array(), '', FALSE);
		$accessControllService = new Tx_Rbac_Domain_AccessControllService();
		$accessControllService->injectRepository($repositoryMock);
		$this->assertEquals($accessControllService->getRepository(), $repositoryMock);
	}
	
	
	
	/**
	 * @test
	 */
	public function hasAccessReturnsTrueIfQueryReturnsNonEmptyRowset() {
		$repositoryMock = $this->getRepositoryThatCreatesGivenQueryObject($this->getQueryObjectForGivenResult($this->exampleResultset));
		$accessControllService = $this->getAccessControllServiceInstance();
		$accessControllService->injectRepository($repositoryMock);
		$this->assertTrue($accessControllService->hasAccess(1, 'object', 'action'));
	}
	
	
	
	/**
	 * @test
	 */
	public function hasAccessReturnsFalseIfQueryReturnsEmptyRowset() {
		$repositoryMock = $this->getRepositoryThatCreatesGivenQueryObject($this->getQueryObjectForGivenResult(array()));
		$accessControllService = $this->getAccessControllServiceInstance();
		$accessControllService->injectRepository($repositoryMock);
		$this->assertTrue(!$accessControllService->hasAccess(1, 'object', 'action'));
	}
	
	
	
	/**
	 * Returns an instance of access controll service
	 *
	 * @return Tx_Rbac_Domain_AccessControllService
	 */
	protected function getAccessControllServiceInstance() {
		$accessControllService = new Tx_Rbac_Domain_AccessControllService();
		return $accessControllService;
	}
	
	
	
	/**
	 * Returns a repository mock that will return given query, when createQuery() is called
	 *
	 * @param Tx_Extbase_Persistence_Query $queryObject
	 * @return Tx_Extbase_Persistence_Repository Repository mock
	 */
	protected function getRepositoryThatCreatesGivenQueryObject($queryObject) {
		$repositoryMock = $this->getMock('Tx_Extbase_Persistence_Repository',array(), array(), '', FALSE);
		$repositoryMock->expects($this->any())->method('createQuery')->will($this->returnValue($queryObject));
		return $repositoryMock;
	}
	
	
	
	/**
	 * Returns a query object that will return a given result
	 *
	 * @param mixed $result Result to be returned by QO's execute() method
	 * @return Tx_Extbase_Persistence_Query Query object mock
	 */
	protected function getQueryObjectForGivenResult($result) {
		$querySettingsMock = $this->getMock('Tx_Extbase_Persistence_Typo3QuerySettings', array(), array(), '', FALSE);
		$querySettingsMock->expects($this->any())->method('setReturnRawQueryResult');
		
		$queryMock = $this->getMock('Tx_Extbase_Persistence_Query', array(), array(), '', FALSE);
		$queryMock->expects($this->any())->method('getQuerySettings')->will($this->returnValue($querySettingsMock));
		$queryMock->expects($this->any())->method('statement')->will($this->returnValue($queryMock));
		$queryMock->expects($this->any())->method('execute')->will($this->returnValue($result));
		return $queryMock;
	}
	
	
	
	
}

?>
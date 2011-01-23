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
 * Object Repository for Role-Base Access Controll
 *
 * @package Domain
 * @subpackage Import
 * @author Michael Knoll <mimi@kaktusteam.de>
 */
class Tx_Rbac_Domain_Repository_ObjectRepository extends Tx_Extbase_Persistence_Repository {
	
	/**
	 * Finds an object by given extension and name
	 *
	 * @param Tx_Rbac_Domain_Model_Extension $extension
	 * @param string $name
	 * @return Tx_Rbac_Domain_Model_Object
	 */
	public function findSingleInstanceByExtensionAndName(Tx_Rbac_Domain_Model_Extension $extension, $name) {
		$query = $this->createQuery();
		$query->matching($query->logicalAnd($query->equals('extension', $extension->getUid()), $query->equals('name', $name)));
		$result = $query->execute();
		if (count($result) > 1) throw new Exception('More than one object found for query settings. This should not be! 1295024084');
		return count($result) == 1 ? $result[0] : null;
	}
	
	
	
	/**
	 * Adds an object to repository if it does not exist yet
	 *
	 * @param Tx_Rbac_Domain_Model_Object $object
	 */
	public function addIfNotExists(Tx_Rbac_Domain_Model_Object $object) {
		print_r($object->getName());
		print_r($object->getExtension()->getUid());
		print_r(count($this->findByExtensionAndName($object->getExtension()->getUid(), $object->getName())));
		if (!(count($this->findByExtensionAndName($object->getExtension()->getUid(), $object->getName())) > 0)) {
			print_r('Adding object');
			$this->add($object);
		}
	}
	
	
	
	/**
	 * Finds objects by given extension and object name
	 *
	 * @param int $extensionUid
	 * @param string $objectName
	 * @return array<Tx_Rbac_Domain_Model_Object> Array of Tx_Rbac_Domain_Model_Object
	 */
	public function findByExtensionAndName($extensionUid, $objectName) {
		$query = $this->createQuery();
		$query->getQuerySettings()->setRespectStoragePage(FALSE);
		$query->matching($query->logicalAnd($query->equals('extension', $extensionUid), $query->equals('name', $objectName)));
		return $query->execute();
	}
	
}
 
?>
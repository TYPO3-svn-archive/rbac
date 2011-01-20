<?php

/***************************************************************
*  Copyright notice
*
*  (c) 2011 Michael Knoll <mimi@kaktusteam.de>, MKLV GbR
*  			
*  All rights reserved
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
 * Domain
 *
 * @version $Id$
 * @copyright Copyright belongs to the respective authors
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 */
class Tx_Rbac_Domain_Model_Domain extends Tx_Extbase_DomainObject_AbstractEntity {
	
	/**
	 * name
	 * @var string
	 * @validate NotEmpty
	 */
	protected $name;
	
	/**
	 * description
	 * @var string
	 */
	protected $description;
	
	/**
	 * isSingular
	 * @var boolean
	 */
	protected $isSingular;
	
	/**
	 * objects
	 * @var Tx_Extbase_Persistence_ObjectStorage<Tx_Rbac_Domain_Model_Object>
	 */
	protected $objects;
	
	/**
	 * extension
	 * @var Tx_Rbac_Domain_Model_Extension
	 */
	protected $extension;
	
	
	
	/**
	 * Constructor for domain object.
	 */
	public function __construct() {
		$this->objects = new Tx_Extbase_Persistence_ObjectStorage();
	}
	
	
	
	/**
	 * Setter for name
	 *
	 * @param string $name name
	 * @return void
	 */
	public function setName($name) {
		$this->name = $name;
	}

	/**
	 * Getter for name
	 *
	 * @return string name
	 */
	public function getName() {
		return $this->name;
	}
	
	/**
	 * Setter for description
	 *
	 * @param string $description description
	 * @return void
	 */
	public function setDescription($description) {
		$this->description = $description;
	}

	/**
	 * Getter for description
	 *
	 * @return string description
	 */
	public function getDescription() {
		return $this->description;
	}
	
	/**
	 * Setter for isSingular
	 *
	 * @param boolean $isSingular isSingular
	 * @return void
	 */
	public function setIsSingular($isSingular) {
		$this->isSingular = $isSingular;
	}

	/**
	 * Getter for isSingular
	 *
	 * @return boolean isSingular
	 */
	public function getIsSingular() {
		return $this->isSingular;
	}
	
	/**
	 * Returns the boolean state of isSingular
	 *
	 * @return boolean The state of isSingular
	 */
	public function isIsSingular() {
		return $this->getIsSingular();
	}
	
	/**
	 * Setter for objects
	 *
	 * @param Tx_Extbase_Persistence_ObjectStorage<Tx_Rbac_Domain_Model_Object> $objects objects
	 * @return void
	 */
	public function setObjects(Tx_Extbase_Persistence_ObjectStorage $objects) {
		$this->objects = $objects;
	}

	/**
	 * Getter for objects
	 *
	 * @return Tx_Extbase_Persistence_ObjectStorage<Tx_Rbac_Domain_Model_Object> objects
	 */
	public function getObjects() {
		return $this->objects;
	}
	
	/**
	 * Adds a Object
	 *
	 * @param Tx_Rbac_Domain_Model_Object The Object to be added
	 * @return void
	 */
	public function addObject(Tx_Rbac_Domain_Model_Object $object) {
		$this->objects->attach($object);
	}
	
	/**
	 * Removes a Object
	 *
	 * @param Tx_Rbac_Domain_Model_Object The Object to be removed
	 * @return void
	 */
	public function removeObject(Tx_Rbac_Domain_Model_Object $object) {
		$this->objects->detach($object);
	}
	
	/**
	 * Setter for extension
	 *
	 * @param Tx_Rbac_Domain_Model_Extension $extension extension
	 * @return void
	 */
	public function setExtension(Tx_Rbac_Domain_Model_Extension $extension) {
		$this->extension = $extension;
	}

	/**
	 * Getter for extension
	 *
	 * @return Tx_Extbase_Persistence_ObjectStorage<Tx_Rbac_Domain_Model_Extension> extension
	 */
	public function getExtension() {
		return $this->extension;
	}
	
	/**
	 * Adds a Extension
	 *
	 * @param Tx_Rbac_Domain_Model_Extension The Extension to be added
	 * @return void
	 */
	public function addExtension(Tx_Rbac_Domain_Model_Extension $extension) {
		$this->extension->attach($extension);
	}
	
	/**
	 * Removes a Extension
	 *
	 * @param Tx_Rbac_Domain_Model_Extension The Extension to be removed
	 * @return void
	 */
	public function removeExtension(Tx_Rbac_Domain_Model_Extension $extension) {
		$this->extension->detach($extension);
	}
	
}
?>
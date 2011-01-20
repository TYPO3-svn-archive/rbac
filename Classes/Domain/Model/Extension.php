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
 * Extension
 *
 * @version $Id$
 * @copyright Copyright belongs to the respective authors
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 */
class Tx_Rbac_Domain_Model_Extension extends Tx_Extbase_DomainObject_AbstractEntity {
	
	/**
	 * name
	 * @var string
	 */
	protected $name;
	
	/**
	 * domains
	 * @var Tx_Extbase_Persistence_ObjectStorage<Tx_Rbac_Domain_Model_Domain>
	 */
	protected $domains;
	
	/**
	 * objects
	 * @var Tx_Extbase_Persistence_ObjectStorage<Tx_Rbac_Domain_Model_Object>
	 */
	protected $objects;
	
	/**
	 * Constructor. Initializes all Tx_Extbase_Persistence_ObjectStorage instances.
	 */
	public function __construct() {
		$this->domains = new Tx_Extbase_Persistence_ObjectStorage();
		
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
	 * Setter for domains
	 *
	 * @param Tx_Extbase_Persistence_ObjectStorage<Tx_Rbac_Domain_Model_Domain> $domains domains
	 * @return void
	 */
	public function setDomains(Tx_Extbase_Persistence_ObjectStorage $domains) {
		$this->domains = $domains;
	}

	/**
	 * Getter for domains
	 *
	 * @return Tx_Extbase_Persistence_ObjectStorage<Tx_Rbac_Domain_Model_Domain> domains
	 */
	public function getDomains() {
		return $this->domains;
	}
	
	/**
	 * Adds a Domain
	 *
	 * @param Tx_Rbac_Domain_Model_Domain The Domain to be added
	 * @return void
	 */
	public function addDomain(Tx_Rbac_Domain_Model_Domain $domain) {
		$this->domains->attach($domain);
	}
	
	/**
	 * Removes a Domain
	 *
	 * @param Tx_Rbac_Domain_Model_Domain The Domain to be removed
	 * @return void
	 */
	public function removeDomain(Tx_Rbac_Domain_Model_Domain $domain) {
		$this->domains->detach($domain);
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
	
}
?>
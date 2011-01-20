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
 * Object
 *
 * @version $Id$
 * @copyright Copyright belongs to the respective authors
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 */
class Tx_Rbac_Domain_Model_Object extends Tx_Extbase_DomainObject_AbstractEntity {
	
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
	 * domains
	 * @var Tx_Extbase_Persistence_ObjectStorage<Tx_Rbac_Domain_Model_Domain>
	 */
	protected $domains;
	
	/**
	 * extension
	 * @var Tx_Rbac_Domain_Model_Extension
	 */
	protected $extension;
	
	
	
	public function __construct() {
		$this->domains = new Tx_Extbase_Persistence_ObjectStorage();
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
	 * @return Tx_Rbac_Domain_Model_Extension extension
	 */
	public function getExtension() {
		return $this->extension;
	}
	
}
?>
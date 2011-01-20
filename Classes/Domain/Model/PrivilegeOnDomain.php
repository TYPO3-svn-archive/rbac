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
 * PrivilegeOnDomain
 *
 * @version $Id$
 * @copyright Copyright belongs to the respective authors
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 */
class Tx_Rbac_Domain_Model_PrivilegeOnDomain extends Tx_Extbase_DomainObject_AbstractEntity {
	
	/**
	 * isAllowed
	 * @var boolean
	 */
	protected $isAllowed;
	
	/**
	 * privilege
	 * @var Tx_Rbac_Domain_Model_Privilege
	 */
	protected $privilege;
	
	/**
	 * role
	 * @var Tx_Rbac_Domain_Model_Role
	 */
	protected $role;
	
	/**
	 * domain
	 * @var Tx_Rbac_Domain_Model_Domain
	 */
	protected $domain;
	
	
	
	/**
	 * Setter for isAllowed
	 *
	 * @param boolean $isAllowed isAllowed
	 * @return void
	 */
	public function setIsAllowed($isAllowed) {
		$this->isAllowed = $isAllowed;
	}

	/**
	 * Getter for isAllowed
	 *
	 * @return boolean isAllowed
	 */
	public function getIsAllowed() {
		return $this->isAllowed;
	}
	
	/**
	 * Returns the boolean state of isAllowed
	 *
	 * @return boolean The state of isAllowed
	 */
	public function isIsAllowed() {
		return $this->getIsAllowed();
	}
	
	/**
	 * Setter for privilege
	 *
	 * @param Tx_Rbac_Domain_Model_Privilege $privilege privilege
	 * @return void
	 */
	public function setPrivilege(Tx_Rbac_Domain_Model_Privilege $privilege) {
		$this->privilege = $privilege;
	}

	/**
	 * Getter for privilege
	 *
	 * @return Tx_Rbac_Domain_Model_Privilege privilege
	 */
	public function getPrivilege() {
		return $this->privilege;
	}
	
	/**
	 * Setter for role
	 *
	 * @param Tx_Rbac_Domain_Model_Role $role role
	 * @return void
	 */
	public function setRole(Tx_Rbac_Domain_Model_Role $role) {
		$this->role = $role;
	}

	/**
	 * Getter for role
	 *
	 * @return Tx_Rbac_Domain_Model_Role role
	 */
	public function getRole() {
		return $this->role;
	}
	
	/**
	 * Setter for domain
	 *
	 * @param Tx_Rbac_Domain_Model_Domain $domain domain
	 * @return void
	 */
	public function setDomain(Tx_Rbac_Domain_Model_Domain $domain) {
		$this->domain = $domain;
	}

	/**
	 * Getter for domain
	 *
	 * @return Tx_Rbac_Domain_Model_Domain domain
	 */
	public function getDomain() {
		return $this->domain;
	}
	
}
?>
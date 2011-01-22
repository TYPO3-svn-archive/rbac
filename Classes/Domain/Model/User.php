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
 * User
 *
 * @version $Id$
 * @copyright Copyright belongs to the respective authors
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 */
class Tx_Rbac_Domain_Model_User extends Tx_Extbase_DomainObject_AbstractEntity {
	
	/**
	 * roles
	 * @var Tx_Extbase_Persistence_ObjectStorage<Tx_Rbac_Domain_Model_Role>
	 */
	protected $roles;
	
	
	
	/**
	 * Holds a frontend user instance
	 *
	 * @var Tx_Extbase_Domain_Model_FrontendUser
	 */
	protected $feUser;
	
	
	
	/**
	 * @return Tx_Extbase_Domain_Model_FrontendUser
	 */
	public function getFeUser() {
		return $this->feUser;
	}

	
	
	/**
	 * Initializes object
	 */
	public function __construct() {
		$this->roles = new Tx_Extbase_Persistence_ObjectStorage();
	}
	
	
	
	/**
	 * @param Tx_Extbase_Domain_Model_FrontendUser $feUser
	 */
	public function setFeUser(Tx_Extbase_Domain_Model_FrontendUser $feUser) {
		$this->feUser = $feUser;
	}
	
	
	
	/**
	 * Setter for roles
	 *
	 * @param Tx_Extbase_Persistence_ObjectStorage<Tx_Rbac_Domain_Model_Role> $roles roles
	 * @return void
	 */
	public function setRoles(Tx_Extbase_Persistence_ObjectStorage $roles) {
		$this->roles = $roles;
	}

	
	
	/**
	 * Getter for roles
	 *
	 * @return Tx_Extbase_Persistence_ObjectStorage<Tx_Rbac_Domain_Model_Role> roles
	 */
	public function getRoles() {
		return $this->roles;
	}
	
	
	
	/**
	 * Adds a Role
	 *
	 * @param Tx_Rbac_Domain_Model_Role The Role to be added
	 * @return void
	 */
	public function addRole(Tx_Rbac_Domain_Model_Role $role) {
		$this->roles->attach($role);
	}
	
	
	
	/**
	 * Removes a Role
	 *
	 * @param Tx_Rbac_Domain_Model_Role The Role to be removed
	 * @return void
	 */
	public function removeRole(Tx_Rbac_Domain_Model_Role $role) {
		$this->roles->detach($role);
	}
	
}
?>
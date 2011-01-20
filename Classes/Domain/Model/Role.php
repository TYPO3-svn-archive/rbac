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
 * Role
 *
 * @version $Id$
 * @copyright Copyright belongs to the respective authors
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 */
class Tx_Rbac_Domain_Model_Role extends Tx_Extbase_DomainObject_AbstractEntity {
	
	/**
	 * Name of role
	 * @var string
	 * @validate NotEmpty
	 */
	protected $name;
	
	/**
	 * Description for role
	 * @var string
	 */
	protected $description;
	
	/**
	 * importance
	 * @var integer
	 * @validate NotEmpty
	 */
	protected $importance;
	
	/**
	 * users
	 * @var Tx_Extbase_Persistence_ObjectStorage<Tx_Rbac_Domain_Model_User>
	 */
	protected $users;
	
	
	
	/**
	 * Setter for name
	 *
	 * @param string $name Name of role
	 * @return void
	 */
	public function setName($name) {
		$this->name = $name;
	}

	/**
	 * Getter for name
	 *
	 * @return string Name of role
	 */
	public function getName() {
		return $this->name;
	}
	
	/**
	 * Setter for description
	 *
	 * @param string $description Description for role
	 * @return void
	 */
	public function setDescription($description) {
		$this->description = $description;
	}

	/**
	 * Getter for description
	 *
	 * @return string Description for role
	 */
	public function getDescription() {
		return $this->description;
	}
	
	/**
	 * Setter for importance
	 *
	 * @param integer $importance importance
	 * @return void
	 */
	public function setImportance($importance) {
		$this->importance = $importance;
	}

	/**
	 * Getter for importance
	 *
	 * @return integer importance
	 */
	public function getImportance() {
		return $this->importance;
	}
	
	/**
	 * Setter for users
	 *
	 * @param Tx_Extbase_Persistence_ObjectStorage<Tx_Rbac_Domain_Model_User> $users users
	 * @return void
	 */
	public function setUsers(Tx_Extbase_Persistence_ObjectStorage $users) {
		$this->users = $users;
	}

	/**
	 * Getter for users
	 *
	 * @return Tx_Extbase_Persistence_ObjectStorage<Tx_Rbac_Domain_Model_User> users
	 */
	public function getUsers() {
		return $this->users;
	}
	
	/**
	 * Adds a User
	 *
	 * @param Tx_Rbac_Domain_Model_User The User to be added
	 * @return void
	 */
	public function addUser(Tx_Rbac_Domain_Model_User $user) {
		$this->users->attach($user);
	}
	
	/**
	 * Removes a User
	 *
	 * @param Tx_Rbac_Domain_Model_User The User to be removed
	 * @return void
	 */
	public function removeUser(Tx_Rbac_Domain_Model_User $user) {
		$this->users->detach($user);
	}
	
}
?>
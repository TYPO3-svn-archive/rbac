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
 * Role Repository for Role-Base Access Controll
 *
 * @package Domain
 * @subpackage Import
 * @author Michael Knoll <mimi@kaktusteam.de>
 */
class Tx_Rbac_Domain_Repository_RoleRepository extends Tx_Extbase_Persistence_Repository {
	
	/**
	 * Adds a role if it does not exist or updates it if it does exist
	 *
	 * @param Tx_Rbac_Domain_Model_Role $role
	 */
	public function addIfNotExists(Tx_Rbac_Domain_Model_Role $role) {
		if (!(count($this->findByName($role->getName())) > 0)) {
			$this->add($role);
		} else {
			$this->update($role);
		}
	}
	
}
 
?>
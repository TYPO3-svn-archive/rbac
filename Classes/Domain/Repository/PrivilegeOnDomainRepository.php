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
 * Privilege-on-Domain Repository for Role-Base Access Controll
 *
 * @package Domain
 * @subpackage Import
 * @author Michael Knoll <mimi@kaktusteam.de>
 */
class Tx_Rbac_Domain_Repository_PrivilegeOnDomainRepository extends Tx_Extbase_Persistence_Repository {

	/**
	 * Finds privilege on domain objects for given role, privilege and domain
	 *
	 * @param Tx_Rbac_Domain_Model_Role $role
	 * @param Tx_Rbac_Domain_Model_Privilege $privilege
	 * @param Tx_Rbac_Domain_Model_Domain $domain
	 */
	public function findByRoleAndPrivilegeAndDomain(Tx_Rbac_Domain_Model_Role $role, Tx_Rbac_Domain_Model_Privilege $privilege, Tx_Rbac_Domain_Model_Domain $domain) {
		$query = $this->createQuery();
		$query->getQuerySettings()->setRespectStoragePage(FALSE);
		$query->matching($query->logicalAnd($query->logicalAnd($query->equals('role', $role), $query->equals('privilege', $privilege)), $query->equals('domain', $domain)));
		return $query->execute();
	}
	
	
	
	/**
	 * Adds a given privilege on domain if it does not exist yet. (Compared by privilege, role and domain)
	 *
	 * @param Tx_Rbac_Domain_Model_PrivilegeOnDomain $privilegeOnDomain
	 */
	public function addIfNotExists(Tx_Rbac_Domain_Model_PrivilegeOnDomain $privilegeOnDomain) {
		if (!(count($this->findByRoleAndPrivilegeAndDomain($privilegeOnDomain->getRole(), $privilegeOnDomain->getPrivilege(), $privilegeOnDomain->getDomain())) > 0)) {
			$this->add($privilegeOnDomain);
		}
	}
	
}
 
?>
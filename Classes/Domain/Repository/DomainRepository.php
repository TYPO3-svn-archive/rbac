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
 * Domain Repository for Role-Base Access Controll
 *
 * @package Domain
 * @subpackage Import
 * @author Michael Knoll <mimi@kaktusteam.de>
 */
class Tx_Rbac_Domain_Repository_DomainRepository extends Tx_Extbase_Persistence_Repository {
	
	/**
	 * Adds a domain to repository if it does not exist. Else updates it.
	 *
	 * @param Tx_Rbac_Domain_Model_Domain $domain
	 */
	public function addIfNotExists(Tx_Rbac_Domain_Model_Domain $domain) {
		if (!(count($this->findByExtensionAndName($domain->getExtension(), $domain->getName())))) {
			$this->add($domain);
		} else {
			$existingDomains = $this->findByExtensionAndName($domain->getExtension(), $domain->getName());
			$existingDomain = $existingDomains[0]; /* @var $existingDomain Tx_Rbac_Domain_Model_Domain */
			$existingDomain->setIsSingular($domain->isIsSingular());
			$existingDomain->setObjects($domain->getObjects());
			$this->update($existingDomain);
		}
	}
	
	
	
	/**
	 * Finds domains for given extension and domain name
	 *
	 * @param Tx_Rbac_Domain_Model_Extension $extension
	 * @param string $domainName
	 * @return array<Tx_Rbac_Domain_Model_Domain>
	 */
	public function findByExtensionAndName(Tx_Rbac_Domain_Model_Extension $extension, $domainName) {
		$query = $this->createQuery();
        $result = $query->matching($query->logicalAnd($query->equals('extension', $extension), $query->equals('name', $domainName)))->execute();
        return $result;
	}
	
	
	
	/**
	 * Finds a domain by given extension and domain name
	 *
	 * @param Tx_Rbac_Domain_Model_Extension $extension
	 * @param string $domainName
	 * @return Tx_Rbac_Domain_Model_Extension
	 */
	public function findSingleInstanceByExtensionAndName(Tx_Rbac_Domain_Model_Extension $extension, $domainName) {
		$result = $this->findByExtensionAndName($extension, $domainName);
		if (count($result) == 1) return $result[0];
		else throw new Exception('None or more than one Domain ('.count($result).') found by extension and name. This sould not be! 1295024087');
	}
	
}
 
?>
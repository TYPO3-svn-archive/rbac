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
 * Class implements a factory for a Ts importer instance 
 *
 * @package Domain
 * @author Michael Knoll <mimi@kaktusteam.de>
 */
class Tx_Rbac_Domain_TsImporterFactory {
	
	/**
	 * Holds an array of instances for extensions
	 * 
	 * array ( $extension => instance )
	 *
	 * @var array
	 */
	private static $instances = array();
	
	
	
	/**
	 * Singleton method returns singleton instance of ts importer for each extension
	 *
	 * @param Tx_Rbac_Domain_Model_Extension $extension
	 * @return Tx_Rbac_Domain_TsImporter
	 */
	public static function getInstanceByExtension(Tx_Rbac_Domain_Model_Extension $extension) {
		if (!array_key_exists($extension->getName(), self::$instances) || is_null(self::$instances[$extension->getName()])) {
			self::$instances[$extension->getName()] = self::createNewInstanceByExtension($extension);
		}
		return self::$instances[$extension->getName()];
	}
	
	
	
	/**
	 * Factory method for creating new ts importer object
	 *
	 * @param Tx_Rbac_Domain_TsImporter $extension
	 */
	private static function createNewInstanceByExtension($extension) {
		$instance = new Tx_Rbac_Domain_TsImporter($extension);
		$instance->injectActionRepository(t3lib_div::makeInstance('Tx_Rbac_Domain_Repository_ActionRepository'));
		$instance->injectDomainRepository(t3lib_div::makeInstance('Tx_Rbac_Domain_Repository_DomainRepository'));
		$instance->injectExtensionRepository(t3lib_div::makeInstance('Tx_Rbac_Domain_Repository_ExtensionRepository'));
		$instance->injectPrivilegeOnDomainRepository(t3lib_div::makeInstance('Tx_Rbac_Domain_Repository_PrivilegeOnDomainRepository'));
		$instance->injectPrivilegeRepository(t3lib_div::makeInstance('Tx_Rbac_Domain_Repository_PrivilegeRepository'));
		$instance->injectRoleRepository(t3lib_div::makeInstance('Tx_Rbac_Domain_Repository_RoleRepository'));
		$instance->injectUserRepository(t3lib_div::makeInstance('Tx_Rbac_Domain_Repository_UserRepository'));
		$instance->injectObjectRepository(t3lib_div::makeInstance('Tx_Rbac_Domain_Repository_ObjectRepository'));
		return $instance;
	}
	
}
 
?>
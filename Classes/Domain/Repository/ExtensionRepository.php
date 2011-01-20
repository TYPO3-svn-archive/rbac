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
 * Extension Repository for Role-Base Access Controll
 *
 * @package Domain
 * @subpackage Import
 * @author Michael Knoll <mimi@kaktusteam.de>
 */
class Tx_Rbac_Domain_Repository_ExtensionRepository extends Tx_Extbase_Persistence_Repository {
	
	/**
	 * Tries to find an extension in repository. Creates one if not available
	 *
	 * @param string $extensionName
	 * @return Tx_Rbac_Domain_Model_Extension
	 */
	public function findOrCreateExtension($extensionName) {
		$query = $this->createQuery();
		$result = $query->matching($query->equals('name', $extensionName))->execute();
		if (!is_array($result) && method_exists('getName', $result) && $result->getName() == $extensionName) {
			return $result;
		} else {
			$extension = new Tx_Rbac_Domain_Model_Extension();
			$extension->setName($extensionName);
			$this->add($extension);
			$this->persistenceManager->persistAll();
			return $extension;
		}
	}
	
}
 
?>
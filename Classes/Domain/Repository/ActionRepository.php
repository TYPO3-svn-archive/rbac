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
 * Action Repository for Role-Base Access Controll
 *
 * @package Domain
 * @subpackage Import
 * @author Michael Knoll <mimi@kaktusteam.de>
 */
class Tx_Rbac_Domain_Repository_ActionRepository extends Tx_Extbase_Persistence_Repository {

	/**
	 * Finds single instance of action by name.
	 *
	 * @param Tx_Rbac_Domain_Action $actionName
	 * @return array
	 */
	public function findSingleInstanceByName($actionName) {
		$result = parent::findByName($actionName);
		if (count($result) == 1) return $result[0];
		else throw new Exception('More than one action found by name. This should not be! 1295024085');
	}
	
}
 
?>
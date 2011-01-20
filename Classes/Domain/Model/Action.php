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
 * Action
 *
 * @version $Id$
 * @copyright Copyright belongs to the respective authors
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 */
class Tx_Rbac_Domain_Model_Action extends Tx_Extbase_DomainObject_AbstractEntity {
	
	/**
	 * Name of action
	 * @var string
	 */
	protected $name;
	
	/**
	 * Description of action
	 * @var string
	 */
	protected $description;
	
	
	
	/**
	 * Setter for name
	 *
	 * @param string $name Name of action
	 * @return void
	 */
	public function setName($name) {
		$this->name = $name;
	}

	/**
	 * Getter for name
	 *
	 * @return string Name of action
	 */
	public function getName() {
		return $this->name;
	}
	
	/**
	 * Setter for description
	 *
	 * @param string $description Description of action
	 * @return void
	 */
	public function setDescription($description) {
		$this->description = $description;
	}

	/**
	 * Getter for description
	 *
	 * @return string Description of action
	 */
	public function getDescription() {
		return $this->description;
	}
	
}
?>
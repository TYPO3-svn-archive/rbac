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
 * Privilege
 *
 * @version $Id$
 * @copyright Copyright belongs to the respective authors
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 */
class Tx_Rbac_Domain_Model_Privilege extends Tx_Extbase_DomainObject_AbstractEntity {
	
	/**
	 * name
	 * @var string
	 */
	protected $name;
	
	/**
	 * description
	 * @var string
	 */
	protected $description;
	
	/**
	 * isSingular
	 * @var boolean
	 */
	protected $isSingular;
	
	/**
	 * actions
	 * @var Tx_Extbase_Persistence_ObjectStorage<Tx_Rbac_Domain_Model_Action>
	 */
	protected $actions;
	
	
	
	public function __construct() {
		$this->actions = new Tx_Extbase_Persistence_ObjectStorage();
	}
	
	
	
	/**
	 * Setter for name
	 *
	 * @param string $name name
	 * @return void
	 */
	public function setName($name) {
		$this->name = $name;
	}

	/**
	 * Getter for name
	 *
	 * @return string name
	 */
	public function getName() {
		return $this->name;
	}
	
	/**
	 * Setter for description
	 *
	 * @param string $description description
	 * @return void
	 */
	public function setDescription($description) {
		$this->description = $description;
	}

	/**
	 * Getter for description
	 *
	 * @return string description
	 */
	public function getDescription() {
		return $this->description;
	}
	
	/**
	 * Setter for isSingular
	 *
	 * @param boolean $isSingular isSingular
	 * @return void
	 */
	public function setIsSingular($isSingular) {
		$this->isSingular = $isSingular;
	}

	/**
	 * Getter for isSingular
	 *
	 * @return boolean isSingular
	 */
	public function getIsSingular() {
		return $this->isSingular;
	}
	
	/**
	 * Returns the boolean state of isSingular
	 *
	 * @return boolean The state of isSingular
	 */
	public function isIsSingular() {
		return $this->getIsSingular();
	}
	
	/**
	 * Setter for actions
	 *
	 * @param Tx_Extbase_Persistence_ObjectStorage<Tx_Rbac_Domain_Model_Action> $actions actions
	 * @return void
	 */
	public function setActions(Tx_Extbase_Persistence_ObjectStorage $actions) {
		$this->actions = $actions;
	}

	/**
	 * Getter for actions
	 *
	 * @return Tx_Extbase_Persistence_ObjectStorage<Tx_Rbac_Domain_Model_Action> actions
	 */
	public function getActions() {
		return $this->actions;
	}
	
	/**
	 * Adds a Action
	 *
	 * @param Tx_Rbac_Domain_Model_Action The Action to be added
	 * @return void
	 */
	public function addAction(Tx_Rbac_Domain_Model_Action $action) {
		$this->actions->attach($action);
	}
	
	/**
	 * Removes a Action
	 *
	 * @param Tx_Rbac_Domain_Model_Action The Action to be removed
	 * @return void
	 */
	public function removeAction(Tx_Rbac_Domain_Model_Action $action) {
		$this->actions->detach($action);
	}
	
}
?>
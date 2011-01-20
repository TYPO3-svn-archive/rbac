<?php
/***************************************************************
*  Copyright notice
*
*  (c) 2010 Daniel Lienert <daniel@lienert.cc>, Michael Knoll <mimi@kaktusteam.de>
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
 * Implements a filter for filtering RBAC roles 
 *
 * @package Domain
 * @subpackage Import
 * @author Michael Knoll <mimi@kaktusteam.de>
 */
class Tx_Rbac_Extlist_Filters_RolesFilter extends Tx_PtExtlist_Domain_Model_Filter_AbstractSingleValueFilter {
    
    /**
     * array of filter values
     * 
     * @var array
     */
    protected $filterValues;
    

    /**
     * Selected album
     * @var int albumUid
     */
    protected $userUid;


    
    /**
     * Unused methods
     */
    protected function initFilterByTsConfig() {}
    protected function initFilterByGpVars() {}   
    public function initFilterBySession() {}
    public function persistToSession() {}
    public function initFilter() {} 
    public function getFilterValueForBreadCrumb() {}
    public function buildFilterCriteria(Tx_PtExtlist_Domain_Configuration_Data_Fields_FieldConfig $fieldIdentifier) {}
    
    
    
    /**
     * @see Tx_PtExtlist_Domain_Model_Filter_FilterInterface::reset()
     *
     */
    public function reset() {
        $this->userUid = 0;
        $this->filterQuery = new Tx_PtExtlist_Domain_QueryObject_Query();
        $this->init();
    }
    
    
    
    /**
     * Sets filter to active if user UID is given
     * @see Classes/Domain/Model/Filter/Tx_PtExtlist_Domain_Model_Filter_AbstractFilter::setActiveState()
     */
    public function setActiveState() {
        if($this->userUid) $this->isActive = true;
    }
    
    
    
    /**
     * Build the filterCriteria for filter 
     * 
     * @return Tx_PtExtlist_Domain_QueryObject_Criteria
     */
    protected function buildFilterCriteriaForAllFields() {
        if($this->userUid) {
            $userField = $this->fieldIdentifierCollection->getFieldConfigByIdentifier('userUid');
            $fieldName = Tx_PtExtlist_Utility_DbUtils::getSelectPartByFieldConfig($userField);
            $criteria = Tx_PtExtlist_Domain_QueryObject_Criteria::equals($fieldName, $this->userUid);
        }
        
        return $criteria;
    }
    
    
    
    /**
     * Set the user Uid
     * 
     * @param int $userUid UID of user to filter roles by
     */
    public function setUserUid($userUid) {
        $this->userUid = $userUid;
        $this->init();
    }
    
    
    
    /**
     * Getter for user UID
     *
     * @return int UID of user currently selected
     */
    public function getUserUid() {
        return $this->userUid;
    }	
}
 
?>
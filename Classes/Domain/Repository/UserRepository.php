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
 * User Repository for Role-Base Access Controll
 *
 * @package Domain
 * @subpackage Import
 * @author Michael Knoll <mimi@kaktusteam.de>
 */
class Tx_Rbac_Domain_Repository_UserRepository extends Tx_Extbase_Persistence_Repository {
	
<<<<<<< HEAD
=======
	/**
	 * Returns rbac user for given fe user object
	 *
	 * @param Tx_Extbase_Domain_Model_FrontendUser $feUser
	 * return Tx_Rbac_Domain_Model_User
	 */
	public function findByFeUser(Tx_Extbase_Domain_Model_FrontendUser $feUser) {
		$query = $this->createQuery();
        $query->getQuerySettings()->setRespectStoragePage(FALSE);
        $query->matching($query->equals('feUser', $feUser->getUid()));
        $rbacUserArray = $query->execute();
        return count($rbacUserArray) > 0 ? $rbacUserArray[0] : null;
	}
	
	
>>>>>>> aac898ba004322cc78a8f76f4a08bfdc086df3ea
}
 
?>
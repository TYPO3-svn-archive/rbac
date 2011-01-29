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
 * Factory for access controll service
 *
 * @package Domain
 * @author Michael Knoll <mimi@kaktusteam.de>
 */
class Tx_Rbac_Domain_AccessControllServiceFactory {

	/**
	 * Holds a singleton instance of access controll service
	 *
	 * @var Tx_Rbac_Domain_AccessControllService
	 */
	private static $instance = null;
	
	
	
	/**
	 * Returns singleton instance of access controll service
	 *
<<<<<<< HEAD
	 * @return Tx_Rbac_Domain_AccessControllService
	 */
	public static function getInstance() {
=======
	 * @param Tx_Extbase_Domain_Model_FrontendUser $feUser
	 * @return Tx_Rbac_Domain_AccessControllService
	 */
	public static function getInstance(Tx_Extbase_Domain_Model_FrontendUser $feUser = null) {
>>>>>>> aac898ba004322cc78a8f76f4a08bfdc086df3ea
		if (self::$instance === null) {
			$repository = t3lib_div::makeInstance(Tx_Rbac_Domain_Repository_UserRepository);
			$accessControllService = new Tx_Rbac_Domain_AccessControllService();
			$accessControllService->injectRepository($repository);
<<<<<<< HEAD
=======
			$accessControllService->injectRbacUserRepository(t3lib_div::makeInstance('Tx_Rbac_Domain_Repository_UserRepository'));
			if ($feUser !== null) $accessControllService->injectFeUser($feUser);
>>>>>>> aac898ba004322cc78a8f76f4a08bfdc086df3ea
		    self::$instance = $accessControllService;
		    
		    // Start lifecycleManager
		    $lifecycleManager = Tx_PtExtlist_Domain_Lifecycle_LifecycleManagerFactory::getInstance();
            $lifecycleManager->registerAndUpdateStateOnRegisteredObject(Tx_PtExtlist_Domain_StateAdapter_SessionPersistenceManagerFactory::getInstance());
        
            // Start session persistence Manager
			$sessionPersistenceManager = Tx_PtExtlist_Domain_StateAdapter_SessionPersistenceManagerFactory::getInstance();
            $sessionPersistenceManager->registerObjectAndLoadFromSession(self::$instance);
		}
		
		return self::$instance;
	}
	
}

?>
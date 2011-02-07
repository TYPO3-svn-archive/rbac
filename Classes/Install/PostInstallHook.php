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

// We need those lines, if extension is first installed (no autoload is running here!)
require_once t3lib_extMgm::extPath('rbac') . 'Classes/Install/Utility.php';
require_once t3lib_extMgm::extPath('pt_extlist') . 'Classes/Utility/NameSpace.php';

/**
 * Hook that is executed after extension has been installed.
 * 
 * This class is used to import some static RBAC settings into database after
 * extension has been installed in Extension-Manager. We call this script via
 * ext_conf_template.txt using the following line:
 * 
 * # cat=basic; type=user[EXT:rbac/Classes/Install/PostInstallHook.php:Tx_Rbac_Install_PostInstallHook->setupRbac]; label=user_function_label
 * updateMessage=0
 * 
 * When the script is processed, all RBAC data from static template in Configuration/TypoScript/setup.txt 
 * given by the key plugin.tx_rbac.settings.rbac is parsed and imported into the respective database tables.
 *
 * @package Install
 * @author Michael Knoll <mimi@kaktusteam.de>
 */
class Tx_Rbac_Install_PostInstallHook {
	
    /**
     * Runs setup of RBAC by importing RBAC data from typoscript into database
     *
     * @return string Message of success / Error message
     */
	public static function setupRbac() {
		// We get TS array of rbac settings
        $tsSetupFile = t3lib_extMgm::extPath('rbac') . '/Configuration/TypoScript/setup.txt';
        return Tx_Rbac_Install_Utility::doImportByExtensionNameTsFilePathAndTsKey('tx_rbac', $tsSetupFile, 'plugin.tx_rbac.settings.rbac');
	}
	
}

?>
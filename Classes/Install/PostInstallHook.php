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
	 * Holds parsed TS array for faking dispatcher request
	 *
	 * @var array
	 */
	protected static $extBaseSettings = array();
    
    
    
	/**
	 * Holds TS string for faking dispatcher request
	 *
	 * @var string
	 */
    protected static $extBaseSettingsString = '
	    plugin.tx_ptextlist.settings.persistence.storagePid = 12
	    
	    extensionName = PtExtlist
	    pluginName = pi1
	    controller = List
	    action = list
	    switchableControllerActions {
	       10 {
	           controller = List
	           action = list
	       }
	    
	    }
	    
	    # Required for requestBuilder
	    
	    persistence{
	        enableAutomaticCacheClearing = 1
	        updateReferenceIndex = 0
	        classes {
	            Tx_Extbase_Domain_Model_FrontendUser {
	                mapping {
	                    tableName = fe_users
	                    recordType = Tx_Extbase_Domain_Model_FrontendUser
	                    columns {
	                        lockToDomain.mapOnProperty = lockToDomain
	                    }
	                }
	            }
	            Tx_Extbase_Domain_Model_FrontendUserGroup {
	                mapping {
	                    tableName = fe_groups
	                    recordType =
	                    columns {
	                        lockToDomain.mapOnProperty = lockToDomain
	                    }
	                }
	            }
	        }
	    }';
    
    
	
    /**
     * Runs setup of RBAC by importing RBAC data from typoscript into database
     *
     * @return string Message of success / Error message
     */
	public static function setupRbac() {
		try {
			// We get some basic typoscript setting for instantiating a dispatcher
		    $typoScriptParser = t3lib_div::makeInstance('t3lib_TSparser'); /* @var $typoScriptParser t3lib_TSparser */
	        $typoScriptParser->parse(self::$extBaseSettingsString);
	        self::$extBaseSettings = Tx_Extbase_Utility_TypoScript::convertTypoScriptArrayToPlainArray($typoScriptParser->setup);
	        
	        // We set up a dispatcher to create dependencies for repositories etc.
		    $dispatcher = new Tx_Extbase_Dispatcher();
	        try {
	            $dispatcher->dispatch('content', self::$extBaseSettings);
	        } catch (Exception $e) {
	            // We get an exception and don't care                
	        }
	        
	        // We get TS array of rbac settings
	        $tsSetupFileContent = file_get_contents(t3lib_extMgm::extPath('rbac') . '/Configuration/TypoScript/setup.txt');
	        $typoScriptParser->parse($tsSetupFileContent);
	        $tsSetup = Tx_Extbase_Utility_TypoScript::convertTypoScriptArrayToPlainArray($typoScriptParser->setup);
	        $rbacSettings = $tsSetup['plugin']['tx_rbac']['settings']['rbac'];
	        
	        // We set up rbac importer and import ts settings into database
	        $extension = t3lib_div::makeInstance('Tx_Rbac_Domain_Repository_ExtensionRepository')->findOrCreateExtension('tx_rbac');
	        $rbacTsImporter = Tx_Rbac_Domain_TsImporterFactory::getInstanceByExtension($extension);
	        $rbacTsImporter->importTsArray($rbacSettings);    
	
	        // We persist everything
	        t3lib_div::makeInstance('Tx_Extbase_Persistence_Manager')->persistAll();
			
	        // We give some Feeedback for EM
			return 'RBAC data has been imported into database.';
		} catch(Exception $e) {
			return 'An Exception has been thrown while importing RBAC settings into database! (' . $e->getMessage() . ') 1295607903';
		}
	}
	
}

?>
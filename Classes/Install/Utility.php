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
 * This class can be used to do post install imports of RBAC settings for third-party extensions.
 * 
 * 
 * Here is a short example of how to use this classe. 
 * 
 * 1) Create a new file 'ext_conf_template.txt' in the root of your extension (if it does not exist yet).
 * 2) Insert the following lines into the 'ext_conf_template.txt' file:
 * 
 *      # cat=basic; type=user[EXT:<your_extension>/Classes/Install/PostInstallHook.php:Tx_<your_extension>_Install_PostInstallHook->setupRbac]; label=Importing TypoScript settings into Database
 *    updateMessage=0
 * 
 * 3) Create a php file 'PostInstallHook.php' in the Classes/Install directory of your extension. Perhaps you have to create this directory first
 * 4) Inside 'PostInstallHook.php' create a class 'Tx_<your_extension>_Install_PostInstallHook'
 * 5) Inside this class, create a public static function with the following lines of code:
 * 
 *    public static function setupRbac() {
 *        $tsSetupFile = t3lib_extMgm::extPath('<your_extension>') . '/Configuration/TypoScript/setup.txt';
 *        return Tx_Rbac_Install_Utility::doImportByExtensionNameTsFilePathAndTsKey('<your_extension>', $tsSetupFile, '<path_to_rbac_settings_inside_ts_file>');
 *    }
 * 
 * 6) Install your extension, click on 'Make Updates' and you're done!
 * 
 *
 * @package Domain
 * @subpackage Import
 * @author Michael Knoll <mimi@kaktusteam.de>
 */
class Tx_Rbac_Install_Utility {
	
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
        
<<<<<<< HEAD
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
    
    
=======
        }';

>>>>>>> aac898ba004322cc78a8f76f4a08bfdc086df3ea
    
    /**
     * Runs an import of rbac settings for given extensionname, absolute path of TS file on server,
     * and TS-key of rbac settings inside given TS file.
     *
     * @param string $extensionName Name of extension to do import for
     * @param string $tsFilePath Path to file with TS settings (absolute on server)
     * @param string $tsKey Key of RBAC settings inside given file in . (dot) notation
     */
    public static function doImportByExtensionNameTsFilePathAndTsKey($extensionName, $tsFilePath, $tsKey) {
    	// We get TS array of rbac settings
    	if (!file_exists($tsFilePath)) throw new Exception('Given file ' . $tsFilePath . ' does not exist! 1295611453');
        $tsSetupFileContent = file_get_contents($tsFilePath);
        $typoScriptParser = t3lib_div::makeInstance('t3lib_TSparser'); /* @var $typoScriptParser t3lib_TSparser */
        $typoScriptParser->parse($tsSetupFileContent);
        $tsSetup = Tx_Extbase_Utility_TypoScript::convertTypoScriptArrayToPlainArray($typoScriptParser->setup);
        $rbacSettings = Tx_PtExtlist_Utility_NameSpace::getArrayContentByArrayAndNamespace($tsSetup, $tsKey);
        return self::doImportByExtensionNameAndTsArray($extensionName, $rbacSettings);
    }
    
    
    
	/**
	 * Runs an import of rbac settings in given TS array for given extension name
	 *
	 * @param string $extensionName
	 * @param array $tsArray
	 * @return string Success message or error message
	 */
	public static function doImportByExtensionNameAndTsArray($extensionName, array $tsArray = array()) {
	    try {
            // We get some basic typoscript setting for instantiating a dispatcher
            $typoScriptParser = t3lib_div::makeInstance('t3lib_TSparser'); /* @var $typoScriptParser t3lib_TSparser */
            $typoScriptParser->parse(self::$extBaseSettingsString);
            self::$extBaseSettings = Tx_Extbase_Utility_TypoScript::convertTypoScriptArrayToPlainArray($typoScriptParser->setup);
            
            // We set up a dispatcher to create dependencies for repositories etc.
<<<<<<< HEAD
            $dispatcher = new Tx_Extbase_Dispatcher();
            try {
                $dispatcher->dispatch('content', self::$extBaseSettings);
            } catch (Exception $e) {
                // We get an exception and don't care                
            }
=======
            $extbaseCore = new Tx_Extbase_Core_Bootstrap();
            $extbaseCore->initialize(self::$extBaseSettings);
>>>>>>> aac898ba004322cc78a8f76f4a08bfdc086df3ea
            
            // We set up rbac importer and import ts settings into database
            $extension = t3lib_div::makeInstance('Tx_Rbac_Domain_Repository_ExtensionRepository')->findOrCreateExtension($extensionName);
            $rbacTsImporter = Tx_Rbac_Domain_TsImporterFactory::getInstanceByExtension($extension);
            $rbacTsImporter->importTsArray($tsArray);    
    
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
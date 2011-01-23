<?php
// This class contains information about classes to be registered in autoload for testing

$rbacPath = t3lib_extMgm::extPath('rbac');
$extlistPath = t3lib_extMgm::extPath('pt_extlist');
return array(
    'tx_rbac_install_utility' => $rbacPath . 'Classes/Install/Utility.php',
    'tx_ptextlist_utility_namespace' => $extlistPath . 'Classes/Utility/NameSpace.php'
);
?>
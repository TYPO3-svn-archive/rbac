<?php
if (!defined ('TYPO3_MODE')) die ('Access denied.');

Tx_Extbase_Utility_Extension::registerPlugin(
	$_EXTKEY,
	'Pi1',
	'RBAC - Role-Base Access Controll Framework'
);

t3lib_extMgm::addStaticFile($_EXTKEY, 'Configuration/TypoScript', 'RBAC - Role-Base Access Controll Framework');

//$TCA['tt_content']['types']['list']['subtypes_addlist'][$_EXTKEY . '_pi1'] = 'pi_flexform';
//t3lib_extMgm::addPiFlexFormValue($_EXTKEY . '_pi1', 'FILE:EXT:' . $_EXTKEY . '/Configuration/FlexForms/flexform_list.xml');


t3lib_extMgm::addLLrefForTCAdescr('tx_rbac_domain_model_role', 'EXT:rbac/Resources/Private/Language/locallang_csh_tx_rbac_domain_model_role.xml');
t3lib_extMgm::allowTableOnStandardPages('tx_rbac_domain_model_role');
$TCA['tx_rbac_domain_model_role'] = array (
	'ctrl' => array (
		'title'             => 'LLL:EXT:rbac/Resources/Private/Language/locallang_db.xml:tx_rbac_domain_model_role',
		'label' 			=> 'name',
		'tstamp' 			=> 'tstamp',
		'crdate' 			=> 'crdate',
		'versioningWS' 		=> 2,
		'versioning_followPages'	=> TRUE,
		'origUid' 			=> 't3_origuid',
		'languageField' 	=> 'sys_language_uid',
		'transOrigPointerField' 	=> 'l18n_parent',
		'transOrigDiffSourceField' 	=> 'l18n_diffsource',
		'delete' 			=> 'deleted',
		'enablecolumns' 	=> array(
			'disabled' => 'hidden'
			),
		'dynamicConfigFile' => t3lib_extMgm::extPath($_EXTKEY) . 'Configuration/TCA/Role.php',
		'iconfile' 			=> t3lib_extMgm::extRelPath($_EXTKEY) . 'Resources/Public/Icons/tx_rbac_domain_model_role.gif'
	)
);

t3lib_extMgm::addLLrefForTCAdescr('tx_rbac_domain_model_user', 'EXT:rbac/Resources/Private/Language/locallang_csh_tx_rbac_domain_model_user.xml');
t3lib_extMgm::allowTableOnStandardPages('tx_rbac_domain_model_user');
$TCA['tx_rbac_domain_model_user'] = array (
	'ctrl' => array (
		'title'             => 'LLL:EXT:rbac/Resources/Private/Language/locallang_db.xml:tx_rbac_domain_model_user',
		'label' 			=> 'roles',
		'tstamp' 			=> 'tstamp',
		'crdate' 			=> 'crdate',
		'versioningWS' 		=> 2,
		'versioning_followPages'	=> TRUE,
		'origUid' 			=> 't3_origuid',
		'languageField' 	=> 'sys_language_uid',
		'transOrigPointerField' 	=> 'l18n_parent',
		'transOrigDiffSourceField' 	=> 'l18n_diffsource',
		'delete' 			=> 'deleted',
		'enablecolumns' 	=> array(
			'disabled' => 'hidden'
			),
		'dynamicConfigFile' => t3lib_extMgm::extPath($_EXTKEY) . 'Configuration/TCA/User.php',
		'iconfile' 			=> t3lib_extMgm::extRelPath($_EXTKEY) . 'Resources/Public/Icons/tx_rbac_domain_model_user.gif'
	)
);

t3lib_extMgm::addLLrefForTCAdescr('tx_rbac_domain_model_action', 'EXT:rbac/Resources/Private/Language/locallang_csh_tx_rbac_domain_model_action.xml');
t3lib_extMgm::allowTableOnStandardPages('tx_rbac_domain_model_action');
$TCA['tx_rbac_domain_model_action'] = array (
	'ctrl' => array (
		'title'             => 'LLL:EXT:rbac/Resources/Private/Language/locallang_db.xml:tx_rbac_domain_model_action',
		'label' 			=> 'name',
		'tstamp' 			=> 'tstamp',
		'crdate' 			=> 'crdate',
		'versioningWS' 		=> 2,
		'versioning_followPages'	=> TRUE,
		'origUid' 			=> 't3_origuid',
		'languageField' 	=> 'sys_language_uid',
		'transOrigPointerField' 	=> 'l18n_parent',
		'transOrigDiffSourceField' 	=> 'l18n_diffsource',
		'delete' 			=> 'deleted',
		'enablecolumns' 	=> array(
			'disabled' => 'hidden'
			),
		'dynamicConfigFile' => t3lib_extMgm::extPath($_EXTKEY) . 'Configuration/TCA/Action.php',
		'iconfile' 			=> t3lib_extMgm::extRelPath($_EXTKEY) . 'Resources/Public/Icons/tx_rbac_domain_model_action.gif'
	)
);

t3lib_extMgm::addLLrefForTCAdescr('tx_rbac_domain_model_privilege', 'EXT:rbac/Resources/Private/Language/locallang_csh_tx_rbac_domain_model_privilege.xml');
t3lib_extMgm::allowTableOnStandardPages('tx_rbac_domain_model_privilege');
$TCA['tx_rbac_domain_model_privilege'] = array (
	'ctrl' => array (
		'title'             => 'LLL:EXT:rbac/Resources/Private/Language/locallang_db.xml:tx_rbac_domain_model_privilege',
		'label' 			=> 'name',
		'tstamp' 			=> 'tstamp',
		'crdate' 			=> 'crdate',
		'versioningWS' 		=> 2,
		'versioning_followPages'	=> TRUE,
		'origUid' 			=> 't3_origuid',
		'languageField' 	=> 'sys_language_uid',
		'transOrigPointerField' 	=> 'l18n_parent',
		'transOrigDiffSourceField' 	=> 'l18n_diffsource',
		'delete' 			=> 'deleted',
		'enablecolumns' 	=> array(
			'disabled' => 'hidden'
			),
		'dynamicConfigFile' => t3lib_extMgm::extPath($_EXTKEY) . 'Configuration/TCA/Privilege.php',
		'iconfile' 			=> t3lib_extMgm::extRelPath($_EXTKEY) . 'Resources/Public/Icons/tx_rbac_domain_model_privilege.gif'
	)
);

t3lib_extMgm::addLLrefForTCAdescr('tx_rbac_domain_model_object', 'EXT:rbac/Resources/Private/Language/locallang_csh_tx_rbac_domain_model_object.xml');
t3lib_extMgm::allowTableOnStandardPages('tx_rbac_domain_model_object');
$TCA['tx_rbac_domain_model_object'] = array (
	'ctrl' => array (
		'title'             => 'LLL:EXT:rbac/Resources/Private/Language/locallang_db.xml:tx_rbac_domain_model_object',
		'label' 			=> 'name',
		'tstamp' 			=> 'tstamp',
		'crdate' 			=> 'crdate',
		'versioningWS' 		=> 2,
		'versioning_followPages'	=> TRUE,
		'origUid' 			=> 't3_origuid',
		'languageField' 	=> 'sys_language_uid',
		'transOrigPointerField' 	=> 'l18n_parent',
		'transOrigDiffSourceField' 	=> 'l18n_diffsource',
		'delete' 			=> 'deleted',
		'enablecolumns' 	=> array(
			'disabled' => 'hidden'
			),
		'dynamicConfigFile' => t3lib_extMgm::extPath($_EXTKEY) . 'Configuration/TCA/Object.php',
		'iconfile' 			=> t3lib_extMgm::extRelPath($_EXTKEY) . 'Resources/Public/Icons/tx_rbac_domain_model_object.gif'
	)
);

t3lib_extMgm::addLLrefForTCAdescr('tx_rbac_domain_model_domain', 'EXT:rbac/Resources/Private/Language/locallang_csh_tx_rbac_domain_model_domain.xml');
t3lib_extMgm::allowTableOnStandardPages('tx_rbac_domain_model_domain');
$TCA['tx_rbac_domain_model_domain'] = array (
	'ctrl' => array (
		'title'             => 'LLL:EXT:rbac/Resources/Private/Language/locallang_db.xml:tx_rbac_domain_model_domain',
		'label' 			=> 'name',
		'tstamp' 			=> 'tstamp',
		'crdate' 			=> 'crdate',
		'versioningWS' 		=> 2,
		'versioning_followPages'	=> TRUE,
		'origUid' 			=> 't3_origuid',
		'languageField' 	=> 'sys_language_uid',
		'transOrigPointerField' 	=> 'l18n_parent',
		'transOrigDiffSourceField' 	=> 'l18n_diffsource',
		'delete' 			=> 'deleted',
		'enablecolumns' 	=> array(
			'disabled' => 'hidden'
			),
		'dynamicConfigFile' => t3lib_extMgm::extPath($_EXTKEY) . 'Configuration/TCA/Domain.php',
		'iconfile' 			=> t3lib_extMgm::extRelPath($_EXTKEY) . 'Resources/Public/Icons/tx_rbac_domain_model_domain.gif'
	)
);

t3lib_extMgm::addLLrefForTCAdescr('tx_rbac_domain_model_privilegeondomain', 'EXT:rbac/Resources/Private/Language/locallang_csh_tx_rbac_domain_model_privilegeondomain.xml');
t3lib_extMgm::allowTableOnStandardPages('tx_rbac_domain_model_privilegeondomain');
$TCA['tx_rbac_domain_model_privilegeondomain'] = array (
	'ctrl' => array (
		'title'             => 'LLL:EXT:rbac/Resources/Private/Language/locallang_db.xml:tx_rbac_domain_model_privilegeondomain',
		'label' 			=> 'is_allowed',
		'tstamp' 			=> 'tstamp',
		'crdate' 			=> 'crdate',
		'versioningWS' 		=> 2,
		'versioning_followPages'	=> TRUE,
		'origUid' 			=> 't3_origuid',
		'languageField' 	=> 'sys_language_uid',
		'transOrigPointerField' 	=> 'l18n_parent',
		'transOrigDiffSourceField' 	=> 'l18n_diffsource',
		'delete' 			=> 'deleted',
		'enablecolumns' 	=> array(
			'disabled' => 'hidden'
			),
		'dynamicConfigFile' => t3lib_extMgm::extPath($_EXTKEY) . 'Configuration/TCA/PrivilegeOnDomain.php',
		'iconfile' 			=> t3lib_extMgm::extRelPath($_EXTKEY) . 'Resources/Public/Icons/tx_rbac_domain_model_privilegeondomain.gif'
	)
);

t3lib_extMgm::addLLrefForTCAdescr('tx_rbac_domain_model_extension', 'EXT:rbac/Resources/Private/Language/locallang_csh_tx_rbac_domain_model_extension.xml');
t3lib_extMgm::allowTableOnStandardPages('tx_rbac_domain_model_extension');
$TCA['tx_rbac_domain_model_extension'] = array (
	'ctrl' => array (
		'title'             => 'LLL:EXT:rbac/Resources/Private/Language/locallang_db.xml:tx_rbac_domain_model_extension',
		'label' 			=> 'name',
		'tstamp' 			=> 'tstamp',
		'crdate' 			=> 'crdate',
		'versioningWS' 		=> 2,
		'versioning_followPages'	=> TRUE,
		'origUid' 			=> 't3_origuid',
		'languageField' 	=> 'sys_language_uid',
		'transOrigPointerField' 	=> 'l18n_parent',
		'transOrigDiffSourceField' 	=> 'l18n_diffsource',
		'delete' 			=> 'deleted',
		'enablecolumns' 	=> array(
			'disabled' => 'hidden'
			),
		'dynamicConfigFile' => t3lib_extMgm::extPath($_EXTKEY) . 'Configuration/TCA/Extension.php',
		'iconfile' 			=> t3lib_extMgm::extRelPath($_EXTKEY) . 'Resources/Public/Icons/tx_rbac_domain_model_extension.gif'
	)
);

?>
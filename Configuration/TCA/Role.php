<?php
if (!defined ('TYPO3_MODE')) 	die ('Access denied.');

$TCA['tx_rbac_domain_model_role'] = array(
	'ctrl' => $TCA['tx_rbac_domain_model_role']['ctrl'],
	'interface' => array(
		'showRecordFieldList' => 'name,description,importance,users'
	),
	'types' => array(
		'1' => array('showitem' => 'name,description,importance,users')
	),
	'palettes' => array(
		'1' => array('showitem' => '')
	),
	'columns' => array(
		'sys_language_uid' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:lang/locallang_general.php:LGL.language',
			'config' => array(
				'type' => 'select',
				'foreign_table' => 'sys_language',
				'foreign_table_where' => 'ORDER BY sys_language.title',
				'items' => array(
					array('LLL:EXT:lang/locallang_general.php:LGL.allLanguages',-1),
					array('LLL:EXT:lang/locallang_general.php:LGL.default_value',0)
				)
			)
		),
		'l18n_parent' => array(
			'displayCond' => 'FIELD:sys_language_uid:>:0',
			'exclude' => 1,
			'label' => 'LLL:EXT:lang/locallang_general.php:LGL.l18n_parent',
			'config' => array(
				'type' => 'select',
				'items' => array(
					array('', 0),
				),
				'foreign_table' => 'tx_rbac_domain_model_role',
				'foreign_table_where' => 'AND tx_rbac_domain_model_role.uid=###REC_FIELD_l18n_parent### AND tx_rbac_domain_model_role.sys_language_uid IN (-1,0)',
			)
		),
		'l18n_diffsource' => array(
			'config'=>array(
				'type'=>'passthrough')
		),
		't3ver_label' => array(
			'displayCond' => 'FIELD:t3ver_label:REQ:true',
			'label' => 'LLL:EXT:lang/locallang_general.php:LGL.versionLabel',
			'config' => array(
				'type'=>'none',
				'cols' => 27
			)
		),
		'hidden' => array(
			'exclude' => 1,
			'label'   => 'LLL:EXT:lang/locallang_general.xml:LGL.hidden',
			'config'  => array(
				'type' => 'check'
			)
		),
		'name' => array(
			'exclude' => 0,
			'label'   => 'LLL:EXT:rbac/Resources/Private/Language/locallang_db.xml:tx_rbac_domain_model_role.name',
			'config'  => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim,required'
			)
		),
		'description' => array(
			'exclude' => 0,
			'label'   => 'LLL:EXT:rbac/Resources/Private/Language/locallang_db.xml:tx_rbac_domain_model_role.description',
			'config'  => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			)
		),
		'importance' => array(
			'exclude' => 0,
			'label'   => 'LLL:EXT:rbac/Resources/Private/Language/locallang_db.xml:tx_rbac_domain_model_role.importance',
			'config'  => array(
				'type' => 'input',
				'size' => 4,
				'eval' => 'int,required'
			)
		),
		'users' => array(
			'exclude' => 0,
			'label'   => 'LLL:EXT:rbac/Resources/Private/Language/locallang_db.xml:tx_rbac_domain_model_role.users',
			'config'  => array(
				'type' => 'inline',
				'foreign_table' => 'tx_rbac_domain_model_user',
				'MM' => 'tx_rbac_role_user_mm',
				'maxitems' => 99999
			)
		),
	),
);
?>
<?php
if (!defined ('TYPO3_MODE')) 	die ('Access denied.');

$TCA['tx_rbac_domain_model_domain'] = array(
	'ctrl' => $TCA['tx_rbac_domain_model_domain']['ctrl'],
	'interface' => array(
		'showRecordFieldList' => 'name,description,is_singular,objects,extension'
	),
	'types' => array(
		'1' => array('showitem' => 'name,description,is_singular,objects,extension')
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
				'foreign_table' => 'tx_rbac_domain_model_domain',
				'foreign_table_where' => 'AND tx_rbac_domain_model_domain.uid=###REC_FIELD_l18n_parent### AND tx_rbac_domain_model_domain.sys_language_uid IN (-1,0)',
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
			'label'   => 'LLL:EXT:rbac/Resources/Private/Language/locallang_db.xml:tx_rbac_domain_model_domain.name',
			'config'  => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim,required'
			)
		),
		'description' => array(
			'exclude' => 0,
			'label'   => 'LLL:EXT:rbac/Resources/Private/Language/locallang_db.xml:tx_rbac_domain_model_domain.description',
			'config'  => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			)
		),
		'is_singular' => array(
			'exclude' => 0,
			'label'   => 'LLL:EXT:rbac/Resources/Private/Language/locallang_db.xml:tx_rbac_domain_model_domain.is_singular',
			'config'  => array(
				'type' => 'check',
				'default' => 0
			)
		),
		'objects' => array(
			'exclude' => 0,
			'label'   => 'LLL:EXT:rbac/Resources/Private/Language/locallang_db.xml:tx_rbac_domain_model_domain.objects',
			'config'  => array(
				'type' => 'inline',
				'foreign_table' => 'tx_rbac_domain_model_object',
				'MM' => 'tx_rbac_domain_object_mm',
				'maxitems' => 99999
			)
		),
		'extension' => array(
			'exclude' => 0,
			'label'   => 'LLL:EXT:rbac/Resources/Private/Language/locallang_db.xml:tx_rbac_domain_model_domain.extension',
			'config'  => array(
				'type' => 'inline',
				'foreign_table' => 'tx_rbac_domain_model_extension',
				'MM' => 'tx_rbac_domain_extension_mm',
				'maxitems' => 99999
			)
		),
		'extension' => array(
			'config' => array(
				'type' => 'passthrough',
			)
		),
	),
);
?>
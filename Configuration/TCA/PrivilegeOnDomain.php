<?php
if (!defined ('TYPO3_MODE')) 	die ('Access denied.');

$TCA['tx_rbac_domain_model_privilegeondomain'] = array(
	'ctrl' => $TCA['tx_rbac_domain_model_privilegeondomain']['ctrl'],
	'interface' => array(
		'showRecordFieldList' => 'is_allowed,privilege,role,domain'
	),
	'types' => array(
		'1' => array('showitem' => 'is_allowed,privilege,role,domain')
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
				'foreign_table' => 'tx_rbac_domain_model_privilegeondomain',
				'foreign_table_where' => 'AND tx_rbac_domain_model_privilegeondomain.uid=###REC_FIELD_l18n_parent### AND tx_rbac_domain_model_privilegeondomain.sys_language_uid IN (-1,0)',
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
		'is_allowed' => array(
			'exclude' => 0,
			'label'   => 'LLL:EXT:rbac/Resources/Private/Language/locallang_db.xml:tx_rbac_domain_model_privilegeondomain.is_allowed',
			'config'  => array(
				'type' => 'check',
				'default' => 0
			)
		),
		'privilege' => array(
			'exclude' => 0,
			'label'   => 'LLL:EXT:rbac/Resources/Private/Language/locallang_db.xml:tx_rbac_domain_model_privilegeondomain.privilege',
			'config'  => array(
				'type' => 'inline',
				'foreign_table' => 'tx_rbac_domain_model_privilege',
				'minitems' => 0,
				'maxitems' => 1,
				'appearance' => array(
					'collapse' => 0,
					'newRecordLinkPosition' => 'bottom',
				),
			)
		),
		'role' => array(
			'exclude' => 0,
			'label'   => 'LLL:EXT:rbac/Resources/Private/Language/locallang_db.xml:tx_rbac_domain_model_privilegeondomain.role',
			'config'  => array(
				'type' => 'inline',
				'foreign_table' => 'tx_rbac_domain_model_role',
				'minitems' => 0,
				'maxitems' => 1,
				'appearance' => array(
					'collapse' => 0,
					'newRecordLinkPosition' => 'bottom',
				),
			)
		),
		'domain' => array(
			'exclude' => 0,
			'label'   => 'LLL:EXT:rbac/Resources/Private/Language/locallang_db.xml:tx_rbac_domain_model_privilegeondomain.domain',
			'config'  => array(
				'type' => 'inline',
				'foreign_table' => 'tx_rbac_domain_model_domain',
				'minitems' => 0,
				'maxitems' => 1,
				'appearance' => array(
					'collapse' => 0,
					'newRecordLinkPosition' => 'bottom',
				),
			)
		),
	),
);
?>
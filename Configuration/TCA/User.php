<?php
if (!defined ('TYPO3_MODE')) 	die ('Access denied.');

$TCA['tx_rbac_domain_model_user'] = array(
	'ctrl' => $TCA['tx_rbac_domain_model_user']['ctrl'],
	'interface' => array(
		'showRecordFieldList' => 'roles, fe_user'
	),
	'types' => array(
		'1' => array('showitem' => 'roles, fe_user')
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
				'foreign_table' => 'tx_rbac_domain_model_user',
				'foreign_table_where' => 'AND tx_rbac_domain_model_user.uid=###REC_FIELD_l18n_parent### AND tx_rbac_domain_model_user.sys_language_uid IN (-1,0)',
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
		'roles' => array(
			'exclude' => 0,
			'label'   => 'LLL:EXT:rbac/Resources/Private/Language/locallang_db.xml:tx_rbac_domain_model_user.roles',
			'config'  => array(
				'type' => 'select',
		        'size' => 10, 
		        'foreign_table_where' => 'OR tx_rbac_domain_model_role.pid = 0 AND tx_rbac_domain_model_role.deleted = 0',
				'foreign_table' => 'tx_rbac_domain_model_role',
				'MM' => 'tx_rbac_user_role_mm',
				'maxitems' => 99999
			)
		),
        'fe_user' => array(
            'exclude' => 0,
            'label'   => 'LLL:EXT:rbac/Resources/Private/Language/locallang_db.xml:tx_rbac_domain_model_user.fe_user',
            'config'  => array(
                'type' => 'select',
                'foreign_table' => 'fe_users',
		        'foreign_class' => 'Tx_Extbase_Domain_Model_FrontendUser',
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
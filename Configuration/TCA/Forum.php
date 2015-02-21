<?php
if (!defined ('TYPO3_MODE')) {
	die ('Access denied.');
}

$GLOBALS['TCA']['tx_agora_domain_model_forum'] = array(
	'ctrl' => $GLOBALS['TCA']['tx_agora_domain_model_forum']['ctrl'],
	'interface' => array(
		'showRecordFieldList' => 'sys_language_uid, l10n_parent, l10n_diffsource, hidden, title, description, public, parent, threads, groups_with_read_access, group_with_write_accesss, groups_with_modification_access, users_with_read_access, users_wth_write_accessii, users_with_modification_access',
	),
	'types' => array(
		'1' => array('showitem' => 'sys_language_uid;;;;1-1-1, l10n_parent, l10n_diffsource, hidden;;1, title, description, public, parent, threads, groups_with_read_access, group_with_write_accesss, groups_with_modification_access, users_with_read_access, users_wth_write_accessii, users_with_modification_access, --div--;LLL:EXT:cms/locallang_ttc.xlf:tabs.access, starttime, endtime'),
	),
	'palettes' => array(
		'1' => array('showitem' => ''),
	),
	'columns' => array(
	
		'sys_language_uid' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.language',
			'config' => array(
				'type' => 'select',
				'foreign_table' => 'sys_language',
				'foreign_table_where' => 'ORDER BY sys_language.title',
				'items' => array(
					array('LLL:EXT:lang/locallang_general.xlf:LGL.allLanguages', -1),
					array('LLL:EXT:lang/locallang_general.xlf:LGL.default_value', 0)
				),
			),
		),
		'l10n_parent' => array(
			'displayCond' => 'FIELD:sys_language_uid:>:0',
			'exclude' => 1,
			'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.l18n_parent',
			'config' => array(
				'type' => 'select',
				'items' => array(
					array('', 0),
				),
				'foreign_table' => 'tx_agora_domain_model_forum',
				'foreign_table_where' => 'AND tx_agora_domain_model_forum.pid=###CURRENT_PID### AND tx_agora_domain_model_forum.sys_language_uid IN (-1,0)',
			),
		),
		'l10n_diffsource' => array(
			'config' => array(
				'type' => 'passthrough',
			),
		),

		't3ver_label' => array(
			'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.versionLabel',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'max' => 255,
			)
		),
	
		'hidden' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.hidden',
			'config' => array(
				'type' => 'check',
			),
		),
		'starttime' => array(
			'exclude' => 1,
			'l10n_mode' => 'mergeIfNotBlank',
			'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.starttime',
			'config' => array(
				'type' => 'input',
				'size' => 13,
				'max' => 20,
				'eval' => 'datetime',
				'checkbox' => 0,
				'default' => 0,
				'range' => array(
					'lower' => mktime(0, 0, 0, date('m'), date('d'), date('Y'))
				),
			),
		),
		'endtime' => array(
			'exclude' => 1,
			'l10n_mode' => 'mergeIfNotBlank',
			'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.endtime',
			'config' => array(
				'type' => 'input',
				'size' => 13,
				'max' => 20,
				'eval' => 'datetime',
				'checkbox' => 0,
				'default' => 0,
				'range' => array(
					'lower' => mktime(0, 0, 0, date('m'), date('d'), date('Y'))
				),
			),
		),

		'title' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:agora/Resources/Private/Language/locallang_db.xlf:tx_agora_domain_model_forum.title',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			),
		),
		'description' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:agora/Resources/Private/Language/locallang_db.xlf:tx_agora_domain_model_forum.description',
			'config' => array(
				'type' => 'text',
				'cols' => 40,
				'rows' => 15,
				'eval' => 'trim'
			)
		),
		'public' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:agora/Resources/Private/Language/locallang_db.xlf:tx_agora_domain_model_forum.public',
			'config' => array(
				'type' => 'check',
				'default' => 0
			)
		),
		'parent' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:agora/Resources/Private/Language/locallang_db.xlf:tx_agora_domain_model_forum.parent',
			'config' => array(
				'type' => 'inline',
				'foreign_table' => 'tx_agora_domain_model_forum',
				'foreign_field' => 'forum',
				'maxitems'      => 9999,
				'appearance' => array(
					'collapseAll' => 0,
					'levelLinksPosition' => 'top',
					'showSynchronizationLink' => 1,
					'showPossibleLocalizationRecords' => 1,
					'showAllLocalizationLink' => 1
				),
			),

		),
		'threads' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:agora/Resources/Private/Language/locallang_db.xlf:tx_agora_domain_model_forum.threads',
			'config' => array(
				'type' => 'inline',
				'foreign_table' => 'tx_agora_domain_model_thread',
				'foreign_field' => 'forum',
				'maxitems'      => 9999,
				'appearance' => array(
					'collapseAll' => 0,
					'levelLinksPosition' => 'top',
					'showSynchronizationLink' => 1,
					'showPossibleLocalizationRecords' => 1,
					'showAllLocalizationLink' => 1
				),
			),

		),
		'groups_with_read_access' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:agora/Resources/Private/Language/locallang_db.xlf:tx_agora_domain_model_forum.groups_with_read_access',
			'config' => array(
				'type' => 'select',
				'foreign_table' => 'tx_agora_domain_model_group',
				'MM' => 'tx_agora_forum_groupswithreadaccess_group_mm',
				'size' => 10,
				'autoSizeMax' => 30,
				'maxitems' => 9999,
				'multiple' => 0,
				'wizards' => array(
					'_PADDING' => 1,
					'_VERTICAL' => 1,
					'edit' => array(
						'type' => 'popup',
						'title' => 'Edit',
						'script' => 'wizard_edit.php',
						'icon' => 'edit2.gif',
						'popup_onlyOpenIfSelected' => 1,
						'JSopenParams' => 'height=350,width=580,status=0,menubar=0,scrollbars=1',
						),
					'add' => Array(
						'type' => 'script',
						'title' => 'Create new',
						'icon' => 'add.gif',
						'params' => array(
							'table' => 'tx_agora_domain_model_group',
							'pid' => '###CURRENT_PID###',
							'setValue' => 'prepend'
							),
						'script' => 'wizard_add.php',
					),
				),
			),
		),
		'group_with_write_accesss' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:agora/Resources/Private/Language/locallang_db.xlf:tx_agora_domain_model_forum.group_with_write_accesss',
			'config' => array(
				'type' => 'select',
				'foreign_table' => 'tx_agora_domain_model_group',
				'MM' => 'tx_agora_forum_groupwithwriteaccesss_group_mm',
				'size' => 10,
				'autoSizeMax' => 30,
				'maxitems' => 9999,
				'multiple' => 0,
				'wizards' => array(
					'_PADDING' => 1,
					'_VERTICAL' => 1,
					'edit' => array(
						'type' => 'popup',
						'title' => 'Edit',
						'script' => 'wizard_edit.php',
						'icon' => 'edit2.gif',
						'popup_onlyOpenIfSelected' => 1,
						'JSopenParams' => 'height=350,width=580,status=0,menubar=0,scrollbars=1',
						),
					'add' => Array(
						'type' => 'script',
						'title' => 'Create new',
						'icon' => 'add.gif',
						'params' => array(
							'table' => 'tx_agora_domain_model_group',
							'pid' => '###CURRENT_PID###',
							'setValue' => 'prepend'
							),
						'script' => 'wizard_add.php',
					),
				),
			),
		),
		'groups_with_modification_access' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:agora/Resources/Private/Language/locallang_db.xlf:tx_agora_domain_model_forum.groups_with_modification_access',
			'config' => array(
				'type' => 'select',
				'foreign_table' => 'tx_agora_domain_model_group',
				'MM' => 'tx_agora_forum_group_mm',
				'size' => 10,
				'autoSizeMax' => 30,
				'maxitems' => 9999,
				'multiple' => 0,
				'wizards' => array(
					'_PADDING' => 1,
					'_VERTICAL' => 1,
					'edit' => array(
						'type' => 'popup',
						'title' => 'Edit',
						'script' => 'wizard_edit.php',
						'icon' => 'edit2.gif',
						'popup_onlyOpenIfSelected' => 1,
						'JSopenParams' => 'height=350,width=580,status=0,menubar=0,scrollbars=1',
						),
					'add' => Array(
						'type' => 'script',
						'title' => 'Create new',
						'icon' => 'add.gif',
						'params' => array(
							'table' => 'tx_agora_domain_model_group',
							'pid' => '###CURRENT_PID###',
							'setValue' => 'prepend'
							),
						'script' => 'wizard_add.php',
					),
				),
			),
		),
		'users_with_read_access' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:agora/Resources/Private/Language/locallang_db.xlf:tx_agora_domain_model_forum.users_with_read_access',
			'config' => array(
				'type' => 'select',
				'foreign_table' => 'tx_agora_domain_model_user',
				'MM' => 'tx_agora_forum_userswithreadaccess_user_mm',
				'size' => 10,
				'autoSizeMax' => 30,
				'maxitems' => 9999,
				'multiple' => 0,
				'wizards' => array(
					'_PADDING' => 1,
					'_VERTICAL' => 1,
					'edit' => array(
						'type' => 'popup',
						'title' => 'Edit',
						'script' => 'wizard_edit.php',
						'icon' => 'edit2.gif',
						'popup_onlyOpenIfSelected' => 1,
						'JSopenParams' => 'height=350,width=580,status=0,menubar=0,scrollbars=1',
						),
					'add' => Array(
						'type' => 'script',
						'title' => 'Create new',
						'icon' => 'add.gif',
						'params' => array(
							'table' => 'tx_agora_domain_model_user',
							'pid' => '###CURRENT_PID###',
							'setValue' => 'prepend'
							),
						'script' => 'wizard_add.php',
					),
				),
			),
		),
		'users_wth_write_accessii' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:agora/Resources/Private/Language/locallang_db.xlf:tx_agora_domain_model_forum.users_wth_write_accessii',
			'config' => array(
				'type' => 'select',
				'foreign_table' => 'tx_agora_domain_model_user',
				'MM' => 'tx_agora_forum_userswthwriteaccessii_user_mm',
				'size' => 10,
				'autoSizeMax' => 30,
				'maxitems' => 9999,
				'multiple' => 0,
				'wizards' => array(
					'_PADDING' => 1,
					'_VERTICAL' => 1,
					'edit' => array(
						'type' => 'popup',
						'title' => 'Edit',
						'script' => 'wizard_edit.php',
						'icon' => 'edit2.gif',
						'popup_onlyOpenIfSelected' => 1,
						'JSopenParams' => 'height=350,width=580,status=0,menubar=0,scrollbars=1',
						),
					'add' => Array(
						'type' => 'script',
						'title' => 'Create new',
						'icon' => 'add.gif',
						'params' => array(
							'table' => 'tx_agora_domain_model_user',
							'pid' => '###CURRENT_PID###',
							'setValue' => 'prepend'
							),
						'script' => 'wizard_add.php',
					),
				),
			),
		),
		'users_with_modification_access' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:agora/Resources/Private/Language/locallang_db.xlf:tx_agora_domain_model_forum.users_with_modification_access',
			'config' => array(
				'type' => 'select',
				'foreign_table' => 'tx_agora_domain_model_user',
				'MM' => 'tx_agora_forum_user_mm',
				'size' => 10,
				'autoSizeMax' => 30,
				'maxitems' => 9999,
				'multiple' => 0,
				'wizards' => array(
					'_PADDING' => 1,
					'_VERTICAL' => 1,
					'edit' => array(
						'type' => 'popup',
						'title' => 'Edit',
						'script' => 'wizard_edit.php',
						'icon' => 'edit2.gif',
						'popup_onlyOpenIfSelected' => 1,
						'JSopenParams' => 'height=350,width=580,status=0,menubar=0,scrollbars=1',
						),
					'add' => Array(
						'type' => 'script',
						'title' => 'Create new',
						'icon' => 'add.gif',
						'params' => array(
							'table' => 'tx_agora_domain_model_user',
							'pid' => '###CURRENT_PID###',
							'setValue' => 'prepend'
							),
						'script' => 'wizard_add.php',
					),
				),
			),
		),
		
		'forum' => array(
			'config' => array(
				'type' => 'passthrough',
			),
		),
	),
);

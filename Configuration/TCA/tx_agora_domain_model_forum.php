<?php
if (!defined('TYPO3_MODE')) {
    die ('Access denied.');
}

$ll = 'LLL:EXT:agora/Resources/Private/Language/locallang_db.xlf:';

return [
    'ctrl' => array(
        'title' => $lll . 'tx_agora_domain_model_forum',
        'label' => 'title',
        'tstamp' => 'tstamp',
        'crdate' => 'crdate',
        'cruser_id' => 'cruser_id',
        'dividers2tabs' => true,
        'sortby' => 'sorting',
        'versioningWS' => 2,
        'versioning_followPages' => true,

        'languageField' => 'sys_language_uid',
        'transOrigPointerField' => 'l10n_parent',
        'transOrigDiffSourceField' => 'l10n_diffsource',
        'delete' => 'deleted',
        'enablecolumns' => array(
            'disabled' => 'hidden',
            'starttime' => 'starttime',
            'endtime' => 'endtime',
        ),
        'searchFields' => 'title,description,public,parent,threads,groups_with_read_access,groups_with_write_access,
							groups_with_modification_access,users_with_read_access,users_with_write_access,
							users_with_modification_access,',
        'iconfile' => 'typo3conf/ext/agora/Resources/Public/Icons/tx_agora_domain_model_forum.gif'
    ),
    'interface' => array(
        'showRecordFieldList' => 'sys_language_uid, l10n_parent, l10n_diffsource, hidden, title, description,
									sub_forums, parent, threads, groups_with_read_access, groups_with_write_access,
									groups_with_modification_access, users_with_read_access, users_with_write_access,
									users_with_modification_access',
    ),
    'types' => array(
        '1' => array('showitem' => 'sys_language_uid;;;;1-1-1, l10n_parent, l10n_diffsource, hidden;;1, title,
									description, parent, --div--;LLL:EXT:cms/locallang_ttc.xlf:tabs.access,
									groups_with_read_access, groups_with_write_access, groups_with_modification_access,
									users_with_read_access, users_with_write_access, users_with_modification_access,
									starttime, endtime'
        ),
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
                'renderType' => 'selectSingleBox',
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
                'renderType' => 'selectSingleBox',
                'items' => array(
                    array('', 0),
                ),
                'foreign_table' => 'tx_agora_domain_model_forum',
                'foreign_table_where' => 'AND tx_agora_domain_model_forum.pid=###CURRENT_PID### AND
                tx_agora_domain_model_forum.sys_language_uid IN (-1,0)',
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

        'crdate' => array(
            'exclude' => 1,
            'label' => $lll . 'tx_agora_domain_model_forum.crdate',
            'config' => array(
                'type' => 'none',
                'format' => 'date',
                'eval' => 'date'
            )
        ),
        'tstamp' => array(
            'exclude' => 1,
            'label' => $lll . 'tx_agora_domain_model_forum.tstamp',
            'config' => array(
                'type' => 'none',
                'format' => 'date',
                'eval' => 'date'
            )
        ),

        'title' => array(
            'exclude' => 1,
            'label' => $lll . 'tx_agora_domain_model_forum.title',
            'config' => array(
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim'
            ),
        ),

        'description' => array(
            'exclude' => 1,
            'label' => $lll . 'tx_agora_domain_model_forum.description',
            'config' => array(
                'type' => 'text',
                'cols' => 40,
                'rows' => 15,
                'eval' => 'trim'
            )
        ),
        'sub_forums' => array(
            'exclude' => 1,
            'label' => $lll . 'tx_agora_domain_model_forum.sub_forums',
            'config' => array(
                'type' => 'inline',
                'foreign_table' => 'tx_agora_domain_model_forum',
                'foreign_field' => 'parent',
                'maxitems' => 9999,
                'appearance' => array(
                    'collapseAll' => 0,
                    'levelLinksPosition' => 'top',
                    'showSynchronizationLink' => 1,
                    'showPossibleLocalizationRecords' => 1,
                    'useSortable' => 1,
                    'showAllLocalizationLink' => 1
                ),
            ),
        ),
        'parent' => array(
            'exclude' => 1,
            'label' => $lll . 'tx_agora_domain_model_forum.parent',
            'config' => array(
                'type' => 'select',
                'renderType' => 'selectSingleBox',
                'items' => array(
                    array('', 0),
                ),
                'foreign_table' => 'tx_agora_domain_model_forum'
            ),
        ),
        'threads' => array(
            'exclude' => 1,
            'label' => $lll . 'tx_agora_domain_model_forum.threads',
            'config' => array(
                'type' => 'inline',
                'foreign_table' => 'tx_agora_domain_model_thread',
                'foreign_field' => 'forum',
                'maxitems' => 9999,
                'appearance' => array(
                    'collapseAll' => 0,
                    'levelLinksPosition' => 'top',
                    'showSynchronizationLink' => 1,
                    'showPossibleLocalizationRecords' => 1,
                    'useSortable' => 1,
                    'showAllLocalizationLink' => 1
                ),
            ),
        ),
        'groups_with_read_access' => array(
            'exclude' => 1,
            'label' => $lll . 'tx_agora_domain_model_forum.groups_with_read_access',
            'config' => array(
                'type' => 'select',
                'foreign_table' => 'fe_groups',
                'MM' => 'tx_agora_forum_groupswithreadaccess_mm',
                'size' => 10,
                'autoSizeMax' => 30,
                'maxitems' => 9999,
                'multiple' => 0,
            ),
        ),
        'groups_with_write_access' => array(
            'exclude' => 1,
            'label' => $lll . 'tx_agora_domain_model_forum.groups_with_write_access',
            'config' => array(
                'type' => 'select',
                'foreign_table' => 'fe_groups',
                'MM' => 'tx_agora_forum_groupswithwriteaccess_mm',
                'size' => 10,
                'autoSizeMax' => 30,
                'maxitems' => 9999,
                'multiple' => 0,
            ),
        ),
        'groups_with_modification_access' => array(
            'exclude' => 1,
            'label' => $lll . 'tx_agora_domain_model_forum.groups_with_modification_access',
            'config' => array(
                'type' => 'select',
                'foreign_table' => 'fe_groups',
                'MM' => 'tx_agora_forum_groupswithmodificationaccess_mm',
                'size' => 10,
                'autoSizeMax' => 30,
                'maxitems' => 9999,
                'multiple' => 0,
            ),
        ),
        'users_with_read_access' => array(
            'exclude' => 1,
            'label' => $lll . 'tx_agora_domain_model_forum.users_with_read_access',
            'config' => array(
                'type' => 'select',
                'foreign_table' => 'fe_users',
                'MM' => 'tx_agora_forum_userswithreadaccess_mm',
                'size' => 10,
                'autoSizeMax' => 30,
                'maxitems' => 9999,
                'multiple' => 0,
            ),
        ),
        'users_with_write_access' => array(
            'exclude' => 1,
            'label' => $lll . 'tx_agora_domain_model_forum.users_with_write_access',
            'config' => array(
                'type' => 'select',
                'foreign_table' => 'fe_users',
                'MM' => 'tx_agora_forum_userswithwriteaccess_mm',
                'size' => 10,
                'autoSizeMax' => 30,
                'maxitems' => 9999,
                'multiple' => 0,
            ),
        ),
        'users_with_modification_access' => array(
            'exclude' => 1,
            'label' => $lll . 'tx_agora_domain_model_forum.users_with_modification_access',
            'config' => array(
                'type' => 'select',
                'foreign_table' => 'fe_users',
                'MM' => 'tx_agora_forum_userswithmodificationaccess_mm',
                'size' => 10,
                'autoSizeMax' => 30,
                'maxitems' => 9999,
                'multiple' => 0,
            ),
        )
    ),
];

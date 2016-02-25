<?php
if (!defined('TYPO3_MODE')) {
    die ('Access denied.');
}

$ll = 'LLL:EXT:agora/Resources/Private/Language/locallang_db.xlf:';

return [
    'ctrl' => array(
        'title' => $lll . 'tx_agora_domain_model_post',
        'label' => 'topic',
        'tstamp' => 'tstamp',
        'crdate' => 'crdate',
        'cruser_id' => 'cruser_id',
        'dividers2tabs' => true,
        'sortby' => 'publishing_date',

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
        'searchFields' => 'topic,text,quoted_post,voting,attachments,creator,historical_versions,',
        'iconfile' => 'typo3conf/ext/agora/Resources/Public/Icons/tx_agora_domain_model_post.gif'
    ),
    'interface' => array(
        'showRecordFieldList' => 'sys_language_uid, l10n_parent, l10n_diffsource, hidden, topic, text, publishing_date,
		crdate, replies, quoted_post, creator, historical_versions, forum',
    ),
    'types' => array(
        '1' => array('showitem' => 'sys_language_uid;;;;1-1-1, l10n_parent, l10n_diffsource, hidden;;1, topic, text,
		publishing_date, crdate, replies, quoted_post, creator, historical_versions, forum,
		--div--;LLL:EXT:cms/locallang_ttc.xlf:tabs.access, starttime, endtime'),
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
                'foreign_table' => 'tx_agora_domain_model_post',
                'foreign_table_where' => 'AND tx_agora_domain_model_post.pid=###CURRENT_PID### AND
                                            tx_agora_domain_model_post.sys_language_uid IN (-1,0)',
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
        'tstamp' => array(
            'exclude' => 1,
            'label' => $lll . 'tx_agora_domain_model_post.tstamp',
            'config' => array(
                'type' => 'none',
                'format' => 'date',
                'eval' => 'date'
            )
        ),

        'topic' => array(
            'exclude' => 1,
            'label' => $lll . 'tx_agora_domain_model_post.topic',
            'config' => array(
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim'
            ),
        ),
        'text' => array(
            'exclude' => 1,
            'label' => $lll . 'tx_agora_domain_model_post.text',
            'config' => array(
                'type' => 'user',
                'userFunc' => 'AgoraTeam\Agora\UserFunc\Parsedown->getParsedText',
                'parameter' => array(
                    'table' => 'tx_agora_domain_model_post',
                    'field' => 'text'
                )
            )
        ),
        'publishing_date' => array(
            'exclude' => 1,
            'l10n_mode' => 'mergeIfNotBlank',
            'label' => $lll . 'tx_agora_domain_model_post.publishing_date',
            'config' => array(
                'type' => 'input',
                'size' => 13,
                'max' => 20,
                'eval' => 'datetime',
                'checkbox' => 0,
                'default' => 0
            ),
        ),
        'crdate' => array(
            'exclude' => 1,
            'l10n_mode' => 'mergeIfNotBlank',
            'label' => $lll . 'tx_agora_domain_model_post.crdate',
            'config' => array(
                'type' => 'input',
                'size' => 13,
                'max' => 20,
                'eval' => 'datetime',
                'checkbox' => 0,
                'default' => 0
            ),
        ),
        'quoted_post' => array(
            'exclude' => 1,
            'label' => $lll . 'tx_agora_domain_model_post.quoted_post',
            'config' => array(
                'type' => 'select',
                'renderType' => 'selectSingleBox',
                'items' => array(
                    array('', 0),
                ),
                'foreign_table' => 'tx_agora_domain_model_post'
            ),
        ),
        'replies' => array(
            'exclude' => 1,
            'label' => $lll . 'tx_agora_domain_model_post.replies',
            'config' => array(
                'type' => 'inline',
                'foreign_table' => 'tx_agora_domain_model_post',
                'foreign_field' => 'quoted_post',
                'maxitems' => 9999,
                'appearance' => array(
                    'collapseAll' => 0,
                    'levelLinksPosition' => 'top',
                    'showSynchronizationLink' => 1,
                    'showPossibleLocalizationRecords' => 1,
                    'showAllLocalizationLink' => 1
                ),
            ),
        ),
        'voting' => array(
            'exclude' => 1,
            'label' => $lll . 'tx_agora_domain_model_post.voting',
            'config' => array(
                'type' => 'inline',
                'foreign_table' => 'tx_agora_domain_model_voting',
                'minitems' => 0,
                'maxitems' => 1,
                'appearance' => array(
                    'collapseAll' => 0,
                    'levelLinksPosition' => 'top',
                    'showSynchronizationLink' => 1,
                    'showPossibleLocalizationRecords' => 1,
                    'showAllLocalizationLink' => 1
                ),
            ),
        ),
        'attachments' => array(
            'exclude' => 1,
            'label' => $lll . 'tx_agora_domain_model_post.attachments',
            'config' => array(
                'type' => 'inline',
                'foreign_table' => 'tx_agora_domain_model_attachment',
                'foreign_field' => 'post',
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
        'creator' => array(
            'exclude' => 1,
            'label' => $lll . 'tx_agora_domain_model_post.creator',
            'config' => array(
                'type' => 'select',
                'renderType' => 'selectSingleBox',
                'items' => array(
                    array('', 0),
                ),
                'foreign_table' => 'fe_users'
            ),
        ),
        'historical_versions' => array(
            'exclude' => 1,
            'label' => $lll . 'tx_agora_domain_model_post.historical_versions',
            'config' => array(
                'type' => 'inline',
                'foreign_table' => 'tx_agora_domain_model_post',
                'foreign_field' => 'original_post',
                'maxitems' => 9999,
                'appearance' => array(
                    'collapseAll' => 0,
                    'levelLinksPosition' => 'top',
                    'showSynchronizationLink' => 1,
                    'showPossibleLocalizationRecords' => 1,
                    'showAllLocalizationLink' => 1
                ),
            ),
        ),
        'thread' => array(
            'exclude' => 1,
            'label' => $lll . 'tx_agora_domain_model_post.thread',
            'config' => array(
                'type' => 'select',
                'renderType' => 'selectSingleBox',
                'items' => array(
                    array('', 0),
                ),
                'foreign_table' => 'tx_agora_domain_model_thread'
            ),
        ),
        'forum' => array(
            'exclude' => 1,
            'label' => $lll . 'tx_agora_domain_model_post.forum',
            'config' => array(
                'type' => 'input',
                'size' => 30,
                'max' => 255,
                'readOnly' => 1,
                'foreign_table' => 'tx_agora_domain_model_forum',
                'foreign_field' => 'title',
            )
        )
    )
];

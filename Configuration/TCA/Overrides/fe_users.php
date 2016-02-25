<?php
defined('TYPO3_MODE') or die();

$lll = 'LLL:EXT:agora/Resources/Private/Language/locallang_db.xlf:';

if (!isset($GLOBALS['TCA']['fe_users']['ctrl']['type'])) {
    if (file_exists($GLOBALS['TCA']['fe_users']['ctrl']['dynamicConfigFile'])) {
        require_once($GLOBALS['TCA']['fe_users']['ctrl']['dynamicConfigFile']);
    }
    $GLOBALS['TCA']['fe_users']['ctrl']['type'] = 'tx_extbase_type';
    $tempColumns = array();
    $tempColumns[$GLOBALS['TCA']['fe_users']['ctrl']['type']] = array(
        'exclude' => 1,
        'label' => 'LLL:EXT:agora/Resources/Private/Language/locallang_db.xlf:tx_agora.tx_extbase_type',
        'config' => array(
            'type' => 'select',
            'items' => array(),
            'size' => 1,
            'maxitems' => 1,
        )
    );
    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTCAcolumns('fe_users', $tempColumns, 1);
}

$tmpAgoraColumns = array(
    'signiture' => array(
        'exclude' => 1,
        'label' => $lll . 'tx_agora_domain_model_user.signiture',
        'config' => array(
            'type' => 'text',
            'cols' => 40,
            'rows' => 15,
            'eval' => 'trim'
        )
    ),
    'posts' => array(
        'exclude' => 1,
        'label' => $lll . 'tx_agora_domain_model_user.posts',
        'config' => array(
            'type' => 'inline',
            'foreign_table' => 'tx_agora_domain_model_post',
            'foreign_field' => 'user',
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
    'favorite_posts' => array(
        'exclude' => 1,
        'label' => $lll . 'tx_agora_domain_model_user.favorite_posts',
        'config' => array(
            'type' => 'select',
            'foreign_table' => 'tx_agora_domain_model_post',
            'MM' => 'tx_agora_feuser_post_mm',
            'size' => 5,
            'minitems' => 0,
            'maxitems' => 9999,
            'renderMode' => 'checkbox',
        ),
    ),
    'observed_threads' => array(
        'exclude' => 1,
        'label' => $lll . 'tx_agora_domain_model_thread.user',
        'config' => array(
            'type' => 'select',
            'foreign_table' => 'tx_agora_domain_model_thread',
            'MM' => 'tx_agora_feuser_thread_mm',
            'size' => 5,
            'minitems' => 0,
            'maxitems' => 9999,
            'renderMode' => 'checkbox',
        ),
    ),
    'spam_posts' => array(
        'exclude' => 1,
        'label' => $lll . 'tx_agora_domain_model_user.spam_posts',
        'config' => array(
            'type' => 'inline',
            'foreign_table' => 'tx_agora_domain_model_post',
            'foreign_field' => 'user2',
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
    'view' => array(
        'config' => array(
            'type' => 'passthrough',
        )
    )
);
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTCAcolumns('fe_users', $tmpAgoraColumns);

$GLOBALS['TCA']['fe_users']['types']['Tx_Agora_User']['showitem'] =
    $GLOBALS['TCA']['fe_users']['types']['0']['showitem'] .
    ',--div--;LLL:EXT:agora/Resources/Private/Language/locallang_db.xlf:tx_agora_domain_model_user,
	signiture, posts, favorite_posts, observed_threads, spam_posts, groups';

$GLOBALS['TCA']['fe_users']['columns']['tx_extbase_type']['config']['items'][] = array(
    $lll . 'fe_users.tx_extbase_type.Tx_Agora_User',
    'Tx_Agora_User'
);
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addToAllTCAtypes(
    'fe_users',
    $GLOBALS['TCA']['fe_users']['ctrl']['type'],
    '',
    'after:' . $TCA['fe_users']['ctrl']['label']
);

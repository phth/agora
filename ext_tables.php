<?php
if (!defined('TYPO3_MODE')) {
    die('Access denied.');
}

if (TYPO3_MODE === 'BE') {
    /**
     * Registers a Backend Module
     */
    \TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerModule(
        'AgoraTeam.' . $_EXTKEY,
        'web',
        'forum',
        '',
        array(
            'ForumAdmin' => 'list, new, create, edit, update, statistic,delete',

        ),
        array(
            'access' => 'user,group',
            'icon' => 'EXT:' . $_EXTKEY . '/ext_icon.gif',
            'labels' => 'LLL:EXT:' . $_EXTKEY . '/Resources/Private/Language/locallang_forum.xlf',
        )
    );
}

/*-----------------------------------------------------------------------
 * Register plugins
 *----------------------------------------------------------------------*/
\TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin(
    $_EXTKEY,
    'Forum',
    'Forum'
);
\TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin(
    $_EXTKEY,
    'Widgets',
    'Widgets'
);
\TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin(
    $_EXTKEY,
    'Forumpages',
    'Forumpages'
);

$pluginSignature = str_replace('_', '', $_EXTKEY) . '_widgets';
$GLOBALS['TCA']['tt_content']['types']['list']['subtypes_addlist'][$pluginSignature] = 'pi_flexform';
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPiFlexFormValue(
    $pluginSignature,
    'FILE:EXT:' . $_EXTKEY . '/Configuration/FlexForms/flexform_widgets.xml'
);

$pluginSignature = str_replace('_', '', $_EXTKEY) . '_forumpages';
$GLOBALS['TCA']['tt_content']['types']['list']['subtypes_addlist'][$pluginSignature] = 'pi_flexform';
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPiFlexFormValue(
    $pluginSignature,
    'FILE:EXT:' . $_EXTKEY . '/Configuration/FlexForms/flexform_forumpages.xml'
);

/*-----------------------------------------------------------------------
 * Add static files
 *----------------------------------------------------------------------*/
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addStaticFile(
    $_EXTKEY,
    'Configuration/TypoScript/Main',
    'Agora - TYPO3 Forum'
);
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addStaticFile(
    $_EXTKEY,
    'Configuration/TypoScript/ExampleTemplate',
    'Agora - TYPO3 Forum - Bootstrap Theme'
);


/*-----------------------------------------------------------------------
 * AddLLrefForTCAdescr
 *----------------------------------------------------------------------*/
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr(
    'tx_agora_domain_model_forum',
    'EXT:agora/Resources/Private/Language/locallang_csh_tx_agora_domain_model_forum.xlf'
);
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr(
    'tx_agora_domain_model_thread',
    'EXT:agora/Resources/Private/Language/locallang_csh_tx_agora_domain_model_thread.xlf'
);
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr(
    'tx_agora_domain_model_post',
    'EXT:agora/Resources/Private/Language/locallang_csh_tx_agora_domain_model_post.xlf'
);
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr(
    'tx_agora_domain_model_votinganswer',
    'EXT:agora/Resources/Private/Language/locallang_csh_tx_agora_domain_model_votinganswer.xlf'
);
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr(
    'tx_agora_domain_model_vote',
    'EXT:agora/Resources/Private/Language/locallang_csh_tx_agora_domain_model_vote.xlf'
);
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr(
    'tx_agora_domain_model_attachment',
    'EXT:agora/Resources/Private/Language/locallang_csh_tx_agora_domain_model_attachment.xlf'
);
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr(
    'tx_agora_domain_model_voting',
    'EXT:agora/Resources/Private/Language/locallang_csh_tx_agora_domain_model_voting.xlf'
);

/*-----------------------------------------------------------------------
 * AllowTablesOnStandardPages
 *----------------------------------------------------------------------*/
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_agora_domain_model_forum');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_agora_domain_model_thread');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_agora_domain_model_post');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_agora_domain_model_view');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_agora_domain_model_vote');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_agora_domain_model_votinganswer');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_agora_domain_model_attachment');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_agora_domain_model_voting');


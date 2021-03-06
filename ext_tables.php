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
			'icon'   => 'EXT:' . $_EXTKEY . '/ext_icon.gif',
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
	'Configuration/TypoScript/Main', 'Agora - TYPO3 Forum'
);
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addStaticFile(
	$_EXTKEY,
	'Configuration/TypoScript/ExampleTemplate', 'Agora - TYPO3 Forum - Bootstrap Theme'
);

/*-----------------------------------------------------------------------
 * TCA-Configurations
 *----------------------------------------------------------------------*/
$GLOBALS['TCA']['tx_agora_domain_model_forum'] = array(
	'ctrl' => array(
		'title'	=> 'LLL:EXT:agora/Resources/Private/Language/locallang_db.xlf:tx_agora_domain_model_forum',
		'label' => 'title',
		'tstamp' => 'tstamp',
		'crdate' => 'crdate',
		'cruser_id' => 'cruser_id',
		'dividers2tabs' => TRUE,
		'sortby' => 'sorting',
		'versioningWS' => 2,
		'versioning_followPages' => TRUE,

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
		'dynamicConfigFile' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extPath($_EXTKEY) . 'Configuration/TCA/Forum.php',
		'iconfile' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extRelPath($_EXTKEY) .
			'Resources/Public/Icons/tx_agora_domain_model_forum.gif'
	),
);
$GLOBALS['TCA']['tx_agora_domain_model_post'] = array(
	'ctrl' => array(
		'title'	=> 'LLL:EXT:agora/Resources/Private/Language/locallang_db.xlf:tx_agora_domain_model_post',
		'label' => 'topic',
		'tstamp' => 'tstamp',
		'crdate' => 'crdate',
		'cruser_id' => 'cruser_id',
		'dividers2tabs' => TRUE,
		'sortby' => 'publishing_date',

		'versioningWS' => 2,
		'versioning_followPages' => TRUE,

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
		'dynamicConfigFile' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extPath($_EXTKEY) . 'Configuration/TCA/Post.php',
		'iconfile' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extRelPath($_EXTKEY) .
			'Resources/Public/Icons/tx_agora_domain_model_post.gif'
	),
);
$GLOBALS['TCA']['tx_agora_domain_model_thread'] = array(
	'ctrl' => array(
		'title'	=> 'LLL:EXT:agora/Resources/Private/Language/locallang_db.xlf:tx_agora_domain_model_thread',
		'label' => 'title',
		'tstamp' => 'tstamp',
		'crdate' => 'crdate',
		'cruser_id' => 'cruser_id',
		'dividers2tabs' => TRUE,
		'sortby' => 'sorting',
		'versioningWS' => 2,
		'versioning_followPages' => TRUE,

		'languageField' => 'sys_language_uid',
		'transOrigPointerField' => 'l10n_parent',
		'transOrigDiffSourceField' => 'l10n_diffsource',
		'delete' => 'deleted',
		'enablecolumns' => array(
			'disabled' => 'hidden',
			'starttime' => 'starttime',
			'endtime' => 'endtime',
		),
		'searchFields' => 'title,solved,closed,sticky,creator,posts,views,groups_with_read_access,
							groups_with_write_access,groups_with_modification_access,users_with_read_access,
							users_with_write_access,users_with_modification_access,',
		'dynamicConfigFile' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extPath($_EXTKEY) . 'Configuration/TCA/Thread.php',
		'iconfile' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extRelPath($_EXTKEY) .
			'Resources/Public/Icons/tx_agora_domain_model_thread.gif'
	),
);
$GLOBALS['TCA']['tx_agora_domain_model_view'] = array(
	'ctrl' => array(
		'title'	=> 'LLL:EXT:agora/Resources/Private/Language/locallang_db.xlf:tx_agora_domain_model_view',
		'label' => 'thread',
		'tstamp' => 'tstamp',
		'crdate' => 'crdate',
		'cruser_id' => 'cruser_id',
		'dividers2tabs' => TRUE,

		'versioningWS' => 2,
		'versioning_followPages' => TRUE,

		'languageField' => 'sys_language_uid',
		'transOrigPointerField' => 'l10n_parent',
		'transOrigDiffSourceField' => 'l10n_diffsource',
		'delete' => 'deleted',
		'enablecolumns' => array(
			'disabled' => 'hidden',
			'starttime' => 'starttime',
			'endtime' => 'endtime',
		),
		'searchFields' => 'thread,user,',
		'dynamicConfigFile' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extPath($_EXTKEY) . 'Configuration/TCA/View.php',
		'iconfile' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extRelPath($_EXTKEY) .
			'Resources/Public/Icons/tx_agora_domain_model_view.gif'
	),
);
$GLOBALS['TCA']['tx_agora_domain_model_voting'] = array(
	'ctrl' => array(
		'title'	=> 'LLL:EXT:agora/Resources/Private/Language/locallang_db.xlf:tx_agora_domain_model_voting',
		'label' => 'question',
		'tstamp' => 'tstamp',
		'crdate' => 'crdate',
		'cruser_id' => 'cruser_id',
		'dividers2tabs' => TRUE,

		'versioningWS' => 2,
		'versioning_followPages' => TRUE,

		'languageField' => 'sys_language_uid',
		'transOrigPointerField' => 'l10n_parent',
		'transOrigDiffSourceField' => 'l10n_diffsource',
		'delete' => 'deleted',
		'enablecolumns' => array(
			'disabled' => 'hidden',
			'starttime' => 'starttime',
			'endtime' => 'endtime',
		),
		'searchFields' => 'question,answers,',
		'dynamicConfigFile' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extPath($_EXTKEY) . 'Configuration/TCA/Voting.php',
		'iconfile' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extRelPath($_EXTKEY) .
			'Resources/Public/Icons/tx_agora_domain_model_voting.gif'
	),
);
$GLOBALS['TCA']['tx_agora_domain_model_attachment'] = array(
	'ctrl' => array(
		'title'	=> 'LLL:EXT:agora/Resources/Private/Language/locallang_db.xlf:tx_agora_domain_model_attachment',
		'label' => 'title',
		'tstamp' => 'tstamp',
		'crdate' => 'crdate',
		'cruser_id' => 'cruser_id',
		'dividers2tabs' => TRUE,
		'sortby' => 'sorting',
		'versioningWS' => 2,
		'versioning_followPages' => TRUE,

		'languageField' => 'sys_language_uid',
		'transOrigPointerField' => 'l10n_parent',
		'transOrigDiffSourceField' => 'l10n_diffsource',
		'delete' => 'deleted',
		'enablecolumns' => array(
			'disabled' => 'hidden',
			'starttime' => 'starttime',
			'endtime' => 'endtime',
		),
		'searchFields' => 'title,file,',
		'dynamicConfigFile' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extPath($_EXTKEY) .
			'Configuration/TCA/Attachment.php',
		'iconfile' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extRelPath($_EXTKEY) .
			'Resources/Public/Icons/tx_agora_domain_model_attachment.gif'
	),
);
$GLOBALS['TCA']['tx_agora_domain_model_vote'] = array(
	'ctrl' => array(
		'title'	=> 'LLL:EXT:agora/Resources/Private/Language/locallang_db.xlf:tx_agora_domain_model_vote',
		'label' => 'voting',
		'tstamp' => 'tstamp',
		'crdate' => 'crdate',
		'cruser_id' => 'cruser_id',
		'dividers2tabs' => TRUE,

		'versioningWS' => 2,
		'versioning_followPages' => TRUE,

		'languageField' => 'sys_language_uid',
		'transOrigPointerField' => 'l10n_parent',
		'transOrigDiffSourceField' => 'l10n_diffsource',
		'delete' => 'deleted',
		'enablecolumns' => array(
			'disabled' => 'hidden',
			'starttime' => 'starttime',
			'endtime' => 'endtime',
		),
		'searchFields' => 'voting,voting_answers,user,',
		'dynamicConfigFile' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extPath($_EXTKEY) . 'Configuration/TCA/Vote.php',
		'iconfile' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extRelPath($_EXTKEY) .
			'Resources/Public/Icons/tx_agora_domain_model_vote.gif'
	),
);
$GLOBALS['TCA']['tx_agora_domain_model_votinganswer'] = array(
	'ctrl' => array(
		'title'	=> 'LLL:EXT:agora/Resources/Private/Language/locallang_db.xlf:tx_agora_domain_model_votinganswer',
		'label' => 'answer',
		'tstamp' => 'tstamp',
		'crdate' => 'crdate',
		'cruser_id' => 'cruser_id',
		'dividers2tabs' => TRUE,
		'sortby' => 'sorting',
		'versioningWS' => 2,
		'versioning_followPages' => TRUE,

		'languageField' => 'sys_language_uid',
		'transOrigPointerField' => 'l10n_parent',
		'transOrigDiffSourceField' => 'l10n_diffsource',
		'delete' => 'deleted',
		'enablecolumns' => array(
			'disabled' => 'hidden',
			'starttime' => 'starttime',
			'endtime' => 'endtime',
		),
		'searchFields' => 'answer,',
		'dynamicConfigFile' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extPath($_EXTKEY) .
			'Configuration/TCA/VotingAnswer.php',
		'iconfile' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extRelPath($_EXTKEY) .
			'Resources/Public/Icons/tx_agora_domain_model_votinganswer.gif'
	),
);

// Hide none used tables
$GLOBALS['TCA']['tx_agora_domain_model_view']['ctrl']['hideTable'] = 1;
$GLOBALS['TCA']['tx_agora_domain_model_voting']['ctrl']['hideTable'] = 1;
$GLOBALS['TCA']['tx_agora_domain_model_attachment']['ctrl']['hideTable'] = 1;
$GLOBALS['TCA']['tx_agora_domain_model_vote']['ctrl']['hideTable'] = 1;
$GLOBALS['TCA']['tx_agora_domain_model_votinganswer']['ctrl']['hideTable'] = 1;

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

/*-----------------------------------------------------------------------
 * UserConfiguration
 *----------------------------------------------------------------------*/
if (!isset($GLOBALS['TCA']['fe_users']['ctrl']['type'])) {
	if (file_exists($GLOBALS['TCA']['fe_users']['ctrl']['dynamicConfigFile'])) {
		require_once($GLOBALS['TCA']['fe_users']['ctrl']['dynamicConfigFile']);
	}
	$GLOBALS['TCA']['fe_users']['ctrl']['type'] = 'tx_extbase_type';
	$tempColumns = array();
	$tempColumns[$GLOBALS['TCA']['fe_users']['ctrl']['type']] = array(
		'exclude' => 1,
		'label'   => 'LLL:EXT:agora/Resources/Private/Language/locallang_db.xlf:tx_agora.tx_extbase_type',
		'config' => array(
			'type' => 'select',
			'items' => array(),
			'size' => 1,
			'maxitems' => 1,
		)
	);
	\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTCAcolumns('fe_users', $tempColumns, 1);
}

if (!isset($GLOBALS['TCA']['fe_groups']['ctrl']['type'])) {
	if (file_exists($GLOBALS['TCA']['fe_groups']['ctrl']['dynamicConfigFile'])) {
		require_once($GLOBALS['TCA']['fe_groups']['ctrl']['dynamicConfigFile']);
	}
	$GLOBALS['TCA']['fe_groups']['ctrl']['type'] = 'tx_extbase_type';
	$tempColumns = array();
	$tempColumns[$GLOBALS['TCA']['fe_groups']['ctrl']['type']] = array(
		'exclude' => 1,
		'label'   => 'LLL:EXT:agora/Resources/Private/Language/locallang_db.xlf:tx_agora.tx_extbase_type',
		'config' => array(
			'type' => 'select',
			'items' => array(),
			'size' => 1,
			'maxitems' => 1,
		)
	);
	\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTCAcolumns('fe_groups', $tempColumns, 1);
}

$GLOBALS['TCA']['fe_groups']['types']['Tx_Agora_Group']['showitem'] = $TCA['fe_groups']['types']['0']['showitem'] .
	',--div--;LLL:EXT:agora/Resources/Private/Language/locallang_db.xlf:tx_agora_domain_model_group,';

$GLOBALS['TCA']['fe_groups']['columns'][$TCA['fe_groups']['ctrl']['type']]['config']['items'][] = array(
	'LLL:EXT:agora/Resources/Private/Language/locallang_db.xlf:fe_groups.tx_extbase_type.Tx_Agora_Group',
	'Tx_Agora_Group'
);

$tmpAgoraColumns = array(
	'signiture' => array(
		'exclude' => 1,
		'label' => 'LLL:EXT:agora/Resources/Private/Language/locallang_db.xlf:tx_agora_domain_model_user.signiture',
		'config' => array(
			'type' => 'text',
			'cols' => 40,
			'rows' => 15,
			'eval' => 'trim'
		)
	),
	'posts' => array(
		'exclude' => 1,
		'label' => 'LLL:EXT:agora/Resources/Private/Language/locallang_db.xlf:tx_agora_domain_model_user.posts',
		'config' => array(
			'type' => 'inline',
			'foreign_table' => 'tx_agora_domain_model_post',
			'foreign_field' => 'user',
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
	'favorite_posts' => array(
		'exclude' => 1,
		'label' => 'LLL:EXT:agora/Resources/Private/Language/locallang_db.xlf:tx_agora_domain_model_user.favorite_posts',
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
		'label' => 'LLL:EXT:agora/Resources/Private/Language/locallang_db.xlf:tx_agora_domain_model_thread.user',
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
		'label' => 'LLL:EXT:agora/Resources/Private/Language/locallang_db.xlf:tx_agora_domain_model_user.spam_posts',
		'config' => array(
			'type' => 'inline',
			'foreign_table' => 'tx_agora_domain_model_post',
			'foreign_field' => 'user2',
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
	'view' => array(
		'config' => array(
			'type' => 'passthrough',
		)
	)
);
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTCAcolumns('fe_users', $tmpAgoraColumns);

$GLOBALS['TCA']['fe_users']['types']['Tx_Agora_User']['showitem'] = $TCA['fe_users']['types']['0']['showitem'] .
	',--div--;LLL:EXT:agora/Resources/Private/Language/locallang_db.xlf:tx_agora_domain_model_user,
	signiture, posts, favorite_posts, observed_threads, spam_posts, groups';

$GLOBALS['TCA']['fe_users']['columns'][$TCA['fe_users']['ctrl']['type']]['config']['items'][] = array(
	'LLL:EXT:agora/Resources/Private/Language/locallang_db.xlf:fe_users.tx_extbase_type.Tx_Agora_User',
	'Tx_Agora_User'
);

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addToAllTCAtypes(
	'fe_users',
	$GLOBALS['TCA']['fe_users']['ctrl']['type'],
	'',
	'after:' . $TCA['fe_users']['ctrl']['label']
);
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addToAllTCAtypes(
	'fe_groups',
	$GLOBALS['TCA']['fe_groups']['ctrl']['type'],
	'',
	'after:' . $TCA['fe_groups']['ctrl']['label']
);

<?php
if (!defined('TYPO3_MODE')) {
	die('Access denied.');
}

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
	'AgoraTeam.' . $_EXTKEY,
	'Forum',
	array(
		'Forum' => 'list, delete, edit, new, create',
		'Thread' => 'list, delete, edit, new, create',
		'Post' => 'list, show, delete, edit, new, create',
		'User' => 'addObservedThread, removeObservedThread',
		'Attachment' => 'download'
	),
	array(
		'Forum' => 'list, delete, edit, new, create',
		'Thread' => 'list, delete, edit, new, create',
		'Post' => 'list, show, delete, edit, new, create',
		'User' => 'addObservedThread, removeObservedThread',
		'Attachment' => 'download',

	)
);

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
	'AgoraTeam.' . $_EXTKEY,
	'Widgets',
	array(
		'Post' => 'listLatest',
		'Thread' => 'listLatest',
		'User' => 'favoritePosts, observedThreads, removeObservedThread',
		'Message' => 'list, show, new, create, delete, listConversation'
	),
	array(
        'Post' => 'listLatest',
        'Thread' => 'listLatest',
        'User' => 'favoritePosts, observedThreads, removeObservedThread',
        'Message' => 'list, show, new, create, delete, listConversation'
	)
);

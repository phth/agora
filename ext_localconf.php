<?php
if (!defined('TYPO3_MODE')) {
	die('Access denied.');
}

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
	'AgoraTeam.' . $_EXTKEY,
	'Forum',
	array(
		'Forum' => 'list, delete, edit, update, new, create',
		'Thread' => 'list, delete, edit, update, new, create',
		'Post' => 'list, show, showHistory, delete, edit, update, new, create',
		'User' => 'addObservedThread, removeObservedThread, addFavoritePost, removeFavoritePost',
		'Attachment' => 'download'
	),
	array(
		'Forum' => 'list, delete, edit, update, new, create',
		'Thread' => 'list, delete, edit, update, new, create',
		'Post' => 'list, show, showHistory, delete, edit, update, new, create',
		'User' => 'addObservedThread, removeObservedThread, addFavoritePost, removeFavoritePost',
		'Attachment' => 'download',
	)
);

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
	'AgoraTeam.' . $_EXTKEY,
	'Widgets',
	array(
		'Post' => 'listLatest',
		'Thread' => 'listLatest',
		'User' => 'favoritePosts, observedThreads, removeObservedThread, removeFavoritePost'
	),
	array(
        'Post' => 'listLatest',
        'Thread' => 'listLatest',
        'User' => 'favoritePosts, observedThreads, removeObservedThread, removeFavoritePost'
	)
);

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
	'AgoraTeam.' . $_EXTKEY,
	'Forumpages',
	array(
		'User' => 'removeObservedThread, listObservedThreads',
	),
	array(
        'User' => 'removeObservedThread, listObservedThreads',
	)
);

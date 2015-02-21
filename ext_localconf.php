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
		'Attachment' => 'download',
		
	),
	// non-cacheable actions
	array(
		'Forum' => 'list, delete, edit, new, create',
		'Thread' => 'list, delete, edit, new, create',
		'Post' => 'list, show, delete, edit, new, create',
		'Attachment' => 'download',
		
	)
);

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
	'AgoraTeam.' . $_EXTKEY,
	'Widgets',
	array(
		'Forum' => 'list, show, new, create, edit, update, delete',
		'Post' => 'list, show, new, create, edit, update, delete, listLatest',
		'Thread' => 'list, show, new, create, edit, update, delete, listLatest',
		'Message' => 'list, show, new, create, delete, listConversation',
		'Attachment' => 'download',
		
	),
	// non-cacheable actions
	array(
		'Forum' => 'create, update, delete',
		'Post' => 'create, update, delete, ',
		'Thread' => 'create, update, delete, ',
		'Message' => 'create, delete, ',
		'Attachment' => '',
		
	)
);

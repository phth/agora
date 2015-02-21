<?php
if (!defined('TYPO3_MODE')) {
	die('Access denied.');
}

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
	'AgoraTeam.' . $_EXTKEY,
	'Forum',
	array(
		'Forum' => 'show, list, delete, edit, new, ',
		
	),
	// non-cacheable actions
	array(
		'Forum' => 'create, update, delete',
		'Post' => 'create, update, delete',
		'Thread' => 'create, update, delete',
		
	)
);

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
	'AgoraTeam.' . $_EXTKEY,
	'Dashboard',
	array(
		'Forum' => 'list, show, new, create, edit, update, delete',
		'Post' => 'list, show, new, create, edit, update, delete',
		'Thread' => 'list, show, new, create, edit, update, delete',
		
	),
	// non-cacheable actions
	array(
		'Forum' => 'create, update, delete',
		'Post' => 'create, update, delete',
		'Thread' => 'create, update, delete',
		
	)
);

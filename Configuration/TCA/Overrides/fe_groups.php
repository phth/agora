<?php
defined('TYPO3_MODE') or die();

$lll = 'LLL:EXT:agora/Resources/Private/Language/locallang_db.xlf:';


if (!isset($GLOBALS['TCA']['fe_groups']['ctrl']['type'])) {
    if (file_exists($GLOBALS['TCA']['fe_groups']['ctrl']['dynamicConfigFile'])) {
        require_once($GLOBALS['TCA']['fe_groups']['ctrl']['dynamicConfigFile']);
    }
    $GLOBALS['TCA']['fe_groups']['ctrl']['type'] = 'tx_extbase_type';
    $tempColumns = array();
    $tempColumns[$GLOBALS['TCA']['fe_groups']['ctrl']['type']] = array(
        'exclude' => 1,
        'label' => 'LLL:EXT:agora/Resources/Private/Language/locallang_db.xlf:tx_agora.tx_extbase_type',
        'config' => array(
            'type' => 'select',
            'items' => array(),
            'size' => 1,
            'maxitems' => 1,
        )
    );
    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTCAcolumns('fe_groups', $tempColumns, 1);
}


$GLOBALS['TCA']['fe_groups']['types']['Tx_Agora_Group']['showitem'] =
    $GLOBALS['TCA']['fe_groups']['types']['0']['showitem'] .
    ',--div--;LLL:EXT:agora/Resources/Private/Language/locallang_db.xlf:tx_agora_domain_model_group,';

$GLOBALS['TCA']['fe_groups']['columns']['tx_extbase_type']['config']['items'][] = array(
    $lll . 'fe_groups.tx_extbase_type.Tx_Agora_Group',
    'Tx_Agora_Group'
);

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addToAllTCAtypes(
    'fe_groups',
    $GLOBALS['TCA']['fe_groups']['ctrl']['type'],
    '',
    'after:' . $GLOBALS['TCA']['fe_groups']['ctrl']['label']
);

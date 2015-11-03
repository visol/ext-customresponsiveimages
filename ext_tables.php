<?php
if (!defined('TYPO3_MODE')) {
	die('Access denied.');
}

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addStaticFile($_EXTKEY, 'Configuration/TypoScript', 'Custom Responsive Images');

// Unserializing the configuration so we can use it here
$extensionConfiguration = unserialize($_EXTCONF);
if ((bool)$extensionConfiguration['enableDefaultConfiguration']) {
	\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPageTSConfig('<INCLUDE_TYPOSCRIPT: source="FILE:EXT:customresponsiveimages/Resources/Private/TSConfig/PageTSConfig/default.ts">');
	unset($GLOBALS['TCA']['tt_content']['columns']['imageorient']['config']['items']);
	$GLOBALS['TCA']['tt_content']['columns']['imageorient']['config']['itemsProcFunc'] =
		'Visol\Customresponsiveimages\Hook\ImageorientItemsProcFunc->setImageorientItems';
}
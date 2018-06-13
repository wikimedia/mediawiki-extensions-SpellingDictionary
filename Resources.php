<?php
/**
 * Resource loader module definitions.
 *
 * @file
 * @license GPL-2.0-or-later
 */

$resourcePaths = [
	'localBasePath' => __DIR__,
	'remoteExtPath' => 'Spellingictionary/' . basename( __DIR__ )
];

// Register modules
// See also http://www.mediawiki.org/wiki/Manual:$wgResourceModules
// ResourceLoader modules are the de facto standard way to easily
// load JavaScript and CSS files to the client.
$wgResourceModules['SpellingDictionary'] = [
	'styles' => [
		'modules/SpellingDictionary.css',
	],
	'scripts' => [
		'modules/SpellingDictionary.js',
	],
	'messages' => [
		'title-special',
	],
	'dependencies' => [
		'mediawiki.util',
		'mediawiki.user',
		'mediawiki.Title',
		'oojs-ui',
	],
] + $resourcePaths;
$wgResourceModules['ext.SpellingDictionary.styles'] = [
	'styles' => 'modules/ext.SpellingDictionary.styles.css',
] + $resourcePaths;
$wgResourceModules['ext.SpellingDictionary.viewByLanguage'] = [
	'scripts' => 'modules/ext.SpellingDictionary.viewByLanguage.js',
	'messages' => [
		'sd-admin-select-language',
		'view-by-lang-section-chooselanguage',
		'sd-admin-view-selected-language',
	],
	'dependencies' => [
		'jquery.uls',
		'oojs-ui',
		'jquery.i18n',
		'mediawiki.jqueryMsg',
		'ext.uls.messages',
		'ext.SpellingDictionary.styles',
	],
] + $resourcePaths;
$wgResourceModules['ext.SpellingDictionary.submitWord'] = [
	'scripts' => 'modules/ext.SpellingDictionary.submitWord.js',
	'messages' => [
		'add-word-form-submit',
		'add-word-section-addword',
		'spell-dict-word',
		'spell-dict-language',
	],
	'dependencies' => [
		'jquery.uls',
		'oojs-ui',
		'jquery.i18n',
		'mediawiki.jqueryMsg',
		'ext.uls.messages',
		'ext.SpellingDictionary.styles',
	]
] + $resourcePaths;

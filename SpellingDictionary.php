<?php
/**
 * SpellingDictionary extension
 * For more info see mediawiki.org/wiki/Extension:SpellingDictionary
 *
 * @author Ankita Shukla
 *
 * To mention the file version in the documentation:
 * @version 0.1.0
 *
 * The license governing the extension code:
 * @license GPL-2.0-or-later
 */

if ( function_exists( 'wfLoadExtension' ) ) {
	wfLoadExtension( 'SpellingDictionary' );
	// Keep i18n globals so mergeMessageFileList.php doesn't break
	$wgMessagesDirs['SpellingDictionary'] = __DIR__ . '/i18n';
	$wgExtensionMessagesFiles['SpellingDictionaryAlias'] = __DIR__ . '/SpellingDictionary.alias.php';
	wfWarn(
		'Deprecated PHP entry point used for the SpellingDictionary extension. ' .
		'Please use wfLoadExtension instead, ' .
		'see https://www.mediawiki.org/wiki/Extension_registration for more details.'
	);
	return;
} else {
	die( 'This version of the SpellingDictionary extension requires MediaWiki 1.29+' );
}

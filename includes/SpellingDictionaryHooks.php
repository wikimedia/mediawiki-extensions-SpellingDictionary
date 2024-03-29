<?php
/**
 * Hooks for SpellingDictionary extension
 *
 * @file
 * @ingroup Extensions
 */

class SpellingDictionaryHooks {
	/**
	 * Add welcome module to the load queue of all pages
	 *
	 * @param OutputPage $out
	 * @param Skin $skin
	 */
	public static function onBeforePageDisplay( OutputPage $out, Skin $skin ) {
		global $wgSpellingDictionaryEnableWelcome;

		if ( $wgSpellingDictionaryEnableWelcome ) {
			$out->addModules( 'ext.SpellingDictionary.welcome.init' );
		}
	}

	/**
	 * Expose configuration variables through mw.config in javascript.
	 *
	 * @param array &$vars
	 */
	public static function onResourceLoaderGetConfigVars( &$vars ) {
		global $wgSpellingDictionaryEnableWelcome, $wgSpellingDictionaryWelcomeColorDefault,
			$wgSpellingDictionaryWelcomeColorDays;

		if ( $wgSpellingDictionaryEnableWelcome ) {
			$vars['wgSpellingDictionaryWelcomeColorDefault'] =
				$wgSpellingDictionaryWelcomeColorDefault;
			$vars['wgSpellingDictionaryWelcomeColorDays'] = $wgSpellingDictionaryWelcomeColorDays;
		}
	}

	/**
	 * Register parser hooks
	 * See also https://www.mediawiki.org/wiki/Manual:Parser_functions
	 *
	 * @param Parser $parser
	 */
	public static function onParserFirstCallInit( $parser ) {
		// Add the following to a wiki page to see how it works:
		// <dump>test</dump>
		// <dump foo="bar" baz="quux">test content</dump>
		$parser->setHook( 'dump', 'SpellingDictionaryHooks::parserTagDump' );

		// Add the following to a wiki page to see how it works:
		// {{#echo: hello }}
		$parser->setFunctionHook( 'echo', 'SpellingDictionaryHooks::parserFunctionEcho' );

		// Add the following to a wiki page to see how it works:
		// {{#showme: hello | hi | there }}
		$parser->setFunctionHook( 'showme', 'SpellingDictionaryHooks::parserFunctionShowme' );
	}

	public static function onRegisterMagicWords( &$magicWordsIds ) {
		// Add the following to a wiki page to see how it works:
		// {{MYWORD}}
		$magicWordsIds[] = 'myword';
	}

	public static function onParserGetVariableValueSwitch( $parser, &$cache, $magicWordId, &$ret ) {
		if ( $magicWordId === 'myword' ) {
			// Return value and cache should match. Cache is used to save
			// additional call when it is used multiple times on a page.
			$ret = $cache['myword'] = self::parserGetWordMyword();
		}
	}

	/**
	 * This registers our database schema update(s)
	 *
	 * @param DatabaseUpdater $updater
	 */
	public static function onLoadExtensionSchemaUpdates( DatabaseUpdater $updater ) {
		$updater->addExtensionTable( 'spell_dict_word_list',
		__DIR__ . '/../sql/spelling_dictionary.sql', true );
	}

	/**
	 * Parser magic word handler for {{MYWORD}}
	 *
	 * @return string Wikitext to be rendered in the page.
	 */
	public static function parserGetWordMyword() {
		global $wgSpellingDictionaryMyWord;

		return wfEscapeWikiText( $wgSpellingDictionaryMyWord );
	}

	/**
	 * Parser hook handler for <dump>
	 *
	 * @param string $data The content of the tag.
	 * @param array $attribs The attributes of the tag.
	 * @param Parser $parser Parser instance available to render
	 *  wikitext into html, or parser methods.
	 * @param PPFrame $frame Can be used to see what template
	 *  arguments ({{{1}}}) this hook was used with.
	 * @return string HTML to insert in the page.
	 */
	public static function parserTagDump( $data, $attribs, $parser, $frame ) {
		$dump = [
			'content' => $data,
			'atributes' => (object)$attribs,
		];

		// Very important to escape user data with htmlspecialchars() to prevent
		// an XSS security vulnerability.
		$html = '<pre>Dump Tag: '
			. htmlspecialchars( FormatJson::encode( $dump, true ) ) . '</pre>';

		return $html;
	}

	/**
	 * Parser function handler for {{#echo: .. }}
	 *
	 * @param Parser $parser
	 * @param string $value
	 * @return string HTML to insert in the page.
	 */
	public static function parserFunctionEcho( $parser, $value ) {
		return '<pre>Echo Function: ' . htmlspecialchars( $value ) . '</pre>';
	}

	/**
	 * Parser function handler for {{#showme: .. | .. }}
	 *
	 * @param Parser $parser
	 * @param string $value
	 * @return string HTML to insert in the page.
	 */
	public static function parserFunctionShowme( $parser, $value ) {
		$args = array_slice( func_get_args(), 2 );
		$showme = [
			'value' => $value,
			'arguments' => $args,
		];

		return '<pre>Showme Function: '
			. htmlspecialchars( FormatJson::encode( $showme, true ) ) . '</pre>';
	}
}

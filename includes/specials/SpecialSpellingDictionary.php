<?php
/**
 * SpellingDictionary SpecialPage for SpellingDictionary extension
 *
 * @file
 * @ingroup Extensions
 */

use MediaWiki\Languages\LanguageNameUtils;

class SpecialSpellingDictionary extends SpecialPage {

	/** @var LanguageNameUtils */
	private $languageNameUtils;

	/**
	 * Initialize the special page.
	 */
	public function __construct(
		LanguageNameUtils $languageNameUtils
	) {
		// A special page should at least have a name.
		// We do this by calling the parent class (the SpecialPage class)
		// constructor method with the name as first and only parameter.
		parent::__construct( 'SpellingDictionary' );
		$this->languageNameUtils = $languageNameUtils;
	}

	public function doesWrites() {
		return true;
	}

	/**
	 * Shows the page to the user.
	 *
	 * @param string $sub The subpage string argument (if any).
	 *  [[Special:SpellingDictionary/subpage]].
	 */
	public function execute( $sub ) {
		$out = $this->getOutput();
		$out->addModules( 'ext.SpellingDictionary.submitWord' );
		$out->setPageTitle( $this->msg( 'title-special' ) );
		$out->addWikiMsg( 'intro-paragraph' );

		// Building a language selector
		// Display languages in their native name
		$languages = $this->languageNameUtils->getLanguageNames(
			LanguageNameUtils::AUTONYMS,
			LanguageNameUtils::SUPPORTED
		);
		ksort( $languages );
		$options = [];
		foreach ( $languages as $code => $name ) {
			$options["$code - $name"] = $code;
		}

		$formDescriptor = [
			'word' => [
				'type' => 'text',
				'label-message' => 'spell-dict-word',
				'required' => true,
				'section' => 'section-addword',
			],
			'language' => [
				'type' => 'select',
				'label-message' => 'spell-dict-language',
				'required' => true,
				'options' => $options,
				'section' => 'section-addword'
			],
		];

		$form = HTMLForm::factory( 'ooui', $formDescriptor, $this->getContext() );
		$form->setId( 'addWordForm' );
		$form->setMessagePrefix( 'add-word-form' );
		$form->setSubmitText( wfMessage( 'add-word-form-submit' )->text() );
		// Callback function
		$form->setSubmitCallback( [ 'SpecialSpellingDictionary', 'store' ] );

		$form->show();
	}

	public static function store( $formData ) {
		Words::addWord( $formData );
	}

	protected function getGroupName() {
		return 'other';
	}
}

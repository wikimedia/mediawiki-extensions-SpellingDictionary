<?php

use MediaWiki\Languages\LanguageNameUtils;

class SpecialViewByLanguage extends SpecialPage {

	/** @var LanguageNameUtils */
	private $languageNameUtils;

	public function __construct(
		LanguageNameUtils $languageNameUtils
	) {
		parent::__construct( 'ViewByLanguage', 'spelladmin' );
		$this->languageNameUtils = $languageNameUtils;
	}

	public function execute( $sub ) {
		if ( !$this->userCanExecute( $this->getUser() ) ) {
			$this->displayRestrictionError();
			return;
		}
		$out = $this->getOutput();
		$out->addModules( 'ext.SpellingDictionary.viewByLanguage' );
		$out->setPageTitle( $this->msg( 'title-view-by-language' ) );
		$out->addWikiMsg( 'view-by-lang-intro' );

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
			'language' => [
				'type' => 'select',
				'label-message' => 'sd-admin-select-language',
				'required' => true,
				'options' => $options,
				'section' => 'section-chooselanguage',
			]
		];
		$form = HTMLForm::factory( 'ooui', $formDescriptor, $this->getContext() );
		$form->setId( 'languageSelectionForm' );
		$form->setMessagePrefix( 'view-by-lang' );
		$form->setSubmitText( wfMessage( 'sd-admin-view-selected-language' )->text() );
		// Callback function
		$form->setSubmitCallback( [ $this, 'showSpellings' ] );
		$form->show();
	}

	public function showSpellings( $formData ) {
		$language = $formData['language'];
		$out = $this->getOutput();
		$out->addHTML( AdminRights::displayByLanguage( $language ) );
	}

	protected function getGroupName() {
		return 'other';
	}
}

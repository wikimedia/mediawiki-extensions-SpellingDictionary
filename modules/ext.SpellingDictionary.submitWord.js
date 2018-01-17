(function( $, mw ) {
	'use strict';

	$( function() {

		var $originalForm = $( '#addWordForm' );
		var $formContainer = $originalForm.parent();
		var selectedLanguage = mw.uls.getFrequentLanguageList()[0];

		$originalForm.hide();

		var ulsTrigger = new OO.ui.ButtonWidget( {
			label: $.uls.data.getAutonym( selectedLanguage ),
			indicator: 'down',
			classes: [ 'ext-spellingdictionary-fullwidth' ]
		} );
		var submitButton = new OO.ui.ButtonInputWidget( {
			label: mw.message( 'add-word-form-submit' ).text(),
			flags: [ 'progressive', 'primary'],
			indicator: 'next',
			type: 'submit'
		} );
		var wordInput = new OO.ui.TextInputWidget( {
			required: true
		} );

		var fieldset = new OO.ui.FieldsetLayout( {
			label: mw.message( 'add-word-section-addword' ).text(),
			classes: [ 'oo-ui-panelLayout', 'oo-ui-panelLayout-padded', 'oo-ui-panelLayout-framed' ]
		} );
		fieldset.addItems( [
			new OO.ui.FieldLayout( wordInput, {
				label: mw.message( 'spell-dict-word').text()
			} ),
			new OO.ui.FieldLayout( ulsTrigger, {
				label: mw.message( 'spell-dict-language' ).text()
			} )
		] );

		var form = new OO.ui.FormLayout( {
			items: [
				fieldset,
				new OO.ui.FieldLayout( submitButton )
			]
		} );
		form.on( 'submit', function() {
			$originalForm.submit();
		});

		$formContainer.append( form.$element );

		function update() {
			ulsTrigger.setLabel($.uls.data.getAutonym( selectedLanguage ) );

			$( 'input[name="wpword"]').val( wordInput.getValue() );
			$( 'select[name="wplanguage"]' ).val( selectedLanguage );
		}

		ulsTrigger.$element.uls( {
			top: '10%',
			quickList: function() {
				return mw.uls.getFrequentLanguageList();
			},
			onSelect: function( language ) {
				selectedLanguage = language;
				update();
			}
		} );
		wordInput.on( 'change', update );

		// Call the update() method to initialize the form
		update();

	} );
})( jQuery, mw );
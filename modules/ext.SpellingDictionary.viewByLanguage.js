(function( $, mw ) {
	'use strict';

	var $originalForm = $("#languageSelectionForm");
	var $formContainer = $originalForm.parent();
	var selectedLanguage = mw.uls.getFrequentLanguageList()[0];

	$originalForm.hide();

	var ulsTrigger = new OO.ui.ButtonWidget( {
		label: $.uls.data.getAutonym( selectedLanguage ),
		indicator: 'down',
		classes: [ 'ext-spellingdictionary-fullwidth' ]
	} );
	var submitButton = new OO.ui.ButtonInputWidget( {
		label: mw.message( 'sd-admin-view-selected-language' ).text(),
		flags: [ 'progressive', 'primary' ],
		indicator: 'next',
		type: 'submit'
	} );

	var fieldsetLayout = new OO.ui.FieldsetLayout( {
		label: mw.message( 'view-by-lang-section-chooselanguage' ).text(),
		classes: [ 'oo-ui-panelLayout', 'oo-ui-panelLayout-padded', 'oo-ui-panelLayout-framed' ]
	} );
	fieldsetLayout.addItems( [
		new OO.ui.FieldLayout ( ulsTrigger, {
			label: mw.message( 'sd-admin-select-language' ).text()
		} )
	] );

	var form = new OO.ui.FormLayout( {
		items: [
			fieldsetLayout,
			new OO.ui.FieldLayout ( submitButton )
		],
		method: 'post',
		action: '/wiki/Special:ViewByLanguage'
	} );

	form.on( 'submit', function() {
		$originalForm.submit();
	});

	$formContainer.append( form.$element );

	function update() {
		ulsTrigger.setLabel($.uls.data.getAutonym( selectedLanguage ) );
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

})( jQuery, mediaWiki );
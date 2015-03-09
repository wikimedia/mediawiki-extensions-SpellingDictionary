<?php
/**
 * SpellingDictionary SpecialPage for SpellingDictionary extension
 *
 * @file
 * @ingroup Extensions
 */

class SpecialSpellingDictionary extends SpecialPage {

	/**
	 * Initialize the special page.
	 */
	public function __construct() {
		// A special page should at least have a name.
		// We do this by calling the parent class (the SpecialPage class)
		// constructor method with the name as first and only parameter.
		parent::__construct( 'SpellingDictionary' );
	}

	/**
	 * Shows the page to the user.
	 * @param string $sub: The subpage string argument (if any).
	 *  [[Special:SpellingDictionary/subpage]].
	 */
	public function execute( $sub ) {
		$out = $this->getOutput();

		$out->setPageTitle( $this->msg( 'title-special' ) );

		// Parses message from .i18n.php as wikitext and adds it to the
		// page output.
		$out->addWikiMsg( 'intro-paragraph' );
		$formDescriptor = array(
			'word' => array(
				'type' => 'text',
				'label-message' => 'spell-dict-word',
				'required' => true,
			),
			'language' => array(
				'type' => 'select',
				'label-message' => 'spell-dict-language',
				'required' => true,
				'options' => array(
					'Abkhaz- Аҧсшәа' => 'ab',
					'Aceh- Acèh' => 'ace',
					'Afar- Qafár af' => 'aa',
					'Afrikaans' => 'af',
					'Akan' => 'ak',
					'Albanian- shqip' => 'sq',
					'Alemannic- Alemannisch' => 'als',
					'Alemannic- Alemannisch' => 'gsw',
					'Algerian- جازايرية' => 'arq',
					'Amharic- አማርኛ' => 'am',
					'Ancient Greek- Ἀρχαία ἑλληνικὴ' => 'grc',
					'Angika- अङ्गिका' => 'anp',
					'Arabic- العربية' => 'ar',
					'Aragonese- aragonés' => 'an',
					'Aramaic- ܐܪܡܝܐ' => 'arc',
					'Armenian- Հայերեն' => 'hy',
					'Aromanian- armãneashti' => 'roa-rup',
					'Aromanian- armãneashti' => 'rup',
					'Assamese- অসমীয়া' => 'as',
					'Asturian- asturianu' => 'ast',
					'Austrian German- Österreichisches Deutsch' => 'de-at',
					'Avar- авар' => 'av',
					'Aymara- Aymar aru' => 'ay',
					'Azerbaijani- azərbaycanca' => 'az',
					'Bakthiari- بختياري' => 'bqi',
					'Bambara- bamanankan' => 'bm',
					'Banjarese- Bahasa Banjar' => 'bjn',
					'Banyumasan- Basa Banyumasan' => 'map-bms',
					'Bashkir- башҡортса' => 'ba',
					'Basque- euskara' => 'eu',
					'Batak Toba (Latin)- Batak Toba' => 'bbc',
					'Batak Toba' => 'bbc-latn',
					'Bavarian- Boarisch' => 'bar',
					'Belarusian in Taraskievica orthography- беларуская (тарашкевіца)\xE2\x80\x8E' => 'be-tarask',
					'Belarusian normative- беларуская' => 'be',
					'Bengali- বাংলা' => 'bn',
					'Bhojpuri- भोजपुरी' => 'bho',
					'Bihari Bhojpuri- भोजपुरी' => 'bh',
					'Bikol Central' => 'bcl',
					'Bishnupriya Manipuri- বিষ্ণুপ্রিয়া মণিপুরী' => 'bpy',
					'Bislama' => 'bi',
					'Bosnian- bosanski' => 'bs',
					'Bráhuí' => 'brh',
					'Brazilian Portuguese- português do Brasil' => 'pt-br',
					'Breton- brezhoneg' => 'br',
					'British English' => 'en-gb',
					'Buginese- ᨅᨔ ᨕᨘᨁᨗ' => 'bug',
					'Bulgarian- български' => 'bg',
					'Burmese- မြန်မာဘာသာ' => 'my',
					'Buryat (Russia)- буряад' => 'bxr',
					'Cajun French- français cadien' => 'frc',
					'Canadian English' => 'en-ca',
					'Cantonese- 粵語' => 'yue',
					'Cantonese- 粵語' => 'zh-yue',
					'Capiznon- Capiceño' => 'cps',
					'Cassubian- kaszëbsczi' => 'csb',
					'Catalan- català' => 'ca',
					'Cebuano' => 'ceb',
					'Chamorro- Chamoru' => 'ch',
					'Chechen- нохчийн' => 'ce',
					'Cherokee- ᏣᎳᎩ' => 'chr',
					'Cheyenne- Tsetsêhestâhese' => 'chy',
					'Chichewa- Chi-Chewa' => 'ny',
					'Chinese (Hong Kong)- 中文（香港）\xE2\x80\x8E' => 'zh-hk',
					'Chinese (Macau)- 中文（澳門）\xE2\x80\x8E' => 'zh-mo',
					'Chinese (Malaysia)- 中文（马来西亚）\xE2\x80\x8E' => 'zh-my',
					'Chinese (PRC)- 中文（中国大陆）\xE2\x80\x8E' => 'zh-cn',
					'Chinese (Singapore)- 中文（新加坡）\xE2\x80\x8E' => 'zh-sg',
					'Chinese (Taiwan)- 中文（台灣）\xE2\x80\x8E' => 'zh-tw',
					'Chinese(Zhōng Wén)- 中文' => 'zh',
					'Choctaw' => 'cho',
					'Chuvash- Чӑвашла' => 'cv',
					'Classical/Literary Chinese- 文言' => 'zh-classical',
					'Cornish- kernowek' => 'kw',
					'Corsican- corsu' => 'co',
					'Cree- Nēhiyawēwin / ᓀᐦᐃᔭᐍᐏᐣ' => 'cr',
					'Croatian- hrvatski' => 'hr',
					'Czech- čeština' => 'cs',
					'Danish- dansk' => 'da',
					'Deutsch (Sie-Form)\xE2\x80\x8E' => 'de-formal',
					'Dhivehi- ދިވެހިބަސް' => 'dv',
					'dolnoserbski' => 'dsb',
					'Dusun Bundu-liwan' => 'dtp',
					'Dutch- Nederlands (informeel)\xE2\x80\x8E' => 'nl-informal',
					'Dutch- Nederlands' => 'nl',
					'Dzongkha (Bhutan)- ཇོང་ཁ' => 'dz',
					'Eastern Mari- олык марий' => 'mhr',
					'Eastern Punjabi (Gurmukhi script) (pan)- ਪੰਜਾਬੀ' => 'pa',
					'Egyptian- مصرى' => 'arz',
					'Emilian- Emiliàn' => 'egl',
					'Emiliano-Romagnolo / Sammarinese- emiliàn e rumagnòl' => 'eml',
					'English' => 'en',
					'Erzya- эрзянь' => 'myv',
					'Esperanto' => 'eo',
					'Estonian- eesti' => 'et',
					'Éwé- eʋegbe' => 'ee',
					'Extremaduran- estremeñu' => 'ext',
					'Faroese- føroyskt' => 'fo',
					'Fiji Hindi (latin)' => 'hif-latn',
					'Fiji Hindi' => 'hif',
					'Fijian- Na Vosa Vakaviti' => 'fj',
					'Finnish- suomi' => 'fi',
					'Franco-Provençal/Arpitan- arpetan' => 'frp',
					'French- français' => 'fr',
					'Frisian- Frysk' => 'fy',
					'Friulian- furlan' => 'fur',
					'Fulfulde, Maasina- Fulfulde' => 'ff',
					'Gagauz- Gagauz' => 'gag',
					'Galician- galego' => 'gl',
					'Gan (Simplified Han)- 赣语（简体）\xE2\x80\x8E' => 'gan-hans',
					'Gan (Traditional Han)- 贛語（繁體）\xE2\x80\x8E' => 'gan-hant',
					'Gan- 贛語' => 'gan',
					'Ganda- Luganda' => 'lg',
					'Georgian- ქართული' => 'ka',
					'German ("Du")- Deutsch' => 'de',
					'Gheg Albanian- Gegë' => 'aln',
					'Gikuyu- Gĩkũyũ' => 'ki',
					'Gilaki- گیلکی' => 'glk',
					'Goan Konkani (Latin script)- Konknni' => 'gom-latn',
					'Gothic- 𐌲𐌿𐍄𐌹𐍃𐌺' => 'got',
					'Greek- Ελληνικά' => 'el',
					'Guaraní, Paraguayan- Avañe\'ẽ' => 'gn',
					'Gujarati- ગુજરાતી' => 'gu',
					'Haitian Creole French- Kreyòl ayisyen' => 'ht',
					'Hakka- 客家語/Hak-kâ-ngî' => 'hak',
					'Halh Mongolian- монгол' => 'mn',
					'Hausa- Hausa' => 'ha',
					'Hawaiian- Hawai`i' => 'haw',
					'Hebrew- עברית' => 'he',
					'Herero- Otsiherero' => 'hz',
					'Hiligaynon- Ilonggo' => 'hil',
					'Hill Mari- кырык мары' => 'mrj',
					'Hindi- हिन्दी' => 'hi',
					'Hiri Motu' => 'ho',
					'Hungarian- magyar' => 'hu',
					'Icelandic- íslenska' => 'is',
					'Ido' => 'io',
					'Igbo- Igbo' => 'ig',
					'Ilokano' => 'ilo',
					'Indonesian- Bahasa Indonesia' => 'id',
					'Ingush- ГӀалгӀай' => 'inh',
					'Interlingua (IALA)- interlingua' => 'ia',
					'Interlingue (Occidental)- Interlingue' => 'ie',
					'Inuktitut- ᐃᓄᒃᑎᑐᑦ/inuktitut' => 'iu',
					'inuktitut' => 'ike-latn',
					'Iñupiak' => 'ik',
					'Irish- Gaeilge' => 'ga',
					'Italian- italiano' => 'it',
					'Jamaican Creole English- Patois' => 'jam',
					'Japanese- 日本語' => 'ja',
					'Javanese- Basa Jawa' => 'jv',
					'Jutish / Jutlandic- jysk' => 'jut',
					'Kabardian (Cyrillic)- Адыгэбзэ' => 'kbd-cyrl',
					'Kabardian- Адыгэбзэ' => 'kbd',
					'Kabyle- Taqbaylit' => 'kab',
					'kalaallisut' => 'kl',
					'Kalmyk-Oirat- хальмг' => 'xal',
					'Kannada- ಕನ್ನಡ' => 'kn',
					'Kanuri, Central- Kanuri' => 'kr',
					'Karachay-Balkar- къарачай-малкъар' => 'krc',
					'Karakalpak- Qaraqalpaqsha' => 'kaa',
					'Kashmiri (Devanagari script)- कॉशुर' => 'ks-deva',
					'Kashmiri (Perso-Arabic script)- کٲشُر' => 'ks-arab',
					'Kashmiri- कॉशुर / کٲشُر' => 'ks',
					'Kazakh (China)- قازاقشا (جۇنگو)\xE2\x80\x8F' => 'kk-cn',
					'Kazakh (Kazakhstan)- қазақша (Қазақстан)\xE2\x80\x8E' => 'kk-kz',
					'Kazakh (Turkey)- qazaqşa (Türkïya)\xE2\x80\x8E' => 'kk-tr',
					'Kazakh Arabic- قازاقشا (تٴوتە)\xE2\x80\x8F' => 'kk-arab',
					'Kazakh Cyrillic- қазақша (кирил)\xE2\x80\x8E' => 'kk-cyrl',
					'Kazakh Latin- qazaqşa (latın)\xE2\x80\x8E' => 'kk-latn',
					'Kazakh- қазақша' => 'kk',
					'Khmer, Central- ភាសាខ្មែរ' => 'km',
					'Khowar- کھوار' => 'khw',
					'Kichwa/Northern Quechua- Runa shimi' => 'qug',
					'Kinaray-a' => 'krj',
					'Kinyarwanda' => 'rw',
					'Kirghiz- Кыргызча' => 'ky',
					'Kirmanjki- Kırmancki' => 'kiu',
					'Komi-Permyak- Перем Коми' => 'koi',
					'Komi-Zyrian- коми' => 'kv',
					'Kongo- Kongo' => 'kg',
					'Korean (DPRK)- 한국어 (조선)' => 'ko-kp',
					'Korean- 한국어' => 'ko',
					'Kotava- Kotava' => 'avk',
					'Koyraboro Senni- Koyraboro Senni' => 'ses',
					'Krio' => 'kri',
					'Kurdish- Kurdî' => 'ku',
					'Kwanyama' => 'kj',
					'Ladino' => 'lad',
					'Lak- лакку' => 'lbe',
					'Laotian- ລາວ' => 'lo',
					'Latgalian- latgaļu' => 'ltg',
					'Latin- Latina' => 'la',
					'Latvian- latviešu' => 'lv',
					'Laz- Lazuri' => 'lzz',
					'Lezgi- лезги' => 'lez',
					'Ligurian- Ligure' => 'lij',
					'Limburgian- Limburgs' => 'li',
					'Lingala- lingála' => 'ln',
					'Lingua Franca Nova- Lingua Franca Nova' => 'lfn',
					'Literary Chinese, bug 8217- 文言' => 'lzh',
					'Lithuanian- lietuvių' => 'lt',
					'Livonian- Līvõ kēļ' => 'liv',
					'Lojban' => 'jbo',
					'Lombard- lumbaart' => 'lmo',
					'Lower Selisian- Schläsch' => 'sli',
					'Lozi- Silozi' => 'loz',
					'Luxemburguish- Lëtzebuergesch' => 'lb',
					'Macedonian- македонски' => 'mk',
					'Maithili- मैथिली' => 'mai',
					'Malagasy- Malagasy' => 'mg',
					'Malay- Bahasa Melayu' => 'ms',
					'Malayalam- മലയാളം' => 'ml',
					'Maltese- Malti' => 'mt',
					'Mandarin Chinese (Traditional Chinese script) (cmn-hant)- 中文（繁體）\xE2\x80\x8E' => 'zh-hant',
					'Mandarin Chinese- 中文（简体）\xE2\x80\x8E' => 'zh-hans',
					'Manx- Gaelg' => 'gv',
					'Maori- Māori' => 'mi',
					'Mapuche, Mapudungu, Araucanian (Araucano)- mapudungun' => 'arn',
					'Marathi- मराठी' => 'mr',
					'Marshallese- Ebon' => 'mh',
					'Mazanderani- مازِرونی' => 'mzn',
					'Min Dong- Mìng-dĕ̤ng-ngṳ̄' => 'cdo',
					'Min-nan- Bân-lâm-gú' => 'nan',
					'Min-nan- Bân-lâm-gú' => 'zh-min-nan',
					'Minangkabau- Baso Minangkabau' => 'min',
					'Mingrelian- მარგალური' => 'xmf',
					'Mirandese- Mirandés' => 'mwl',
					'Mizo/Lushai- Mizo ţawng' => 'lus',
					'Moksha- мокшень' => 'mdf',
					'Moldovan- молдовеняскэ' => 'mo',
					'Moroccan- Maġribi' => 'ary',
					'Muskogee/Creek- Mvskoke' => 'mus',
					'Nahuatl- Nāhuatl' => 'nah',
					'Nauruan- Dorerin Naoero' => 'na',
					'Navajo- Diné bizaad' => 'nv',
					'Ndonga- Oshiwambo' => 'ng',
					'Neapolitan- Napulitano' => 'nap',
					'Nedersaksies' => 'nds-nl',
					'Nepali- नेपाली' => 'ne',
					'Newar / Nepal Bhasha- नेपाल भाषा' => 'new',
					'Niuean- Niuē' => 'niu',
					'Norfuk/Pitcairn/Norfolk- Norfuk / Pitkern' => 'pih',
					'Norman- Nouormand' => 'nrm',
					'North Frisian- Nordfriisk' => 'frr',
					'Northern Kurdish (Arabic script)- كوردي (عەرەبی)\xE2\x80\x8F' => 'ku-arab',
					'Northern Kurdish (Latin script)- Kurdî (latînî)\xE2\x80\x8E' => 'ku-latn',
					'Northern Luri- لوری' => 'lrc',
					'Northern Sami- sámegiella' => 'se',
					'Northern Sotho- Sesotho sa Leboa' => 'nso',
					'Norwegian (Nynorsk)- norsk nynorsk' => 'nn',
					'Norwegian- norsk bokmål' => 'nb',
					'Norwegian- norsk bokmål' => 'no',
					'Novial' => 'nov',
					'Occitan- occitan' => 'oc',
					'Old Church Slavonic- словѣньскъ / ⰔⰎⰑⰂⰡⰐⰠⰔⰍⰟ' => 'cu',
					'Old English- Ænglisc' => 'ang',
					'Oriya- ଓଡ଼ିଆ' => 'or',
					'Oromo- Oromoo' => 'om',
					'Ossetic- Ирон' => 'os',
					'Palatinate German- Pälzisch' => 'pfl',
					'Pali- पालि' => 'pi',
					'Pampanga- Kapampangan' => 'pam',
					'Pangasinan- Pangasinan' => 'pag',
					'Papiamentu' => 'pap',
					'Pennsylvania German- Deitsch' => 'pdc',
					'Persian- فارسی' => 'fa',
					'Picard' => 'pcd',
					'Piedmontese- Piemontèis' => 'pms',
					'Plattdüütsch' => 'nds',
					'Plautdietsch' => 'pdt',
					'Polish- polski' => 'pl',
					'Pontic/Pontic Greek- Ποντιακά' => 'pnt',
					'Portuguese- português' => 'pt',
					'Prussian- Prūsiskan' => 'prg',
					'qırımtatarca (Latin)\xE2\x80\x8E' => 'crh-latn',
					'qırımtatarca' => 'crh',
					'Raeto-Romance- rumantsch' => 'rm',
					'Rinconada Bikol- Iriga Bicolano' => 'bto',
					'Riograndenser Hunsrückisch- Hunsrik' => 'hrx',
					'Ripuarian- Ripoarisch' => 'ksh',
					'Romagnol- Rumagnôl' => 'rgn',
					'Romanian- română' => 'ro',
					'Rundi/Kirundi/Urundi- Kirundi' => 'rn',
					'Russian- русский' => 'ru',
					'Rusyn- русиньскый' => 'rue',
					'Sakha- саха тыла' => 'sah',
					'Samoan- Gagana Samoa' => 'sm',
					'Samogitian - žemaitėška' => 'bat-smg',
					'Samogitian- žemaitėška' => 'sgs',
					'Sango/Sangho- Sängö' => 'sg',
					'Sanskrit- संस्कृतम्' => 'sa',
					'Santali' => 'sat',
					'Sardinian- sardu' => 'sc',
					'Sassarese- Sassaresu' => 'sdc',
					'Saterland Frisian- Seeltersk' => 'stq',
					'Schweizer Hochdeutsch' => 'de-ch',
					'Scots Gaelic- Gàidhlig' => 'gd',
					'Scots' => 'sco',
					'Serbocroatian- srpskohrvatski / српскохрватски' => 'sh',
					'Seri- Cmique Itom' => 'sei',
					'Setswana- Setswana' => 'tn',
					'Shona- chiShona' => 'sn',
					'Sichuan Yi- ꆇꉙ' => 'ii',
					'Sicilian- sicilianu' => 'scn',
					'Silesian- ślůnski' => 'szl',
					'Simple English' => 'simple',
					'Sindhi- سنڌي' => 'sd',
					'Sinhalese- සිංහල' => 'si',
					'Slovak- slovenčina' => 'sk',
					'Slovenian- slovenščina' => 'sl',
					'Somali- Soomaaliga' => 'so',
					'Sorani- کوردی' => 'ckb',
					'South Azerbaijani- تورکجه' => 'azb',
					'Southern Balochi- بلوچی مکرانی' => 'bcc',
					'Southern Quechua- Runa Simi' => 'qu',
					'Southern Sami- Åarjelsaemien' => 'sma',
					'Southern Sotho- Sesotho' => 'st',
					'Spanish- español' => 'es',
					'Sranan Tongo- Sranantongo' => 'srn',
					'srpski (latinica)\xE2\x80\x8E' => 'sr-el',
					'Sundanese- Basa Sunda' => 'su',
					'Swahili- Kiswahili' => 'sw',
					'Swati- SiSwati' => 'ss',
					'Swedish- svenska' => 'sv',
					'Tagalog- Tagalog' => 'tl',
					'Tahitian- reo tahiti' => 'ty',
					'Tajiki (Cyrllic script)- тоҷикӣ' => 'tg-cyrl',
					'Tajiki (Latin script)- tojikī' => 'tg-latn',
					'Tajiki- тоҷикӣ' => 'tg',
					'Talysh- толышә зывон' => 'tly',
					'Tamazight- ⵜⴰⵎⴰⵣⵉⵖⵜ' => 'tzm',
					'Tamil- தமிழ்' => 'ta',
					'Tarantino- tarandíne' => 'roa-tara',
					'Tarifit' => 'rif',
					'Tašlḥiyt' => 'shi-latn',
					'Tašlḥiyt/ⵜⴰⵛⵍⵃⵉⵜ' => 'shi',
					'Tatar (Cyrillic script)- татарча' => 'tt-cyrl',
					'Tatar (Latin script)- tatarça' => 'tt-latn',
					'Tatar- татарча/tatarça' => 'tt',
					'Telugu- తెలుగు' => 'te',
					'tetun' => 'tet',
					'Thai- ไทย' => 'th',
					'Tibetan- བོད་ཡིག' => 'bo',
					'Tigrinya- ትግርኛ' => 'ti',
					'Tok Pisin' => 'tpi',
					'Toki Pona' => 'tokipona',
					'Tonga (Tonga Islands)- lea faka-Tonga' => 'to',
					'Tornedalen Finnish- meänkieli' => 'fit',
					'Tsonga- Xitsonga' => 'ts',
					'Tulu- ತುಳು' => 'tcy',
					'Tumbuka- chiTumbuka' => 'tum',
					'Tunisian Arabic- تونسي' => 'aeb',
					'Turkish- Türkçe' => 'tr',
					'Turkmen- Türkmençe' => 'tk',
					'Ṫuroyo' => 'tru',
					'Twi- Twi' => 'tw',
					'Tyvan- тыва дыл' => 'tyv',
					'Udmurt- удмурт' => 'udm',
					'Ukrainian- українська' => 'uk',
					'Upper Franconian- Mainfränkisch' => 'vmf',
					'Upper Sorbian- hornjoserbsce' => 'hsb',
					'Urdu- اردو' => 'ur',
					'Uyghur (Arabic script)- ئۇيغۇرچە' => 'ug-arab',
					'Uyghur (Latin script)- Uyghurche' => 'ug-latn',
					'Uyghur- ئۇيغۇرچە / Uyghurche' => 'ug',
					'Uzbek- oʻzbekcha' => 'uz',
					'Venda- Tshivenda' => 've',
					'Venetian- vèneto' => 'vec',
					'Veps- vepsän kel’' => 'vep',
					'Vietnamese- Tiếng Việt' => 'vi',
					'Vlăheşte' => 'ruq-latn',
					'Vlăheşte' => 'ruq',
					'Vlax Romany- Romani' => 'rmy',
					'Vod/Votian- Vaďďa' => 'vot',
					'Volapük' => 'vo',
					'Võro' => 'fiu-vro',
					'Võro' => 'vro',
					'Walloon- walon' => 'wa',
					'Waray-Waray- Winaray' => 'war',
					'Welsh- Cymraeg' => 'cy',
					'West Flemish- West-Vlams' => 'vls',
					'Western Balochi- بلوچی رخشانی' => 'bgn',
					'Western Punjabi- پنجابی' => 'pnb',
					'Wolof' => 'wo',
					'Wu Chinese- 吴语' => 'wuu',
					'Xhosan- isiXhosa' => 'xh',
					'Yiddish- ייִדיש' => 'yi',
					'Yoruba- Yorùbá' => 'yo',
					'Zamboanga Chavacano- Chavacano de Zamboanga' => 'cbk-zam',
					'Zazaki' => 'diq',
					'Zeeuws/Zeaws- Zeêuws' => 'zea',
					'Zhuang- Vahcuengh' => 'za',
					'Zulu- isiZulu' => 'zu',
					'Βλαεστε' => 'ruq-grek',
					'беларуская (тарашкевіца)\xE2\x80\x8E' => 'be-x-old',
					'Влахесте' => 'ruq-cyrl',
					'къырымтатарджа (Кирилл)\xE2\x80\x8E' => 'crh-cyrl',
					'српски (ћирилица)\xE2\x80\x8E' => 'sr-ec',
					'српски / srpski' => 'sr',
					'پښتو' => 'ps',
					'ⵜⴰⵛⵍⵃⵉⵜ' => 'shi-tfng',
					'ᐃᓄᒃᑎᑐᑦ' => 'ike-cans',
				),
				// 'class' => 'uls-trigger',
				),
		);

		$form = HTMLForm::factory( 'vform', $formDescriptor, $this->getContext() );
		$form->setSubmitText( wfMessage( 'add-word-form-submit' )->text() );
		//Callback function
		$form->setSubmitCallback( array( 'SpecialSpellingDictionary', 'store' ) );

		$form->show();

	}

	static function store( $formData ) {
		Words::addWord( $formData );
	}

}

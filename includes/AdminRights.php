<?php

// namespace SpellingDictionary;

class AdminRights {
	public static function displayAllWords() {
		global $wgSpellingDictionaryDatabase;
		$dbr = wfGetDB( DB_REPLICA, [], $wgSpellingDictionaryDatabase );
		$rows = $dbr->select(
			'spell_dict_word_list',
			'*',
			1,
			__METHOD__
		);
		$result = [];
		$words = '<b>Spelling &nbsp;&nbsp;&nbsp;&nbsp;Language</b><br>';
		foreach ( $rows as $row ) {
			$words .= "<span class = \"spelling\">" . $row->sd_word .
			"&nbsp;&nbsp;&nbsp;&nbsp;" .
			"</span><span class = \"language\">" . $row->sd_language . "</span><br>";
		}
		return $words;
	}

	public static function displayByLanguage( $language ) {
		global $wgSpellingDictionaryDatabase;
		$dbr = wfGetDB( DB_REPLICA, [], $wgSpellingDictionaryDatabase );
		$rows = $dbr->select(
			'spell_dict_word_list',
			'*',
			[
				'sd_language' => $language,
			],
			__METHOD__
		);
		$words = "";
		foreach ( $rows as $row ) {
			$words .= $row->sd_word . " of language " . $row->sd_language;
			$words .= "\t<a href=''>Edit</a> \t<a href='' id = 'deleteSpelling'>Delete</a> <br>";
		}
		return $words;
	}

	public static function deleteSpelling( $spelling ) {
		global $wgSpellingDictionaryDatabase;
		$dbr = wfGetDB( DB_REPLICA, [], $wgSpellingDictionaryDatabase );
		$rows = $dbr->delete(
			'spell_dict_word_list',
			[
				'sd_word' => $spelling,
			],
			__METHOD__
		);
	}
}

<?php

class Words {
	static function addWord( $formData ) {
		// $user = $this->getUser();
		global $wgSpellingDictionaryDatabase;
		$dbw = wfGetDB( DB_MASTER, [], $wgSpellingDictionaryDatabase );

		$user = "ABC";

		$values = [
			'sd_word' => $formData['word'],
			'sd_language' => $formData['language'],
			'sd_user' => $user,
			'sd_timestamp' => $dbw->timestamp(),
		];

		$dbw->insert( 'spell_dict_word_list',
			$values,
			__METHOD__ );
	}
}

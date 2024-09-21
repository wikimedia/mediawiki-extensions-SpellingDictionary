<?php

use MediaWiki\MediaWikiServices;

class Words {
	public static function addWord( $formData ) {
		// $user = $this->getUser();
		global $wgSpellingDictionaryDatabase;
		$dbw = MediaWikiServices::getInstance()->getDBLoadBalancer()
			->getConnection( DB_PRIMARY, [], $wgSpellingDictionaryDatabase );

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

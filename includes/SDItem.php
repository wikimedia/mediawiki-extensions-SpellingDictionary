<?php

use MediaWiki\MediaWikiServices;

/**
 * A single 'item' in the Spelling Dictionary Admin Links page
 */
class SDItem {
	public $link;

	static function showPage( $page_title, $desc = null, $query = [] ) {
		$item = new SDItem();
		$item->link = Linker::link( $page_title, $desc );
		return $item;
	}

	static function customSpecialPage( $page_title ) {
		$item = new SDItem();

		$page = MediaWikiServices::getInstance()
			->getSpecialPageFactory()
			->getPage( $page_title );

		$item->link = Linker::link( $page->getPageTitle(), $page->getDescription() );
		return $item;
	}

}

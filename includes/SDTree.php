<?php
/**
 * The structure of the page would be like a tree where the
 * Tree contains sections.
 * Every section will have items (which will be possibly links to other pages)
 */

// The 'tree' that holds all the sections and links for the Admin page
class SDTree {

	public $sections;

	function __construct() {
		$this->sections = [];
	}

	function addSection( $section ) {
		$this->sections[] = $section;
	}

	function toString() {
		$text = "";
		foreach ( $this->sections as $section ) {
			$text .= $section->toString();
		}
		return $text;
	}
}

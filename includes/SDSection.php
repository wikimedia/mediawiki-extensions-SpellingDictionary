<?php
/**
 * A single section of the Admin Links 'tree', composed of a header and rows
 */
class SDSection {

	public $header;
	public $items;

	public function __construct( $header ) {
		$this->header = $header;
		$this->items = [];
	}

	public function addItem( $item ) {
		$this->items[] = $item;
	}

	public function toString() {
		$text = '	<h2 class="mw-specialpagesgroup">' . $this->header . "</h2>\n";
		$text .= "	<p>\n";
		foreach ( $this->items as $i => $item ) {
			if ( $i > 0 ) {
				$text .= " ·\n";
			}
			$text .= '		' . $item->link;
		}
		return $text . "\n	</p>\n";
	}

}

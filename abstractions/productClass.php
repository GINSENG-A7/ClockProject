<?php
class Product {
	public $entryId;
	public $title;
	public $body;
	public $price;
	public $sectionId;
	function __construct($entryId, $title, $body, $price, $sectionId) {
		$this->entryId = $entryId;
		$this->title = $title;
		$this->body = $body;
		$this->price = $price;
		$this->sectionId = $sectionId;
	}
}
?>
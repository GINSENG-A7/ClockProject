<?php
require_once ('./connection_script.php');
require_once ('./classes/photoClass.php');
class Entry
{
    public $idEntry;
    public $idSection;
	public $title;
    public $body;
    public $price;
    public $imagesArray;

    public function __construct($idEntry, $title, $body, $price, $idSection) {
        $this->idEntry = $idEntry;
        $this->title = $title;
        $this->body = $body;
        $this->price = $price;
		$this->idSection = $idSection;
    }

    public function setImages($conn){
        $this->imagesArray = SelectAllImagesByEntryId($conn, $this->idEntry);
    }
}
?>
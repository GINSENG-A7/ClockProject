<?php
class Photo
{
    public $idImage;
    public $path;

    public function __construct($idImage, $path) {
        $this->idImage = $idImage;
        $this->path = $path;
    }
}
?>
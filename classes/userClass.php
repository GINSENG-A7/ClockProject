<?php
require_once ('./connection_script.php');
class User
{
    public $idUser;
	public $idRole;
    public $login;
	public $password;

    public function __construct($idUser, $idRole, $login, $password) {
        $this->idUser = $idUser;
        $this->idRole = $idRole;
        $this->login = $login;
        $this->password = $password;
    }
}
?>
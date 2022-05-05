<?php
require_once ('./connection_script.php');
require_once ('./classes/userClass.php');
class AdvancedUser extends User
{
    public $name;
    public $surname;
    public $patronymic;
	public $address;
	public $email;
	public $token;
	public $discount;

    public function __construct($idUser, $idRole, $login, $password, $name, $surname, $patronymic, $address, $email, $token, $discount) {
        $this->idUser = $idUser;
        $this->idRole = $idRole;
        $this->login = $login;
        $this->password = $password;
		$this->name = $name;
		$this->surname = $surname;
		$this->patronymic = $patronymic;
		$this->address = $address;
		$this->email = $email;
		$this->token = $token;
		$this->discount = $discount;
    }

}
?>
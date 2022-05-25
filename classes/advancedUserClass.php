<?php
require_once ('./connection_script.php');
require_once ('./classes/userClass.php');
class AdvancedUser extends User
{
    public $name;
    public $surname;
    public $patronymic;
	public $address;
	public $district;
	public $city;
	public $street;
	public $house;
	public $flat;
	public $postIndex;
	public $email;
	public $token;
	public $discount;

    public function __construct($idUser, $idRole, $login, $password, $name, $surname, $patronymic, $district, $city, $street, $house, $flat, $postIndex, $email, $token, $discount) {
        $this->idUser = $idUser;
        $this->idRole = $idRole;
        $this->login = $login;
        $this->password = $password;
		$this->name = $name;
		$this->surname = $surname;
		$this->patronymic = $patronymic;
		$this->district = $district;
		$this->city = $city;
		$this->street = $street;
		$this->house = $house;
		$this->flat = $flat;
		$this->postIndex = $postIndex;
		$this->email = $email;
		$this->token = $token;
		$this->discount = $discount;
    }

}
?>
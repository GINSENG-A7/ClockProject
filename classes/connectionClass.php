<?php
class Connection
{
    public static $serverIP;
	public static $username;
	public static $password;

    public function __construct($serverIP, $username, $password) {
        $this->serverIP = $serverIP;
		$this->username = $username;
		$this->password = $password;
    }

	public function get_mysqli_connection($databaseName) {
		return mysqli_connect($this->serverIP, $this->username, $this->password, $databaseName);
	}
}
?>
<?php

require_once("Zend/Auth/Result.php");


class Hardcoded_Auth_Adapter implements Zend_Auth_Adapter_Interface
{
	protected $_username;
	protected $_password;

	public function __construct($username, $password) {
		$this->_username = $username;
		$this->_password = $password;
	}

	public function authenticate() {
		$users = Array(
			"alice" => "wonder",
			"bob" => "land"
		);
		return ($users[$this->_username] == $this->_password) ?
			new Zend_Auth_Result(Zend_Auth_Result::SUCCESS, $this->_username) :
			new Zend_Auth_Result(Zend_Auth_Result::FAILURE_CREDENTIAL_INVALID, $this->_username);
	}
}

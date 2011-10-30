<?php

class Application_Form_Login extends Zend_Form
{
	public function init()
	{
		$this->setMethod("post");

		$username = $this->addElement("text", "username", Array("required" => true, "label" => "Your username:"));
		$password = $this->addElement("password", "password", Array("required" => true, "label" => "Your password:"));
		$login = $this->addElement("submit", "login");
	}
}


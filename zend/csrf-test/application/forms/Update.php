<?php

class Application_Form_Update extends Zend_Form
{
	public function init()
	{
		$this->setAction("/index/update")
			->setMethod("post");

		$this->addElement("text", "message", Array(
			'required'   => true,
			'label'      => 'What are you doing?'
		));
		$this->addElement("submit", "submit");

		// !! CSRF PROTECTION BY TOKEN
		$this->addElement("hash", "csrf", Array("ignore" => true));
	}
}


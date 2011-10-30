<?php

class IndexController extends Zend_Controller_Action
{
	protected function getForm() {
		return new Application_Form_Update();
	}

	public function init() {
		$bootstrap = $this->getInvokeArg('bootstrap');
		$configArray = $bootstrap->getOptions();
		$this->config = new Zend_Config($configArray);
	}

	public function indexAction()	{
		$this->view->status =	file_exists($this->config->storage->file_name) ?
			file_get_contents($this->config->storage->file_name) :
			"Status file doesn't exist yet.";

		$this->view->form = $this->getForm();
	}

	public function updateAction() {
		if (Zend_Auth::getInstance()->hasIdentity()) {
			$request = $this->getRequest();

			$form = $this->getForm();
			// !! CSRF RISK
			// WRONG:    if (!$form->isValid($request->getParams())) {
			// CORRECT:  if (!$form->isValid($request->getPost())) {
			if (!$form->isValid($request->getPost())) {
				$this->view->form = $form;
				return $this->render('index');
			}

			$params = $form->getValues();
			$message = Zend_Auth::getInstance()->getIdentity() . ": " . $params["message"] . "\n";
			file_put_contents($this->config->storage->file_name, $message, FILE_APPEND);
		}

		$this->_helper->redirector('index');
	}
}


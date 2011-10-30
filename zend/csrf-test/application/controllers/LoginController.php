<?php

require_once "Hardcoded/Auth/Adapter.php";


class LoginController extends Zend_Controller_Action
{
	protected function getForm()
	{
		return new Application_Form_Login(Array(
			'action' => '/login/process'
		));
	}

	public function getAuthAdapter(array $params) {
		return new Hardcoded_Auth_Adapter($params["username"], $params["password"]);
	}

	public function indexAction() {
		$this->view->form = $this->getForm();
	}

	public function logoutAction() {
		Zend_Auth::getInstance()->clearIdentity();
		$this->_helper->redirector('index', 'index');
	}

	public function preDispatch() {
		if (Zend_Auth::getInstance()->hasIdentity()) {
			// If the user is logged in, we don't want to show the login form;
			// however, the logout action should still be available
			if ('logout' != $this->getRequest()->getActionName()) {
				$this->_helper->redirector('index', 'index');
			}
		} else {
			// If they aren't, they can't logout, so that action should 
			// redirect to the login form
			if ('logout' == $this->getRequest()->getActionName()) {
				$this->_helper->redirector('index');
			}
		}
	}

	public function processAction() {
		$request = $this->getRequest();

		// validate form
		$form = $this->getForm();
		if (!$form->isValid($request->getPost())) {
			$this->view->form = $form;
			return $this->render('index');
		}

		// authenticate
		$adapter = $this->getAuthAdapter($form->getValues());
		$auth    = Zend_Auth::getInstance();
		$result  = $auth->authenticate($adapter);
		if (!$result->isValid()) {
			$form->setDescription('Invalid credentials provided');
			$this->view->form = $form;
			return $this->render('index');
		}

		$this->_helper->redirector('index', 'index');
	}
}


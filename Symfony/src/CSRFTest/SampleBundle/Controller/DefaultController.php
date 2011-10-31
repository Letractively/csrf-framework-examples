<?php

namespace CSRFTest\SampleBundle\Controller;

use CSRFTest\SampleBundle\Entity\Status;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;


class DefaultController extends Controller
{
	public function createAction(Request $request) {
		$status = new Status();
		$form = $this->getForm($status);

		// !! CSRF risk -- accept POST only!
		if ($request->getMethod() == 'POST') {
			$form->bindRequest($request);
			if ($form->isValid()) {
				$em = $this->getDoctrine()->getEntityManager();
				$em->persist($status);
				$em->flush();
			}
		}
		
		return $this->redirect($this->generateUrl('CSRFTestSampleBundle_homepage'));
	}

	protected function getForm($status) {
		return $this->createFormBuilder($status)
			->add("author", "text")
			->add("status", "text")
			->getForm();
	}

    public function indexAction()
	{
		$status = new Status();
		$form = $this->getForm($status);

		$status = $this->getDoctrine()->getRepository('CSRFTestSampleBundle:Status')->findAll();

        return $this->render('CSRFTestSampleBundle:Default:index.html.twig', array('form' => $form->createView(), 'status' => $status));
	}
}

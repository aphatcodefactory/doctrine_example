<?php
namespace AppBundle\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use AppBundle\Entity\ExampleClass;


class ExampleController extends Controller {
	/**
	* @Route("/example/add")
	*/
	public function addAction() {
	
		$student = new ExampleClass();

		$student->setName('Thomas');
		$student->setAddress('Herklotzgasse 21');

		$doctrine = $this->getDoctrine()->getManager();

		// tells Doctrine you want to save the Product
		$doctrine->persist($student);

		//executes the queries (i.e. the INSERT query)
		$doctrine->flush();
		return new Response('Saved new student "'.$student->getName().'" with id ' . $student->getId());
	}

	/**
	* @Route("/example/display")
	*/
	public function displayAction() {

		$stud = $this->getDoctrine()->getRepository('AppBundle:ExampleClass')->findAll();
		return $this->render('example/display.html.twig', array('data' => $stud));
	}

	/**
	* @Route("/example/update/{id}")
	*/
	public function updateAction($id) {
		$doctrine = $this->getDoctrine()->getManager();

		$student = $doctrine->getRepository('AppBundle:ExampleClass')->find($id);

		if (!$student) {
			throw $this->createNotFoundException('No student found for id '.$id);
		}

		$student->setAddress('Herklotzgasse 21, Wien');
		$doctrine->flush();
		return new Response('Changes updated!');
	}

	/**
	* @Route("/example/delete/{id}")
	*/
	public function deleteAction($id) {

		$doctrine = $this->getDoctrine()->getManager();
		$student = $doctrine->getRepository('AppBundle:ExampleClass')->find($id);

		if (!$student) {
			throw $this->createNotFoundException('No student found for id '.$id);
		}

		$doctrine->remove($student);
		$doctrine->flush();
		return new Response('Record deleted!');
	}
}
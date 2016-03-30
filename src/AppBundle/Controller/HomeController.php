<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;

class HomeController extends Controller
{
	/**
     * @Route("/home", name="app_home")
     */
	public function headerAction()
	{
		return $this->render('/homepage/header.html.twig');

		return new Response($html);
	}

	/**
     * @Route("/home", name="app_home")
     */
	public function homeAction()
	{
		return $this->render('/homepage/home.html.twig');

		return new Response($html);
	}

	/**
     * @Route("/about", name="app_about")
     */
	public function aboutAction()
	{
		return $this->render('/homepage/about.html.twig');

		return new Response($html);
	}

	/**
     * @Route("/projects", name="app_projects")
     */
	public function projectsAction()
	{
		return $this->render('/homepage/projects.html.twig');

		return new Response($html);
	}

	/**
     * @Route("/contact", name="app_contact")
     */
	public function contactAction()
	{
		return $this->render('/homepage/contact.html.twig');

		return new Response($html);
	}

	/**
     * @Route("/blog", name="app_blog")
     */
	public function blogAction()
	{
		return $this->render('/blogpage/blog.html.twig');

		return new Response($html);
	}

}
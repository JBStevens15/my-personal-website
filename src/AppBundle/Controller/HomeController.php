<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use AppBundle\Entity\BlogPost;
use AppBundle\Form\Type\BlogPostType;
use Symfony\Component\HttpFoundation\Request;

class HomeController extends Controller
{
	/**
     * @Route("/", name="app_homeBlank")
     */
	public function homeBlankUrlAction()
	{
		return $this->render('/homepage/home.html.twig');
	}

	/**
     * @Route("/home", name="app_home")
     */
	public function homeAction()
	{
		return $this->render('/homepage/home.html.twig');
	}

	/**
     * @Route("/about", name="app_about")
     */
	public function aboutAction()
	{
		return $this->render('/homepage/about.html.twig');
	}

	/**
     * @Route("/projects", name="app_projects")
     */
	public function projectsAction()
	{
		return $this->render('/homepage/projects.html.twig');
	}

	/**
     * @Route("/contact", name="app_contact")
     */
	public function contactAction()
	{
		return $this->render('/homepage/contact.html.twig');
	}

	/**
     * @Route("/blog", name="app_blog")
     */
	public function blogAction()
	{
		$repository = $this->getDoctrine()
			->getRepository('AppBundle:BlogPost');

		$blogPosts = $repository->findAll();

		return $this->render(
			'/blogpage/blog.html.twig',
			array(
				'blogPosts' => $blogPosts
			)
		);
	}

	/**
	 * @Route("/blogedit", name="app_blog_edit")
	 */
	public function blogEditAction(Request $request)
	{
		$blogPost = new BlogPost();

		$form = $this->createForm(BlogPostType::class, $blogPost);

		if ($request->getMethod() === 'POST') {

			$form->handleRequest($request);

			if ($form->isValid()) {

				$em = $this->getDoctrine()->getManager();
				$em->persist($blogPost);
				$em->flush();

				return $this->redirectToRoute('app_blog');
			}
		}

		return $this->render(
			'/blogpage/blog_edit.html.twig',
			array(
				'blogPostForm' => $form->createView(),
			)
		);
	}

}
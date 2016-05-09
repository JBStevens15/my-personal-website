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

		$blogPosts = $repository->findAllOrderedByDate();

		return $this->render(
			'/blogpage/blog.html.twig',
			array(
				'blogPosts' => $blogPosts
			)
		);
	}

	/**
	 * @Route("/blog/{slug}", name="app_blog_show")
	 */
	public function blogPostAction($slug)
	{
		$repository = $this->getDoctrine()
			->getRepository('AppBundle:BlogPost');

		$blogPost = $repository->findPostBySlug();
		
		return $this->render(
			'/blogpage/blog_post.html.twig',
			array(
				'blogPost' => $blogPost
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

				return $this->redirectToRoute('app_blog_edit');
			}
		}

		$blogPosts = $this->getDoctrine()->getRepository('AppBundle:BlogPost')->findAllOrderedByDate();

		return $this->render(
			'/blogpage/blog_edit.html.twig',
			array(
				'blogPostForm' => $form->createView(),
				'blogPosts' => $blogPosts,
			)
		);
	}

	/**
	 * @Route("/blogedit/{id}/delete", name="app_blog_delete")
	 */
	public function blogDeleteAction($id)
	{
		$repository = $this->getDoctrine()
			->getRepository('AppBundle:BlogPost');

		$em = $this->getDoctrine()->getManager();

		$blogPost = $repository->find($id);

		$em->remove($blogPost);
		$em->flush();

		return $this->redirectToRoute('app_blog_edit');
	}

	/**
	 * @Route("/blogedit/{id}/edit", name="app_blog_update")
	 */
	public function blogUpdateAction(Request $request, $id)
	{
		$repository = $this->getDoctrine()
			->getRepository('AppBundle:BlogPost');

		$em = $this->getDoctrine()->getManager();

		$blogPost = $repository->find($id);

		$form = $this->createForm(BlogPostType::class, $blogPost);
		$form->handleRequest($request);

		if ($form->isSubmitted() && $form->isValid()) {

			// perform some action
			$em->persist($blogPost);
			$em->flush();

			return $this->redirectToRoute('app_blog_edit');
		}

		return $this->render(
			'blogpage/blog_update.html.twig',
			array(
				'blogPostForm' => $form->createView(),
			)
		);
	}
}
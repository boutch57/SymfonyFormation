<?php

namespace AppBundle\Controller;

use AppBundle\Service\MarkDownTransformer;
use AppBundle\Entity\project;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class ProjectsController extends Controller
{
    /**
     * @Route("/projects")
     */

    public function indexAction()
    {
        $cache = $this->get('doctrine_cache.providers.my_markdown_cache');

        $some_markdown = "super *code* **Markdown** haha";

        $transformer = $this->get('app.markdown_transformer');
        $some_markdown = $transformer->parse($some_markdown);

        $key = 'key';

        if($cache->contains($key)) {

            $some_markdown = $cache->fetch($key);
        }

        else {

            $some_markdown = $this->get('markdown.parser')->transformMarkdown($some_markdown);
            $cache->save($key, $some_markdown);
        }

       /* $projets = new project();

        $projets->setName('Projet 2');
        $projets->setDescription('Ceci est le projet 2');
        $projets->setTargetAmount('40');


        $em = $this->getDoctrine()->getManager();

        $em->persist($projets);
        $em->flush();

        return new Response("<body><h1>Event created!</h1></body>"); */

        $em = $this->getDoctrine()->getManager();

        $projets = $em->getRepository(project::class)->findAll();

        return $this->render('projects/index.html.twig', compact('projets', 'some_markdown'));

    }
}
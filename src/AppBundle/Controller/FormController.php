<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class FormController extends Controller
{
    /**
     * @Route("/", name="form")
     */
    public function indexAction(Request $request)
    {
        $categories = ['Sports', 'Science'];

        // replace this example code with whatever you need
        return $this->render('subscription/form.html.twig', ['categories' => $categories]);
    }
}

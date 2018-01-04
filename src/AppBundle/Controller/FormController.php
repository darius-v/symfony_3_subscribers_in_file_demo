<?php

namespace AppBundle\Controller;

use AppBundle\Service\Subscriber;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class FormController extends Controller
{
    private $subscriber;

    public function __construct(Subscriber $subscriber)
    {
        $this->subscriber = $subscriber;
    }

    /**
     * @Route("/", name="form")
     */
    public function indexAction(): Response
    {
        $categories = $this->subscriber->getCategories();

        // replace this example code with whatever you need
        return $this->render('subscription/form.html.twig', ['categories' => $categories]);
    }

    /**
     * @param Request $request
     * @return Response
     * @Route("/save", name="save_subscriber")
     */
    public function save(Request $request): Response
    {
        $this->subscriber->save($request->get('name'), $request->get('email'), $request->get('categories'));
    }
}

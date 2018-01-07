<?php

namespace AppBundle\Controller;

use AppBundle\Service\SubscriberService;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class SubscriberController extends Controller
{
    private $subscriber;

    public function __construct(SubscriberService $subscriber)
    {
        $this->subscriber = $subscriber;
    }

    /**
     * @Route("/", name="form")
     */
    public function indexAction(): Response
    {
        $categories = $this->subscriber->getCategories();

        return $this->render('subscription/form.html.twig', ['categories' => $categories]);
    }

    private function checkCsrf(Request $request)
    {
        if (!$this->isCsrfTokenValid('tokenId', $request->get('token'))) {
            throw new \Exception('Token invalid');
        }
    }

    /**
     * @param Request $request
     * @return Response
     * @Route("/save", name="save_subscriber")
     * @throws \Exception
     */
    public function save(Request $request): Response
    {
        $this->checkCsrf($request);

        $this->subscriber->save(
            $request->get('name'),
            $request->get('email'),
            $request->get('id'),
            $request->get('categories')
        );

        return $this->jsonResponse();
    }

    /**
     * @param string $id
     * @return Response
     * @Route("/edit/{id}", name="edit_form")
     */
    public function editForm(string $id): Response
    {
        $subscriber = $this->subscriber->findById($id);

        $categories = $this->subscriber->getCategories();

        return $this->render(
            'subscription/form.html.twig',
            [
                'categories' => $categories,
                'subscriber' => $subscriber
            ]
        );
    }

    private function jsonResponse(array $data = null): Response
    {
        $response = new JsonResponse();
        $response->setData(['success' => 1, 'data' => $data]);

        return $response;
    }

    /**
     * @return Response
     * @Route("/list", name="list")
     */
    public function list(): Response
    {
        $subscribers = $this->subscriber->getList();
        return $this->render('subscription/list.html.twig', ['subscribers' => $subscribers]);
    }

    /**
     * @param string $id
     * @param Request $request
     * @return Response
     * @Route("/delete/{id}", name="delete")
     */
    public function delete(string $id, Request $request): Response
    {
        $this->checkCsrf($request);

        $this->subscriber->delete($id);

        $response = new JsonResponse();
        $response->setData(['success' => 1]);

        return $response;
    }
}

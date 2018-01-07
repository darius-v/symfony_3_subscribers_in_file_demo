<?php

namespace AppBundle\Service;

use AppBundle\Repository\SubscriberRepository;
use Symfony\Component\Validator\Exception\ValidatorException;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use AppBundle\Entity\Subscriber;

define('CATEGORIES', ['Sports', 'Science']);

class SubscriberService
{
    private $validator;
    private $subscriberRepository;

    public function __construct(
        ValidatorInterface $validator,
        SubscriberRepository $subscriberRepository
    ) {
        $this->validator = $validator;
        $this->subscriberRepository = $subscriberRepository;
    }

    public function getCategories(): array
    {
        return CATEGORIES;
    }

    /**
     * @param string $name
     * @param string $email
     * @param string $id
     * @param array|null $categories
     * @throws \Exception
     */
    public function save(string $name, string $email, string $id, array $categories = null): void
    {
        $subscriber = new Subscriber();

        $subscriber->id = $id;
        $subscriber->name = $name;
        $subscriber->email = $email;
        $subscriber->categories = $categories;

        $errors = $this->validator->validate($subscriber);

        if (count($errors) > 0) {
            /*
             * Uses a __toString method on the $errors variable which is a
             * ConstraintViolationList object. This gives us a nice string
             * for debugging.
             */
            $errorsString = (string) $errors;

            throw new ValidatorException($errorsString);
        }

        $this->subscriberRepository->save($subscriber);
    }

    public function getList(): array
    {
        return $this->subscriberRepository->getList();
    }

    /**
     * @param string $id
     * @throws Exception
     * @return array
     */
    public function findById(string $id): array
    {
        $subscriber = $this->subscriberRepository->findById($id);

        if (is_null($subscriber)) {
            throw new Exception('Subscriber not found by id ' . $id);
        }

        return $subscriber;
    }

    public function delete(string $id)
    {
        $this->subscriberRepository->delete($id);
    }
}

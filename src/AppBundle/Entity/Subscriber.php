<?php

namespace AppBundle\Entity;

use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Context\ExecutionContextInterface;

class Subscriber
{
    /**
     * @Assert\NotBlank()
     */
    public $name;

    /**
     * @Assert\NotBlank()
     * @Assert\Email(
     *     message = "The email '{{ value }}' is not a valid email.",
     *     checkMX = true
     * )
     */
    public $email;

    public $categories;

    /**
     * @param ExecutionContextInterface $context
     * @param $payload
     * @Assert\Callback
     */
    public function validate(ExecutionContextInterface $context, $payload)
    {
        // check if the name is actually a fake name
        if (!count($this->categories)) {
            $context->buildViolation('Category not selected')
                ->atPath('categories')
                ->addViolation();
        } else {
            foreach ($this->categories as $category) {
                // check if the name is actually a fake name
                if (!in_array($category, CATEGORIES)) {
                    $context->buildViolation('Wrong categories')
                        ->atPath('categories')
                        ->addViolation();
                }
            }
        }
    }
}
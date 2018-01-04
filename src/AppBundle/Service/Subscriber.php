<?php

namespace AppBundle\Service;

class Subscriber
{
    public function getCategories(): array
    {
        return ['Sports', 'Science'];
    }

    public function save(string $name, string $email, array $categories): void
    {
        die('save' . $name);
    }
}
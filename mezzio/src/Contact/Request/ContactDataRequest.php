<?php

declare(strict_types=1);

namespace Contact\Request;

class ContactDataRequest
{
    private ?string $name;
    private ?string $number;
    private ?string $type;

    public function __construct(?string $name, ?string $number, ?string $type)
    {
        $this->name = $name;
        $this->number = $number;
        $this->type = $type;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function getNumber(): ?string
    {
        return $this->number;
    }

    public function getType(): ?string
    {
        return $this->type;
    }
}
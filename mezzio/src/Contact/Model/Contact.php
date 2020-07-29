<?php

declare(strict_types=1);

namespace Contact\Model;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="contacts")
 * @ORM\HasLifecycleCallbacks()
 */
class Contact implements \JsonSerializable
{
    /**
     * @var int|null
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue
     */
    protected $id;

    /**
     * @var string|null
     * @ORM\Column(name="guid", type="string", nullable=true)
     */
    protected $guid;

    /**
     * @var string|null
     * @ORM\Column(name="name", type="string", nullable=true)
     */
    protected $name;

    /**
     * @var string|null
     * @ORM\Column(name="number", type="string", nullable=true)
     */
    protected $number;

    /**
     * @var string|null
     * @ORM\Column(name="type", type="string", nullable=true)
     */
    protected $type;

    public function __construct(?string $guid, ?string $name, ?string $number, ?string $type)
    {
        $this->guid = $guid;
        $this->name = $name;
        $this->number = $number;
        $this->type = $type;
    }

    public function getId(): ?int
    {
        return $this->id;
    }
    
    public function getGuid(): ?string
    {
        return $this->guid;
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

    public function setName(?string $name): void
    {
        $this->name = $name;
    }

    public function setNumber(?string $number): void
    {
        $this->number = $number;
    }

    public function setType(?string $type): void
    {
        $this->type = $type;
    }

    public function jsonSerialize()
    {
        return [
            'id' => $this->getId(),
            'guid' => $this->getGuid(),
            'name' => $this->getName(),
            'number' => $this->getNumber(),
            'type' => $this->getType(),
        ];
    }
}
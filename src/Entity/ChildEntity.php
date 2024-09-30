<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiProperty;
use ApiPlatform\Metadata\ApiResource;
use App\Repository\ChildEntityRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Attribute\Groups;

#[ORM\Entity(repositoryClass: ChildEntityRepository::class)]
#[ApiResource(operations: [])]
class ChildEntity
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[ApiProperty(security: "object.getId() != 1")]
    #[Groups(['test'])]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Groups(['test'])]
    private ?string $name = null;

    #[ORM\ManyToOne(inversedBy: 'children')]
    #[ORM\JoinColumn(nullable: false)]
    private ?ParentEntity $parent = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getParent(): ?ParentEntity
    {
        return $this->parent;
    }

    public function setParent(?ParentEntity $parent): static
    {
        $this->parent = $parent;

        return $this;
    }
}

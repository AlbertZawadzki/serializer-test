<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\GetCollection;
use App\Repository\ParentEntityRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Attribute\Groups;

#[ORM\Entity(repositoryClass: ParentEntityRepository::class)]
#[ApiResource(
    operations: [
        new GetCollection(
            uriTemplate: 'parents',
            normalizationContext: [
                'groups' => [
                    'test'
                ]
            ],
        ),
    ]
)]
class ParentEntity
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['test'])]
    private ?int $id = null;

    /**
     * @var Collection<int, ChildEntity>
     */
    #[ORM\OneToMany(targetEntity: ChildEntity::class, mappedBy: 'parent')]
    #[Groups(['test'])]
    private Collection $children;

    public function __construct()
    {
        $this->children = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection<int, ChildEntity>
     */
    public function getChildren(): Collection
    {
        return $this->children;
    }

    public function addChild(ChildEntity $child): static
    {
        if (!$this->children->contains($child)) {
            $this->children->add($child);
            $child->setParent($this);
        }

        return $this;
    }

    public function removeChild(ChildEntity $child): static
    {
        if ($this->children->removeElement($child)) {
            // set the owning side to null (unless already changed)
            if ($child->getParent() === $this) {
                $child->setParent(null);
            }
        }

        return $this;
    }
}

<?php

namespace App\Entity;

use App\Repository\TagRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TagRepository::class)]
class Tag
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(length: 255)]
    private ?string $description = null;

    #[ORM\Column(length: 255)]
    private ?string $url = null;

    #[ORM\OneToMany(targetEntity: Article::class, mappedBy: 'tag')]
    private $tag;

    public function __construct()
    {
        $this->tag = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getUrl(): ?string
    {
        return $this->url;
    }

    public function setUrl(string $url): self
    {
        $this->url = $url;

        return $this;
    }

    /**
     * @return Collection|Article[]
     */
    public function getTag(): Collection
    {
        return $this->tag;
    }

    public function addTag(Article $tag): self
    {
        if (!$this->tag->contains($tag)) {
            $this->tag[] = $tag;
            $tag->setTags($this);
        }

        return $this;
    }

    public function removeTag(Article $tag): self
    {
        if ($this->tag->removeElement($tag)) {
            // set the owning side to null (unless already changed)
            if ($tag->getTags() === $this) {
                $tag->setTags(null);
            }
        }

        return $this;
    }

    public function __toString() {
        return $this->name;
    }
}

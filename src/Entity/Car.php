<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CarRepository")
 */
class Car
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Post", mappedBy="car", orphanRemoval=true)
     */
    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Mark", inversedBy="cars")
     * @ORM\JoinColumn(nullable=false)
     */
    private $mark;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\EngineSize", inversedBy="cars")
     * @ORM\JoinColumn(nullable=false)
     */
    private $engineSize;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\BodyType", inversedBy="cars")
     * @ORM\JoinColumn(nullable=false)
     */
    private $bodyType;

    /**
     * @ORM\Column(type="integer")
     */
    private $year;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Post", mappedBy="car", orphanRemoval=true)
     */
    private $posts;


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

    public function getMark(): ?Mark
    {
        return $this->mark;
    }

    public function setMark(?Mark $mark): self
    {
        $this->mark = $mark;

        return $this;
    }

    public function getEngineSize(): ?EngineSize
    {
        return $this->engineSize;
    }

    public function setEngineSize(?EngineSize $engineSize): self
    {
        $this->engineSize = $engineSize;

        return $this;
    }

    public function getBodyType(): ?BodyType
    {
        return $this->bodyType;
    }

    public function setBodyType(?BodyType $bodyType): self
    {
        $this->bodyType = $bodyType;

        return $this;
    }

    public function getYear(): ?int
    {
        return $this->year;
    }

    public function setYear(int $year): self
    {
        $this->year = $year;

        return $this;
    }


    public function __construct()
    {
        $this->posts = new ArrayCollection();
    }



    public function __toString(): string
    {
        return $this->name;
    }

    /**
     * @return Collection|Post[]
     */
    public function getPosts(): Collection
    {
        return $this->posts;
    }

    public function addPost(Post $post): self
    {
        if (!$this->posts->contains($post)) {
            $this->posts[] = $post;
            $post->setCar($this);
        }

        return $this;
    }

    public function removePost(Post $post): self
    {
        if ($this->posts->contains($post)) {
            $this->posts->removeElement($post);
            // set the owning side to null (unless already changed)
            if ($post->getCar() === $this) {
                $post->setCar(null);
            }
        }

        return $this;
    }
}

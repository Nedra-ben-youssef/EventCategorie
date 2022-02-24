<?php

namespace App\Entity;
use App\Repository\EventRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * @ORM\Entity(repositoryClass=EventRepository::class)
 */
class Event
{
    /**
    
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     *
     * @ORM\Column(name="nameevent", type="string", length=255)
     *@Assert\NotBlank(message="name is required")
     */
    public $nameevent;

    /**
    
     * @ORM\Column(name="descriptionevent", type="string", length=255)
     *@Assert\NotBlank(message="description is required")
    
     */
    private $descriptionEvent;

    /**
    
     * @ORM\Column(name="promotion", type="string", length=255)
     * @Assert\NotBlank(message="promotion is required")
     */
    private $promotion;

    /**
    
     * @ORM\Column(name="newPrix", type="float")
     * @Assert\NotBlank(message="le nouveau prix is required")
    
     */
    private $newPrix;

    /**
     *
     * @ORM\ManyToOne(targetEntity="Categorie")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="categorie_id", referencedColumnName="id")
     * })
     */
    private $categorie;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $image;


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getnameevent(): ?string
    {
        return $this->nameevent;
    }

    public function setnameevent(string $nameevent): self
    {
        $this->nameevent = $nameevent;

        return $this;
    }

    public function getDescriptionEvent(): ?string
    {
        return $this->descriptionEvent;
    }

    public function setDescriptionEvent(string $descriptionEvent): self
    {
        $this->descriptionEvent = $descriptionEvent;

        return $this;
    }

    public function getPromotion(): ?string
    {
        return $this->promotion;
    }

    public function setPromotion(string $promotion): self
    {
        $this->promotion = $promotion;

        return $this;
    }

    public function getNewPrix(): ?float
    {
        return $this->newPrix;
    }

    public function setNewPrix(float $newPrix): self
    {
        $this->newPrix = $newPrix;

        return $this;
    }

    public function getCategorie(): ?Categorie
    {
        return $this->categorie;
    }

    public function setCategorie(?Categorie $categorie): self
    {
        $this->categorie = $categorie;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(?string $image): self
    {
        $this->image = $image;

        return $this;
    }
    
    
}

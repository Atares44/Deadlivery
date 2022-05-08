<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\AdressRepository")
 */
class Adress
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $adressNumber;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $adressStreet;

    /**
     * @ORM\Column(type="integer")
     */
    private $adressPostCode;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $adressTown;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $adressCountry;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\User", inversedBy="userAdresses")
     */
    private $adressUsers;

    public function __construct()
    {
        $this->adressUsers = new ArrayCollection();
    }



    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAdressNumber(): ?int
    {
        return $this->adressNumber;
    }

    public function setAdressNumber(?int $adressNumber): self
    {
        $this->adressNumber = $adressNumber;

        return $this;
    }

    public function getAdressStreet(): ?string
    {
        return $this->adressStreet;
    }

    public function setAdressStreet(string $adressStreet): self
    {
        $this->adressStreet = $adressStreet;

        return $this;
    }

    public function getAdressPostCode(): ?int
    {
        return $this->adressPostCode;
    }

    public function setAdressPostCode(int $adressPostCode): self
    {
        $this->adressPostCode = $adressPostCode;

        return $this;
    }

    public function getAdressTown(): ?string
    {
        return $this->adressTown;
    }

    public function setAdressTown(string $adressTown): self
    {
        $this->adressTown = $adressTown;

        return $this;
    }

    public function getAdressCountry(): ?string
    {
        return $this->adressCountry;
    }

    public function setAdressCountry(string $adressCountry): self
    {
        $this->adressCountry = $adressCountry;

        return $this;
    }

    /**
     * @return Collection|User[]
     */
    public function getAdressUsers(): Collection
    {
        return $this->adressUsers;
    }

    public function addAdressUser(User $adressUser): self
    {
        if (!$this->adressUsers->contains($adressUser)) {
            $this->adressUsers[] = $adressUser;
        }

        return $this;
    }

    public function removeAdressUser(User $adressUser): self
    {
        if ($this->adressUsers->contains($adressUser)) {
            $this->adressUsers->removeElement($adressUser);
        }

        return $this;
    }
}

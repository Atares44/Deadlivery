<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PaymentCardRepository")
 */
class PaymentCard
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=19)
     */
    private $cardNumber;

    /**
     * @ORM\Column(type="string", length=2)
     */
    private $cardMonth;

    /**
     * @ORM\Column(type="string", length=2)
     */
    private $cardYear;

    /**
     * @ORM\Column(type="string", length=3)
     */
    private $cardSecurityCode;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Clients", mappedBy="cards")
     */
    private $cardOwner;

    public function __construct()
    {
        $this->cardOwner = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCardNumber(): ?string
    {
        return $this->cardNumber;
    }

    public function setCardNumber(string $cardNumber): self
    {
        $this->cardNumber = $cardNumber;

        return $this;
    }

    public function getCardMonth(): ?string
    {
        return $this->cardMonth;
    }

    public function setCardMonth($cardMonth): self
    {
        $this->cardMonth = $cardMonth;

        return $this;
    }

    public function getCardYear(): ?string
    {
        return $this->cardYear;
    }

    public function setCardYear($cardYear): self
    {
        $this->cardYear = $cardYear;

        return $this;
    }

    public function getCardSecurityCode(): ?string
    {
        return $this->cardSecurityCode;
    }

    public function setCardSecurityCode(string $cardSecurityCode): self
    {
        $this->cardSecurityCode = $cardSecurityCode;

        return $this;
    }

    /**
     * @return Collection|Clients[]
     */
    public function getCardOwner(): Collection
    {
        return $this->cardOwner;
    }

    public function addCardOwner(Clients $cardOwner): self
    {
        if (!$this->cardOwner->contains($cardOwner)) {
            $this->cardOwner[] = $cardOwner;
            $cardOwner->addCard($this);
        }

        return $this;
    }

    public function removeCardOwner(Clients $cardOwner): self
    {
        if ($this->cardOwner->contains($cardOwner)) {
            $this->cardOwner->removeElement($cardOwner);
            $cardOwner->removeCard($this);
        }

        return $this;
    }
}

<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ClientsRepository")
 */
class Clients
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $clientRank;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $nbOrders;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Orders", mappedBy="client")
     */
    private $orders;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Comments", mappedBy="commentClient")
     */
    private $comments;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\PaymentCard", inversedBy="cardOwner")
     */
    private $cards;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\User", mappedBy="clientAccount", cascade={"persist", "remove"})
     */
    private $user;

    public function __construct()
    {
        $this->orders = new ArrayCollection();
        $this->comments = new ArrayCollection();
        $this->cards = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getClientRank(): ?string
    {
        return $this->clientRank;
    }

    public function setClientRank(string $clientRank): self
    {
        $this->clientRank = $clientRank;

        return $this;
    }

    public function getNbOrders(): ?int
    {
        return $this->nbOrders;
    }

    public function setNbOrders(?int $nbOrders): self
    {
        $this->nbOrders = $nbOrders;

        return $this;
    }

    /**
     * @return Collection|Orders[]
     */
    public function getOrders(): Collection
    {
        return $this->orders;
    }

    public function addOrder(Orders $order): self
    {
        if (!$this->orders->contains($order)) {
            $this->orders[] = $order;
            $order->setClient($this);
        }

        return $this;
    }

    public function removeOrder(Orders $order): self
    {
        if ($this->orders->contains($order)) {
            $this->orders->removeElement($order);
            // set the owning side to null (unless already changed)
            if ($order->getClient() === $this) {
                $order->setClient(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Comments[]
     */
    public function getComments(): Collection
    {
        return $this->comments;
    }

    public function addComment(Comments $comment): self
    {
        if (!$this->comments->contains($comment)) {
            $this->comments[] = $comment;
            $comment->setCommentClient($this);
        }

        return $this;
    }

    public function removeComment(Comments $comment): self
    {
        if ($this->comments->contains($comment)) {
            $this->comments->removeElement($comment);
            // set the owning side to null (unless already changed)
            if ($comment->getCommentClient() === $this) {
                $comment->setCommentClient(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|PaymentCard[]
     */
    public function getCards(): Collection
    {
        return $this->cards;
    }

    public function addCard(PaymentCard $card): self
    {
        if (!$this->cards->contains($card)) {
            $this->cards[] = $card;
        }

        return $this;
    }

    public function removeCard(PaymentCard $card): self
    {
        if ($this->cards->contains($card)) {
            $this->cards->removeElement($card);
        }

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        // set (or unset) the owning side of the relation if necessary
        $newClientAccount = null === $user ? null : $this;
        if ($user->getClientAccount() !== $newClientAccount) {
            $user->setClientAccount($newClientAccount);
            $user->addRoles("ROLE_CLIENT");
        }

        return $this;
    }
}

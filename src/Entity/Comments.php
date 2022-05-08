<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CommentsRepository")
 */
class Comments
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
    private $commentTitle;

    /**
     * @ORM\Column(type="text")
     */
    private $commentText;

    /**
     * @ORM\Column(type="integer")
     */
    private $commentNote;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Clients", inversedBy="comments")
     * @ORM\JoinColumn(nullable=false)
     */
    private $commentClient;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Products", inversedBy="comments")
     * @ORM\JoinColumn(nullable=false)
     */
    private $commentProduct;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCommentTitle(): ?string
    {
        return $this->commentTitle;
    }

    public function setCommentTitle(string $commentTitle): self
    {
        $this->commentTitle = $commentTitle;

        return $this;
    }

    public function getCommentText(): ?string
    {
        return $this->commentText;
    }

    public function setCommentText(string $commentText): self
    {
        $this->commentText = $commentText;

        return $this;
    }

    public function getCommentNote(): ?int
    {
        return $this->commentNote;
    }

    public function setCommentNote(int $commentNote): self
    {
        $this->commentNote = $commentNote;

        return $this;
    }

    public function getCommentClient(): ?Clients
    {
        return $this->commentClient;
    }

    public function setCommentClient(?Clients $commentClient): self
    {
        $this->commentClient = $commentClient;

        return $this;
    }

    public function getCommentProduct(): ?Products
    {
        return $this->commentProduct;
    }

    public function setCommentProduct(?Products $commentProduct): self
    {
        $this->commentProduct = $commentProduct;

        return $this;
    }
}

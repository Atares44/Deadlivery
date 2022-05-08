<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ProductsRepository")
 */
class Products
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
    private $productName;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $productDesc;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $productNature;

    private $averageNote;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Comments", mappedBy="commentProduct")
     */
    private $comments;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Orders", mappedBy="orderProducts")
     */
    private $orders;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\ServicesType", inversedBy="products")
     * @ORM\JoinColumn(nullable=false)
     */
    private $productService;

    /**
     * @ORM\Column(type="string", nullable=true)
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="products", referencedColumnName="id")
     * })
     */
    private $productImg;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $productStatus;

    public function __construct()
    {
        $this->comments = new ArrayCollection();
        $this->orders = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getProductName(): ?string
    {
        return $this->productName;
    }

    public function setProductName(string $productName): self
    {
        $this->productName = $productName;

        return $this;
    }

    public function getProductDesc(): ?string
    {
        return $this->productDesc;
    }

    public function setProductDesc(?string $productDesc): self
    {
        $this->productDesc = $productDesc;

        return $this;
    }

    public function getProductNature(): ?string
    {
        return $this->productNature;
    }

    public function setProductNature(string $productNature): self
    {
        $this->productNature = $productNature;

        return $this;
    }

    public function getAverageNote(): ?int
    {
        $avg = 0;
        $nbNotes = 0;
        foreach ($this->comments as $comment){
            $avg += $comment->getCommentNote();
            $nbNotes++;
        }
        if($nbNotes>0){
            return $total = $avg/$nbNotes;
        } else {
            return $total = 0;
        }
    }

    public function setAverageNote(?int $averageNote): self
    {
        $this->averageNote = $averageNote;

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
            $comment->setCommentProduct($this);
        }

        return $this;
    }

    public function removeComment(Comments $comment): self
    {
        if ($this->comments->contains($comment)) {
            $this->comments->removeElement($comment);
            // set the owning side to null (unless already changed)
            if ($comment->getCommentProduct() === $this) {
                $comment->setCommentProduct(null);
            }
        }

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
            $order->setOrderProducts($this);
        }

        return $this;
    }

    public function removeOrder(Orders $order): self
    {
        if ($this->orders->contains($order)) {
            $this->orders->removeElement($order);
            // set the owning side to null (unless already changed)
            if ($order->getOrderProducts() === $this) {
                $order->setOrderProducts(null);
            }
        }

        return $this;
    }

    public function getProductService(): ?ServicesType
    {
        return $this->productService;
    }

    public function setProductService(?ServicesType $productService): self
    {
        $this->productService = $productService;

        return $this;
    }

    public function getProductImg()
    {
        return $this->productImg;
    }

    public function setProductImg($productImg): self
    {
        $this->productImg = $productImg;

        return $this;
    }

    public function __toString()
    {
        return $this->productName;
    }

    public function getProductStatus(): ?string
    {
        return $this->productStatus;
    }

    public function setProductStatus(string $productStatus): self
    {
        $this->productStatus = $productStatus;

        return $this;
    }


}

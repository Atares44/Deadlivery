<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ServicesTypeRepository")
 */
class ServicesType
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
    private $serviceName;

    /**
     * @ORM\Column(type="decimal", precision=10, scale=0, nullable=true)
     */
    private $price;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Products", mappedBy="productService")
     */
    private $products;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Orders", mappedBy="orderService")
     */
    private $orders;

    /**
     * @ORM\Column(type="text")
     */
    private $serviceDesc;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $serviceTypeStatus;

    public function __construct()
    {
        $this->products = new ArrayCollection();
        $this->orders = new ArrayCollection();
    }

    public function __toString()
    {
        return $this->serviceName;
    }


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getServiceName(): ?string
    {
        return $this->serviceName;
    }

    public function setServiceName(string $serviceName): self
    {
        $this->serviceName = $serviceName;

        return $this;
    }

    /**
     * @return Collection|Products[]
     */
    public function getProducts(): Collection
    {
        return $this->products;
    }

    public function addProduct(Products $product): self
    {
        if (!$this->products->contains($product)) {
            $this->products[] = $product;
            $product->setProductService($this);
        }

        return $this;
    }

    public function removeProduct(Products $product): self
    {
        if ($this->products->contains($product)) {
            $this->products->removeElement($product);
            // set the owning side to null (unless already changed)
            if ($product->getProductService() === $this) {
                $product->setProductService(null);
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
            $order->setOrderService($this);
        }

        return $this;
    }

    public function removeOrder(Orders $order): self
    {
        if ($this->orders->contains($order)) {
            $this->orders->removeElement($order);
            // set the owning side to null (unless already changed)
            if ($order->getOrderService() === $this) {
                $order->setOrderService(null);
            }
        }

        return $this;
    }

    public function getServiceDesc(): ?string
    {
        return $this->serviceDesc;
    }

    public function setServiceDesc(string $serviceDesc): self
    {
        $this->serviceDesc = $serviceDesc;

        return $this;
    }

    public function getPrice(): ?string
    {
        return $this->price;
    }

    public function setPrice(?string $price): self
    {
        $this->price = $price;

        return $this;
    }

    public function getServiceTypeStatus(): ?string
    {
        return $this->serviceTypeStatus;
    }

    public function setServiceTypeStatus(string $serviceTypeStatus): self
    {
        $this->serviceTypeStatus = $serviceTypeStatus;

        return $this;
    }
}

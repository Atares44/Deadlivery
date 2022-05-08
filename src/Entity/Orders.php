<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\OrdersRepository")
 */
class Orders
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="date")
     */
    private $orderDate;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Clients", inversedBy="orders")
     * @ORM\JoinColumn(nullable=false)
     */
    private $client;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Products", inversedBy="orders")
     * @ORM\JoinColumn(nullable=false)
     */
    private $orderProducts;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\ServicesType", inversedBy="orders")
     * @ORM\JoinColumn(nullable=false)
     */
    private $orderService;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $shippingANumber;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $shippingAStreet;

    /**
     * @ORM\Column(type="integer")
     */
    private $shippingAPostCode;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $shippingATown;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $shippingACountry;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $billingANumber;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $billingAStreet;

    /**
     * @ORM\Column(type="integer")
     */
    private $billingAPostCode;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $billingATown;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $billingACountry;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $orderRef;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $orderStatus;

    /**
     * @ORM\Column(type="date")
     * @Assert\GreaterThanOrEqual("+6 days", message="Il faut compter 7 jours de préparation du produit avant de pouvoir le louer")
     * @Assert\LessThanOrEqual(propertyPath="calcMaxDateStart", message="Réservation impossible plus de 2 mois à l'avance")
     */
    private $orderStartDate;

    /**
     * @ORM\Column(type="date")
     * @Assert\GreaterThanOrEqual(propertyPath="orderStartDate", message="La date de fin de location doit être supérieure à la date de début de location")
     * @Assert\LessThanOrEqual(propertyPath="calcMaxDate", message="La durée de location est limité à 2 mois")
     */
    private $orderEndDate;

    /**
     * @ORM\Column(type="decimal", precision=10, scale=0)
     */
    private $orderPrice;

    /**
     * @Assert\EqualTo("true", message="Le produit n'est pas disponible sur la periode sélectionné")
     */
    private $orderDispo;

    /**
     * @return mixed
     */
    public function getOrderDispo()
    {
        return $this->orderDispo;
    }

    /**
     * @param mixed $orderDispo
     */
    public function setOrderDispo($orderDispo): void
    {
        $this->orderDispo = $orderDispo;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getOrderDate(): ?\DateTimeInterface
    {
        return $this->orderDate;
    }

    public function setOrderDate(\DateTimeInterface $orderDate): self
    {
        $this->orderDate = $orderDate;

        return $this;
    }

    public function getClient(): ?Clients
    {
        return $this->client;
    }

    public function setClient(?Clients $client): self
    {
        $this->client = $client;

        return $this;
    }

    public function getOrderProducts(): ?Products
    {
        return $this->orderProducts;
    }

    public function setOrderProducts(?Products $orderProducts): self
    {
        $this->orderProducts = $orderProducts;

        return $this;
    }

    public function getOrderService(): ?ServicesType
    {
        return $this->orderService;
    }

    public function setOrderService(?ServicesType $orderService): self
    {
        $this->orderService = $orderService;

        return $this;
    }

    public function getShippingANumber(): ?string
    {
        return $this->shippingANumber;
    }

    public function setShippingANumber(?string $shippingANumber): self
    {
        $this->shippingANumber = $shippingANumber;

        return $this;
    }

    public function getShippingAStreet(): ?string
    {
        return $this->shippingAStreet;
    }

    public function setShippingAStreet(string $shippingAStreet): self
    {
        $this->shippingAStreet = $shippingAStreet;

        return $this;
    }

    public function getShippingAPostCode(): ?int
    {
        return $this->shippingAPostCode;
    }

    public function setShippingAPostCode(int $shippingAPostCode): self
    {
        $this->shippingAPostCode = $shippingAPostCode;

        return $this;
    }

    public function getShippingATown(): ?string
    {
        return $this->shippingATown;
    }

    public function setShippingATown(string $shippingATown): self
    {
        $this->shippingATown = $shippingATown;

        return $this;
    }

    public function getShippingACountry(): ?string
    {
        return $this->shippingACountry;
    }

    public function setShippingACountry(string $shippingACountry): self
    {
        $this->shippingACountry = $shippingACountry;

        return $this;
    }

    public function getBillingANumber(): ?string
    {
        return $this->billingANumber;
    }

    public function setBillingANumber(?string $billingANumber): self
    {
        $this->billingANumber = $billingANumber;

        return $this;
    }

    public function getBillingAStreet(): ?string
    {
        return $this->billingAStreet;
    }

    public function setBillingAStreet(string $billingAStreet): self
    {
        $this->billingAStreet = $billingAStreet;

        return $this;
    }

    public function getBillingAPostCode(): ?int
    {
        return $this->billingAPostCode;
    }

    public function setBillingAPostCode(int $billingAPostCode): self
    {
        $this->billingAPostCode = $billingAPostCode;

        return $this;
    }

    public function getBillingATown(): ?string
    {
        return $this->billingATown;
    }

    public function setBillingATown(string $billingATown): self
    {
        $this->billingATown = $billingATown;

        return $this;
    }

    public function getBillingACountry(): ?string
    {
        return $this->billingACountry;
    }

    public function setBillingACountry(string $billingACountry): self
    {
        $this->billingACountry = $billingACountry;

        return $this;
    }

    public function getOrderRef(): ?string
    {
        return $this->orderRef;
    }

    public function setOrderRef(string $orderRef): self
    {
        $this->orderRef = $orderRef;

        return $this;
    }

    public function getOrderStatus(): ?string
    {
        return $this->orderStatus;
    }

    public function setOrderStatus(string $orderStatus): self
    {
        $this->orderStatus = $orderStatus;

        return $this;
    }

    public function getOrderStartDate(): ?\DateTimeInterface
    {
        return $this->orderStartDate;
    }

    public function setOrderStartDate(\DateTimeInterface $orderStartDate): self
    {

        $this->orderStartDate = $orderStartDate;

        return $this;
    }

    public function getOrderEndDate(): ?\DateTimeInterface
    {
        return $this->orderEndDate;
    }

    public function setOrderEndDate(\DateTimeInterface $orderEndDate): self
    {
        $this->orderEndDate = $orderEndDate;

        return $this;
    }

    public function getOrderPrice(): ?string
    {
        return $this->orderPrice;
    }

    public function setOrderPrice(string $orderPrice): self
    {
        $this->orderPrice = $orderPrice;

        return $this;
    }

    public function calcMaxDate(): \DateTime
    {
        return $this->orderStartDate->add(new \DateInterval('P60D'));
    }

    public function calcMaxDateStart(): \DateTime
    {
        $dateNow = new \DateTime();
        return $dateNow->add(new \DateInterval('P60D'));

    }

}

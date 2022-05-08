<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\TempOrderRepository")
 */
class TempOrder
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
    private $tempStartDate;

    /**
     * @ORM\Column(type="date")
     */
    private $tempEndDate;

    /**
     * @ORM\Column(type="integer")
     */
    private $tempOrderServId;

    /**
     * @ORM\Column(type="integer")
     */
    private $tempOrderProductId;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $tempOrderStatus;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $tempOrderRef;

    /**
     * @ORM\Column(type="decimal", precision=10, scale=0, nullable=true)
     */
    private $tempOrderPrice;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $tempShippingANumber;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $tempShippingAStreet;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $tempShippingAPostCode;

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    private $tempShippingATown;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $tempShippingACountry;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $tempBillingANumber;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $tempBillingAStreet;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $tempBillingAPostCode;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $tempBillingATown;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $tempBillingACountry;

    /**
     * @ORM\Column(type="datetime")
     */
    private $tempOrderDate;

    /**
     * @ORM\Column(type="date")
     */
    private $availableDate;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTempStartDate(): ?\DateTimeInterface
    {
        return $this->tempStartDate;
    }

    public function setTempStartDate(\DateTimeInterface $tempStartDate): self
    {
        $this->tempStartDate = $tempStartDate;

        return $this;
    }

    public function getTempEndDate(): ?\DateTimeInterface
    {
        return $this->tempEndDate;
    }

    public function setTempEndDate(\DateTimeInterface $tempEndDate): self
    {
        $this->tempEndDate = $tempEndDate;

        return $this;
    }

    public function getTempOrderServId(): ?int
    {
        return $this->tempOrderServId;
    }

    public function setTempOrderServId(int $tempOrderServId): self
    {
        $this->tempOrderServId = $tempOrderServId;

        return $this;
    }

    public function getTempOrderProductId(): ?int
    {
        return $this->tempOrderProductId;
    }

    public function setTempOrderProductId(int $tempOrderProductId): self
    {
        $this->tempOrderProductId = $tempOrderProductId;

        return $this;
    }

    public function getTempOrderStatus(): ?string
    {
        return $this->tempOrderStatus;
    }

    public function setTempOrderStatus(string $tempOrderStatus): self
    {
        $this->tempOrderStatus = $tempOrderStatus;

        return $this;
    }

    public function getTempOrderRef(): ?string
    {
        return $this->tempOrderRef;
    }

    public function setTempOrderRef(string $tempOrderRef): self
    {
        $this->tempOrderRef = $tempOrderRef;

        return $this;
    }

    public function getTempOrderPrice(): ?string
    {
        return $this->tempOrderPrice;
    }

    public function setTempOrderPrice(string $tempOrderPrice): self
    {
        $this->tempOrderPrice = $tempOrderPrice;

        return $this;
    }

    public function getTempShippingANumber(): ?string
    {
        return $this->tempShippingANumber;
    }

    public function setTempShippingANumber(?string $tempShippingANumber): self
    {
        $this->tempShippingANumber = $tempShippingANumber;

        return $this;
    }

    public function getTempShippingAStreet(): ?string
    {
        return $this->tempShippingAStreet;
    }

    public function setTempShippingAStreet(string $tempShippingAStreet): self
    {
        $this->tempShippingAStreet = $tempShippingAStreet;

        return $this;
    }

    public function getTempShippingAPostCode(): ?int
    {
        return $this->tempShippingAPostCode;
    }

    public function setTempShippingAPostCode(int $tempShippingAPostCode): self
    {
        $this->tempShippingAPostCode = $tempShippingAPostCode;

        return $this;
    }

    public function getTempShippingATown(): ?string
    {
        return $this->tempShippingATown;
    }

    public function setTempShippingATown(string $tempShippingATown): self
    {
        $this->tempShippingATown = $tempShippingATown;

        return $this;
    }

    public function getTempShippingACountry(): ?string
    {
        return $this->tempShippingACountry;
    }

    public function setTempShippingACountry(string $tempShippingACountry): self
    {
        $this->tempShippingACountry = $tempShippingACountry;

        return $this;
    }

    public function getTempBillingANumber(): ?string
    {
        return $this->tempBillingANumber;
    }

    public function setTempBillingANumber(?string $tempBillingANumber): self
    {
        $this->tempBillingANumber = $tempBillingANumber;

        return $this;
    }

    public function getTempBillingAStreet(): ?string
    {
        return $this->tempBillingAStreet;
    }

    public function setTempBillingAStreet(string $tempBillingAStreet): self
    {
        $this->tempBillingAStreet = $tempBillingAStreet;

        return $this;
    }

    public function getTempBillingAPostCode(): ?int
    {
        return $this->tempBillingAPostCode;
    }

    public function setTempBillingAPostCode(int $tempBillingAPostCode): self
    {
        $this->tempBillingAPostCode = $tempBillingAPostCode;

        return $this;
    }

    public function getTempBillingATown(): ?string
    {
        return $this->tempBillingATown;
    }

    public function setTempBillingATown(string $tempBillingATown): self
    {
        $this->tempBillingATown = $tempBillingATown;

        return $this;
    }

    public function getTempBillingACountry(): ?string
    {
        return $this->tempBillingACountry;
    }

    public function setTempBillingACountry(string $tempBillingACountry): self
    {
        $this->tempBillingACountry = $tempBillingACountry;

        return $this;
    }

    public function getTempOrderDate(): ?\DateTimeInterface
    {
        return $this->tempOrderDate;
    }

    public function setTempOrderDate(\DateTimeInterface $tempOrderDate): self
    {
        $this->tempOrderDate = $tempOrderDate;

        return $this;
    }

    public function verifTime($dateNow, $dateOrder)
    {
        if((date_diff($dateNow,$dateOrder)->format('%i'))>20){
            return true;
        } else {
            return false;
        }
    }

    public function getAvailableDate(): ?\DateTimeInterface
    {
        return $this->availableDate;
    }

    public function setAvailableDate(\DateTimeInterface $availableDate): self
    {
        $this->availableDate = $availableDate;

        return $this;
    }
}

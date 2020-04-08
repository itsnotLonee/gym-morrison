<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UsersPaymentRepository")
 */
class UsersPayment
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $user_id;

    /**
     * @ORM\Column(type="integer")
     */
    private $payment_id;

    /**
     * @ORM\Column(type="date")
     */
    private $date_purchase;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Payment", inversedBy="payment")
     */
    private $payment;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="user")
     */
    private $user;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUserId(): ?int
    {
        return $this->user_id;
    }

    public function setUserId(int $user_id): self
    {
        $this->user_id = $user_id;

        return $this;
    }

    public function getPaymentId(): ?int
    {
        return $this->payment_id;
    }

    public function setPaymentId(int $payment_id): self
    {
        $this->payment_id = $payment_id;

        return $this;
    }

    public function getDatePurchase(): ?\DateTimeInterface
    {
        return $this->date_purchase;
    }

    public function setDatePurchase(\DateTimeInterface $date_purchase): self
    {
        $this->date_purchase = $date_purchase;

        return $this;
    }
}

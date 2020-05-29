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
     * @ORM\Column(type="date")
     */
    private $date_purchase;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Payment", inversedBy="payment")
     */
    private $payment;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="payment")
     */
    private $user;

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getPayment()
    {
        return $this->payment;
    }

    /**
     * @param mixed $payment
     */
    public function setPayment($payment): void
    {
        $this->payment = $payment;
    }

    /**
     * @return mixed
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param mixed $user
     */
    public function setUser($user): void
    {
        $this->user = $user;
    }

    /**
     * @return mixed
     */
    public function getDatePurchase()
    {
        return $this->date_purchase;
    }

    /**
     * @param mixed $date_purchase
     */
    public function setDatePurchase($date_purchase): void
    {
        $this->date_purchase = $date_purchase;
    }
}

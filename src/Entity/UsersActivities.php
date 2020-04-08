<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UsersActivitiesRepository")
 */
class UsersActivities
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="activity")
     */
    private $user;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Activities", inversedBy="activity")
     */
    private $activity;

    public function getId(): ?int
    {
        return $this->id;
    }
}

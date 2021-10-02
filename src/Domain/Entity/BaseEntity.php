<?php

namespace App\Domain\Entity;

use DateTime;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class BaseEntity
 * @package App\Domain\BaseEntity
 */
abstract class BaseEntity
{
    /**
     * @var int
     */
    #[ORM\Column(type: "integer", unique: true, nullable: false)]
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: "AUTO")]
    protected int $id;

    /**
     * @var DateTime $createdAt
     */
    #[ORM\Column(type: "datetime", nullable: true)]
    protected DateTime $createdAt;

    /**
     * @var DateTime $updatedAt
     */
    #[ORM\Column(type: "datetime", nullable: true)]
    protected DateTime $updatedAt;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return DateTime|null
     */
    public function getCreatedAt(): ?DateTime
    {
        return $this->createdAt;
    }

    /**
     * @return DateTime|null
     */
    public function getUpdatedAt(): ?DateTime
    {
        return $this->updatedAt;
    }

    /**
     * Gets triggered only on insert
     */
    #[ORM\PrePersist]
    public function onPrePersist()
    {
        $this->createdAt = new DateTime("now");
        $this->updatedAt = new DateTime("now");
    }

    /**
     * Gets triggered every time on update
     */
    #[ORM\PreUpdate]
    public function onPreUpdate()
    {
        $this->updatedAt = new DateTime("now");
    }
}

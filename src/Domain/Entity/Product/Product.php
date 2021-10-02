<?php

namespace App\Domain\Entity\Product;

use App\Domain\Entity\BaseEntity;
use App\Infrastructure\Repository\Product\ProductRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class ProductController
 * @package App\Controller
 * @author Nasir Aliyev <nasir@aliyev.email>
 */
#[ORM\Entity(repositoryClass: ProductRepository::class, readOnly: false)]
class Product extends BaseEntity
{
    /**
     * @var string
     */
    #[ORM\Column(type: "string", length: 255)]
    #[Assert\NotBlank]
    #[Assert\Length(min: 3)]
    private string $title;

    /**
     * @var string
     */
    #[ORM\Column(type: "text")]
    #[Assert\Length(min: 3)]
    private string $description;

    /**
     * @var float
     */
    #[ORM\Column(type: "decimal", precision: 6, scale: 2)]
    #[Assert\Length(max: 10000)]
    private float $price;

    /**
     * @return string|null
     */
    public function getTitle(): ?string
    {
        return $this->title;
    }

    /**
     * @param string $title
     * @return $this
     */
    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    /**
     * @return float|null
     */
    public function getPrice(): ?float
    {
        return $this->price;
    }

    /**
     * @param float $price
     * @return $this
     */
    public function setPrice(float $price): self
    {
        $this->price = $price;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getDescription(): ?string
    {
        return $this->description;
    }

    /**
     * @param string $description
     * @return $this
     */
    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }
}

<?php

namespace App\Entity;

use App\Repository\AttributeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=AttributeRepository::class)
 */
class Attribute
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
	 * @Assert\NotBlank(message="You should type Attribute name")
	 * @Assert\Length(min=3, max=256, minMessage="Length must greater then 3 chars", maxMessage="Length must lower then 255 chars")
	 *
     * @ORM\Column(type="string", length=255, unique=true)
     */
    private $name;

    /**
     * @ORM\Column(type="integer", options={"default": "0"})
     */
    private $sortOrder;

    /**
     * @ORM\ManyToMany(targetEntity=Product::class, mappedBy="attribute", cascade={"persist"})
     */
    private $products;

    /**
     * @ORM\OneToMany(targetEntity=AttributeValue::class, mappedBy="attribute", cascade={"persist"})
     */
    private $attributeValues;

    public function __construct()
    {
        $this->products = new ArrayCollection();
        $this->attributeValues = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getSortOrder(): ?int
    {
        return $this->sortOrder;
    }

    public function setSortOrder(int $sortOrder): self
    {
        $this->sortOrder = $sortOrder;

        return $this;
    }

    /**
     * @return Collection|Product[]
     */
    public function getProducts(): Collection
    {
        return $this->products;
    }

    public function addProduct(Product $product): self
    {
        if (!$this->products->contains($product)) {
            $this->products[] = $product;
            $product->addAttribute($this);
        }

        return $this;
    }

    /**
     * @return Collection|AttributeValue[]
     */
    public function getAttributeValues(): Collection
    {
        return $this->attributeValues;
    }

    public function addAttributeValue(AttributeValue $attributeValue): self
    {
        if (!$this->attributeValues->contains($attributeValue)) {
            $this->attributeValues[] = $attributeValue;
            $attributeValue->setAttribute($this);
        }

        return $this;
    }
}

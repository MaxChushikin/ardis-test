<?php

namespace App\Entity;

use App\Repository\AttributeValueRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=AttributeValueRepository::class)
 */
class AttributeValue
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
	 * @Assert\NotBlank(message="You should type Attribte value")
	 * @Assert\Length(min=3, max=256, minMessage="Length must greater then 3 chars", maxMessage="Length must lower then 255 chars")
	 *
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\ManyToOne(targetEntity=Product::class, inversedBy="attributeValue", cascade={"persist"})
     */
    private $product;

    /**
     * @ORM\ManyToOne(targetEntity=Attribute::class, inversedBy="attributeValues", cascade={"persist"})
     */
    private $attribute;


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

    public function getProduct(): ?Product
    {
        return $this->product;
    }

    public function setProduct(?Product $product): self
    {
        $this->product = $product;

        return $this;
    }

    public function getAttribute(): ?Attribute
    {
        return $this->attribute;
    }

    public function setAttribute(?Attribute $attribute): self
    {
        $this->attribute = $attribute;

        return $this;
    }
}

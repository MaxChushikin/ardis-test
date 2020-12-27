<?php

	namespace App\Entity;

	use App\Repository\ProductRepository;
	use Doctrine\Common\Collections\ArrayCollection;
	use Doctrine\Common\Collections\Collection;
	use Doctrine\ORM\Mapping as ORM;
	use Gedmo\Mapping\Annotation as Gedmo;
	use Symfony\Component\Validator\Constraints as Assert;

	/**
	 * @ORM\Entity(repositoryClass=ProductRepository::class)
	 */
	class Product
	{
		/**
		 * @ORM\Id
		 * @ORM\GeneratedValue
		 * @ORM\Column(type="integer")
		 */
		private $id;

		/**
		 * @Assert\NotBlank(message="You should type product Name")
		 * @Assert\Length(min=3, max=256, minMessage="Length must greater then 3 chars", maxMessage="Length must lower then 255 chars")
		 *
		 * @ORM\Column(type="string", length=255)
		 */
		private $name;

		/**
		 * @ORM\Column(type="string", length=255)
		 * @Gedmo\Slug(fields={"name"})
		 */
		private $slug;

		/**
		 * @Assert\NotBlank(message="You should type product Price")
		 * @Assert\Positive(message="Price must be greater then 0")
		 *
		 * @ORM\Column(type="float")
		 */
		private $price;

		/**
		 * @var \DateTime $createdAt
		 *
		 * @Gedmo\Timestampable(on="create")
		 * @ORM\Column(type="datetime")
		 */
		private $createdAt;

		/**
		 * @var \DateTime $updatedAt
		 *
		 * @Gedmo\Timestampable(on="update")
		 * @ORM\Column(type="datetime")
		 */
		private $updatedAt;

		/**
		 * @ORM\OneToMany(targetEntity=AttributeValue::class, mappedBy="product", cascade={"all"})
		 */
		private $attributeValue;

		/**
		 * @ORM\ManyToMany(targetEntity=Attribute::class, inversedBy="products", cascade={"all"})
		 */
		private $attribute;

		public function __construct ()
		{
			$this->attributeValue = new ArrayCollection();
			$this->attribute = new ArrayCollection();
		}

		public function getId (): ?int
		{
			return $this->id;
		}

		public function getName (): ?string
		{
			return $this->name;
		}

		public function setName (?string $name): self
		{
			$this->name = $name;

			return $this;
		}

		public function getPrice (): ?float
		{
			return $this->price;
		}

		public function setPrice (?float $price): self
		{
			$this->price = $price;

			return $this;
		}

		public function getSlug (): ?string
		{
			return $this->slug;
		}

		public function setSlug (string $slug): self
		{
			$this->slug = $slug;

			return $this;
		}


		public function getCreatedAt()
		{
			return $this->createdAt;
		}

		public function getUpdatedAt()
		{
			return $this->updatedAt;
		}

		public function setCreatedAt()
		{
			return $this->createdAt;
		}

		public function setUpdatedAt()
		{
			return $this->updatedAt;
		}

		/**
		 * @return Collection|AttributeValue[]
		 */
		public function getAttributeValue (): Collection
		{
			return $this->attributeValue;
		}

		public function addAttributeValue (AttributeValue $attributeValue): self
		{
			if (!$this->attributeValue->contains($attributeValue)) {
				$this->attributeValue[] = $attributeValue;
				$attributeValue->setProduct($this);
			}

			return $this;
		}

		public function removeAttributeValue (AttributeValue $attributeValue): self
		{
			if ($this->attributeValue->removeElement($attributeValue)) {
				// set the owning side to null (unless already changed)
				if ($attributeValue->getProduct() === $this) {
					$attributeValue->setProduct(NULL);
				}
			}

			return $this;
		}

		/**
		 * @return Collection|Attribute[]
		 */
		public function getAttribute (): Collection
		{
			return $this->attribute;
		}

		public function addAttribute (Attribute $attribute): self
		{
			if (!$this->attribute->contains($attribute)) {
				$this->attribute[] = $attribute;
			}

			return $this;
		}
	}

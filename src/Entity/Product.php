<?php

	namespace App\Entity;

	use App\Repository\ProductRepository;
	use Doctrine\Common\Collections\ArrayCollection;
	use Doctrine\Common\Collections\Collection;
	use Doctrine\ORM\Mapping as ORM;
	use Gedmo\Mapping\Annotation as Gedmo;
	use Gedmo\Timestampable\Traits\TimestampableEntity;

	/**
	 * @ORM\Entity(repositoryClass=ProductRepository::class)
	 */
	class Product
	{
		use TimestampableEntity;

		/**
		 * @ORM\Id
		 * @ORM\GeneratedValue
		 * @ORM\Column(type="integer")
		 */
		private $id;

		/**
		 * @ORM\Column(type="string", length=255)
		 */
		private $name;

		/**
		 * @ORM\Column(type="string", length=255)
		 * @Gedmo\Slug(fields={"name"})
		 */
		private $slug;

		/**
		 * @ORM\Column(type="float")
		 */
		private $price;

		/**
		 * @ORM\OneToMany(targetEntity=AttributeValue::class, mappedBy="product", cascade={"all"})
		 */
		private $attributeValue;

		/**
		 * @ORM\ManyToMany(targetEntity=Attribute::class, inversedBy="products")
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

		public function setName (string $name): self
		{
			$this->name = $name;

			return $this;
		}

		public function getPrice (): ?float
		{
			return $this->price;
		}

		public function setPrice (float $price): self
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

		public function removeAttribute (Attribute $attribute): self
		{
			$this->attribute->removeElement($attribute);

			return $this;
		}
	}

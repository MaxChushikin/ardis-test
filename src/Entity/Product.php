<?php

	namespace App\Entity;
                                 
                                 	use App\Repository\ProductRepository;
                                 	use Doctrine\Common\Collections\ArrayCollection;
                                 	use Doctrine\Common\Collections\Collection;
                                 	use Doctrine\ORM\Mapping as ORM;
                                 	use Gedmo\Mapping\Annotation as Gedmo;
                                 
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
                                 		 * @ORM\Column(type="datetime")
                                 		 */
                                 		private $createdAt;
                                 
                                 		/**
                                 		 * @ORM\Column(type="datetime")
                                 		 */
                                 		private $updatedAt;
                              
                                   /**
                                    * @ORM\OneToMany(targetEntity=AttributeValue::class, mappedBy="product")
                                    */
                                   private $attibuteValue;
            
                                   /**
                                    * @ORM\ManyToMany(targetEntity=Attribute::class, inversedBy="products")
                                    */
                                   private $Attribute;
                           
                                   public function __construct()
                                   {
                                       $this->attibuteValue = new ArrayCollection();
                                       $this->Attribute = new ArrayCollection();
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
                                 
                                 		public function getCreatedAt (): ?\DateTimeInterface
                                 		{
                                 			return $this->createdAt;
                                 		}
                                 
                                 		public function setCreatedAt (\DateTimeInterface $createdAt): self
                                 		{
                                 			$this->createdAt = $createdAt;
                                 
                                 			return $this;
                                 		}
                                 
                                 		public function getUpdatedAt (): ?\DateTimeInterface
                                 		{
                                 			return $this->updatedAt;
                                 		}
                                 
                                 		public function setUpdatedAt (\DateTimeInterface $updatedAt): self
                                 		{
                                 			$this->updatedAt = $updatedAt;
                                 
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
                                   public function getAttibuteValue(): Collection
                                   {
                                       return $this->attibuteValue;
                                   }
                  
                                   public function addAttibuteValue(AttributeValue $attibuteValue): self
                                   {
                                       if (!$this->attibuteValue->contains($attibuteValue)) {
                                           $this->attibuteValue[] = $attibuteValue;
                                           $attibuteValue->setProduct($this);
                                       }
                  
                                       return $this;
                                   }
               
                                   public function removeAttibuteValue(AttributeValue $attibuteValue): self
                                   {
                                       if ($this->attibuteValue->removeElement($attibuteValue)) {
                                           // set the owning side to null (unless already changed)
                                           if ($attibuteValue->getProduct() === $this) {
                                               $attibuteValue->setProduct(null);
                                           }
                                       }
               
                                       return $this;
                                   }
      
                                   /**
                                    * @return Collection|Attribute[]
                                    */
                                   public function getAttribute(): Collection
                                   {
                                       return $this->Attribute;
                                   }
   
                                   public function addAttribute(Attribute $attribute): self
                                   {
                                       if (!$this->Attribute->contains($attribute)) {
                                           $this->Attribute[] = $attribute;
                                       }
   
                                       return $this;
                                   }

                                   public function removeAttribute(Attribute $attribute): self
                                   {
                                       $this->Attribute->removeElement($attribute);

                                       return $this;
                                   }
                                 	}

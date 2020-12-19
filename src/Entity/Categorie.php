<?php

namespace App\Entity;

use App\Repository\CategorieRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=CategorieRepository::class)
 */
class Categorie
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;


    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nom;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\SousCategorie", mappedBy="categorie")
     */
    private $sousCategories;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Produit", mappedBy="categorie")
     */
    private $produits;



    /**
     * @ORM\Column(type="string", length=255)
     */
    private $description;

    /**
     *@ORM\Column(type="string")
     * @Assert\NotBlank(message="Please, upload the photo.")
     * @Assert\File(mimeTypes={ "image/png", "image/jpeg" })
     */
    private $image;

    /**
     * @ORM\Column(type="boolean")
     */
    private $important;


    public function __construct()
    {
        $this->sousCategories = new ArrayCollection();
        $this->produits = new ArrayCollection();
    }
    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * @return Collection|SousCategorie[]
     */
    public function getSousCategories(): Collection
    {
        return $this->sousCategories;
    }

    public function addSousCategorie(SousCategorie $sousCategories): self
    {

        if (!$this->sousCategories->contains($sousCategories)) {
            $this->sousCategories[] = $sousCategories;
            $sousCategories->setCategorie($this);
        }

        return $this;
    }

    public function removeSousCategorie(SousCategorie $sousCategories): self
    {
        if ($this->sousCategories->contains($sousCategories)) {
            $this->sousCategories->removeElement($sousCategories);
            // set the owning side to null (unless already changed)
            if ($sousCategories->getCategorie() === $this) {
                $sousCategories->setCategorie(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Produit[]
     */
    public function getProduits(): Collection
    {
        return $this->produits;
    }

    public function addProduit(Produit $produit): self
    {
        if (!$this->produits->contains($produit)) {
            $this->produits[] = $produit;
            $produit->setCategorie($this);
        }

        return $this;
    }

    public function removeProduit(Produit $produit): self
    {
        if ($this->produits->contains($produit)) {
            $this->produits->removeElement($produit);
            // set the owning side to null (unless already changed)
            if ($produit->getCategorie() === $this) {
                $produit->setCategorie(null);
            }
        }

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }
    public function __toString() {
        return $this->nom;
    }

    public function getimage()
    {
        return $this->image;
    }

    public function setimage($image)
    {
        $this->image = $image;

        return $this;
    }

    public function getimportant()
    {
        return $this->important;
    }

    public function setimportant($important)
    {
        $this->important = $important;

        return $this;
    }
}

<?php
class Cours
{
    private ?int $id_cours = null;
    private ?string $titre = null;
    private ?string $proprietaire = null;
    private ?int $prix = null;
    private ?string $description = null;
    private ?string $image = null;
    private ?int $category = null;
    private ?string $pdf = null;

    public function __construct(
        $id_cours = null,
        $titre,
        $proprietaire,
        $prix,
        $description,
        $image,
        $category,
        $pdf
    ) {
        $this->id_cours = $id_cours;
        $this->titre = $titre;
        $this->proprietaire = $proprietaire;
        $this->prix = $prix;
        $this->description = $description;
        $this->image = $image;
        $this->category = $category;
        $this->pdf = $pdf;
    }

    public function getIdCours()
    {
        return $this->id_cours;
    }

    public function getTitre()
    {
        return $this->titre;
    }

    public function setTitre($titre)
    {
        $this->titre = $titre;
        return $this;
    }

    public function getProprietaire()
    {
        return $this->proprietaire;
    }

    public function setProprietaire($proprietaire)
    {
        $this->proprietaire = $proprietaire;
        return $this;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function setDescription($description)
    {
        $this->description = $description;
        return $this;
    }

    public function getPrix()
    {
        return $this->prix;
    }

    public function setPrix($prix)
    {
        $this->prix = $prix;
        return $this;
    }

    public function getImage()
    {
        return $this->image;
    }

    public function setImage($image)
    {
        $this->image = $image;
        return $this;
    }

    public function getCategory()
    {
        return $this->category;
    }

    public function setCategory($category)
    {
        $this->category = $category;
        return $this;
    }

    public function getPdf()
    {
        return $this->pdf;
    }

    public function setPdf($image)
    {
        $this->image = $pdf;
        return $this;
    }
}
?>

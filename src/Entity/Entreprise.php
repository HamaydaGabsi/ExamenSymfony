<?php

namespace App\Entity;

use App\Repository\EntrepriseRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EntrepriseRepository::class)]
class Entreprise
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 60, nullable: true)]
    private $Designation;

    #[ORM\OneToMany(mappedBy: 'Entreprise', targetEntity: PFE::class)]
    private $pFEs;

    public function __construct()
    {
        $this->pFEs = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDesignation(): ?string
    {
        return $this->Designation;
    }

    public function setDesignation(?string $Designation): self
    {
        $this->Designation = $Designation;

        return $this;
    }
    public function __toString()
    {
        return $this->Designation;
    }

    /**
     * @return Collection<int, PFE>
     */
    public function getPFEs(): Collection
    {
        return $this->pFEs;
    }

    public function addPFE(PFE $pFE): self
    {
        if (!$this->pFEs->contains($pFE)) {
            $this->pFEs[] = $pFE;
            $pFE->setEntreprise($this);
        }

        return $this;
    }

    public function removePFE(PFE $pFE): self
    {
        if ($this->pFEs->removeElement($pFE)) {
            // set the owning side to null (unless already changed)
            if ($pFE->getEntreprise() === $this) {
                $pFE->setEntreprise(null);
            }
        }

        return $this;
    }
}

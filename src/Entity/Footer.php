<?php

namespace App\Entity;

use App\Repository\FooterRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: FooterRepository::class)]
class Footer
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $ContactTitle = null;

    #[ORM\Column(length: 255)]
    private ?string $ContactContain = null;

    #[ORM\Column(length: 255)]
    private ?string $Hourly = null;

    #[ORM\Column(length: 255)]
    private ?string $logo = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getContactTitle(): ?string
    {
        return $this->ContactTitle;
    }

    public function setContactTitle(string $ContactTitle): static
    {
        $this->ContactTitle = $ContactTitle;

        return $this;
    }

    public function getContactContain(): ?string
    {
        return $this->ContactContain;
    }

    public function setContactContain(string $ContactContain): static
    {
        $this->ContactContain = $ContactContain;

        return $this;
    }

    public function getHourly(): ?string
    {
        return $this->Hourly;
    }

    public function setHourly(string $Hourly): static
    {
        $this->Hourly = $Hourly;

        return $this;
    }

    public function getLogo(): ?string
    {
        return $this->logo;
    }

    public function setLogo(string $logo): static
    {
        $this->logo = $logo;

        return $this;
    }


}

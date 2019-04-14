<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PermissionRepository")
 */
class Permission
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="boolean")
     */
    private $criar;

    /**
     * @ORM\Column(type="boolean")
     */
    private $ler;

    /**
     * @ORM\Column(type="boolean")
     */
    private $editar;

    /**
     * @ORM\Column(type="boolean")
     */
    private $apagar;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="permissions")
     * @ORM\JoinColumn(nullable=false)
     */
    private $username;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Module", inversedBy="permissions")
     * @ORM\JoinColumn(nullable=false)
     */
    private $module;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCriar(): ?bool
    {
        return $this->criar;
    }

    public function setCriar(bool $criar): self
    {
        $this->criar = $criar;

        return $this;
    }

    public function getLer(): ?bool
    {
        return $this->ler;
    }

    public function setLer(bool $ler): self
    {
        $this->ler = $ler;

        return $this;
    }

    public function getEditar(): ?bool
    {
        return $this->editar;
    }

    public function setEditar(bool $editar): self
    {
        $this->editar = $editar;

        return $this;
    }

    public function getApagar(): ?bool
    {
        return $this->apagar;
    }

    public function setApagar(bool $apagar): self
    {
        $this->apagar = $apagar;

        return $this;
    }

    public function getUsername(): ?User
    {
        return $this->username;
    }

    public function setUsername(?User $username): self
    {
        $this->username = $username;

        return $this;
    }

    public function getModule(): ?Module
    {
        return $this->module;
    }

    public function setModule(?Module $module): self
    {
        $this->module = $module;

        return $this;
    }
}

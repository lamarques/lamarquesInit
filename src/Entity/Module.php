<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ModuleRepository")
 */
class Module
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
    private $name;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $menuName;


    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $controller;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $action;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Permission", mappedBy="module", orphanRemoval=true)
     */
    private $permissions;

    public function __construct()
    {
        $this->permissions = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return Collection|Permission[]
     */
    public function getPermissions(): Collection
    {
        return $this->permissions;
    }

    public function addPermission(Permission $permission): self
    {
        if (!$this->permissions->contains($permission)) {
            $this->permissions[] = $permission;
            $permission->setModule($this);
        }

        return $this;
    }

    /**
     * @return mixed
     */
    public function getMenuName()
    {
        return $this->menuName;
    }

    /**
     * @param mixed $menuName
     * @return Module
     */
    public function setMenuName($menuName)
    {
        $this->menuName = $menuName;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getController()
    {
        return $this->controller;
    }

    /**
     * @param mixed $controller
     * @return Module
     */
    public function setController($controller)
    {
        $this->controller = $controller;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getAction()
    {
        return $this->action;
    }

    /**
     * @param mixed $action
     * @return Module
     */
    public function setAction($action)
    {
        $this->action = $action;
        return $this;
    }



    public function removePermission(Permission $permission): self
    {
        if ($this->permissions->contains($permission)) {
            $this->permissions->removeElement($permission);
            // set the owning side to null (unless already changed)
            if ($permission->getModule() === $this) {
                $permission->setModule(null);
            }
        }

        return $this;
    }
}

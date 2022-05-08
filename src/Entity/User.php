<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 *
 * @UniqueEntity(fields="userMail", message="L'email est déjà utilisé")
 * @UniqueEntity(fields="userPseudo", message="Le pseudo est déjà utilisé")
 */
class User implements UserInterface
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=180, unique=true)
     */
    private $userMail;

    /**
     * @ORM\Column(type="json")
     */
    private $roles = [];

    /**
     * @var string The hashed password
     * @ORM\Column(type="string")
     */
    private $password;

    /**
     * Utilisé lors de la modification de mot de passe
     * @var string The hashed password
     * @ORM\Column(type="string")
     */
    private $oldPassword;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $userName;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $userFirstName;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $userSurname;

    /**
     * @ORM\Column(type="string", length=255, unique=true)
     */
    private $userPseudo;

    /**
     * @ORM\Column(type="string", length=20)
     */
    private $userTel;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Role")
     * @ORM\JoinColumn(nullable=true)
     */
    private $role;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Adress", mappedBy="adressUsers")
     */
    private $userAdresses;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Clients", inversedBy="user", cascade={"persist", "remove"})
     * @ORM\JoinColumn(name="client_id", referencedColumnName="id")
     */
    private $clientAccount;

    public function __construct()
    {
        $this->userAdresses = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUserMail(): ?string
    {
        return $this->userMail;
    }

    public function setUserMail(string $userMail): self
    {
        $this->userMail = $userMail;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUsername(): string
    {
        return (string) $this->userMail;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    public function addRoles(string $role){
        $this->roles[] = $role;
    }

    /**
     * @see UserInterface
     */
    public function getPassword(): string
    {
        return (string) $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;
        $this->oldPassword = $this->password;
        return $this;
    }


    public function getOldPassword(): string
    {
        return (string) $this->oldPassword;
    }

    public function setOldPassword(string $password): self
    {
        $this->oldPassword = $this->password;
        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getSalt()
    {
        // not needed when using the "bcrypt" algorithm in security.yaml
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    /**
     * @return mixed
     */
    public function getUserFirstName()
    {
        return $this->userFirstName;
    }

    public function setUserFirstName(string $userFirstName): self
    {
        $this->userFirstName = $userFirstName;

        return $this;
    }

    public function getUserSurname(): ?string
    {
        return $this->userSurname;
    }

    public function setUserSurname(string $userSurname): self
    {
        $this->userSurname = $userSurname;

        return $this;
    }

    public function getUserPseudo(): ?string
    {
        return $this->userPseudo;
    }

    public function setUserPseudo(string $userPseudo): self
    {
        $this->userPseudo = $userPseudo;

        return $this;
    }

    public function getUserTel(): ?string
    {
        return $this->userTel;
    }

    public function setUserTel(string $userTel): self
    {
        $this->userTel = $userTel;

        return $this;
    }

    public function getRole(): ?Role
    {
        return $this->role;
    }

    public function setRole(?Role $role): self
    {
        $this->role = $role;

        return $this;
    }

    /**
     * @return Collection|Adress[]
     */
    public function getUserAdresses(): Collection
    {
        return $this->userAdresses;
    }

    public function addUserAdress(Adress $userAdress): self
    {
        if (!$this->userAdresses->contains($userAdress)) {
            $this->userAdresses[] = $userAdress;
            $userAdress->addAdressUser($this);
        }

        return $this;
    }

    public function removeUserAdress(Adress $userAdress): self
    {
        if ($this->userAdresses->contains($userAdress)) {
            $this->userAdresses->removeElement($userAdress);
            $userAdress->removeAdressUser($this);
        }

        return $this;
    }

    public function removeAllUserAdress(){
        $this->userAdresses = new ArrayCollection();
    }

    public function getClientAccount(): ?Clients
    {
        return $this->clientAccount;
    }

    public function setClientAccount(?Clients $clientAccount): self
    {
        $this->clientAccount = $clientAccount;

        return $this;
    }
}

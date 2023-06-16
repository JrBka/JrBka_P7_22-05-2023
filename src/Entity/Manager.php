<?php

namespace App\Entity;

use App\Repository\ManagerRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: ManagerRepository::class)]
#[ORM\EntityListeners(['App\EntityListener\ManagerListener'])]
#[UniqueEntity('email')]
class Manager implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 180, unique: true)]
    #[Assert\NotBlank(normalizer: 'trim')]
    #[Assert\Email]
    private ?string $email = null;

    #[ORM\Column]
    #[Assert\NotBlank(normalizer: 'trim')]
    private array $roles = ['ROLE_SUPER_ADMIN'];

    #[ORM\Column]
    private ?string $password = 'apiPassword';

    #[Assert\NotBlank(normalizer: 'trim')]
    #[Assert\Regex(['pattern' => '/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?([^\w\s]|[_])).{8,}$/',
        'match' => true,
        'message' => 'The password must contain at least eight characters, including upper and lower case letters, a number and a symbol'
    ])]
    private ?string $plainPassword = null;

    #[ORM\OneToMany(mappedBy: 'manager', targetEntity: Client::class, orphanRemoval: true)]
    private Collection $client;

    #[ORM\OneToMany(mappedBy: 'manager', targetEntity: Mobile::class, orphanRemoval: true)]
    private Collection $mobile;

    public function __construct()
    {
        $this->client = new ArrayCollection();
        $this->mobile = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->email;
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

    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials():void
    {
        // If you store any temporary, sensitive data on the user, clear it here
        $this->plainPassword = null;
    }

    public function getPlainPassword(): ?string
    {
        return $this->plainPassword;
    }

    public function setPlainPassword(?string $plainPassword): self
    {
        $this->plainPassword = $plainPassword;
        return $this;
    }

    /**
     * @return Collection<int, Client>
     */
    public function getClient(): Collection
    {
        return $this->client;
    }

    public function addClient(Client $client): static
    {
        if (!$this->client->contains($client)) {
            $this->client->add($client);
            $client->setManager($this);
        }

        return $this;
    }

    public function removeClient(Client $client): static
    {
        if ($this->client->removeElement($client)) {
            // set the owning side to null (unless already changed)
            if ($client->getManager() === $this) {
                $client->setManager(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Mobile>
     */
    public function getMobile(): Collection
    {
        return $this->mobile;
    }

    public function addMobile(Mobile $mobile): static
    {
        if (!$this->mobile->contains($mobile)) {
            $this->mobile->add($mobile);
            $mobile->setManager($this);
        }

        return $this;
    }

    public function removeMobile(Mobile $mobile): static
    {
        if ($this->mobile->removeElement($mobile)) {
            // set the owning side to null (unless already changed)
            if ($mobile->getManager() === $this) {
                $mobile->setManager(null);
            }
        }

        return $this;
    }
}

<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Delete;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Patch;
use ApiPlatform\Metadata\Post;
use ApiPlatform\Metadata\Put;
use App\Repository\ClientRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: ClientRepository::class)]
#[ApiResource(
    operations: [
        new Get(normalizationContext: ['groups'=> ['clientDetails']]),
        new GetCollection(paginationItemsPerPage: 10, paginationClientItemsPerPage: true, normalizationContext: ['groups'=> ['clientsList']]),
        new Patch(normalizationContext: ['groups'=> ['clientAuthorisation']], denormalizationContext: ['groups'=> ['clientAuthorisation']], validationContext: ['groups'=>['clientAuthorisation']]),
        new Post(normalizationContext: ['groups'=> ['clientDetails']], denormalizationContext: ['groups'=> ['clientDetailsForPost']]),
        new Put(normalizationContext: ['groups'=> ['clientDetails']], denormalizationContext: ['groups'=> ['clientDetailsForPut']], validationContext: ['groups'=>['contextValidationForPut']],),
        new Delete()
    ],
    security: "is_granted('ROLE_SUPER_ADMIN')"
)]
#[UniqueEntity('email')]
#[ORM\EntityListeners(['App\EntityListener\ClientListener'])]
class Client implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['clientDetails','clientsList'])]
    private ?int $id = null;

    #[ORM\Column(length: 180, unique: true)]
    #[Assert\Email(groups: ['contextValidationForPut'])]
    #[Assert\NotBlank(normalizer: 'trim',groups: ['contextValidationForPut'])]
    #[Groups(['clientDetails','clientDetailsForPut','clientDetailsForPost','clientsList'])]
    private ?string $email = null;

    #[ORM\Column]
    #[Assert\NotBlank(normalizer: 'trim',groups: ['contextValidationForPut'])]
    #[Groups(['clientDetails','clientDetailsForPut'])]
    private array $roles = ['ROLE_ADMIN'];

    #[ORM\Column]
    private ?string $password = 'apiPassword';

    #[Assert\NotBlank(normalizer: 'trim')]
    #[Assert\Regex(['pattern' => '/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?([^\w\s]|[_])).{8,}$/',
        'match' => true,
        'message' => 'The password must contain at least eight characters, including upper and lower case letters, a number and a symbol'
    ])]
    #[Groups(['clientDetails','clientDetailsForPost','clientDetailsForPut'])]
    private ?string $plainPassword = null;

    #[ORM\Column]
    #[Groups(['clientDetails'])]
    private \DateTimeImmutable $createdAt;

    #[ORM\OneToMany(mappedBy: 'client', targetEntity: User::class, orphanRemoval: true)]
    #[Groups(['clientDetails'])]
    private Collection $users;

    #[ORM\Column()]
    #[Groups(['clientAuthorisation','clientDetails','clientsList', 'contextValidationForPut'])]
    private \DateTimeImmutable $authorizedUntil ;

    public function __construct()
    {
        $this->createdAt = new \DateTimeImmutable();
        $this->users = new ArrayCollection();
        $this->authorizedUntil = new \DateTimeImmutable('+30days');
    }

    /**
     * @see UserInterface
     */
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

    public function getUsername(): string {
        return $this->getUserIdentifier();
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_ADMIN';

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
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeImmutable $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * @return Collection<int, User>
     */
    public function getUsers(): Collection
    {
        return $this->users;
    }

    public function addUser(User $user): self
    {
        if (!$this->users->contains($user)) {
            $this->users->add($user);
            $user->setClient($this);
        }

        return $this;
    }

    public function removeUser(User $user): self
    {
        if ($this->users->removeElement($user)) {
            // set the owning side to null (unless already changed)
            if ($user->getClient() === $this) {
                $user->setClient(null);
            }
        }

        return $this;
    }

    public function getAuthorizedUntil(): ?\DateTimeInterface
    {
        return $this->authorizedUntil;
    }

    public function setAuthorizedUntil(\DateTimeImmutable $authorizedUntil): self
    {
        $this->authorizedUntil = $authorizedUntil;

        return $this;
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
}

<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Delete;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Patch;
use ApiPlatform\Metadata\Post;
use ApiPlatform\Metadata\Put;
use App\Repository\MobileRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: MobileRepository::class)]
#[ORM\EntityListeners(['App\EntityListener\MobileListener'])]
#[ApiResource(
    operations: [
        new Get(normalizationContext: ['groups' => ['mobileDetails']], security: "is_granted('ROLE_USER') or is_granted('ROLE_ADMIN')"),
        new GetCollection(paginationItemsPerPage: 10, paginationClientItemsPerPage: true, normalizationContext: ['groups' => ['mobilesList']], security: "is_granted('ROLE_USER') or is_granted('ROLE_ADMIN')"),
        new Post(normalizationContext: ['groups'=> ['mobileDetails']], denormalizationContext: ['groups' => ['mobileDetailsForPostPatchPut']], security: "is_granted('ROLE_SUPER_ADMIN')"),
        new Patch(normalizationContext: ['groups'=> ['mobileDetails']], denormalizationContext: ['groups' => ['mobileDetailsForPostPatchPut']], security: "is_granted('ROLE_SUPER_ADMIN')"),
        new Put( normalizationContext: ['groups'=> ['mobileDetails']], denormalizationContext: ['groups' => ['mobileDetailsForPostPatchPut']], security: "is_granted('ROLE_SUPER_ADMIN')"),
        new Delete(security: "is_granted('ROLE_SUPER_ADMIN')")
    ]
)]
#[UniqueEntity('name')]
class Mobile
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['mobileDetails','mobilesList'])]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(normalizer: 'trim')]
    #[Groups(['mobileDetails','mobilesList','mobileDetailsForPostPatchPut'])]
    private ?string $name = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(normalizer: 'trim')]
    #[Groups(['mobileDetails','mobilesList','mobileDetailsForPostPatchPut'])]
    private ?string $brand = null;

    #[ORM\Column]
    #[Assert\NotBlank(normalizer: 'trim')]
    #[Groups(['mobileDetails','mobileDetailsForPostPatchPut'])]
    private ?string $price = null;

    #[ORM\Column]
    #[Groups(['mobileDetails'])]
    private \DateTimeImmutable $createdAt;

    #[ORM\Column(nullable: true)]
    #[Groups(['mobileDetails'])]
    private ?\DateTimeImmutable $updatedAt = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(normalizer: 'trim')]
    #[Groups(['mobileDetails','mobileDetailsForPostPatchPut'])]
    private ?string $storage = null;

    #[ORM\Column(type: Types::TEXT)]
    #[Assert\NotBlank(normalizer: 'trim')]
    #[Groups(['mobileDetails','mobileDetailsForPostPatchPut'])]
    private ?string $description = null;

    public function __construct()
    {
        $this->createdAt = new \DateTimeImmutable();
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

    public function getBrand(): ?string
    {
        return $this->brand;
    }

    public function setBrand(string $brand): self
    {
        $this->brand = $brand;

        return $this;
    }

    public function getPrice(): ?string
    {
        return $this->price;
    }

    public function setPrice(string $price): self
    {
        $this->price = $price;

        return $this;
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

    public function getUpdatedAt(): ?\DateTimeImmutable
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(\DateTimeImmutable $updatedAt): self
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    public function getStorage(): ?string
    {
        return $this->storage;
    }

    public function setStorage(string $storage): self
    {
        $this->storage = $storage;

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
}

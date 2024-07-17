<?php

namespace App\Entity;

use App\Repository\TicketRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

use ApiPlatform\Metadata\ApiResource;

use Symfony\Component\Serializer\Attribute\Groups;

use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\Post;
use ApiPlatform\Metadata\Patch;

use ApiPlatform\Metadata\ApiFilter;
use ApiPlatform\Doctrine\Orm\Filter\DateFilter;

#[ORM\Entity(repositoryClass: TicketRepository::class)]
#[ORM\Table(name: '`ticket`')]
#[ApiFilter(DateFilter::class, properties: ['ordered_at' => DateFilter::EXCLUDE_NULL])]
#[ApiResource(
    operations: [
        new GetCollection(security: "is_granted('ROLE_USER')"),
        new Get(security: "is_granted('ROLE_USER')"),
        new Post(security: "is_granted('ROLE_WAITER')"),
        new Patch(security: "is_granted('ROLE_WAITER') or is_granted('ROLE_BARTENDER')"),
    ],
    normalizationContext: ['groups' => ['read']],
    denormalizationContext: ['groups' => ['write']]
)]
class Ticket
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups('read')]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    #[Groups(['read', 'write'])]
    private ?\DateTimeInterface $ordered_at = null;

    /**
     * @var Collection<int, Beverage>
     */
    #[ORM\ManyToMany(targetEntity: Beverage::class)]
    #[Groups(['read', 'write'])]
    private Collection $drinks;

    #[ORM\Column]
    #[Groups(['read', 'write'])]
    private ?int $table_nb = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    #[Groups(['read', 'write'])]
    private ?User $waiter = null;

    #[ORM\ManyToOne]
    #[Groups(['read', 'write'])]
    private ?User $bartender = null;

    #[ORM\Column(length: 100)]
    #[Groups(['read', 'write'])]
    private ?string $status = null;

    public function __construct()
    {
        $this->drinks = new ArrayCollection();
        $this->ordered_at = new \DateTime();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getOrderedAt(): ?\DateTimeInterface
    {
        return $this->ordered_at;
    }

    public function setOrderedAt(\DateTimeInterface $ordered_at): static
    {
        $this->ordered_at = $ordered_at;

        return $this;
    }

    /**
     * @return Collection<int, Beverage>
     */
    public function getDrinks(): Collection
    {
        return $this->drinks;
    }

    public function addDrink(Beverage $drink): static
    {
        if (!$this->drinks->contains($drink)) {
            $this->drinks->add($drink);
        }

        return $this;
    }

    public function removeDrink(Beverage $drink): static
    {
        $this->drinks->removeElement($drink);

        return $this;
    }

    public function getTableNb(): ?int
    {
        return $this->table_nb;
    }

    public function setTableNb(int $table_nb): static
    {
        $this->table_nb = $table_nb;

        return $this;
    }

    public function getWaiter(): ?User
    {
        return $this->waiter;
    }

    public function setWaiter(?User $waiter): static
    {
        $this->waiter = $waiter;

        return $this;
    }

    public function getBartender(): ?User
    {
        return $this->bartender;
    }

    public function setBartender(?User $bartender): static
    {
        $this->bartender = $bartender;

        return $this;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(string $status): static
    {
        $this->status = $status;

        return $this;
    }
}

<?php

namespace App\Entity;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation\Slug;
use App\Repository\VinylMixRepository;
use Gedmo\Timestampable\Traits\TimestampableEntity;

#[ORM\Entity(repositoryClass: VinylMixRepository::class)]
class VinylMix
{
    use TimestampableEntity;

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $title = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $description = null;

    #[ORM\Column]
    private ?int $trackCount = null;

    #[ORM\Column(length: 255)]
    private ?string $genre = null;


    #[ORM\Column]
    private int $votes = 0;

    #[ORM\Column(length: 100, unique: true)]
    #[Slug(fields: ['title'])]
    private ?string $slug = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): static
    {
        $this->title = $title;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getTrackCount(): ?int
    {
        return $this->trackCount;
    }

    public function setTrackCount(int $trackCount): static
    {
        $this->trackCount = $trackCount;

        return $this;
    }

    public function getGenre(): ?string
    {
        return $this->genre;
    }

    public function setGenre(string $genre): static
    {
        $this->genre = $genre;

        return $this;
    }

    public function getVotes(): ?int
    {
        return $this->votes;
    }

    public function setVotes(int $votes): static
    {
        $this->votes = $votes;

        return $this;
    }
    public function getVotesString(): string
    {
        $prefix = ($this->votes === 0) ? '' : (($this->votes >= 0) ? '+' : '-');
        return sprintf('%s %d', $prefix, abs($this->votes));
    }
    public function getImageUrl(int $width): string
    {
        return sprintf(
            'https://picsum.photos/id/%d/%d',
            ($this->getId() + 50) % 1000, // number between 0 and 1000, based on the id
            $width
        );
    }
    public function upvotes(): void
    {
        $this->votes++;
    }
    public function downvote(): void
    {
        $this->votes--;
    }

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(string $slug): static
    {
        $this->slug = $slug;

        return $this;
    }
}

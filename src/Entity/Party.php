<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PartyRepository")
 */
class Party
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="datetime")
     */
    private $date_started;

    /**
     * @ORM\Column(type="integer")
     */
    private $user_id;

    /**
     * @ORM\Column(type="integer")
     */
    private $nb_try;

    /**
     * @ORM\Column(type="text")
     */
    private $cards;

    /**
     * @ORM\Column(type="integer")
     */
    private $nb_cards;

    /**
     * @ORM\Column(type="integer")
     */
    private $state;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateStarted(): ?\DateTimeInterface
    {
        return $this->date_started;
    }

    public function setDateStarted(\DateTimeInterface $date_started): self
    {
        $this->date_started = $date_started;

        return $this;
    }

    public function getUserId(): ?int
    {
        return $this->user_id;
    }

    public function setUserId(int $user_id): self
    {
        $this->user_id = $user_id;

        return $this;
    }

    public function getNbTry(): ?int
    {
        return $this->nb_try;
    }

    public function setNbTry(int $nb_try): self
    {
        $this->nb_try = $nb_try;

        return $this;
    }

    public function getCards(): ?string
    {
        return $this->cards;
    }

    public function setCards(string $cards): self
    {
        $this->cards = $cards;

        return $this;
    }

    public function getNbCards(): ?int
    {
        return $this->nb_cards;
    }

    public function setNbCards(int $nb_cards): self
    {
        $this->nb_cards = $nb_cards;

        return $this;
    }
    public function getState(): ?int
    {
        return $this-> state;
    }

    public function setState(int $state): self
    {
        $this->state = $state;

        return $this;
    }
}

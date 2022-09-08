<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

#[ORM\Entity(repositoryClass: UserRepository::class)]
#[UniqueEntity(fields: ['email'], message: 'There is already an account with this email')]
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 180, unique: true)]
    private ?string $email = null;

    #[ORM\Column]
    private array $roles = [];

    /**
     * @var string The hashed password
     */
    #[ORM\Column]
    private ?string $password = null;

    #[ORM\Column(length: 255)]
    private ?string $username = null;

    #[ORM\OneToMany(mappedBy: 'user', targetEntity: ReservationDieteticien::class)]
    private Collection $reservationDieteticiens;

    #[ORM\OneToMany(mappedBy: 'user', targetEntity: ReservationCoach::class)]
    private Collection $reservationCoaches;

    #[ORM\OneToMany(mappedBy: 'user', targetEntity: Post::class)]
    private Collection $posts;

    #[ORM\OneToMany(mappedBy: 'user', targetEntity: Comment::class)]
    private Collection $comments;

    #[ORM\Column(type: 'boolean')]
    private $isVerified = false;

    public function __construct()
    {
        $this->reservationDieteticiens = new ArrayCollection();
        $this->reservationCoaches = new ArrayCollection();
        $this->posts = new ArrayCollection();
        $this->comments = new ArrayCollection();
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
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(string $username): self
    {
        $this->username = $username;

        return $this;
    }

    /**
     * @return Collection<int, ReservationDieteticien>
     */
    public function getReservationDieteticiens(): Collection
    {
        return $this->reservationDieteticiens;
    }

    public function addReservationDieteticien(ReservationDieteticien $reservationDieteticien): self
    {
        if (!$this->reservationDieteticiens->contains($reservationDieteticien)) {
            $this->reservationDieteticiens->add($reservationDieteticien);
            $reservationDieteticien->setUser($this);
        }

        return $this;
    }

    public function removeReservationDieteticien(ReservationDieteticien $reservationDieteticien): self
    {
        if ($this->reservationDieteticiens->removeElement($reservationDieteticien)) {
            // set the owning side to null (unless already changed)
            if ($reservationDieteticien->getUser() === $this) {
                $reservationDieteticien->setUser(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, ReservationCoach>
     */
    public function getReservationCoaches(): Collection
    {
        return $this->reservationCoaches;
    }

    public function addReservationCoach(ReservationCoach $reservationCoach): self
    {
        if (!$this->reservationCoaches->contains($reservationCoach)) {
            $this->reservationCoaches->add($reservationCoach);
            $reservationCoach->setUser($this);
        }

        return $this;
    }

    public function removeReservationCoach(ReservationCoach $reservationCoach): self
    {
        if ($this->reservationCoaches->removeElement($reservationCoach)) {
            // set the owning side to null (unless already changed)
            if ($reservationCoach->getUser() === $this) {
                $reservationCoach->setUser(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Post>
     */
    public function getPosts(): Collection
    {
        return $this->posts;
    }

    public function addPost(Post $post): self
    {
        if (!$this->posts->contains($post)) {
            $this->posts->add($post);
            $post->setUser($this);
        }

        return $this;
    }

    public function removePost(Post $post): self
    {
        if ($this->posts->removeElement($post)) {
            // set the owning side to null (unless already changed)
            if ($post->getUser() === $this) {
                $post->setUser(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Comment>
     */
    public function getComments(): Collection
    {
        return $this->comments;
    }

    public function addComment(Comment $comment): self
    {
        if (!$this->comments->contains($comment)) {
            $this->comments->add($comment);
            $comment->setUser($this);
        }

        return $this;
    }

    public function removeComment(Comment $comment): self
    {
        if ($this->comments->removeElement($comment)) {
            // set the owning side to null (unless already changed)
            if ($comment->getUser() === $this) {
                $comment->setUser(null);
            }
        }

        return $this;
    }

    public function isVerified(): bool
    {
        return $this->isVerified;
    }

    public function setIsVerified(bool $isVerified): self
    {
        $this->isVerified = $isVerified;

        return $this;
    }

    
}

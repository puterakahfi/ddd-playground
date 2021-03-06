<?php

namespace Leos\Domain\User\Model;

use Doctrine\Common\Collections\ArrayCollection;

use Leos\Domain\Wallet\Model\Wallet;
use Leos\Domain\User\ValueObject\UserId;
use Leos\Domain\Security\ValueObject\AuthUser;
use Leos\Domain\Security\ValueObject\EncodedPasswordInterface;

/**
 * Class User
 *
 * @package Leos\Domain\User\Model
 */
class User
{
    /**
     * @var UserId
     */
    private $uuid;

    /**
     * @var string
     */
    private $email;

    /**
     * @var AuthUser
     */
    private $auth;

    /**
     * @var Wallet[]|ArrayCollection
     */
    private $wallets;

    /**
     * @var \DateTime
     */
    private $createdAt;

    /**
     * @var null|\DateTime
     */
    private $updatedAt;

    public function __construct(UserId $userId, string $username, string $email, EncodedPasswordInterface $encodedPassword)
    {
        $this->uuid = $userId;
        $this->auth = new AuthUser($username, $encodedPassword);
        $this->email = $email;
        $this->wallets = new ArrayCollection();
        $this->createdAt = new \DateTime();
    }

    public function id(): UserId
    {
        return $this->uuid;
    }

    public function email(): string
    {
        return $this->email;
    }

    public function username(): string
    {
        return $this->auth->username();
    }

    public function auth(): AuthUser
    {
        return $this->auth;
    }


    public function createdAt(): \DateTime
    {
        return $this->createdAt;
    }

    public function updatedAt(): ?\DateTime
    {
        return $this->updatedAt;
    }


    public function realBalance(): int
    {
        $total = 0;

        foreach ($this->wallets as $wallet) {

            $total += $wallet->real()->amount();
        }

        return $total;
    }

    public function bonusBalance(): int
    {
        $total = 0;

        foreach ($this->wallets as $wallet) {

            $total += $wallet->bonus()->amount();
        }

        return $total;
    }
}

<?php

namespace Leos\Application\UseCase\User;

use Leos\Application\UseCase\User\Request\GetUser;

use Leos\Domain\User\Model\User;
use Leos\Domain\User\Exception\UserNotFoundException;
use Leos\Domain\User\Repository\UserRepositoryInterface;

/**
 * Class GetUserHandler
 *
 * @package Leos\Application\UseCase\User
 */
class GetUserHandler
{
    /**
     * @var UserRepositoryInterface
     */
    private $repository;

    /**
     * GetUserHandler constructor.
     * @param UserRepositoryInterface $repository
     */
    public function __construct(UserRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }
    
    /**
     * @param GetUser $request
     * @return User
     * @throws UserNotFoundException
     */
    public function handle(GetUser $request): User
    {
        $user = $this->repository->findOneById($request->uuid());

        if (!$user) {

            throw new UserNotFoundException();
        }

        return $user;
    }
}

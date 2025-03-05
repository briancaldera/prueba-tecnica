<?php

namespace App\Repositories;

use App\ValueObjects\Email;
use App\ValueObjects\Name;
use App\ValueObjects\Password;
use Db\Doctrine\DoctrineConnection;
use Db\Doctrine\DTO\UserDTO;
use Doctrine\DBAL\DriverManager;
use Doctrine\ORM\ORMSetup;
use Doctrine\ORM\EntityManager;
use App\Repositories\UserRepositoryInterface;
use App\Models\User;
use App\ValueObjects\UserId;


class DoctrineUserRepository implements UserRepositoryInterface
{
    public function save(User $user): void
    {
        $userDTO = new UserDTO(
            id: null,
            name: $user->name->name,
            email: $user->email->email,
            password: $user->password->hash,
            createdAt: $user->createdAt,
        );

        $em = $this->getEntityManager();

        try {
            $em->beginTransaction();
            $em->persist($userDTO);
            $em->flush();
            $em->commit();
            $user->setId(new UserId($userDTO->id));
        } catch (\Throwable $th) {
            $em->rollback();
            throw $th;
        }
    }

    public function findById(UserId $id): ?User
    {
        $em = $this->getEntityManager();
        $userDTO = $em->find(UserDTO::class, $id->id);

        $user = new User(
            id: new UserId($userDTO->id),
            name: new Name($userDTO->name),
            email: new Email($userDTO->email),
            password: Password::fromHash($userDTO->password),
            createdAt: $userDTO->createdAt,
        );

        return $user;
    }

    public function delete(UserId $id): void
    {
        $em = $this->getEntityManager();

        try {
            $em->beginTransaction();
            $em->remove($this->findById($id));
            $em->flush();
            $em->commit();
        } catch (\Throwable $th) {
            $em->rollback();
            throw $th;
        }
    }

    private function getEntityManager(): EntityManager
    {
        return DoctrineConnection::getEntityManager();
    }
}
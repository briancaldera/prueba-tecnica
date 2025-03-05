<?php

namespace App\Services;

use App\ValueObjects\Email;
use Db\Doctrine\DoctrineConnection;
use App\Services\EmailServiceInterface;

class EmailService implements EmailServiceInterface
{
    public function emailExists(Email $email): bool
    {
        $em = DoctrineConnection::getEntityManager();

        $query = $em->createQuery('SELECT COUNT(*) FROM Db\Doctrine\DTO\UserDTO WHERE email = ?1');
        $query->setParameter(1, $email->email);

        $result = $query->getSingleScalarResult();

        return $result > 0;
    }
}
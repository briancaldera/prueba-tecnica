<?php declare(strict_types=1);

use Db\Doctrine\DoctrineConnection;
use Doctrine\ORM\EntityManager;
use PHPUnit\Framework\TestCase;
use Doctrine\DBAL\Connection;

class DbTest extends TestCase {
    public function test_db_connection() {
        $em = DoctrineConnection::getEntityManager();


        $this->assertInstanceOf(EntityManager::class, $em);
        $this->assertInstanceOf(Connection::class, $em->getConnection());
    }
}
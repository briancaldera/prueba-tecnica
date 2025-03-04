<?php

namespace Db\Doctrine;

use Doctrine\DBAL\DriverManager;
use Doctrine\DBAL\Connection;
use Doctrine\ORM\ORMSetup;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Configuration;
use App\Utils\FileUtils;

final class DoctrineConnection
{
    private static ?Connection $instance = null;
    private static ?Configuration $config = null;

    public static function getConnection()
    {
        if (self::$instance === null || !self::$instance->isConnected()) {

            $config = ORMSetup::createAttributeMetadataConfiguration(
                paths: ['/var/www/html/db'],
                isDevMode: true,
            );

            self::$config = $config;

            $connectionsParams = [
                'driver' => 'pdo_mysql',
                'dbname' => 'prueba-tecnica-db',
                'user' => 'username',
                'password' => 'password',
                'host' => 'db',
            ];

            self::$instance = DriverManager::getConnection($connectionsParams, $config);
        }

        return self::$instance;
    }

    public static function getEntityManager(): EntityManager
    {
        return new EntityManager(self::getConnection(), self::$config);
    }
}

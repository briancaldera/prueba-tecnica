<?php

namespace Db\Doctrine\Utils;

use Db\Doctrine\DoctrineConnection;
use Doctrine\ORM\Query\ResultSetMapping;

final class TestUtils {
    public static function wipeTable(string $table): void {
        DoctrineConnection::getConnection()->delete($table);
    }
}
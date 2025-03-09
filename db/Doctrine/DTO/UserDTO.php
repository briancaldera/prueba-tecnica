<?php

namespace Db\Doctrine\DTO;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: 'users')]
final class UserDTO {
    function __construct(
        #[ORM\Id]
        #[ORM\Column(type:'integer')]
        #[ORM\GeneratedValue]
        public private(set) ?int $id,
        #[ORM\Column(type:'string')]
        public private(set) string $name,
        #[ORM\Column(type:'string', unique: true)]
        public private(set) string $email,
        #[ORM\Column(type:'string')]
        public private(set) string $password,
        #[ORM\Column(type: 'datetime_immutable')]
        public private(set) \DateTimeImmutable $createdAt,
    ) {
    }
}
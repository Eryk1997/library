<?php

declare(strict_types=1);

namespace App\Shared\Infrastructure\Doctrine\Type;

use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\Type;
use Symfony\Component\Uid\Uuid;

class UuidType extends Type
{
    public const NAME = 'uuid_mariadb';

    public function getSQLDeclaration(array $column, AbstractPlatform $platform): string
    {
        return 'UUID';
    }

    public function convertToDatabaseValue($value, AbstractPlatform $platform): ?string
    {
        if ($value === null || is_string($value)) {
            return $value;
        }

        if ($value instanceof Uuid) {
            return $value->toRfc4122();
        }

        throw new \InvalidArgumentException(sprintf('Expected Uuid or string, got %s', get_debug_type($value)));
    }

    public function convertToPHPValue($value, AbstractPlatform $platform): ?Uuid
    {
        if ($value === null || $value instanceof Uuid) {
            return $value;
        }

        if (is_string($value)) {
            return Uuid::fromRfc4122($value);
        }

        throw new \InvalidArgumentException(sprintf('Expected string or null, got %s', get_debug_type($value)));
    }

    public function getName(): string
    {
        return self::NAME;
    }

    public function requiresSQLCommentHint(AbstractPlatform $platform): bool
    {
        return true;
    }
}

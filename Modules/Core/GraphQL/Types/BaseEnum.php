<?php

namespace Modules\Core\GraphQL\Types;

use GraphQL\Type\Definition\NonNull;
use GraphQL\Type\Definition\NullableType;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\EnumType as GraphQLEnumType;
use Rebing\GraphQL\Support\Facades\GraphQL;

abstract class BaseEnum extends GraphQLEnumType
{
    public const NAME = 'BaseEnum';
    public const DESCRIPTION = '';

    abstract public function values(): array;

    public static function nonNullType(): NonNull|Type
    {
        return Type::nonNull(static::type());
    }

    public static function type(): Type|NullableType
    {
        return GraphQL::type(static::NAME);
    }

    public static function list(): Type
    {
        return Type::listOf(static::nonNullType());
    }

    public static function nonNullList(): NonNull|Type
    {
        return NonNullType::listOf(static::nonNullType());
    }

    public function attributes(): array
    {
        $attributes = [
            'name' => static::NAME,
            'values' => $this->values(),
        ];

        if (defined(static::class.'::DESCRIPTION') && !empty(static::DESCRIPTION)) {
            $attributes['description'] = static::DESCRIPTION;
        }

        return $attributes;
    }
}

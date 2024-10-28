<?php

namespace Modules\Core\GraphQL\Types;

use GraphQL\Type\Definition\NonNull;
use GraphQL\Type\Definition\NullableType;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\InputType as GraphQLInputType;

abstract class BaseInput extends GraphQLInputType
{
    public const NAME = 'BaseInput';
    public const DESCRIPTION = '';

    public function fields(): array
    {
        return [];
    }

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
        ];

        if (defined(static::class.'::DESCRIPTION') && !empty(static::DESCRIPTION)) {
            $attributes['description'] = static::DESCRIPTION;
        }

        return $attributes;
    }
}

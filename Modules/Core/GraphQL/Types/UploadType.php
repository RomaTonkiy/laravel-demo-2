<?php

namespace Modules\Core\GraphQL\Types;

use GraphQL\Type\Definition\NonNull;
use GraphQL\Type\Definition\NullableType;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\UploadType as GraphQLUploadType;

class UploadType extends GraphQLUploadType
{
    public const NAME = 'Upload';

    public static function nonNullType(): NonNull|Type
    {
        return Type::nonNull(static::type());
    }

    public static function type(): Type|NullableType
    {
        return GraphQL::type(static::NAME);
    }

    public static function paginate(): Type
    {
        return GraphQL::paginate(static::type());
    }

    public static function list(): Type
    {
        return Type::listOf(static::nonNullType());
    }

    public static function nonNullList(): NonNull|Type
    {
        return NonNullType::listOf(static::nonNullType());
    }
}

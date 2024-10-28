<?php

declare(strict_types=1);

namespace Modules\Core\Traits\GraphQL;

use GraphQL\Type\Definition\Type;

trait IdsHelperTrait
{
    protected string $idArgsKey = 'id';
    protected string $idsArgsKey = 'ids';

    protected function getIdArgs(): array
    {
        return [
            $this->idArgsKey => [
                'type' => Type::id(),
                'rules' => ['nullable', 'integer'],
            ],
        ];
    }

    protected function getIdsArgs(): array
    {
        return [
            $this->idsArgsKey => [
                'type' => Type::listOf(Type::id()),
                'rules' => ['nullable', 'array'],
            ],
        ];
    }
}

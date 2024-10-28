<?php

namespace Modules\Core\Traits\GraphQL;

use GraphQL\Type\Definition\Type;

trait PaginateHelperTrait
{
    protected string $perPageArgsKey = 'per_page';

    protected string $pageArgsKey = 'page';

    protected function getPaginateArgs(): array
    {
        return [
            $this->perPageArgsKey => [
                'type' => Type::int(),
                'rules' => ['nullable', 'integer'],
            ],
            $this->pageArgsKey => [
                'type' => Type::int(),
                'rules' => ['nullable', 'integer'],
                'defaultValue' => 1,
            ],
        ];
    }
}

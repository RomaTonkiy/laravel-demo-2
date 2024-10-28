<?php

namespace Modules\Core\Services;

use Illuminate\Support\Facades\Validator as ValidatorFacade;
use Illuminate\Validation\ValidationException;
use Illuminate\Validation\Validator;

abstract class BaseServiceWithValidator
{
    private Validator $validator;

    public function __construct(
    )
    {
        $this->validator = ValidatorFacade::make([], []);
    }

    protected function checkValidator(): void
    {
        if (!empty($this->validator->errors()->toArray())) {
            throw new ValidationException($this->validator);
        }
    }

    protected function addError(string $key, string $message): void
    {
        $this->validator->errors()->add($key, $message);
    }
}

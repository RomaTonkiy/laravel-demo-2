<?php
namespace Modules\Permissions\Enums;

enum AvailableOperationsEnum: string
{
    case CREATE = 'create';
    case READ = 'read';
    case UPDATE = 'update';
    case DELETE = 'delete';

}

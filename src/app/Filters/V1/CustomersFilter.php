<?php

namespace App\Filters\V1;

use App\Filters\ApiFilter;
use Illuminate\Http\Request;

class CustomersFilter extends ApiFilter
{
    protected array $operatorMap = [
        'eq' => '=', // equal
        'lt' => '<', // less than
        'lte' => '<=', // less than or equal
        'gt' => '>', // grater than
        'gte' => '>=', // grater than or equal
    ];

    protected array $allowedParams = [
        'name' => ['eq'],
        'type' => ['eq'],
        'email' => ['eq'],
        'address' => ['eq'],
        'city' => ['eq'],
        'state' => ['eq'],
        'postalCode' => ['eq', 'gt', 'lt'],
    ];

    protected array $columnMap = [
        'postalCode' => 'postal_code',
    ];
}

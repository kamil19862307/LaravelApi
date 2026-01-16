<?php

namespace App\Filters\V1;

use App\Filters\ApiFilter;
use Illuminate\Http\Request;

class InvoicesFilter extends ApiFilter
{
    protected array $operatorMap = [
        'eq' => '=', // equal
        'lt' => '<', // less than
        'lte' => '<=', // less than or equal
        'gt' => '>', // grater than
        'gte' => '>=', // grater than or equal
        'ne' => '!=', // not equal
    ];

    protected array $allowedParams = [
        'customerId' => ['eq'],
        'amount' => ['eq', 'lt', 'gte', 'lte', 'gt'],
        'status' => ['eq', 'ne'],
        'billedAt' => ['eq', 'lt', 'gte', 'lte', 'gt'],
        'paidAt' => ['eq', 'lt', 'gte', 'lte', 'gt'],
    ];

    protected array $columnMap = [
        'customerId' => 'customer_id',
        'billedAt' => 'billed_at',
        'paidAt' => 'paid_at',
    ];
}

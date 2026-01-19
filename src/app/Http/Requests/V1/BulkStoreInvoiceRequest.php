<?php

namespace App\Http\Requests\V1;

use App\Models\Customer;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class BulkStoreInvoiceRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        // Проверка для каждого елемента массива. data: [{customer_id}]
        // data: [
        //      0 => ['customer_id' => 1],
        //      1 => ['customer_id' => 2],
        //      2 => ['customer_id' => 3],
        //  ]
        return [
            '*.customer_id' => 'required|integer|exists:customers,id',
            '*.amount' => 'required|numeric',
            '*.status' => ['required', Rule::in('BILLED', 'PAID', 'VOID', 'billed', 'paid', 'void')],
            '*.billed_at' => 'required|date_format:Y-m-d H:i:s',
            '*.paid_at' => 'date_format:Y-m-d H:i:s|nullable',
        ];
    }

    // Данные будут приходить из json в CamelCase, а в базе snake_case
    protected function prepareForValidation()
    {
        $data = [];

        foreach ($this->toArray() as $obj) {
            $obj['customer_id'] = $obj['customerId'] ?? null;
            $obj['billed_at'] = $obj['billedAt'] ?? null;
            $obj['paid_at'] = $obj['paidAt'] ?? null;

            $data[] = $obj;
        }

        $this->merge($data);
    }
}

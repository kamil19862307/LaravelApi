<?php

namespace App\Http\Requests\V1;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateCustomerRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        $user = $this->user();

        return $user !== null && $user->tokenCan('update');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $method = $this->method();


        if ($method == 'PUT') {

            return [
                'name' => 'required',
                'email' => 'required|email',
                'type' => ['required', Rule::in('I', 'B', 'i', 'b')],
                'address' => 'required',
                'city' => 'required',
                'state' => 'required',
                'postal_code' => 'required',
            ];

        } else {

            return [
                'name' => 'sometimes|required',
                'email' => 'sometimes|required|email',
                'type' => ['sometimes', 'required', Rule::in('I', 'B', 'i', 'b')],
                'address' => 'sometimes|required',
                'city' => 'sometimes|required',
                'state' => 'sometimes|required',
                'postal_code' => 'sometimes|required',
            ];
        }
    }

    // Данные будут приходить из json в CamelCase, а в базе snake_case, поэтому изменим postalCode на postal_code
    protected function prepareForValidation()
    {
        if ($this->postalCode) {

            $this->merge([
                'postal_code' => $this->postalCode,
            ]);

        }
    }
}

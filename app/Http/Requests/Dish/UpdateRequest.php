<?php

namespace App\Http\Requests\Dish;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @property int id
 * @property string name
 * @property float price
 */
class UpdateRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'name' => ['string'],
            'price' => ['numeric', 'min:0']
        ];
    }
}

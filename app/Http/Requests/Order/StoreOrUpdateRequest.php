<?php

namespace App\Http\Requests\Order;

use App\Enums\Order\StatusEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;

/**
 * @property int id
 * @property string status
 * @property array dishes
 */
class StoreOrUpdateRequest extends FormRequest
{

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
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
            'id' => ['integer', 'exists:App\Models\Order,id'],
            'status' => ['string', new Enum(StatusEnum::class)],
            'dishes' => ['array'],
            'dishes.*.id' => ['required', 'integer', 'exists:App\Models\Dish,id'],
            'dishes.*.amount' => ['required', 'integer', 'min:1']
        ];
    }
}

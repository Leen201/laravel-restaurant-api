<?php

namespace App\Http\Requests\Order;

use App\Enums\Order\StatusEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;

/**
 * @property int|null page
 * @property int|null limit
 * @property string|null status
 */
class IndexRequest extends FormRequest
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
            'page' => ['required_with:limit', 'integer', 'min:1'],
            'limit' => ['required_with:page', 'integer', 'min:1'],
            'status' => ['string', new Enum(StatusEnum::class)]
        ];
    }
}

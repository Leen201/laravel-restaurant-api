<?php

namespace App\Http\Requests\Dish;

use Illuminate\Foundation\Http\FormRequest;
use JetBrains\PhpStorm\ArrayShape;

/**
 * @property int|null page
 * @property int|null limit
 * @property string|null order_by
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
     */
    #[ArrayShape([
        'page' => "string[]",
        'limit' => "string[]",
        'order_by' => "string[]"
    ])] public function rules(): array
    {
        return [
            'order_by' => ['in:name,price'],
            'page' => ['required_with:limit', 'integer', 'min:1'],
            'limit' => ['required_with:page', 'integer', 'min:1'],
        ];
    }
}

<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ArticleStoreRequest extends FormRequest
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
     * @return array
     */
    public function rules(): array
    {
        return [
            'mode' => 'required|boolean',
            'category' => 'required|exists:categories,ID',
            'title' => 'required|max:150',
            'description' => 'required|max:250',
            'preview' => 'image|mimes:jpeg,png,jpg|max:2048',
            'body' => 'required',
        ];
    }
}

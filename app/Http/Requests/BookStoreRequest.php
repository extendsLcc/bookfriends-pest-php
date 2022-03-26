<?php

namespace App\Http\Requests;

use App\Models\Pivot\BookUser;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class BookStoreRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'title' => 'required',
            'author' => 'required',
            'status' => [
                'required',
                Rule::in(array_keys(BookUser::$statuses))
            ],
        ];
    }
}

<?php

namespace App\Http\Requests;

use App\Models\Book;
use App\Models\Pivot\BookUser;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

/**
 * @property Book $book
 */
class BookUpdateRequest extends FormRequest
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

    public function authorize(): bool
    {
        return $this->user()->can('update', $this->book);
    }
}

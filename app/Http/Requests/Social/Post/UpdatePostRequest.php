<?php

namespace App\Http\Requests\Social\Post;

use App\Enums\PostVisibility;
use App\Http\Requests\Traits\ValidatesAttachments;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdatePostRequest extends FormRequest
{
    use ValidatesAttachments;

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title' => 'required|string|max:36',
            'content' => 'required|string|max:564',
            'attachments' => 'nullable|array',
            'attachments.*' => 'file|mimes:jpeg,png,jpg,gif,avi,mp4',
            'visibility' => ['nullable', Rule::in(PostVisibility::getValues())],
        ];
    }
}

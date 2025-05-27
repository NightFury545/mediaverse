<?php

namespace App\Http\Requests\Social\PostRequests;

use App\Enums\FileExtension;
use App\Enums\PostVisibility;
use App\Http\Requests\Traits\ValidatesAttachments;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CreatePostRequest extends FormRequest
{
    use ValidatesAttachments;

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $allowedExtensions = array_merge(
            FileExtension::getImageExtensions(),
            FileExtension::getVideoExtensions()
        );

        $mimes = implode(',', $allowedExtensions);

        return [
            'title' => 'required|string|min:3|max:36',
            'content' => 'required|string|max:564',
            'tags' => 'nullable|array',
            'tags.*' => 'string|min:2|max:24',
            'attachments' => 'nullable|array',
            'attachments.*' => [
                'file',
                'mimes:' . $mimes,
                'max:20480',
            ],
            'visibility' => ['nullable', Rule::in(PostVisibility::getValues())],
            'comments_enabled' => 'nullable|boolean',
        ];
    }
}


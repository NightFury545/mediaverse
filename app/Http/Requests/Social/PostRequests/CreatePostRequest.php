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

        return [
            'title' => 'required|string|max:36',
            'content' => 'required|string|max:564',
            'attachments' => 'nullable|array',
            'attachments.*' => ['file', Rule::in($allowedExtensions), 'max:20480'],
            'visibility' => ['nullable', Rule::in(PostVisibility::getValues())],
            'comments_enabled' => 'nullable|boolean',
        ];
    }
}


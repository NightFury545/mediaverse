<?php

namespace App\Http\Requests\Social\MessageRequests;

use App\Enums\FileExtension;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateMessageRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'content' => 'nullable|string|max:360',
            'attachments' => 'nullable|array',
            'attachments.*' => ['file', Rule::in(FileExtension::getAllExtensions()), 'max:20480'],
            'is_read' => 'nullable|boolean',
        ];
    }
}

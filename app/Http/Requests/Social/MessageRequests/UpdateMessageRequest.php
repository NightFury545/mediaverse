<?php

namespace App\Http\Requests\Social\MessageRequests;

use App\Enums\FileExtension;
use Illuminate\Validation\Rule;

class UpdateMessageRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'content' => 'nullable|string|max:360|required_without:attachments',
            'attachments' => 'nullable|array|required_without:content',
            'attachments.*' => ['file', Rule::in(FileExtension::getAllExtensions()), 'max:20480'],
            'is_read' => 'nullable|boolean',
        ];
    }
}

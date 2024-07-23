<?php

namespace App\Http\Requests\Admin\Task;

use App\Constants\UserType;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreTaskRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => ['required', Rule::unique('tasks', 'title'), 'string', 'min:10', 'max:100'],
            'description' => ['required', 'string', 'min:10', 'max:500'],
            'assigned_by_id' => ['required'],
            'assigned_to_id'=> ['required', Rule::exists('users', 'id')->where('type', UserType::TYPE_NORMAL)],
        ];
    }
}

<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class StoreTaskRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name'           => 'required|min:1',
            'status_id'      => 'exists:App\Models\TaskStatus,id',
            'description'    => 'nullable',
            'assigned_to_id' => 'nullable',
            'labels' => 'nullable',
        ];
    }
}

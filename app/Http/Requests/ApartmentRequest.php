<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ApartmentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        // next week, authorization
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
            'name' => ['required', 'min:3', 'max:255'], // you can use vertical bar(pipe)
            'floors' => ['required', 'integer', 'min:1'],
        ];
    }

    public function messages() {
        return [
            'name.required' => 'The apartment name is required',
            'floors.required' => 'You have to input the number of floors',
            'name.min' => 'ต้องการขื่ออย่างน้อย 3 ตัวอักษร'
        ];
    }
}

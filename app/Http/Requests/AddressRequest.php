<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddressRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->check();
    }

    public function rules(): array
    {
        return [
            'full_name' => ['required', 'string', 'max:100'],
            'phone' => ['required', 'string', 'regex:/^(?:\+88|88)?(01[3-9]\d{8})$/'],
            'division_id' => ['required', 'exists:divisions,id'],
            'district_id' => ['required', 'exists:districts,id'],
            'upazila_id' => ['required', 'exists:upazilas,id'],
            'area' => ['required', 'string', 'max:100'],
            'full_address' => ['required', 'string', 'max:500'],
            'landmark' => ['nullable', 'string', 'max:150'],
            'postal_code' => ['nullable', 'string', 'max:10'],
            'type' => ['required', 'in:home,office,other'],
            'is_default_delivery' => ['boolean'],
            'is_default_billing' => ['boolean'],
        ];
    }

    public function messages(): array
    {
        return [
            'phone.regex' => 'Please provide a valid Bangladeshi mobile number (01XXXXXXXXX).',
            'division_id.required' => 'Please select a Division in Bangladesh.',
            'district_id.required' => 'Please select your District.',
            'upazila_id.required' => 'Please select your Upazila or Thana.',
        ];
    }
}

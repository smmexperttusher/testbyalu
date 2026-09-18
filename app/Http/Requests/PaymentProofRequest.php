<?php

namespace App\Http\Requests;

use App\Models\Setting;
use Illuminate\Foundation\Http\FormRequest;

class PaymentProofRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->check();
    }

    public function rules(): array
    {
        $maxSizeKb = Setting::get('screenshot_max_size_kb', 4096);
        $allowedFormats = Setting::get('allowed_screenshot_formats', ['jpg', 'jpeg', 'png', 'webp']);
        $mimes = implode(',', (array) $allowedFormats);

        return [
            'payment_method' => ['required', 'in:bkash,nagad'],
            // Bangladesh phone number: supports 01XXXXXXXXX or +8801XXXXXXXXX
            'phone_number' => [
                'required',
                'string',
                'regex:/^(?:\+88|88)?(01[3-9]\d{8})$/',
            ],
            'transaction_id' => [
                'required',
                'string',
                'min:6',
                'max:50',
                'unique:payment_proofs,transaction_id',
            ],
            'screenshot' => [
                'required',
                'file',
                'image',
                "mimes:{$mimes}",
                "max:{$maxSizeKb}",
            ],
            'delivery_address_id' => [
                'required',
                'exists:addresses,id',
            ],
            'shipping_method_id' => [
                'nullable',
                'exists:shipping_methods,id',
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'phone_number.regex' => 'Please enter a valid 11-digit Bangladeshi mobile number (e.g. 017XXXXXXXX or 018XXXXXXXX).',
            'transaction_id.unique' => 'This Transaction ID has already been submitted. Please verify your transaction receipt.',
            'screenshot.required' => 'Payment screenshot is required to verify your transaction.',
            'screenshot.max' => 'The payment screenshot may not be greater than 4MB.',
        ];
    }
}

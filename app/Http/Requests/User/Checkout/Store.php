<?php

namespace App\Http\Requests\User\Checkout;

use Illuminate\Foundation\Http\FormRequest;
use Auth;

class Store extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        // return false; default setting

        // mensetting semua yang masuk ke halaman checkout user harus sudah login
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        // mensetting expired tanggal hari ini
        $expiredValidation = date('Y-m', time());

        // membuat form validation rules
        return [
            'name' => 'required|string',
            'email' => 'required|email|unique:users,email,' . Auth::id() . ',id',
            'occupation' => 'required|string',
            'card_number' => 'required|numeric|digits_between:8,16',
            'expired' => 'required|date|date_format:Y-m|after_or_equal:' . $expiredValidation,
            'cvc' => 'required|numeric|digits:3',

        ];
    }
}

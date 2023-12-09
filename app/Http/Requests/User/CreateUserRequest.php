<?php
/**
 * Sports Manager PRO.
 *
 * PHP version 8.3
 *
 * LICENSE: Sports Manager PRO can not be copied and/or distributed
 * without the express permission of Sports Manager PRO.
 *
 * @author    Marcin Lewandowski <marcin.lewandowski@appcadabra.pl>
 * @copyright 2023 appcadabra.pl
 */

declare(strict_types=1);

namespace App\Http\Requests\User;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class CreateUserRequest extends FormRequest
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
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'min:3', 'max:30', 'unique:users'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => [
                'required',
                Password::min(size: 8)
                    ->mixedCase()
                    ->letters()
                    ->numbers()
                    ->symbols(),
            ],
        ];
    }
}

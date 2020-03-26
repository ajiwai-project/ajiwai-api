<?php


namespace Ajiwai\Application\Requests\Auth;


use Ajiwai\Exceptions\RequestsValidateException;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

class RefreshTokenRequest extends FormRequest
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
            'grant_type' => 'required|regex:{^refresh_token$}',
            'refresh_token' => 'required',
        ];
    }

    /**
     * @param Validator $validator
     */
    protected function failedValidation(Validator $validator)
    {
        throw new RequestsValidateException();
    }

    public function token()
    {
        return self::get('refresh_token');
    }
}

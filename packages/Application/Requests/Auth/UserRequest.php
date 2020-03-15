<?php


namespace Ajiwai\Application\Requests\Auth;


use Ajiwai\Library\Auth\AuthUser;
use Ajiwai\Exceptions\RequestsValidateException;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
            'user_id' => 'required|string|max:20',
            'password' => 'required|regex:{^[a-zA-Z0-9-]+$}|max:8|min:4'
        ];
    }

    /**
     * @param Validator $validator
     */
    protected function failedValidation(Validator $validator)
    {
        throw new RequestsValidateException();
    }

    /**
     * 認証用ユーザークラスへ変換する
     * @return AuthUser
     */
    public function toEntity(): AuthUser
    {
        return new AuthUser(self::get('user_id'), self::get('password'));
    }

    /**
     * 連想型配列へ変換する
     * @return array
     */
    public function toCredentials()
    {
        return array('user_id' => self::get('user_id'), 'password' => self::get('password'));
    }
}

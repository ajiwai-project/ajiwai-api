<?php


namespace Ajiwai\Application\Requests\Auth;


use Ajiwai\Domain\Model\Auth\User;
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
            'userId' => 'required|string|max:20',
            'password' => 'required|alpha_num|max:8|min:4'
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
     * @return User
     */
    public function toEntity(): User
    {
        return new User(self::input('userId'), self::input('password'));
    }
}

<?php

namespace Ajiwai\Application\Requests\Ajiwai;

use Ajiwai\Domain\Ajiwai\Ajiwai;
use Ajiwai\Exceptions\RequestsValidateException;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

class AjiwaiRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }


    public function rules()
    {
        return [
            'brand_name' => ['required', 'max:40'],
            'photo' => [
                'file',
                'image',
                'mimes:jpeg,png',
                'dimensions:min_width=120,min_height=120,max_width=400,max_height=400'
            ],
            'comment' => ['required', 'string']
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new RequestsValidateException();
    }

    public function toEntity(): Ajiwai
    {
        return new Ajiwai(self::get('brand_name'), self::get('image'), self::get('comment'));
    }
}

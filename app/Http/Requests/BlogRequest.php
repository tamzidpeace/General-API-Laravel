<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class BlogRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'title' => 'required|string',
            'body' => 'required|string',
            'comment' => 'required|string',
        ];
    }

    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException($this->validation($validator));
    }

    public static function validation($validator)
    {
        // if ($validator->fails()) return Base::error($validator->errors()->first(), $validator->errors());
        return response()->json([
            'success' => false,
            'code' => 400,
            'message' => $validator->errors()->first(),
            'data' => $validator->errors(),
            'type' => 'validation'
        ]);
    }


}

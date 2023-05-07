<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
            'title' => ['required'],
            'desc' => ['required'],
            'img' => ['size:512','image','mimes:jpeg,png,jpg,gif,svg','max:10'],
            'price' => ['required','max:10']
        ];
    }
    public function messages()
    {
        return[
            'title.required' => 'Please Fill This Field Product Title',
            'desc.required' => 'Please Fill This Field Product Description',
            'price.required' => 'Please Fill This Field Product Price',

            'price.max' => 'maximum is 10 digit',
            'img.size' => 'the maximum size is 512 k/b',

        ];


    }
}

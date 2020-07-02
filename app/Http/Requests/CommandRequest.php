<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CommandRequest extends FormRequest
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
            'name_ar'=> 'required|max:10|unique:commands,name_ar',
            'name_en'=> 'required|max:10|unique:commands,name_en',
            'price'=> 'required|numeric',
            'details_ar'=> 'required',
            'details_en'=> 'required',
        ];
    }
    public function messages(){
        return [
            'name.required'=>__('message.command.name'),
            'price.required'=>__('message.command.pricereq'),
            'details.required'=>"le details et obligatoire",
            'name.unique'=>"nom deja existe",
            'name.max'=>"nom contien plus que dix caractaires",

        ];
    }

}

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
            'image'=> 'required',
            'name_en'=> 'required|max:10|unique:commands,name_en',
            'price'=> 'required|numeric',
            'details_ar'=> 'required',
            'details_en'=> 'required',
        ];
    }
    public function messages(){
        return [
            'name_ar.required'=>__('message.command.name'),
            'image.required'=>"l'image est obligatoire !!",
            'name_en.required'=>__('message.command.name'),
            'price.required'=>__('message.command.pricereq'),
            'details_ar.required'=>"le details et obligatoire",
            'details_en.required'=>"le details et obligatoire",
            'name.unique'=>"nom deja existe",
            'name.unique'=>"nom deja existe",
            'name_ar.max'=>"العدد الأقصى للحروف هو 10",
            'name_en.max'=>"nom contien plus que dix caractaires",

        ];
    }

}

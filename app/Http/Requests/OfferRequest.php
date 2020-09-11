<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OfferRequest extends FormRequest
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
            'name' => 'required|max:100',
            'price' => 'required|numeric',
            'details' => 'required',
            'photo' => 'required|mimes:png,jpg,jpeg',
        ];
    }


    public function messages()
    {

        return [
            'name.required' =>'يجب ادخال الاسم ',
            'name.unique' => 'اسم العرض موجود ',
            'price.numeric' => 'سعر العرض يجب ان يكون ارقام',
            'price.required' => 'السعر مطلوب',
            'details.required' => 'ألتفاصيل مطلوبة ',
            'photo.required' =>  'صوره العرض مطلوب',
            'photo.mimes' =>  'صوره غير صالحة',

        ];
    }

}
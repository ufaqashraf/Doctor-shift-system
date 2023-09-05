<?php
namespace App\Http\Requests\Admin\Projects;

use Illuminate\Foundation\Http\FormRequest;

class StoreUpdateRequest extends FormRequest
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
            
            'name' => 'required',
            
            'image' => 'mimes:jpeg,jpg,png,gif',
            //'territory_id' => 'required',
//            'name' => 'required',
//            'shift' => 'required',
//            'mobile' => 'required|numeric',
//            'phone' => 'sometimes|nullable|numeric',
        ];
    }
}

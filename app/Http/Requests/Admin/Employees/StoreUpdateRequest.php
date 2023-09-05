<?php
namespace App\Http\Requests\Admin\Employees;

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
            //'employee_id' => 'required||unique:hrm_employees_job_detail',
            'email' => 'required|string|email|max:255',
            'name' => 'required',
            'first_name' => 'required',
            'last_name' => 'required',
            'father_name' => 'required',
            'designation' => 'required',
            'gender' => 'required',
            'employment_type' => 'required',
            'image' => 'mimes:jpeg,jpg,png,gif',
            //'territory_id' => 'required',
//            'name' => 'required',
//            'shift' => 'required',
//            'mobile' => 'required|numeric',
//            'phone' => 'sometimes|nullable|numeric',
        ];
    }
}

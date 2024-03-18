<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Factory as ValidationFactory;
class PersonRequest extends FormRequest

{   

    public function __construct(ValidationFactory $validationFactory)
    {

        $validationFactory->extend(
            'maleorfemale',
            function ($attribute, $value, $parameters) {
                return in_array($value, ['M','F']);   
            },
            'Value must be M or F'
           
        );  
    
    }

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
        
        $sql_date_format = 'Y-m-d';

        if ($this->method() == 'POST') {
            return [
                "firstname" => 'required|string|max:255',
                "lastname" => 'required|string|max:255',
                "birth_date" =>  "required|string|date_format:$sql_date_format|max:255",
                "gender"  =>  'required|string|max:255|maleorfemale',
                "email"  =>  'required|string|unique:App\Models\Person,email'
            ];
        }
       
        // PUT|UPDATE case

        return [
            "firstname" => 'sometimes|string|max:255',
            "lastname" => 'sometimes|string|max:255',
            "birth_date" =>  "sometimes|string|date_format:$sql_date_format|max:255",
            "gender"  =>  'sometimes|string|max:255|maleorfemale',
            "email"  =>  'sometimes|string|unique:App\Models\Person,email,'. $this->id
        ];
        
    }
}

<?php


namespace App\Http\Requests;


use Illuminate\Foundation\Http\FormRequest;

class PackageRqRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        switch($this->method())
        {
            case 'GET':
            case 'DELETE':
            {
                return [];
            }
            case 'POST':
            {
                return [
                    'begin_place' => 'required',
                    'arrival_place' => 'required',
                    'begin_time' => 'required|date',
                    'arrival_time' => 'required|date',
                    'empty_luggage' => 'required',
                ];
            }
            case 'PUT':
            case 'PATCH':
            default:break;
        }

    }
}
/*'quick_contact_phone' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10|max:11',*/
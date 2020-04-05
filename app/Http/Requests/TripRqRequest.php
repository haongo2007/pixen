<?php


namespace App\Http\Requests;


use Illuminate\Foundation\Http\FormRequest;

class TripRqRequest extends FormRequest
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
                    'name' => 'required',
                    'begin_place' => 'required',
                    'arrival_place' => 'required',
                    'date_send' => 'required|date',
                    'size' => 'required',
                ];
            }
            case 'PUT':
            case 'PATCH':
            default:break;
        }

    }
}
/*'quick_contact_phone' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10|max:11',*/
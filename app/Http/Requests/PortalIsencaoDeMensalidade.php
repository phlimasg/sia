<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PortalIsencaoDeMensalidade extends FormRequest
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
            'upload' => 'required',
            'upload.*' => 'required|mimes:jpeg,jpg,pdf|max:1000000',
            'cpf' => 'required|string',
            'motivo_id' => 'required|numeric|not_in:0',
            'apelacao' => 'required|string',
            'user_token'=> 'required|string'
        ];
    }
}

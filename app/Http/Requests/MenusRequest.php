<?php

namespace Dnvmaster\Http\Requests;

use Dnvmaster\Http\Requests\Request;
use Illuminate\Support\Facades\Auth;

class MenusRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return \Auth::user()->canDo('EDIT_MENU');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title'=>'required|max:255',
        ];
    }
}

<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class KelasRequest extends Request
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return ['nama_kelas' => 'required|string|max:20'];
    }
}

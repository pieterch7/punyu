<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class SiswaRequest extends Request
{
    public function authorize()
    {
        return true;
    }
    public function rules()
    {
        //cek apakah create atau update
        if ($this->method() == 'PATCH') {
            $nisn_rules = 'required|string|size:4';
            $telepon_rules = 'sometimes|numeric|digits_between:10,15';
        }
        else 
        {
            $nisn_rules = 'required|string|size:4|unique:siswa,nisn';
            $telepon_rules = 'sometimes|numeric|digits_between:10,15|unique:telepon,nomor_telepon';
        }
        return [
            //
            'nisn' => $nisn_rules,
            'nama_siswa' => 'required|string|max:30',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required|in:L,P',
            'nomor_telepon' => $telepon_rules,
            'id_kelas' => 'required',
            'foto' => 'sometimes|image|max:500|mimes:jpeg,jpg,bmp,png',
        ];
    }
}

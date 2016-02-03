<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Semnas;
use Illuminate\Http\Request;
use Validator;

class SemnasController extends Controller
{
    public function store(Request $request)
    {
        $validator = $this->validator($request->all());
        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator,'semnas')
                ->withInput();
        }

        $user = $this->create($request->all());

        return redirect('/home');
    }

    public function create(array $data)
    {
        Semnas::create([
            'nama'  => $data['nama'],
            'email'  => $data['email'],
            'notelp' => $data['notelp'],
            'kategori'=> $data['kategori'],
        ]);
    }

    public function validator(array $data)
    {
        return Validator::make($data, [
            'nama'   => 'required|max:60',
            'email'  => 'required|email|max:60|unique:semnas',
            'notelp' => 'required|max:14|unique:semnas',
        ]);
    }
}

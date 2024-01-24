<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;

class StudentController extends Controller
{
    public function create()
    {
        return view('create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nim' => 'required|size:8|unique:students',
            'nama' => 'required|min:3|max:50',
            'jenis_kelamin' => 'required|in:P,L',
            'jurusan' => 'required',
            'alamat' => 'nullable',
        ]);

        $mahasiswa = new Student([
            'nim' => $validatedData['nim'],
            'nama' => $validatedData['nama'],
            'jenis_kelamin' => $validatedData['jenis_kelamin'],
            'jurusan' => $validatedData['jurusan'],
            'alamat' => $validatedData['alamat'],
        ]);

        $mahasiswa->save();

        $request->session()->put('pesan', 'Penambahan data berhasil');

        return redirect()->route('create.student');
    }
}

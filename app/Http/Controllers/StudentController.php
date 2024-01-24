<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
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

        return redirect()->route('students.index');
    }

    public function edit(string $id)
    {
        $student = Student::findOrFail($id);
        return view('edit', compact('student'));
    }
    public function update(Request $request, string $id)
    {
        // Validasi data
        $validateData = Validator::make($request->all(), [
            'nim' => 'required|integer|unique:students,nim,'.$id,
            'nama' => 'required|min:3|max:50',
            'jenis_kelamin' => 'required|in:P,L',
            'jurusan' => 'required',
            'alamat' => 'nullable',
        ]);

        if ($validateData->fails()) {
            return redirect()->back()->withErrors($validateData)->withInput();
        }

        // Temukan mahasiswa berdasarkan ID
        $mahasiswa = Student::findOrFail($id);

        // Update data mahasiswa
        $mahasiswa->update([
            'nim' => $request->nim,
            'nama' => $request->nama,
            'jenis_kelamin' => $request->jenis_kelamin,
            'jurusan' => $request->jurusan,
            'alamat' => $request->alamat,
        ]);

        // Redirect dengan pesan sukses
        return redirect()->route('students.index')->with('success', 'Data mahasiswa berhasil diperbarui');
    }

    public function delete($id)
    {
        $student = Student::find($id);

        if (!$student) {
            return redirect()->route('create.student')->with('error', 'Mahasiswa tidak ditemukan');
        }


        // Hapus data mahasiswa dari database
        $student->delete();

        return redirect()->route('students.index')->with('success', 'Mahasiswa berhasil dihapus');
    }

    public function index()
    {
        $students = Student::all();
        return view('index', compact('students'));
    }

}

<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use App\Models\Student;
use Illuminate\Support\Facades\Storage;

class StudentController extends Controller
{
    public function create()
    {
        return view('create');
    }

    public function store(Request $request)
    {
        // Validasi data yang diterima
        $request->validate([
            'nim' => 'required|string',
            'nama' => 'required|string',
            'jenis_kelamin' => 'required|in:P,L',
            'jurusan' => 'required|in:TI,SI,MI,KA',
            'alamat' => 'required|string',
            'foto' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Validasi untuk gambar
        ]);

        // Simpan gambar yang diunggah
        $fotoName = $request->foto->getClientOriginalName();
        $request->foto->storeAs('public/foto-mahasiswa', $fotoName);

        // Simpan data mahasiswa ke dalam database
        Student::create([
            'nim' => $request->nim,
            'nama' => $request->nama,
            'jenis_kelamin' => $request->jenis_kelamin,
            'jurusan' => $request->jurusan,
            'alamat' => $request->alamat,
            'foto' => $fotoName, // Simpan nama file gambar
        ]);

        // Redirect atau response sesuai kebutuhan aplikasi
        return redirect()->back()->with('success', 'Data mahasiswa berhasil disimpan.');
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
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Validasi untuk gambar
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
    
        // Jika ada gambar yang diunggah
        if ($request->hasFile('foto')) {
            // Hapus foto lama jika ada
            if ($mahasiswa->foto) {
                Storage::delete('public/foto-mahasiswa/' . $mahasiswa->foto);
            }
    
            // Simpan gambar yang diunggah
            $fotoName = $request->foto->getClientOriginalName();
            $request->foto->storeAs('public/foto-mahasiswa', $fotoName);
    
            // Update nama foto pada data mahasiswa
            $mahasiswa->foto = $fotoName;
            $mahasiswa->save();
        }
    
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

    public function detail($id)
    {
        $student = Student::find($id);
        return view('detail', compact('student'));
    }

}

<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;
use App\Models\Student;
use Illuminate\Http\Request;

class StudentApiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Implementation for listing resources goes here
        $students = Student::all()->toJson(JSON_PRETTY_PRINT);
    return response($students, 200);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Implementation for showing the form goes here
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate incoming data
        $validateData = Validator::make($request->all(), [
            'nim' => 'required|size:8|unique:student,nim',
            'nama' => 'required|min:3|max:50',
            'jenis_kelamin' => 'required|in:P,L',
            'jurusan' => 'required',
            'alamat' => '',
            'image' => 'required|file|image|max:1000',
        ]);

        // Check for validation errors
        if ($validateData->fails()) {
            return response($validateData->errors(), 400);
        } else {
            // Create a new Student instance
            $mahasiswa = new Student();
            
            // Assign values from the request to the model
            $mahasiswa->nim = $request->nim;
            $mahasiswa->name = $request->nama;
            $mahasiswa->gender = $request->jenis_kelamin;
            $mahasiswa->departement = $request->jurusan;
            $mahasiswa->address = $request->alamat;
            
            // Handle file upload for the 'image' field
            if ($request->hasFile('image')) {
                $extFile = $request->image->getClientOriginalExtension();
                $namaFile = 'user-' . time() . "." . $extFile;
                $path = $request->image->move('assets/images', $namaFile);
                $mahasiswa->image = $path;
            }
            
            // Save the student record to the database
            $mahasiswa->save();
            
            // Return a success response
            return response()->json([
                "message" => "Student record created"
            ], 201);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // Implementation for displaying a specific resource goes here
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // Implementation for showing the edit form goes here
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Implementation for updating a resource goes here
        if (Student::where('id', $id)->exists()) {
            $validateData = Validator::make($request->all(), [
                'nim' => 'required|size:8|unique:student,nim,'.$id,
                'nama' => 'required|min:3|max:50',
                'jenis_kelamin' => 'required|in:P,L',
                'jurusan' => 'required',
                'alamat' => '',
                'image' => 'required|file|image|max:1000',
            ]);
        
            if ($validateData->fails()) {
                return response($validateData->errors(), 400);
            } else {
                $mahasiswa = Student::find($id);
                $mahasiswa->nim = $request->nim;
                $mahasiswa->name = $request->nama;
                $mahasiswa->gender = $request->jenis_kelamin;
                $mahasiswa->departement = $request->jurusan;
                $mahasiswa->address = $request->alamat;
        
                if ($request->hasFile('image')) {
                    $extFile = $request->image->getClientOriginalExtension();
                    $namaFile = 'user-' . time() . "." . $extFile;
        
                    // Hapus file lama sebelum menyimpan yang baru
                    File::delete($mahasiswa->image);
        
                    $path = $request->image->move('assets/images', $namaFile);
                    $mahasiswa->image = $path;
                }
        
                $mahasiswa->save();
        
                return response()->json([
                    "message" => "student record updated"
                ], 201);
            }
        } else {
            return response()->json([
                "message" => "Student not found"
            ], 404);
        }
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Implementation for deleting a resource goes here
        if (Student::where('id', $id)->exists()) {
            $mahasiswa = Student::find($id);
        
            // Hapus file terkait sebelum menghapus rekaman student
            File::delete($mahasiswa->image);
        
            // Hapus rekaman student dari database
            $mahasiswa->delete();
        
            return response()->json([
                "message" => "student record deleted"
            ], 201);
        } else {
            return response()->json([
                "message" => "Student not found"
            ], 404);
        }
        
    }
}

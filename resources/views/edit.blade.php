<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Formulir Pembaruan Data Mahasiswa</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Tambahkan stylesheet kustom Anda di sini jika diperlukan -->
</head>

<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header bg-primary text-white text-center">
                        <h1 class="font-weight-bold">Formulir Pembaruan Data Mahasiswa</h1>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('students.update', $student->id) }}">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label for="nim" class="form-label">NIM:</label>
                                <input type="text" name="nim" class="form-control" value="{{ $student->nim }}" required>
                            </div>
                            <div class="form-group">
                                <label for="nama" class="form-label">Nama:</label>
                                <input type="text" name="nama" class="form-control" value="{{ $student->nama }}" required>
                            </div>
                            <div class="form-group">
                                <label for="jenis_kelamin" class="form-label">Jenis Kelamin:</label>
                                <select name="jenis_kelamin" class="form-select" required>
                                    <option value="P" {{ $student->jenis_kelamin == 'P' ? 'selected' : '' }}>Perempuan</option>
                                    <option value="L" {{ $student->jenis_kelamin == 'L' ? 'selected' : '' }}>Laki-laki</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="jurusan" class="form-label">Jurusan:</label>
                                <input type="text" name="jurusan" class="form-control" value="{{ $student->jurusan }}" required>
                            </div>
                            <div class="form-group">
                                <label for="alamat" class="form-label">Alamat:</label>
                                <textarea name="alamat" class="form-control">{{ $student->alamat }}</textarea>
                            </div>
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary">Update</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Sertakan script Anda di sini jika diperlukan -->

</body>

</html>

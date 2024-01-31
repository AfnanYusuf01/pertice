<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Detail Mahasiswa</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f8f9fa;
        }

        .container {
            margin-top: 50px;
        }

        .card {
            border: none;
            border-radius: 15px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
        }

        .card-header {
            background-color: #007bff;
            color: #ffffff;
            border-radius: 15px 15px 0 0;
        }

        .btn-primary {
            background-color: #007bff;
            border: none;
            border-radius: 5px;
            padding: 10px 20px;
        }

        .btn-primary:hover {
            background-color: #0056b3;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header text-center">
                        <h1 class="font-weight-bold">Detail Mahasiswa</h1>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">Informasi Mahasiswa</h5>
                        <p class="card-text">NIM: <span id="nim"></span></p>
                        <p class="card-text">Nama: <span id="nama"></span></p>
                        <p class="card-text">Jenis Kelamin: <span id="jenis_kelamin"></span></p>
                        <p class="card-text">Jurusan: <span id="jurusan"></span></p>
                        <p class="card-text">Alamat: <span id="alamat"></span></p>
                        <a href="#" class="btn btn-primary" onclick="goBack()">Kembali</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Fungsi untuk kembali ke halaman sebelumnya
        function goBack() {
            window.history.back();
        }

        // Fungsi untuk mengisi informasi mahasiswa
        function fillStudentInfo() {
            // Mendapatkan parameter ID dari URL
            const urlParams = new URLSearchParams(window.location.search);
            const studentId = urlParams.get('id');

            // Mendapatkan data mahasiswa dari sumber daya eksternal (misal: API)
            // Di sini, Anda dapat menggunakan JavaScript untuk mengirim permintaan AJAX ke backend
            // dan mendapatkan detail mahasiswa berdasarkan ID.
            // Contoh:
            // fetch(`/api/student/${studentId}`)
            //     .then(response => response.json())
            //     .then(data => {
            //         document.getElementById('nim').innerText = data.nim;
            //         document.getElementById('nama').innerText = data.nama;
            //         document.getElementById('jenis_kelamin').innerText = data.jenis_kelamin;
            //         document.getElementById('jurusan').innerText = data.jurusan;
            //         document.getElementById('alamat').innerText = data.alamat;
            //     })
            //     .catch(error => console.error('Error:', error));

            // Contoh data statis (harus diganti dengan data sebenarnya dari backend)
            const studentData = {
                nim: '1234567890',
                nama: 'John Doe',
                jenis_kelamin: 'Laki-laki',
                jurusan: 'Teknik Informatika',
                alamat: 'Jl. Contoh No. 123'
            };

            // Mengisi informasi mahasiswa ke dalam elemen HTML
            document.getElementById('nim').innerText = studentData.nim;
            document.getElementById('nama').innerText = studentData.nama;
            document.getElementById('jenis_kelamin').innerText = studentData.jenis_kelamin;
            document.getElementById('jurusan').innerText = studentData.jurusan;
            document.getElementById('alamat').innerText = studentData.alamat;
        }

        // Panggil fungsi untuk mengisi informasi mahasiswa saat halaman dimuat
        fillStudentInfo();
    </script>
</body>

</html>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>Simpanan</title>
    <meta name="description" content="">
    <meta name="keywords" content="">

    <!-- Favicons -->
    <link href="{{ asset('assets/img/JM.png') }}" rel="icon">
    <link href="{{ asset('assets/img/JM.png') }}" rel="apple-touch-icon">

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com" rel="preconnect">
    <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Raleway:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="{{ asset('assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/aos/aos.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/glightbox/css/glightbox.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/swiper/swiper-bundle.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/simple-datatables/style.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.12.0/dist/sweetalert2.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Main CSS File -->
    <link href="{{ asset('assets/css/main.css') }}" rel="stylesheet">

</head>

<body class="index-page">

    <header id="header" class="header d-flex align-items-center sticky-top">
        <div class="container-fluid container-xl position-relative d-flex align-items-center">

            <a class="logo d-flex align-items-center me-auto gap-1">
                <h1 class="sitename">JMB</h1>
                <img src="{{ asset('assets/img/JM.png') }}" class="img-fluid animated" alt="">
            </a>

            <nav id="navmenu" class="navmenu">
                <ul>
                    <li><a href="#hero" class="active">Home<br></a></li>
                </ul>
                <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
            </nav>
            <form action="{{ route('logout') }}" method="POST" id="logout-button">
                @csrf
                <button type="submit" style="border: none;" class="btn-getstarted">Logout</button>
            </form>
        </div>
    </header>

    <main class="main">

        <!-- Hero Section -->
        <section id="hero" class="hero section">

            <div class="container">
                <div class="row gy-4">
                    <div class="col-lg-6 order-2 order-lg-1 d-flex flex-column justify-content-center">
                        <h1>Selamat Datang Di Aplikasi Kami</h1>
                        <p>Kami Dari Koprasi Jasa Marga Palikanci</p>
                    </div>
                    <div class="col-lg-6 order-1 order-lg-2 hero-img">
                        <img src="{{ asset('assets/img/hero-img.png') }}" class="img-fluid animated" alt="">
                    </div>
                </div>
            </div>

        </section><!-- /Hero Section -->

        <section id="data" class="hero section">

            <div class="container">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h3 class="card-title text-center mb-0 flex-grow-1">Daftar Simpanan</h3>
                        <button class="btn btn-outline-primary" style="border-radius: 50%; font-size: 20px;"
                            data-bs-toggle="modal" data-bs-target="#addModal"><i class="bi bi-plus"></i></button>
                    </div>
                    <div class="card-body">
                        <table class="table datatable" id="myDataTable">
                            <thead>
                                <tr>
                                    <th>No Urut</th>
                                    <th>No Anggota</th>
                                    <th>Nama</th>
                                    <th>Unit</th>
                                    <th>No Hp</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $no = 1;
                                @endphp
                                @forelse ($simpanan as $s)
                                    <tr>
                                        <td>{{ $no++ }}</td>
                                        <td>{{ $s->nomor_anggota }}</td>
                                        <td>{{ $s->nama }}</td>
                                        <td>{{ $s->unit }}</td>
                                        <td>{{ $s->no_hp }}</td>
                                        <td class="d-flex gap-1 justify-content-center align-items-center">
                                            <a href="{{ route('show.detail', $s->hashed_id) }}"
                                                class="btn btn-success btn-sm"><i class="bi bi-search"></i></a>
                                            <button class="btn btn-info btn-sm btn-edit" data-bs-toggle="modal"
                                                data-bs-target="#editModal" data-id="{{ $s->hashed_id }}"
                                                data-nomor-anggota="{{ $s->nomor_anggota }}"
                                                data-nama="{{ $s->nama }}" data-unit="{{ $s->unit }}"
                                                data-no-hp="{{ $s->no_hp }}"><i class="bi bi-pen"></i></button>
                                            <form class="deleteform"
                                                action="{{ route('simpanan.destroy', $s->hashed_id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-danger btn-sm"><i
                                                        class="bi bi-trash"></i></button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <form action="{{ route('create_simpanan') }}" method="post" accept-charset="utf-8">
                        @csrf

                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="addModalLabel">Buat Simpanan Baru</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="form-group">
                                    <label for="nama">Nama</label>
                                    <input type="text" name="nama" value="{{ old('nama') }}"
                                        class="form-control" placeholder="Nama lengkap anggota" required>
                                </div>
                                <div class="form-group">
                                    <label for="nomor_anggota">Nomor Aggota</label>
                                    <input type="text" name="nomor_anggota" value="{{ old('nomor_anggota') }}"
                                        class="form-control" placeholder="Nomor anggota" required>
                                </div>
                                <div class="row g-2">
                                    <div class="col mb-0">
                                        <label for="no_hp">No Hp</label>
                                        <input type="text" name="no_hp" value="{{ old('no_hp') }}"
                                            class="form-control" placeholder="Nomor handphone aktif" required>
                                    </div>
                                    <div class="col mb-0">
                                        <label for="unit">Unit</label>
                                        <input type="text" name="unit" value="{{ old('unit') }}"
                                            class="form-control" placeholder="Unit divisi" required>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-success">Simpan</button>
                                <button type="button" class="btn btn-secondary"
                                    data-bs-dismiss="modal">Batal</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel"
                aria-hidden="true">
                <div class="modal-dialog">
                    <form id="formEdit" action="" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="editModalLabel">Edit Data Barang</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">

                                <input type="hidden" name="id" id="edit_id">

                                <div class="mb-3">
                                    <label for="edit_nama" class="form-label">Nama</label>
                                    <input type="text" name="nama" id="edit_nama" class="form-control"
                                        placeholder="Input nama lengkap" required>
                                </div>

                                <div class="mb-3">
                                    <label for="edit_nomor_anggota" class="form-label">Nomor Anggota</label>
                                    <input type="text" name="nomor_anggota" id="edit_nomor_anggota"
                                        class="form-control" placeholder="Input nomor anggota" required>
                                </div>

                                <div class="row g-2 mb-3">
                                    <div class="col">
                                        <label for="edit_unit" class="form-label">Unit</label>
                                        <input type="text" name="unit" id="edit_unit" class="form-control"
                                            placeholder="Input unit/divisi" required>
                                    </div>
                                    <div class="col">
                                        <label for="edit_no_hp" class="form-label">No Hp</label>
                                        <input type="text" name="no_hp" id="edit_no_hp" class="form-control"
                                            placeholder="Input nomor aktif" required>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-success">Simpan</button>
                                <button type="button" class="btn btn-secondary"
                                    data-bs-dismiss="modal">Batal</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

        </section>

        </div>

    </main>

    <footer id="footer" class="footer">

        <div class="container">
            <div class="copyright text-center ">
                <p>© <span>Copyright</span> <strong class="px-1 sitename">Symphony</strong> <span>All Rights
                        Reserved</span></p>
            </div>
        </div>

    </footer>

    <!-- Scroll Top -->
    <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>

    <!-- Preloader -->
    <div id="preloader"></div>

    <!-- Vendor JS Files -->
    <script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/php-email-form/validate.js') }}"></script>
    <script src="{{ asset('assets/vendor/aos/aos.js') }}"></script>
    <script src="{{ asset('assets/vendor/glightbox/js/glightbox.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/purecounter/purecounter_vanilla.js') }}"></script>
    <script src="{{ asset('assets/vendor/swiper/swiper-bundle.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/simple-datatables/simple-datatables.js') }}"></script>
    <script src="{{ asset('assets/vendor/imagesloaded/imagesloaded.pkgd.min.js"') }}"></script>
    <script src="{{ asset('assets/vendor/isotope-layout/isotope.pkgd.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.12.0/dist/sweetalert2.all.min.js"></script>

    <!-- Main JS File -->
    <script src="{{ asset('assets/js/main.js') }}"></script>
    <script>
        $(document).ready(function() {
            $(document).on('click', '.btn-edit', function() {
                const hashedId = $(this).data('id');
                const nama = $(this).data('nama');
                const nomorAnggota = $(this).data('nomor-anggota');
                const unit = $(this).data('unit');
                const noHp = $(this).data('no-hp');

                $('#formEdit').attr('action', `/simpanan/${hashedId}`);

                $('#edit_id').val(hashedId); 
                $('#edit_nama').val(nama);
                $('#edit_nomor_anggota').val(nomorAnggota);
                $('#edit_unit').val(unit);
                $('#edit_no_hp').val(noHp);

                $('#editModal').modal('show');
            });

            const deleteForms = document.querySelectorAll('.deleteform');
            deleteForms.forEach(form => {
                form.addEventListener('submit', function(event) {
                    event.preventDefault();

                    Swal.fire({
                        title: "Apa kamu yakin?",
                        text: "Data ini akan dihapus secara permanen!!",
                        icon: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#3085d6",
                        cancelButtonColor: "#d33",
                        confirmButtonText: "Ya, saya yakin!"
                    }).then((result) => {
                        if (result.isConfirmed) {
                            this.submit();
                        }
                    });
                });
            });
        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Select the table by its ID (you added id="myDataTable" above)
            new simpleDatatables.DataTable("#myDataTable");
        });
    </script>
    <script>
        $(document).ready(function() {
            // Cek apakah ada pesan 'success' dari session
            @if (session('success'))
                Swal.fire({
                    title: 'Login Sukses!',
                    text: '{{ session('success') }}',
                    html: `
                        <img src="https://media.giphy.com/media/v1.Y2lkPWVjZjA1ZTQ3a3lobjFyYnIwbHgybG42bzQwMTJvZDFzZXhqeDJjbHBwczdkc3gzMyZlcD12MV9zdGlja2Vyc19zZWFyY2gmY3Q9cw/AQmRoVFBa1DDQeXprE/giphy.gif" 
                            width="140" style="border-radius: 10px;" alt="Success">
                        <p style="margin-top: 10px;">Selamat datang kembali 🎉</p>
                    `,
                    confirmButtonText: 'OK'
                });
            @endif
            @if (session('sukses'))
                Swal.fire({
                    title: 'Berhasil!',
                    text: '{{ session('sukses') }}',
                    icon: 'success',
                    confirmButtonText: 'OK'
                });
            @endif

            @if ($errors->any())
                Swal.fire({
                    title: 'Kesalahan!',
                    html: '@foreach ($errors->all() as $error) {{ $error }}<br> @endforeach',
                    icon: 'error',
                    confirmButtonText: 'OK'
                });
            @endif
        });
    </script>
    <script>
        $(document).ready(function() {
            document.getElementById('logout-button').addEventListener('submit', function(e) {
                e.preventDefault();

                var form = this;

                Swal.fire({
                    title: 'Apakah Anda yakin ingin keluar?',
                    html: `
                    <img src="https://media.giphy.com/media/v1.Y2lkPTc5MGI3NjExdnBieDV6Zm9qdmtocmplZmJnenBiMjc5bjV4cmFxdXFnc2VtdnR6bSZlcD12MV9naWZzX3NlYXJjaCZjdD1n/vL8jVjKkqbVh2qdFj0/giphy.gif"
                    width="140"
                    style="border-radius: 10px;"
                    alt="Logout GIF">
                    <p style="margin-top: 10px;">Sampai jumpa lagi 👋</p>`,
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya, Logout!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            });
        });
    </script>

</body>

</html>
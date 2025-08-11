<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>Detail Simpanan</title>
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
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.12.0/dist/sweetalert2.min.css">

    <!-- Main CSS File -->
    <link href="{{ asset('assets/css/main.css') }}" rel="stylesheet">

</head>

<body class="index-page">

    <header id="header" class="header d-flex align-items-center sticky-top">
        <div class="container-fluid container-xl position-relative d-flex align-items-center">

            <a href="#" class="logo d-flex align-items-center me-auto gap-1">
                <h1 class="sitename">JMB</h1>
                <img src="{{ asset('assets/img/JM.png') }}" class="img-fluid animated" alt="">
            </a>

            <nav id="navmenu" class="navmenu">

                <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
            </nav>
        </div>
    </header>

    <main class="main"><!-- /Hero Section -->

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
                                    <th>No</th>
                                    <th>Jenis Simpanan</th>
                                    <th>Jumlah Setoran</th>
                                    <th>Tanggal</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($simpanan->transaksi as $t)
                                    <tr>
                                        <td>{{ sprintf('%06d', $loop->iteration) }}</td>
                                        <td>{{ $t->jenis_simpanan }}</td>
                                        <td>{{ 'Rp. ' . number_format($t->setoran, 0, ',', '.') }}</td>
                                        <td>{{ $t->tgl }}</td>
                                        <td class="d-flex gap-1 justify-content-center align-items-center">
                                            <button class="btn btn-info btn-sm edit-btn" data-bs-toggle="modal"
                                                data-bs-target="#editModal" 
                                                data-id="{{ $t->hashed_id }}"
                                                data-jenis-simpanan="{{ $t->jenis_simpanan }}"
                                                data-setoran="{{ $t->setoran }}" 
                                                data-tanggal="{{ $t->tanggal }}">
                                                <i class="bi bi-pen"></i>
                                            </button>
                                            <form class="deleteform"
                                                action="{{ route('transaksi.destroy', $t->hashed_id) }}"
                                                method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm"><i
                                                        class="bi bi-trash"></i></button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center">Tidak ada data transaksi.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                        <div class="justify-content-between d-flex align-items-center mb-3">
                            <a href="{{ route('simpan.index') }}" type="button" class="btn btn-secondary">Kembali</a>
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <h7>Total Simpanan:
                                    <span class="text-success fw-bold">
                                        {{ 'Rp. ' . number_format($totalSetoran, 0, ',', '.') }}
                                    </span>
                                </h7>
                            </div>
                        </div>
                        <div class="d-flex">
                            <a href="{{ route('transaksi.pdf', ['hashed_id' => $simpanan->hashed_id]) }}"
                                class="btn btn-success btn-sm ms-auto">
                                <i class="bi bi-filetype-pdf"></i> PDF
                            </a>
                        </div>
                    </div>
                </div>

                <div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="addModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog">
                        <form action="{{ route('transaksi.create', ['hashed_id' => $simpanan->hashed_id]) }}"
                            method="post" accept-charset="utf-8">
                            @csrf
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="addModalLabel">Tambah Simpanan Baru</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <input type="hidden" name="id_simpanan" value="{{ $simpanan->id }}">
                                <div class="modal-body">
                                    <div class="row g-2">
                                        <div class="col mb-0">
                                            <label for="jenis_simpanan">Jenis Simpanan</label>
                                            <input type="text" name="jenis_simpanan" value=""
                                                class="form-control" placeholder="Jenis Simpanan" required>
                                        </div>
                                    </div>
                                    <div class="row g-2">
                                        <div class="col mb-0">
                                            <label for="tanggal">Tanggal</label>
                                            <input type="date" name="tgl" value="" class="form-control"
                                                required>
                                        </div>
                                        <div class="col mb-0">
                                            <label for="unit">Jumlah Setoran</label>
                                            <input type="number" name="setoran" value="" class="form-control"
                                                placeholder="Jumlah setoran" required>
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
                                    <h5 class="modal-title" id="editModalLabel">Edit Simpanan</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">

                                    <input type="hidden" name="id" id="edit_id">

                                    <div class="form-group">
                                        <label for="edit_jenis_simpanan" class="form-label">Jenis Simpanan</label>
                                        <input type="text" name="jenis_simpanan" id="edit_jenis_simpanan"
                                            class="form-control" placeholder="Input Jenis simpanan" required>
                                    </div>

                                    <div class="row g-2 ">
                                        <div class="col">

                                            <label for="edit_setoran" class="form-label">Jumlah Setor</label>
                                            <input type="text" name="setoran" id="edit_setoran"
                                                class="form-control" placeholder="Input Jumlah Simpanan" required>
                                        </div>
                                        <div class="col">
                                            <label for="edit_tanggal" class="form-label">Tanggal</label>
                                            <input type="date" name="tanggal" id="edit_tanggal"
                                                class="form-control" placeholder="Input Jumlah setoran" required>
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
                const hashedId      = $(this).data('id');
                const jeniSimpanan  = $(this).data('jenis-simpanan');
                const jumlahSetor   = $(this).data('setoran');
                const tanggal       = $(this).data('tanggal');

                $('#formEdit').attr('action', '');

                $('#edit_id').val(hashedId);
                $('#edit_jenis_simpanan').val(jeniSimpanan);
                $('#edit_setoran').val(jumlahSetor);
                $('#tanggal').val(tanggal);

                $('#modal').modal('show');
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

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
                        <h3 class="card-title text-center mb-0 flex-grow-1">Jenis Simpanan</h3>
                        <button class="btn btn-outline-primary" style="border-radius: 50%; font-size: 20px;"
                            data-bs-toggle="modal" data-bs-target="#addModal"><i class="bi bi-plus"></i></button>
                    </div>
                    <div class="card-body">
                        <table class="table datatable" id="myDataTable">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Jenis Simpanan</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($jenis as $j)
                                    <tr>
                                        <td>{{ sprintf('%02d', $loop->iteration) }}</td>
                                        <td>{{ $j->jenis }}</td>
                                        <td class="d-flex gap-1 justify-content-center align-items-center">
                                            <button class="btn btn-info btn-sm btn-edit" data-bs-toggle="modal"
                                                data-bs-target="#editModal" 
                                                data-id="{{ $j->hashed_id }}"
                                                data-jenis="{{ $j->jenis }}"><i class="bi bi-pen"></i></button>
                                            <form class="deleteform"
                                                action="{{ route('jenis.delete', $j->hashed_id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-danger btn-sm"><i
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
                            <button onclick="location.href='{{ route('simpan.index') }}'" class="btn btn-secondary">Kembali</button>
                    </div>
                </div>
            </div>

            <div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <form action="{{ route('jenis.create') }}" method="post" accept-charset="utf-8">
                        @csrf
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="addModalLabel">Tambah Simpanan Baru</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="form-group">
                                    <label for="jenis">Jenis Simpanan</label>
                                    <input type="text" name="jenis" value=""
                                        class="form-control" placeholder="Masukkan Jenis Simpanan" required>
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
                                <h5 class="modal-title" id="editModalLabel">Edit Jenis Simpanan</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <input type="hidden" name="id" id="edit_id">
                                <div class="form-group">
                                    <label for="edit_jenis" class="form-label">Jenis Simpanan</label>
                                    <input type="text" name="jenis" id="edit_jenis" class="form-control" required>
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
                const jenis = $(this).data('jenis');

                $('#formEdit').attr('action', /jenis-simpanan/${hashedId});

                $('#edit_id').val(hashedId);
                $('#edit_jenis').val(jenis);

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

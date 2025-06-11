@extends('layouts.app')

@section('content')
<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card shadow-sm border-0">
                <div class="card-body">
                    <h3 class="mb-4">Hubungi Kami</h3>

                    <form method="POST" action="#">
                        @csrf
                        <div class="mb-3">
                            <label for="name" class="form-label">Nama</label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="Nama Anda" required>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email" placeholder="Email Anda" required>
                        </div>
                        <div class="mb-3">
                            <label for="message" class="form-label">Pesan</label>
                            <textarea class="form-control" id="message" name="message" rows="5" placeholder="Tulis pesan Anda..." required></textarea>
                        </div>
                        <button type="submit" class="btn btn-success">
                            <i class="bi bi-send"></i> Kirim Pesan
                        </button>
                    </form>
                </div>
            </div>

            <div class="mt-4 text-center text-muted">
                <p><i class="bi bi-geo-alt me-1"></i>SMKN 8 Jakarta</p>
                <p><i class="bi bi-envelope me-1"></i>laxiva@gmail.com</p>
                <p><i class="bi bi-telephone me-1"></i>No Handphone</p>
            </div>
        </div>
    </div>
</div>
@endsection

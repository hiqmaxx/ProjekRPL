@extends('layouts.app')

@section('content')
<div class="container mb-5">
    <div class="row justify-content-center">
        <div class="col-md-10 col-lg-8">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-success text-white fw-semibold">
                    <i class="bi bi-cart-check me-1"></i> Pesan Makanan
                </div>
                <div class="card-body">

                    <form method="POST" action="{{ route('order.place') }}" enctype="multipart/form-data">
                        @csrf

                        {{-- Makanan --}}
                        <div class="mb-4">
                            <label class="form-label fw-bold">Pilih Makanan</label>
                            @foreach($foods as $food)
                                <div class="border rounded p-3 mb-3 shadow-sm bg-light">
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input food-checkbox" name="food_ids[]" value="{{ $food->id }}"
                                               id="food-{{ $food->id }}" onchange="toggleQty({{ $food->id }}); updateQRIS();"
                                               data-name="{{ strtolower($food->name) }}">
                                        <label class="form-check-label fw-semibold" for="food-{{ $food->id }}">
                                            {{ $food->name }} - Rp{{ number_format($food->price, 0, ',', '.') }}
                                        </label>
                                    </div>
                                    <div class="ms-4 mt-2">
                                        <small class="text-muted">{{ $food->description ?? 'Tidak ada deskripsi.' }}</small>
                                        <input type="number" name="quantities[]" id="qty-{{ $food->id }}"
                                               class="form-control mt-2" placeholder="Jumlah" min="1" disabled>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        {{-- QRIS Dinamis --}}
                        <div class="mb-4">
                            <label class="form-label fw-bold">QRIS untuk Pembayaran</label>
                            <div id="qris-container" class="row g-3 justify-content-center mb-3">
                                {{-- Akan diisi oleh JavaScript --}}
                            </div>

                            {{-- Hidden input qris_type[] --}}
                            <input type="hidden" name="qris_type" id="qris_type">

                            {{-- Upload Bukti --}}
                            <label for="qris_image" class="form-label">Upload Bukti Pembayaran</label>
                            <input type="file" name="qris_image" id="qris_image"
                                   class="form-control @error('qris_image') is-invalid @enderror" required>
                            @error('qris_image')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Submit --}}
                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn btn-success">
                                <i class="bi bi-send-check me-1"></i> Kirim Pesanan
                            </button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>

{{-- Scripts --}}
<script>
    function toggleQty(id) {
        const checkbox = document.getElementById(`food-${id}`);
        const qtyInput = document.getElementById(`qty-${id}`);
        qtyInput.disabled = !checkbox.checked;
        if (!checkbox.checked) qtyInput.value = '';
    }

    function updateQRIS() {
        const checkboxes = document.querySelectorAll('.food-checkbox');
        const qrisContainer = document.getElementById('qris-container');
        const qrisTypeInput = document.getElementById('qris_type');

        // Reset
        qrisContainer.innerHTML = '';
        let selectedTypes = [];

        checkboxes.forEach(checkbox => {
            if (checkbox.checked) {
                const name = checkbox.dataset.name;
                if (name.includes('laksa') && !selectedTypes.includes('laksa')) {
                    selectedTypes.push('laksa');
                    qrisContainer.innerHTML += `
                        <div class="col-6 col-sm-5 text-center">
                            <img src="{{ asset('storage/qris.jpg') }}" alt="QRIS Laksa" class="img-fluid rounded shadow-sm">
                            <p class="small mt-2 fw-medium">QRIS Laksa</p>
                        </div>
                    `;
                }
                if (name.includes('asinan') && !selectedTypes.includes('asinan')) {
                    selectedTypes.push('asinan');
                    qrisContainer.innerHTML += `
                        <div class="col-6 col-sm-5 text-center">
                            <img src="{{ asset('storage/qris asinan.png') }}" alt="QRIS Asinan" class="img-fluid rounded shadow-sm">
                            <p class="small mt-2 fw-medium">QRIS Asinan</p>
                        </div>
                    `;
                }
            }
        });

        // Simpan jenis QRIS yang dipilih (misal ["laksa", "asinan"])
        qrisTypeInput.value = selectedTypes.join(',');
    }
</script>
@endsection

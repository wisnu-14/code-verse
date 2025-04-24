@extends('layouts.admin')
@section('title', 'Request')
@section('custom-css-admin-page')
    <link rel="stylesheet" href="{{ asset('css/admin/request.css') }}">
@endsection
@section('custom-js-admin-page')
    <script src="{{ asset('js/admin/.js') }}"></script>
@endsection
@section('adminContent')
    @if (session('success'))
        <div class="toast-container position-fixed bottom-0 end-0 p-3 ">
            <div class="toast show" id="successToast" role="alert" aria-live="assertive" aria-atomic="true">
                <div class="toast-header">
                    <img src="{{ asset('image/assets/logo/code-verse.png') }}" class="rounded me-2" alt="..."
                        width="20px">
                    <strong class="me-auto">Notifikasi</strong>
                    <small>Baru Saja</small>
                    <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
                <div class="toast-body text-dark">
                    {{ session('success') }}
                    <div class="loading-bar"></div>
                </div>
            </div>
        </div>
    @endif
    @if (session('error'))
        <div class="toast-container position-fixed bottom-0 end-0 p-3 ">
            <div class="toast show" id="successToast" role="alert" aria-live="assertive" aria-atomic="true">
                <div class="toast-header">
                    <img src="{{ asset('image/assets/logo/code-verse.png') }}" class="rounded me-2" alt="..."
                        width="20px">
                    <strong class="me-auto">Notifikasi</strong>
                    <small>Baru Saja</small>
                    <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
                <div class="toast-body">
                    {{ session('error') }}
                    <div class="loading-bar"></div>
                </div>
            </div>
        </div>
    @endif
    <div class="container-fluid">
        <h3 class="text-white">Daftar Request Materi</h3>
        <div class="container-fluid card-message">
            @if ($requests->count() > 0)
                <div class="row">
                    @foreach ($requests as $request)
                        <div class="col-md-6 col-lg-4 mb-4 mt-5">
                            <div class="card shadow-sm h-100">
                                <div class="card-body d-flex flex-column">
                                    <h5 class="card-title">{{ $request->name }}</h5>
                                    <div class="border mb-2"></div>
                                    <h6 class="card-subtitle text-muted mb-2">{{ $request->email ?? 'Tidak ada email' }}
                                    </h6>
                                    <!-- Konten pesan -->
                                    <p class="card-text message-box" id="message-{{ $loop->index }}">
                                        {{ Str::limit($request->message, 100, '...') }}
                                    </p>
                                    @if (strlen($request->message) > 100)
                                        <button class="btn btn-link p-0 text-primary"
                                            onclick="toggleMessage({{ $loop->index }}, '{{ $request->message }}')">
                                            Lihat Selengkapnya
                                        </button>
                                    @endif
                                </div>
                                <div class="card-footer bg-light d-flex justify-content-between align-items-center">
                                    <small class="text-muted">
                                        {{ $request->created_at->format('d F Y, H:i') ?? 'Waktu tidak tersedia' }}
                                    </small>
                                </div>
                            </div>
                            <button type="button" class="text-white btn-hapus" data-bs-toggle="modal"
                                data-bs-target="#confirmDeleteModal"
                                onclick="setDeleteForm('{{ route('requests.destroy', $request->id) }}')">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                    class="bi bi-trash-fill" viewBox="0 0 16 16">
                                    <path
                                        d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5M8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5m3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0" />
                                </svg>
                            </button>
                        </div>
                    @endforeach
                </div>
                <!-- Modal Konfirmasi -->
                <div class="modal fade" id="confirmDeleteModal" tabindex="-1" aria-labelledby="confirmDeleteModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header text-white">
                                <h5 class="modal-title" id="confirmDeleteModalLabel">Konfirmasi Penghapusan</h5>
                                <button type="button" class="btn-close " data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                Apakah Anda yakin ingin menghapus request ini?
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                <form id="deleteForm" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-hapus-modal">Hapus</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="d-flex justify-content-center mt-4">
                    {{ $requests->links('pagination::bootstrap-5') }}
                </div>
            @else
                <p class="text-center">Belum ada permintaan materi.</p>
            @endif
        </div>
    </div>
    <script>
        function toggleMessage(index, fullMessage) {
            const messageBox = document.getElementById(`message-${index}`);
            const isExpanded = messageBox.dataset.expanded === "true";

            if (isExpanded) {
                // Sembunyikan kembali pesan
                messageBox.textContent = fullMessage.substring(0, 100) + "...";
                messageBox.dataset.expanded = "false";
            } else {
                // Tampilkan pesan lengkap
                messageBox.textContent = fullMessage;
                messageBox.dataset.expanded = "true";
            }
        }
    </script>
    <script>
        function setDeleteForm(action) {
            // Set form action di modal
            const form = document.getElementById('deleteForm');
            form.action = action;
        }
    </script>

@endsection

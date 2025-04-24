@extends('layouts.admin')
@section('title', 'List Users')
@section('custom-css-admin-page')
    <link rel="stylesheet" href="{{ asset('css/admin/userList.css') }}">
@endsection
@section('custom-js-admin-page')
    <script src="{{ asset('js/admin/user.js') }}"></script>
@endsection
@section('adminContent')
  <div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="table-container rounded-3 p-3">
                <h3 class="table-title text-white mb-4">Users Authenticated</h3>
                <div class="table-responsive">
                    <table id="visitorTable" class="table table-striped table-dark table-hover w-100 py-3">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Name</th>
                                <th>Id User</th>
                                <th>Email</th>
                                <th>Created At</th>
                                <th>Updated At</th>
                                <th class="text-end action">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $index => $user)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>
                                        <img src="{{ asset('image/public/default-avatar.png') }}" alt="Profile Picture"
                                            class="rounded-circle me-2" width="50">
                                        {{ $user->name }}
                                    </td>
                                    <td>{{ ucfirst($user->role) }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->created_at->format('d-m-Y') }}</td>
                                    <td>{{ $user->updated_at->format('d-m-Y') }}</td>
                                    <td class="text-end">
                                        <button class="btn action-btn" data-bs-toggle="tooltip" data-bs-placement="top"
                                            title="Delete">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                fill="#A02334" class="bi bi-trash-fill" viewBox="0 0 16 16">
                                                <path
                                                    d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5M8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5m3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0" />
                                            </svg>
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
  </div>
@endsection

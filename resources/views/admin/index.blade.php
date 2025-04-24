@extends('layouts.admin')
@section('title','Dashboard')
@section('custom-css-admin-page')
    <link rel="stylesheet" href="{{ asset('css/admin/dashboard.css') }}">
@endsection
@section('custom-js-admin-page')
    <script src="{{ asset('js/admin/dashboard.js') }}"></script>
@endsection
@section('adminContent')
<div class="container-fluid">
    <h3 class="h3 mb-5 text-white">Dashboard</h3>
    <div class="mb-3 border-bottom pb-5">
        <div class="container">
            <div class="row gy-4">
                <!-- Card 1: Authenticated User -->
                <div class="col-md-4 col-sm-6">
                    <div class="card card-ath-user card-content h-100">
                        <div class="card-header card-header-ath-user border-grey text-center">Authenticated User</div>
                        <div class="card-body">
                            <div class="card-text">
                                <div class="card-text-inside-ath-user">
                                    <p>100</p>
                                </div>
                                <div class="card-logo ath-user">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" fill="#FF9D3D" class="bi bi-person-fill-check" viewBox="0 0 16 16">
                                        <path d="M12.5 16a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7m1.679-4.493-1.335 2.226a.75.75 0 0 1-1.174.144l-.774-.773a.5.5 0 0 1 .708-.708l.547.548 1.17-1.951a.5.5 0 1 1 .858.514M11 5a3 3 0 1 1-6 0 3 3 0 0 1 6 0" />
                                        <path d="M2 13c0 1 1 1 1 1h5.256A4.5 4.5 0 0 1 8 12.5a4.5 4.5 0 0 1 1.544-3.393Q8.844 9.002 8 9c-5 0-6 3-6 4" />
                                    </svg>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer bg-transparent border-grey">
                            <small> Update at 10-November-2024 </small>
                        </div>
                    </div>
                </div>

                <!-- Card 2: Material Authors -->
                <div class="col-md-4 col-sm-6">
                    <div class="card card-m-authors card-content h-100">
                        <div class="card-header card-header-m-authors bborder-grey text-center">Material Authors</div>
                        <div class="card-body">
                            <div class="card-text">
                                <div class="card-text-inside-m-authors">
                                    <p>100</p>
                                </div>
                                <div class="card-logo m-authors">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" fill="#c03333" class="bi bi-person-lines-fill" viewBox="0 0 16 16">
                                        <path d="M6 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6m-5 6s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1zM11 3.5a.5.5 0 0 1 .5-.5h4a.5.5 0 0 1 0 1h-4a.5.5 0 0 1-.5-.5m.5 2.5a.5.5 0 0 0 0 1h4a.5.5 0 0 0 0-1zm2 3a.5.5 0 0 0 0 1h2a.5.5 0 0 0 0-1zm0 3a.5.5 0 0 0 0 1h2a.5.5 0 0 0 0-1z"/>
                                    </svg>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer bg-transparent border-grey">
                            <small> Update at 10-November-2024 </small>
                        </div>
                    </div>
                </div>

                <!-- Card 3: Materi Available -->
                <div class="col-md-4 col-sm-6">
                    <div class="card card-avb-materi card-content h-100">
                        <div class="card-header card-header-avb-materi border-grey text-center">Materi Available</div>
                        <div class="card-body">
                            <div class="card-text">
                                <div class="card-text-inside-avb-materi">
                                    <p>{{ $materiCount }}</p>
                                </div>
                                <div class="card-logo card-logo-avb-materi">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="45" height="45" fill="#c0b432" class="bi bi-calendar2-check-fill" viewBox="0 0 16 16">
                                        <path d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5m9.954 3H2.545c-.3 0-.545.224-.545.5v1c0 .276.244.5.545.5h10.91c.3 0 .545-.224.545-.5v-1c0-.276-.244-.5-.546-.5m-2.6 5.854a.5.5 0 0 0-.708-.708L7.5 10.793 6.354 9.646a.5.5 0 1 0-.708.708l1.5 1.5a.5.5 0 0 0 .708 0z"/>
                                    </svg>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer bg-transparent border-grey">
                            <small> Update at 10-November-2024 </small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid container-fluid-chart">
        <div class="row">
            <!-- Materi Distribution Chart -->
            <div class="col-lg-4 col-md-12 mb-4 d-flex justify-content-center">
                <div class="chart-container shadow-lg rounded-3 p-5">
                    <h3 class="text-center pb-4">Materi Distribution</h3>
                    <canvas id="materiChart" width="400" height="250"></canvas>
                </div>
            </div>

            <!-- Materi Views Chart -->
            <div class="col-lg-4 col-md-12 mb-4 d-flex justify-content-center">
                <div class="chart-container-custom shadow-lg rounded-3 p-5">
                    <h3 class="text-center pb-4">Materi Views</h3>
                    <canvas id="materiPieChart" width="400" height="250"></canvas>
                </div>
            </div>

            <!-- Website Visitor Chart -->
            <div class="col-lg-4 col-md-12 mb-4 d-flex justify-content-center">
                <div class="line-chart-container shadow-lg rounded-3 p-5">
                    <h3 class="text-center pb-4">Web Visitor</h3>
                    <canvas id="visitorLineChart" width="400" height="400"></canvas>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="table-container shadow-lg rounded-3 p-3">
                    <h3 class="table-title mb-4">Admin Lists</h3>
                    <div class="table-responsive">
                        <table id="visitorTable" class="table table-striped table-dark table-hover w-100 py-3">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Name</th>
                                    <th>Id User</th>
                                    <th>Email</th>
                                    <th class="text-end action">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($users as $key => $user)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>
                                        <img src="{{asset('image/public/default-avatar.png') }}" alt="profile picture" class="rounded-circle me-2" width="50">
                                        {{ $user->name }}
                                    </td>
                                    <td>{{ $user->id }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td class="text-end">
                                        <button class="btn action-btn" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="white" class="bi bi-pencil-fill" viewBox="0 0 16 16">
                                                <path d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.5.5 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11z"/>
                                            </svg>
                                        </button>
                                        <button class="btn action-btn" data-bs-toggle="tooltip" data-bs-placement="top" title="Delete">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="#A02334" class="bi bi-trash-fill" viewBox="0 0 16 16">
                                                <path d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5M8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5m3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0"/>
                                            </svg>
                                        </button>
                                    </td>
                                </tr>
                                @empty
                                @endforelse
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
const data = @json($data);
const viewsData = @json($views);
const visitorsData = @json($visitors);

</script>
@endsection

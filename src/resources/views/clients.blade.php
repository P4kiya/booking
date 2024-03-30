@extends('layouts.layout')

@section('content')
    <div class="page-wrapper">
        <div class="content container-fluid">


            <div class="page-header">
                <div class="row align-items-center">
                    <div class="colEmpty">
                        <h3 class="page-title">Client</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="/">Dashboard</a>
                            </li>
                            <li class="breadcrumb-item active">Client</li>
                        </ul>
                    </div>
                    <div class="col-auto">
                        <a href="{{ route('add_client') }}" class="btn btn-primary me-1">
                            <i class="fas fa-plus"></i>
                        </a>
                    </div>
                </div>
            </div>


            <div class="row">
                <div class="col s12">

                    <div class="card card-table">
                        <div class="card-body">
                            <div class="responsive-table">
                                <table class="table table-center table-hover datatable">
                                    <thead class="thead-light">
                                        <tr>
                                            <th>Client</th>
                                            <th>Email</th>
                                            <th>Telephone</th>
                                            <th>Genre </th>
                                            <th>Registere le</th>
                                            <th class="right-align">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        @foreach ($clients as $client)
                                            <tr>
                                                <td>
                                                    <h2 class="table-avatar">

                                                        <a href="/profile/{{ $client->id }}"
                                                            class="avatar avatar-sm me-2">
                                                            <img class="avatar-img rounded-circle"
                                                                src="assets/img/profiles/avatar-02.jpg" alt="User Image">
                                                        </a>

                                                        <a href="/profile/{{ $client->id }}">{{ $client->nom }}
                                                            <span>{{ $client->cnie }}</span>
                                                        </a>
                                                    </h2>
                                                </td>
                                                <td>{{ $client->email }}</td>
                                                <td>{{ $client->phone }}</td>
                                                <td>{{ $client->gendre }}</td>
                                                <td>{{ $client->created_at->format('d M Y') }}</td>
                                                <td class="right-align">
                                                    <a href=" {{ route('edit_client', $client->id) }}"
                                                        class="btn btn-sm btn-white text-success me-2">
                                                        <i class="far fa-edit me-1"></i> Edit
                                                    </a>

                                                    <a href="{{ route('delete_client', $client->id) }}"
                                                        class="btn btn-sm btn-white text-danger me-2">
                                                        <i class="far fa-trash-alt me-1"></i>Delete
                                                    </a>
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
        </div>
    </div>
@endsection

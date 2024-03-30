@extends('layouts.layout')

@section('content')
    <div class="page-wrapper">
        <div class="content container-fluid">

            <!-- Page Header -->
            <div class="page-header">
                <div class="row">
                    <div class="col s12">
                        <h3 class="page-title">Client</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="/">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="/clients">Client</a></li>
                            <li class="breadcrumb-item active">Modifier Client</li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- /Page Header -->

            <div class="row">
                <div class="col s12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Basic Info</h4>
                            <form method="post" action="{{ route('updateClient', $client->id)}}">
                                @csrf
                                <div class="row">
                                    <div class="col s12 m6">
                                        <div class="form-group">
                                            <label>Nom</label>
                                            <input type="text" name="nom" value="{{ $client->nom }}" class="form-control">
                                            
                                        </div>
                                        <div class="form-group">
                                            <label>Email</label>
                                            <input type="email" name="email" value="{{ $client->email }}" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col s12 m6">
                                        <div class="form-group">
                                            <label>Prenom</label>
                                            <input type="text" name="prenom" value="{{ $client->prenom }}" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label>Phone</label>
                                            <input type="text" name="phone" value="{{ $client->phone }}" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col s12 m6">
                                        <div class="form-group">
                                            <label>Gender</label>
                                            <select class="select" name="gendre">
                                                <option {{ $client->gendre == 'Male' ? 'selected' : '' }}>Male</option>
                                                <option {{ $client->gendre == 'Female' ? 'selected' : '' }}>Female</option>
                                            </select>
                                        </div>

                                    </div>
                                    <div class="col s12 m6">
                                        <div class="form-group">
                                            <label>CNIE</label>
                                            <input type="text" name="cnie" value="{{ $client->cnie }}" class="form-control">
                                        </div>
                                    </div>

                                </div>
                                <h4 class="card-title mt-4">Address</h4>
                                <div class="row">
                                    <div class="col s12 m6">
                                        <div class="form-group">
                                            <label>Pays</label>
                                            <input type="text" name="pays" value="{{ $client->pays }}" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label>La region</label>
                                            <input type="text" name="region" value="{{ $client->region }}" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col s12 m6">
                                        <div class="form-group">
                                            <label>La ville</label>
                                            <input type="text" name="ville" value="{{ $client->ville }}" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label>Code Postal</label>
                                            <input type="text" name="code_postal" value="{{ $client->code_postal }}" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="right-align mt-4">
                                    <button type="submit" class="btn btn-primary">Modifier</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

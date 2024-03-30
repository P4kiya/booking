@extends('layouts.layout')

@section('content')
    <div class="page-wrapper">
        <div class="content container-fluid">
            <div class="page-header">
                <div class="row">
                    <div class="col s12">
                        <h3 class="page-title">Appartements</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="/">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="/appartements">Appartements</a></li>
                            <li class="breadcrumb-item active">Modifie appartement</li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col s12 xl8 offset-xl2">
                    <form method="post" action="{{ route('updateAppartement', $appartement->id)}}" enctype="multipart/form-data">
                        @csrf
                        <div class="card">
                            <div class="card-body">
                                <div class="bank-inner-details">
                                    <div class="row">
                                        <div class="col s12 l12 m12">
                                            <div class="form-group">
                                                <label>Appartement Image</label>
                                                <div class="change-photo-btn">
                                                    <div>
                                                        <p>Modifie Image</p>
                                                    </div>
                                                    <input type="file" value="{{ $appartement->img }}" class="upload"  name="img">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col s12 l12 m12">
                                            <div class="form-group">
                                                <label>Prix haut season<span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" name="prix_haut" value="{{ number_format($appartement->prix_haut, 0, '.', '') }}">
                                            </div>
                                        </div>
                                        <div class="col s12 l12 m12">
                                            <div class="form-group">
                                                <label>Prix basse season<span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" name="prix_bas" value="{{ number_format($appartement->prix_bas, 0, '.', '') }}">
                                            </div>
                                        </div>
                                        <div class="col s12 l12 m12">
                                            <div class="form-group">
                                                <label>Numero d'appartement<span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" name="numero_appartement" value="{{ $appartement->numero_appartement }}">
                                            </div>
                                        </div>
                                        <div class="col s12 l12 m12">
                                            <div class="form-group modal-select-box">
                                                <label>Etage</label>
                                                <select class="select" name="etage">
                                                    <option {{ $appartement->etage == 1 ? 'selected' : '' }}>1</option>
                                                    <option {{ $appartement->etage == 2 ? 'selected' : '' }}>2</option>
                                                    <option {{ $appartement->etage == 3 ? 'selected' : '' }}>3</option>
                                                    <option {{ $appartement->etage == 4 ? 'selected' : '' }}>4</option>
                                                    <option {{ $appartement->etage == 5 ? 'selected' : '' }}>5</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col s12 l12 m12">
                                            <div class="form-group">
                                                <label>Nombre de chambre<span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" name="nombre_chambre" value="{{ $appartement->nombre_chambre }}">
                                            </div>
                                        </div>
                                        <div class="col s12 l12 m12">
                                            <div class="form-group">
                                                <label>Capacite d'appartement<span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" name="capacite_appartement" value="{{ $appartement->capacite_appartement }}">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class=" blog-categories-btn pt-0">
                                <div class="bank-details-btn ">
                                    <button name="submit" class="btn btn-primary me-2">Modifier</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

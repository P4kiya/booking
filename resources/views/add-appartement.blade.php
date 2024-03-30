@extends('layouts.layout')

@section('content')
    <div class="page-wrapper">
        <div class="content container-fluid">

            <!-- Page Header -->
            <div class="page-header">
                <div class="row">
                    <div class="col s12">
                        <h3 class="page-title"><a href="/appartements" style="color: black">Appartements</a></h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="/">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="/appartements">Appartements</a></li>
                            <li class="breadcrumb-item active">Ajoute appartement</li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- /Page Header -->

            <div class="row">
                <div class="col s12 xl8 offset-xl2">
                    <div class="alert alert-danger alert-dismissible fade show" role="alert" id="alertDiv"
                        style="display: none;">
                        <strong>Error !</strong>
                        <a type="button" class="btn-close modal-close" data-bs-dismiss="alert" aria-label="Close"
                            onclick="hideAlert()"></a>
                    </div>
                </div>
                <div class="col s12 xl8 offset-xl2">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Appartement Info</h4>
                            <form id="appartementForm" method="POST" action="{{ route('storeaAppartement') }}"
                                enctype="multipart/form-data" onsubmit="validateForm()">
                                @csrf
                                <div class="row">
                                    <div>
                                        <div class="form-group">
                                            <label>Appartement Image</label>
                                            <div class="change-photo-btn">
                                                <div>
                                                    <p>Add Image</p>
                                                </div>
                                                <input type="file" class="upload" name="img">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>Prix haut season<span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" name="prix_haut"
                                                oninput="resetBorderColor(this)">
                                        </div>
                                        <div class="form-group">
                                            <label>Prix basse season<span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" name="prix_bas"
                                                oninput="resetBorderColor(this)">
                                        </div>
                                        <div class="form-group">
                                            <label>Numero d'appartement<span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" name="numero_appartement"
                                                oninput="resetBorderColor(this)">
                                        </div>

                                        <div class="form-group modal-select-box">
                                            <label>Etage<span class="text-danger">*</span></label>
                                            <select class="select" name="etage">
                                                <option value="1">1</option>
                                                <option value="2">2</option>
                                                <option value="3">3</option>
                                                <option value="4">4</option>
                                                <option value="5">5</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Nombre de chambre<span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" name="nombre_chambre"
                                                oninput="resetBorderColor(this)">
                                        </div>
                                        <div class="form-group">
                                            <label>Capacite d'appartement<span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" name="capacite_appartement"
                                                oninput="resetBorderColor(this)">
                                        </div>
                                    </div>
                                </div>
                                <div class="right-align mt-4">
                                    <button type="submit" name="submit" class="btn btn-primary">Ajoute</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <script>
                document.getElementById('appartementForm').addEventListener('submit', function(event) {
                    let inputs = Array.from(this.getElementsByTagName('input'));
                    let emptyFields = inputs.filter(input => input.name !== 'img').some(input => input.value === '');
                    if (emptyFields) {
                        event.preventDefault();
                        let alertDiv = document.querySelector('#alertDiv');
                        alertDiv.style.display = 'block';
                        alertDiv.querySelector('strong').textContent = 'Error! Please Complete this form .';
                    }
                });

                function hideAlert() {
                    document.getElementById('alertDiv').style.display = 'none';
                }

                function validateForm() {
                    let inputs = Array.from(document.getElementById('appartementForm').getElementsByTagName('input'));
                    inputs.filter(input => input.name !== 'img').forEach(input => {
                        if (input.value == '') {
                            input.style.border = '1px solid red';
                        }
                    });
                }

                function resetBorderColor(input) {
                    if (input.value != '') {
                        input.style.border = '1px solid #ced4da';
                    }
                }
            </script>
        @endsection

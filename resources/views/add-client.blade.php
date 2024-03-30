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
                            <li class="breadcrumb-item active">Ajoute Client</li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- /Page Header -->


            <div class="alert alert-danger alert-dismissible fade show" role="alert" id="alertDiv" style="display: none;">
                <strong>Error !</strong>
                <a type="button" class="btn-close modal-close" data-bs-dismiss="alert" aria-label="Close" onclick="hideAlert()"></a>
            </div>

            <div class="row">
                <div class="col s12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Basic Info</h4>
                            <form id="clientForm" method="POST" action="{{ route('storeClient') }}"
                                onsubmit="validateForm()">
                                @csrf
                                <div class="row">
                                    <div class="col s12 m6">
                                        <div class="form-group">
                                            <label>Nom<span class="text-danger">*</span></label>
                                            <input type="text" name="nom" class="form-control"
                                                oninput="resetBorderColor(this)">
                                        </div>
                                        <div class="form-group">
                                            <label>Email<span class="text-danger">*</span></label>
                                            <input type="email" name="email" class="form-control"
                                                oninput="resetBorderColor(this)">
                                        </div>
                                    </div>
                                    <div class="col s12 m6">
                                        <div class="form-group">
                                            <label>Prenom<span class="text-danger">*</span></label>
                                            <input type="text" name="prenom" class="form-control"
                                                oninput="resetBorderColor(this)">
                                        </div>
                                        <div class="form-group">
                                            <label>Phone<span class="text-danger">*</span></label>
                                            <input type="text" name="phone" class="form-control"
                                                oninput="resetBorderColor(this)">
                                        </div>
                                    </div>
                                    <div class="col s12 m6">
                                        <div class="form-group">
                                            <label>Gender<span class="text-danger">*</span></label>
                                            <select class="select" name="gendre">
                                                <option selected>Male</option>
                                                <option>Femalle</option>
                                            </select>
                                        </div>

                                    </div>
                                    <div class="col s12 m6">
                                        <div class="form-group">
                                            <label>CNIE<span class="text-danger">*</span></label>
                                            <input type="text" name="cnie" class="form-control"
                                                oninput="resetBorderColor(this)">
                                        </div>
                                    </div>
                                </div>
                                <h4 class="card-title mt-4">Address</h4>
                                <div class="row">
                                    <div class="col s12 m6">
                                        <div class="form-group">
                                            <label>Pays<span class="text-danger">*</span></label>
                                            <input type="text" name="pays" class="form-control"
                                                oninput="resetBorderColor(this)">
                                        </div>
                                        <div class="form-group">
                                            <label>La region<span class="text-danger">*</span></label>
                                            <input type="text" name="region" class="form-control"
                                                oninput="resetBorderColor(this)">
                                        </div>
                                    </div>
                                    <div class="col s12 m6">
                                        <div class="form-group">
                                            <label>La ville<span class="text-danger">*</span></label>
                                            <input type="text" name="ville" class="form-control"
                                                oninput="resetBorderColor(this)">
                                        </div>
                                        <div class="form-group">
                                            <label>Code Postal<span class="text-danger">*</span></label>
                                            <input type="text" name="code_postal" class="form-control"
                                                oninput="resetBorderColor(this)">
                                        </div>
                                    </div>
                                    <input type="text" name="status" value="active" style="display: none">
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
                document.getElementById('clientForm').addEventListener('submit', function(event) {
                    var inputs = this.getElementsByTagName('input');
                    var emptyFields = Array.from(inputs).some(input => input.value === '');
                    if (emptyFields) {
                        event.preventDefault();
                        var alertDiv = document.querySelector('#alertDiv');
                        alertDiv.style.display = 'block';
                        alertDiv.querySelector('strong').textContent = 'Error! Please Complete this form .';
                    }
                });

                function hideAlert() {
                    document.getElementById('alertDiv').style.display = 'none';
                }
                function validateForm() {
                    var inputs = document.getElementById('clientForm').getElementsByTagName('input');
                    for (var i = 0; i < inputs.length; i++) {
                        if (inputs[i].value == '') {
                            inputs[i].style.border = '1px solid red';
                        }
                    }
                }

                function resetBorderColor(input) {
                    if (input.value != '') {
                        input.style.border = '1px solid #ced4da';
                    }
                }
            </script>
        @endsection

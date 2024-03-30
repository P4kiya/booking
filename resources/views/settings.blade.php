@extends('layouts.layout')

@section('content')
    <div class="page-wrapper">
        <div class="content container-fluid">
            <div class="page-header">
                <div class="row">
                    <div class="col s12">
                        <h3 class="page-title">Parametre</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="/">Dashboard</a>
                            </li>
                            <li class="breadcrumb-item active">Parametre</li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="row">

                <div class="col s12 m12">

                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">Parametre</h5>
                        </div>
                        <div class="card-body">

                            <!-- Form -->
                            <form method="POST" action="{{ $settings ? route('updateSettings', $settings->id) : route('storeSettings') }}" enctype="multipart/form-data">
                                @csrf
                                <div class="row form-group">
                                    <label for="name" class="col s12 m3 col-form-label input-label">Logo</label>
                                    <div class="col s12 m9">
                                        <div class="d-flex align-items-center">
                                            <label class="avatar avatar-xxl profile-cover-avatar m-0" for="edit_img">
                                                @if (!empty($settings->logo))
                                                    <img id="avatarImg" class="avatar-img"
                                                        src="{{ asset('assets/img/settings/' . $settings->logo) }}">
                                                @else
                                                    <img id="avatarImg" class="avatar-img"
                                                        src="{{ asset('assets/img/settings/logo.jpg') }}">
                                                @endif
                                                <input type="file" id="edit_img" name="logo" value="{{ old('logo', $settings->logo ?? '') }}">
                                                <span class="avatar-edit">
                                                    <i data-feather="edit-2" class="avatar-uploader-icon shadow-soft"></i>
                                                </span>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <label for="name" class="col s12 m3 col-form-label input-label">Nom de
                                        l'entreprise</label>
                                    <div class="col s12 m9">
                                        <input type="text" class="form-control" name="name" id="name" placeholder="Nom de l'entreprise"
                                            value="{{ $settings->name ?? '' }}">

                                    </div>
                                </div>
                                <div class="row form-group">
                                    <label for="location" class="col s12 m3 col-form-label input-label">Location</label>
                                    <div class="col s12 m9">
                                        <div class="mb-3">
                                            <input type="text" name="address" class="form-control" id="location"
                                                placeholder="Address" value="{{ $settings->address ?? '' }}">
                                        </div>
                                        <div class="mb-3">
                                            <input type="text" name="country" class="form-control" id="location"
                                                placeholder="Pays" value="{{ $settings->country ?? 'Marrakech' }}">
                                        </div>
                                        <div class="mb-3">
                                            <input type="text" name="city" class="form-control" placeholder="Ville"
                                                value="{{ $settings->city ?? 'Maroc' }}">
                                        </div>
                                        <div class="mb-3">

                                            <div class="upload-sign">
                                                <div class="form-group service-upload"
                                                    style="background-image: url('assets/img/settings/signature.png'); background-repeat: no-repeat; background-position: center;">
                                                    <span style="position: absolute; top: 0; left: 0;">Upload Sign</span>
                                                    <input type="file" name="signature_image" />
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>

                                <div class="right-align">
                                    <button type="submit" class="btn btn-primary">{{ $settings ? 'Change' : 'Save' }}</button>
                                </div>
                            </form>
                            <!-- /Form -->

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

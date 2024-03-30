@extends('layouts.layout')

@section('content')
    <div class="page-wrapper">
        <div class="content container-fluid">

            <!-- Page Header -->
            <div class="page-header">
                <div class="row align-items-center">
                    <div class="colEmpty">
                        <h3 class="page-title"><a href="/reservation" style="color: black">Reservation</a></h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="/">Dashboard</a></li>
                            <li class="breadcrumb-item active">Reservation</li>
                        </ul>
                    </div>
                    <div class="col-auto">
                        <a href="/add-reservation" class="btn btn-primary">
                            <i class="fas fa-plus"></i>
                        </a>
                        <a class="btn btn-primary filter-btn" href="javascript:void(0);" id="filter_search">
                            <i class="fas fa-filter"></i>
                        </a>
                    </div>
                </div>
            </div>
            <!-- /Page Header -->

            <!-- Search Filter -->
            <div id="filter_inputs" class="card filter-card">
                <div class="card-body pb-0">
                    <form action="{{ route('getReservation') }}" method="GET">
                        <div class="row">
                            <div class="col s12 l2">
                                <div class="form-group">
                                    <label>Client:</label>
                                    <input class="form-control " type="text" name="client">
                                </div>
                            </div>
                            <div class="col s12 l2">
                                <div class="form-group">
                                    <label>Status:</label>
                                    <select class="select" name="status">
                                        <option value="">Select Status</option>
                                        <option value="Valide">Valide</option>
                                        <option value="Annule">Annule</option>
                                        <option value="Expire">Expire</option>
                                        <option value="En attente">En attente</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col s12 l2">
                                <div class="form-group">
                                    <label>De:</label>
                                    <input class="form-control " type="date" name="from_date">
                                </div>
                            </div>
                            <div class="col s12 l2">
                                <div class="form-group">
                                    <label>A:</label>
                                    <input class="form-control " type="date" name="to_date">
                                </div>
                            </div>
                            <div class="col s12 l2">
                                <div class="form-group">
                                    <label>Reservation:</label>
                                    <input type="text" class="form-control" name="reservation">
                                </div>
                            </div>
                            <div class="col s12 l2 text-md-end">
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary btn-blog mt-4">
                                        Cherche</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <!-- /Search Filter -->

            <div class="row">
                @foreach ($reservations as $reservation)
                    <div class="col s12 m6 l4 xl3">
                        <div class="card"
                            style="{{ $reservation->status == 'Valide' ? 'background-color: #cbffa9ab' : ($reservation->status == 'Annule' ? 'background-color: #df2e3734' : '') }}">
                            <div class="card-body">
                                <div class="inv-header mb-3 d-flex justify-content-between">
                                    <div>
                                        <a href="/profile/{{ $reservation->client->id }}" class="avatar avatar-sm me-2">
                                            <img class="avatar-img rounded-circle" src="assets/img/profiles/avatar-04.jpg">
                                        </a>
                                        <a class="text-dark" href="/profile/{{ $reservation->client->id }}">{{ $reservation->client->prenom }}
                                            {{ $reservation->client->nom }}</a>
                                    </div>
                                    <div style="padding-top: 7px;">
                                        <style>
                                            .annule-item:hover {
                                                color: #0052ea !important;
                                            }

                                            .confirm-item:hover {
                                                color: green !important;
                                            }

                                            .delete-item:hover {
                                                color: red !important;
                                            }
                                        </style>
                                        <div class="right-align">
                                            <div class="dropdown dropdown-action">
                                                <a class="action-icon dropdown-toggle dropdown-trigger"
                                                    data-target="dropdownEst{{ $reservation->id }}" aria-expanded="false">
                                                    <i class="fas fa-ellipsis-h"></i></a>
                                                <div id="dropdownEst{{ $reservation->id }}"
                                                    class="dropdown-menu dropdown-menu-right ">
                                                    <form action="{{ route('statusConfirme', $reservation->id) }}"
                                                        method="post">
                                                        @csrf
                                                        <button type="submit" id="confirm{{ $reservation->id }}"
                                                            class="dropdown-item confirm-item">
                                                            <i class="fas fa-check me-2"></i>Confirme</button>
                                                    </form>
                                                    <form action="{{ route('statusAnnule', $reservation->id) }}"
                                                        method="post">
                                                        @csrf
                                                        <button id="cancel{{ $reservation->id }}"
                                                            class="dropdown-item annule-item" type="submit">
                                                            <i class="fas fa-times me-2"></i>Annule</button>
                                                    </form>
                                                    <a id="deletea{{ $reservation->id }}" class="dropdown-item delete-item"
                                                        href="{{ route('delete_reservation', $reservation->id) }}">
                                                        <i class="far fa-trash-alt me-2"></i>Supprime</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="invoice-id mb-3">
                                    <a href="/view-reservation/{{ $reservation->id }}" class="text-primary btn-link"
                                        style="color: #230399 !important">#{{ $reservation->id }}</a>
                                </div>
                                <div class="row align-items-center" style="margin-top: -20px">
                                    <div class="colEmpty">
                                        <span class="text-sm text-muted"></span>
                                        <h6 class="mb-0"></h6>
                                    </div>
                                    <div class="col-auto right-align">
                                        <span class="text-sm text-muted"><i class="far fa-calendar-alt"></i> Du</span>
                                        <h6 class="mb-0">
                                            {{ \Carbon\Carbon::parse($reservation->date_depuis)->format('d/m') }}</h6>
                                    </div>
                                </div>
                                <div class="row align-items-center">
                                    <div class="colEmpty">
                                        <span class="text-sm text-muted"><i class="far fa-money-bill-alt"></i> Total
                                        </span>
                                        <h6 class="mb-0 mt-2"><sup> DH/ </sup>{{ $reservation->total }}</h6>
                                    </div>
                                    <div class="col-auto right-align">
                                        <span class="text-sm text-muted"><i class="far fa-calendar-alt"></i> A</span>
                                        <h6 class="mb-0">
                                            {{ \Carbon\Carbon::parse($reservation->date_jusqua)->format('d/m') }}</h6>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <div class="row align-items-center">
                                    <div class="col-auto">
                                        @if ($reservation->expire)
                                            <span class="badge bg-info-light">Expired</span>
                                        @elseif($reservation->expire ==false)
                                            @if ($reservation->status == 'En attente')
                                                <span class="badge bg-warning-light">{{ $reservation->status }}</span>
                                            @elseif($reservation->status == 'Valide')
                                                <span class="badge bg-success-light">Confirme</span>
                                            @elseif($reservation->status == 'Annule')
                                                <span class="badge bg-danger-light">{{ $reservation->status }}</span>
                                            @endif
                                        @endif
                                    </div>
                                    <div class="col right-align d-flex justify-content-end">
                                        <a href="{{ route('view_reservation', $reservation->id) }}"
                                            class="btn btn-light btn-sm me-2 rounded-pill circle-btn">
                                            <i class="far fa-eye"></i>
                                        </a>
                                        <a href="{{ route('edit_reservation', $reservation->id) }}"
                                            class="btn btn-light btn-sm rounded-pill circle-btn">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection

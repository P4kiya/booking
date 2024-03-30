@extends('layouts.layout')

@section('content')
    <div class="page-wrapper profile-wrapper">
        <div class="content container-fluid">

            <div class="row justify-content-lg-center">
                <div class="col s12 m10 l10 ml-0">

                    <div class="page-header">
                        <div class="row">
                            <div class="colEmpty">
                                <h3 class="page-title">Profile</h3>
                                <ul class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="/">Dashboard</a></li>
                                    <li class="breadcrumb-item active">Profile</li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <form action="{{ route('profile', $client->id)}}" method="post">
                        @csrf
                        <div class="center-align mb-5">

                            <h2>{{ ucfirst($client->prenom) }} {{ ucfirst($client->nom) }}<i class="fas fa-certificate text-primary small" data-toggle="tooltip"
                                    data-placement="top" title="" data-original-title="Verified"></i></h2>
                            <ul class="list-inline">
                                <li class="list-inline-item">
                                    <i class="fas fa-id-card"></i> <span>{{ $client->cnie }}</span>
                                </li>
                                <li class="list-inline-item">
                                    <i class="fas fa-map-marker-alt"></i> {{ ucfirst($client->ville) }}, {{ ucfirst($client->pays) }}
                                </li>
                                <li class="list-inline-item">
                                    <i class="far fa-calendar-alt"></i> <span>{{ $client->created_at->format('M Y') }}</span>
                                </li>
                            </ul>
                        </div>

                        <div class="row">

                            <div class="col s12">
                                <div class="card">
                                    <div class="card-header">
                                        <h5 class="card-title">Activity</h5>
                                    </div>
                                    <div class="card-body card-body-height">
                                        <ul class="activity-feed">
                                            @foreach($client->reservations as $reservation)
                                                <li class="feed-item">
                                                    <div class="feed-date">{{ $reservation->created_at->format('M d') }}</div>
                                                    <span class="feed-text">Nouvelle Réservation<a
                                                            href="{{ route('view_reservation', $reservation->id) }}">"#{{ $reservation->id }}</a></span>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </form>

                </div>
            </div>
        </div>

    </div>
@endsection

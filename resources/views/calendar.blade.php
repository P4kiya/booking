@extends('layouts.layout')

@section('content')
    <div class="page-wrapper">
        <div class="content container-fluid">
            <div class="page-header">
                <div class="row align-items-center">
                    <div class="colEmpty">
                        <h3 class="page-title"><a href="/calendar" style="color: black">Planning</a></h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="/">Dashboard</a></li>
                            <li class="breadcrumb-item active">Planning</li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="row">

                <div class="col s12 l9 m8">
                    <div class="card bg-white">
                        <div class="card-body">
                            <div id="calendar" class="fc fc-unthemed fc-ltr">
                                <div class="fc-toolbar fc-header-toolbar">
                                    <div class="fc-left">
                                        <div class="fc-button-group">
                                            <button type="button"
                                                class="fc-prev-button fc-button fc-state-default fc-corner-left"
                                                onclick="changeWeek('prev')">
                                                <span class="fc-icon fc-icon-left-single-arrow"></span>
                                            </button>
                                            <button type="button"
                                                class="fc-next-button fc-button fc-state-default fc-corner-right"
                                                onclick="changeWeek('next')">
                                                <span class="fc-icon fc-icon-right-single-arrow"></span>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="fc-center">
                                        <h2>{{ \Carbon\Carbon::now()->format('d/m/y') }}</h2>
                                        <h2 id="currentWeek" style="display: none">
                                            {{ \Carbon\Carbon::now()->format('d/m') }}</h2>
                                    </div>
                                    <div class="fc-clear"></div>
                                </div>
                                <div class="fc-view-container">
                                    <div class="fc-view fc-agendaWeek-view fc-agenda-view">
                                        <table>
                                            <thead class="fc-head">
                                                <tr>
                                                    <td class="fc-head-container fc-widget-header">
                                                        <div class="fc-row fc-widget-header"
                                                            style="border-right-width: 1px;">
                                                            <table>
                                                                <thead>
                                                                    <tr>
                                                                        <th class="fc-axis fc-widget-header"
                                                                            style="text-align: center;">
                                                                            Numero<br>d'appartement
                                                                        </th>
                                                                        @foreach (['lundi', 'mardi', 'mercredi', 'jeudi', 'vendredi', 'samedi', 'dimanche'] as $day)
                                                                            <th class="fc-day-header fc-widget-header fc-{{ $day }} fc-past"
                                                                                style="padding-top: 20px">
                                                                                <span>{{ ucfirst(trans($day)) }} <br>
                                                                                </span>
                                                                                <span>{{ \Carbon\Carbon::parse($dates[$day])->format('d/m') }}</span>
                                                                            </th>
                                                                        @endforeach
                                                                    </tr>
                                                                </thead>
                                                            </table>
                                                        </div>
                                                    </td>
                                                </tr>
                                            </thead>
                                            <tbody class="fc-body">
                                                <tr>
                                                    <td class="fc-widget-content">
                                                        <div class="fc-scroller fc-time-grid-container">
                                                            <div class="fc-time-grid fc-unselectable">
                                                                <div class="fc-slats">
                                                                    <table id="calendarTable">
                                                                        <tbody class="fc-body">
                                                                            @foreach ($appartements as $appartement)
                                                                                <tr>
                                                                                    <td style="text-align: center;">
                                                                                        {{ $appartement['numero_appartement'] }}
                                                                                    </td>
                                                                                    @foreach ($dates as $day => $date)
                                                                                        @php
                                                                                            $isReserved = false;
                                                                                            $reservationId = null;
                                                                                            $reservationColor = '#fff';
                                                                                            $currentReservation = null;
                                                                                            foreach ($reservations as $reservation) {
                                                                                                if ($appartement['id'] == $reservation['appartement_id'] && strtotime($date) >= strtotime($reservation['date_depuis']) && strtotime($date) <= strtotime($reservation['date_jusqua'])) {
                                                                                                    $isReserved = true;
                                                                                                    $reservationId = $reservation['id'];
                                                                                                    $reservationColor = isset($reservation->agency->color) ? (empty($reservation->agency->color) ? '#000' : '#' . $reservation->agency->color) : '#000';
                                                                                                    $currentReservation = $reservation;
                                                                                                    break;
                                                                                                }
                                                                                            }
                                                                                        @endphp
                                                                                        <td>
                                                                                            <div class="d-flex"
                                                                                                style="height: 100%;width: 100%;">
                                                                                                @if ($isReserved && $date == $currentReservation['date_jusqua'])
                                                                                                    <div class="res-div"
                                                                                                        style="height: 100%; width: 50%; background-color: {{ $reservationColor }};border-radius:  0 80% 80% 0 ">
                                                                                                    </div>
                                                                                                    @php
                                                                                                        $overlapColor = '#fff';
                                                                                                        foreach ($reservations as $otherReservation) {
                                                                                                            if ($appartement['id'] == $otherReservation['appartement_id'] && $currentReservation['date_jusqua'] == $otherReservation['date_depuis']) {
                                                                                                                $overlapColor = isset($otherReservation->agency->color) ? (empty($otherReservation->agency->color) ? '#000' : '#' . $otherReservation->agency->color) : '#000';
                                                                                                                break;
                                                                                                            }
                                                                                                        }
                                                                                                    @endphp
                                                                                                    <div
                                                                                                        style="height: 100% ;width: 50%;background-color: {{ $overlapColor }};border-radius:  80% 0 0 80% ">
                                                                                                    </div>
                                                                                                    @elseif ($isReserved && $date == $currentReservation['date_depuis'])
                                                                                                        @if (!empty($currentReservation) && !empty($otherReservation) AND $currentReservation['date_depuis'] == $otherReservation['date_jusqua'])
                                                                                                        <div class="res-div" style="height: 100%; width: 50%;background-color: {{ $overlapColor }};border-radius: 0 80% 80% 0">
                                                                                                        </div>
                                                                                                        <div class="res-div"
                                                                                                            style="height: 100% ;width: 50%; background-color: {{ $reservationColor }};border-radius:  80% 0 0 80% ">
                                                                                                        </div>
                                                                                                        @else
                                                                                                        <div class="res-div"
                                                                                                        style="height: 100%; width: 50%;">
                                                                                                    </div>
                                                                                                    <div class="res-div"
                                                                                                        style="height: 100% ;width: 50%; background-color: {{ $reservationColor }};border-radius:  80% 0 0 80% ">
                                                                                                    </div>
                                                                                                        @endif
                                                                                                @else
                                                                                                    @if ($isReserved && $date >= $currentReservation['date_depuis'] && $date <= $currentReservation['date_jusqua'])
                                                                                                        <div
                                                                                                            style="height: 100%; width: 100%; background-color: {{ $reservationColor }};">
                                                                                                        </div>
                                                                                                    @else
                                                                                                        <div
                                                                                                            style="height: 100%; width: 100%;">
                                                                                                        </div>
                                                                                                    @endif
                                                                                                @endif
                                                                                            </div>
                                                                                        </td>
                                                                                    @endforeach
                                                                                </tr>
                                                                            @endforeach
                                                                        </tbody>
                                                                    </table>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col s12 l3 " style="margin-top: 20px">
                    <div class="d-flex">
                        <div class="col-auto mt-2">
                            <h4 class="card-title">Agences</h4>
                        </div>
                        <div class="col-auto" style="margin-left: 7%;">
                            <button data-toggle="modal" data-target="#exampleModal" class="btn btn-primary">
                                <i class="fas fa-plus"></i>
                            </button>
                        </div>
                        <div class="modal fade" id="exampleModal"
                            style="padding-top: 150px; background-color: rgba(0, 0, 0, 0.4); " tabindex="-1" role="dialog"
                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <form method="post" action="{{ route('storeAgency') }}">
                                    @csrf
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h2 class="modal-title" id="exampleModalLabel" style="text-align: center;">
                                                Ajoute une agence :
                                            </h2>
                                        </div>
                                        <div class="modal-body">
                                            <div class="item-title-head table-block">
                                                <div class="title-head-left"
                                                    style="display: flex !important; margin-top: 5px;">
                                                    <div style="margin-top: 7px;">
                                                        <h4 class="title">Nom :</h4>
                                                    </div>
                                                    <div style="margin-left: 50px; width: 220px;">
                                                        <input name="name" autocomplete="off" type="text"
                                                            class="form-control" placeholder="nom" />
                                                    </div>
                                                </div>
                                                <div class="title-head-left"
                                                    style="display: flex !important; margin-top: 5px;">
                                                    <div style="margin-top: 7px;">
                                                        <h4 class="title">Color :</h4>
                                                    </div>
                                                    <div style="margin-left: 40px;width: 220px;">
                                                        <input name="color" autocomplete="off"
                                                            type="text"class="form-control" placeholder="color" />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-dismiss="modal">Annuler</button>
                                            <button type="submit" class="btn btn-primary">Ajoute</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div id="calendar-events" class="mb-3">
                        <div class="calendar-events" style="color: #000">
                            <i class="fas fa-circle"></i>
                            <span style="color: #455560">Default</span>
                        </div>
                        @foreach ($agencies as $agency)
                            <div class="calendar-events"
                                style="color: {{ Str::startsWith($agency->color, '#') ? '' : '#' }}{{ $agency->color }}">
                                <i class="fas fa-circle"></i>
                                <span style="color: #455560;">{{ ucfirst($agency->name) }}</span>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

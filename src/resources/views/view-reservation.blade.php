@extends('layouts.layout')

@section('content')
    <div class="page-wrapper" id="view_reservation">
        <div class="content container-fluid">

            <div class="row justify-content-center">
                <div class="col s12 xl8 ml-0">
                    <div class="text-md-end">
                        <div class="btn-group btn-group-sm d-print-none mb-4" id="hidediv">
                            <a id="print" class="btn btn-white text-black-50 me-2"><i class="fa fa-print"></i>Print</a>
                        </div>
                    </div>

                    <div class="card" id="facture">
                        <div class="card-body">
                            <div class="invoice-item">
                                <div class="row">
                                    <div class="col s12 m6">
                                        <div class="invoice-logo">
                                            <img src="{{ asset('assets/img/logo.jpg') }}" alt="logo">
                                        </div>
                                    </div>
                                    <div class="col s12 m6">
                                        <p class="invoice-details">
                                            <strong>Reservation :</strong> #{{ sprintf("%03d", $reservation->id) }} <br>
                                            <strong>Le :</strong> {{ \Carbon\Carbon::now()->format('d/m/Y') }}
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <!-- Invoice Item -->
                            <div class="invoice-item">
                                <div class="row">
                                    <div class="col s12 m6">
                                        <div class="invoice-info">
                                            <strong class="customer-text">Facture du</strong>
                                            <p class="invoice-details invoice-details-two">
                                                Agence booking<br>
                                                806 Massira 1,<br>
                                                Marrakech, MA <br>
                                            </p>
                                        </div>
                                    </div>
                                    <div class="col s12 m6">
                                        <div class="invoice-info invoice-info2">
                                            <strong class="customer-text">Facturer à</strong>
                                            <p class="invoice-details">
                                                <Span>{{ ucfirst($reservation->client->prenom) }} </Span> <span>{{ ucfirst($reservation->client->nom) }}</span><br>
                                                {{ ucfirst($reservation->client->pays) }}, {{ ucfirst($reservation->client->ville) }}<br>
                                                {{ $reservation->client->phone }}<br>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- /Invoice Item -->
                            <hr class="mt-0">
                            <!-- Invoice Item -->
                            <div class="invoice-item invoice-table-wrap">
                                <h5>Services</h5>
                                <div class="row">
                                    <div class="col s12">
                                        <div class="responsive-table">

                                            <table class="invoice-table table table-border mb-0">
                                                <thead>
                                                    <tr>
                                                        <th class="w-75">Service</th>
                                                        <th class="right-align">Quantite</th>
                                                        <th class="right-align">Prix</th>
                                                        <th class="right-align">Total</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td class="w-50">Hebergement</td>
                                                        <td class="right-align">{{ \Carbon\Carbon::parse($reservation->date_jusqua)->diffInDays(\Carbon\Carbon::parse($reservation->date_depuis)) }}j</td>
                                                        <td class="right-align"><span style="font-size: 11px">DH</span> {{ $reservation->prix }}
                                                        </td>
                                                        <td class="right-align"><span style="font-size: 11px">DH</span>
                                                            {{ $reservation->total }}</td>
                                                    </tr>
                                                    {{-- <tr>
                                                        <td class="w-50">Petit-déjeuner</td>
                                                        <td class="right-align">4</td>
                                                        <td class="right-align"><span style="font-size: 11px">DH</span> 50
                                                        </td>
                                                        <td class="right-align"><span style="font-size: 11px">DH</span> 200
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="w-50">Visite a ourika</td>
                                                        <td class="right-align"></td>
                                                        <td class="right-align"><span style="font-size: 11px">DH</span> 200
                                                        </td>
                                                        <td class="right-align"><span style="font-size: 11px">DH</span> 200
                                                        </td>
                                                    </tr> --}}
                                                    <tr>
                                                        <td colspan="3" class="right-align text-muted border-bottom-0">
                                                            Subtotal</td>
                                                        <td class="right-align border-bottom-0"><span
                                                                style="font-size: 11px">DH</span> {{ $reservation->total }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan="3" class="right-align text-muted border-bottom-0">
                                                            TVA</td>
                                                        <td class="right-align border-bottom-0"><span
                                                                style="font-size: 11px">DH</span> 50</td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan="3" class="right-align text-muted">Discount (10%)
                                                        </td>
                                                        <td class="right-align"><span style="font-size: 11px">DH</span> {{ ($reservation->total + 50) * 0.1 }}
                                                        </td>
                                                    </tr>
                                                </tbody>
                                                <tfoot class="border-bottom border-1">
                                                    <tr>
                                                        <th colspan="3" class="right-align font-weight-600">Total</th>
                                                        <th class="right-align font-weight-600"><span
                                                                style="font-size: 11px">DH</span> {{ ($reservation->total + 50) - (($reservation->total + 50) * 0.1) }}</th>
                                                    </tr>
                                                </tfoot>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- /Invoice Item -->

                            <div class="invoice-sign right-align pt-0 pb-3">
                                <img class="img-fluid d-inline-block" src="{{ asset('assets/img/signature.png') }}">
                            </div>
                            <hr>
                            <div class="invoice-terms mb-0">
                                <h6>Notes:</h6>
                                <p class="mb-0">
                                    
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

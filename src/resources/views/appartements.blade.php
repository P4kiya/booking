@extends('layouts.layout')

@section('content')
    <div class="page-wrapper">
        <div class="content container-fluid">

            <!-- Page Header -->
            <div class="page-header">
                <div class="row align-items-center">
                    <div class="colEmpty">
                        <h3 class="page-title">Appartements</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="/">Dashboard</a>
                            </li>
                            <li class="breadcrumb-item active">Appartements</li>
                        </ul>
                    </div>
                    <div class="col s12 m3 text-md-end">
                        <a href="{{ route('add_appartement') }}" class="btn btn-primary btn-blog mb-3"><i
                                class="feather-plus-circle me-1"></i>
                            Ajouter</a>
                    </div>
                </div>
            </div>

            <div class="row flex-row-reverse">

                @foreach ($appartements as $appartement)
                    <div class="col s12 m6 xl4 d-flex">
                        <div class="blog grid-blog flex-fill">
                            <div class="blog-image">
                                <a href="appartement-details"><img style="height: 250px;" class="img-fluid"
                                        src="{{ $appartement->img ? asset('assets/img/appartements/' . $appartement->img) : asset('assets/img/appartements/example.webp') }}"></a>
                            </div>
                            <div class="blog-content">
                                <ul class="entry-meta meta-item">
                                    <li>
                                        <div class="post-author">
                                            <a>
                                                <span>
                                                    <h3 class="post-title">
                                                        {{ number_format($appartement->prix_haut, 0, '.', '') }}
                                                        <span><sup>DH</sup><sub>/Nuit</sub></span>
                                                    </h3>
                                                    <h4 class="post-date"><span>N° </span>
                                                        {{ $appartement->numero_appartement }}</h4>
                                                    <h4 class="post-date"><span>Etage </span> {{ $appartement->etage }}
                                                    </h4>
                                                    <ul class="item-amenities ">
                                                        <li>
                                                            <i class="fa fa-bed"></i><span class="item-label">
                                                                {{ $appartement->nombre_chambre }} Chambres</span>
                                                        </li>
                                                        <li>
                                                            <i class="fa fa-user"></i><span class="item-label"
                                                                style="width: 100px">
                                                                {{ $appartement->capacite_appartement }}
                                                                Capacite</span>
                                                        </li>
                                                    </ul>
                                                </span>
                                            </a>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                            <div class="row">
                                <div class="edit-options">
                                    <div class= "edit-delete-btn">
                                        <a href="{{ route('edit_appartement', $appartement->id) }}" class="text-success"><i
                                                class="feather-edit-3 me-1"></i>
                                            Edit</a>
                                        <a href="{{ route('delete_appartement', $appartement->id) }}" class="text-danger"
                                            href="#deleteModal"><i class="feather-trash-2 me-1"></i>
                                            Delete</a>
                                    </div>
                                    <div class="status-toggle">
                                        <form action="{{ route('status', $appartement->id) }}" method="post">
                                            @csrf
                                            <input id="status_{{ $appartement->id }}" class="check" type="checkbox"
                                                {{ $appartement->status == 'active' ? 'checked' : '' }}
                                                onchange="this.form.submit()" value="{{ $appartement->status ?? 'inactive' }}">
                                            <label for="status_{{ $appartement->id }}" class="checktoggle checkbox-bg">
                                            </label>
                                            <span>Active</span>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach

            </div>
            <!-- Pagination -->
            @if ($appartements->total() > 6)
                <div class="row ">
                    <div class="col s12">
                        <div class="pagination-tab  d-flex justify-content-center">
                            <ul class="pagination mb-0">
                                <li class="page-item {{ $appartements->currentPage() == 1 ? 'disabled' : '' }}">
                                    <a class="page-link" href="{{ $appartements->previousPageUrl() }}" tabindex="-1"><i
                                            class="feather-chevron-left mr-2"></i>Previous</a>
                                </li>
                                @for ($i = 1; $i <= $appartements->lastPage(); $i++)
                                    <li class="page-item {{ $appartements->currentPage() == $i ? 'active' : '' }}">
                                        <a class="page-link"
                                            href="{{ route('appartements', ['page' => $i]) }}">{{ $i }}</a>
                                    </li>
                                @endfor
                                <li
                                    class="page-item {{ $appartements->currentPage() == $appartements->lastPage() ? 'disabled' : '' }}">
                                    <a class="page-link" href="{{ $appartements->nextPageUrl() }}">Next<i
                                            class="feather-chevron-right ml-2"></i></a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    @endsection

@extends('admin.layouts.app')

@section('content')
<!--start content-->
<main class="page-content">
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Vehicles</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">View</li>
                </ol>
            </nav>
        </div>
        <div class="ms-auto">

        </div>
    </div>
    <!--end breadcrumb-->

    <div class="card">
        <div class="card-header py-3">
            <div class="row g-3 align-items-center">
                <div class="col-12 col-lg-4 col-md-6 me-auto">
                    <h5 class="mb-1">{!! date('d/m/Y', strtotime($vehicle->created_at)) !!}</h5>
                    <p class="mb-0">Vehicle ID : {{ $vehicle->id }}</p>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="row">

                <div class="col">
                    <div class="card border-0 shadow-none radius-10">
                        <div class="card-body">
                            <div class="d-flex align-items-center gap-3">
                                <div class=" border-0">
                                    @if ($vehicle->image)
                                    <img src="{{ $vehicle->image }}" class="img-fluid" width="400">
                                    @else
                                    <img src="{{ asset('frontend/assets/images/comparision-placeholder.jpeg') }}" class="img-fluid" width="400" />
                                    @endif
                                </div>
                                <div class="info">
                                    <h6 class="mb-2"><b>Modal: </b>{{ $vehicle->name }}</h6>
                                    {{-- <h6 class="mb-2"><b></b>
                                            @if ($vehicle->image)
                                                <img src="{{ $vehicle->image }}" class="rounded-circle" width="400">
                                    @else
                                    <img src="{{ asset('frontend/assets/images/comparision-placeholder.jpeg') }}" width="400" />
                                    @endif
                                    </h6> --}}
                                    <p class="mb-1"><b>Body: </b>{{ $vehicle->body_type }}</p>
                                    {{-- <p class="mb-1"><b>Feature: </b>{{ $vehicle->feature }}</p> --}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>

</main>
<!--end page main-->
@endsection
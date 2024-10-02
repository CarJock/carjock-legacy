@extends('admin.layouts.app')
@section('content')
    <!--start wrapper-->
    <!--start content-->
    <main class="page-content">
        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Contact Us</div>
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
                        <h5 class="mb-1">{!! date('d/m/Y', strtotime($contact->created_at)) !!}</h5>
                        <p class="mb-0">Message ID : {{ $contact->id }}</p>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="row">

                    <div class="col">
                        <div class="card border-0 shadow-none radius-10">
                            <div class="card-body">
                                <div class="d-flex align-items-center gap-3">
                                    {{-- <div class="icon-box bg-light-primary border-0">
                                        <i class="bi bi-person text-primary"></i>
                                    </div> --}}
                                    <div class="info">
                                        <h6 class="mb-2"><b>First Name: </b>{{ $contact->first_name }}</h6>
                                        <h6 class="mb-2"><b>Last Name: </b>{{ $contact->last_name }}</h6>
                                        <p class="mb-1"><b>Email: </b>{{ $contact->email }}</p>
                                        <p class="mb-1"><b>Phone: </b>{{ $contact->phone }}</p>
                                        <p class="mb-1"><b>Message: </b>{{ $contact->message }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

    </main>
    <!--end page main-->



    <!--end wrapper-->
@endsection

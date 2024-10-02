@extends('admin.layouts.app')

@section('content')

    <main class="page-content">
        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Ads Management</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Ads</li>
                    </ol>
                </nav>
            </div>

            <div class="ms-auto">
                <div class="btn-group">
                    <button type="button" class="btn btn-primary"><a class="text-white"
                            href="{{ route('admin.ads.create') }}">Create
                            New</a></button>
                </div>
            </div>
        </div>
        <!--end breadcrumb-->



        <div class="card">
            @if ($message = Session::get('message'))
                <div class="alert alert-success alert-block">
                    {{ $message }}
                </div>
            @endif

            @if (count($ads) == 0)
                <h4 class="text-center text-muted m-3">No data available</h4>
            @else
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table align-middle mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th>#</th>
                                    <th>Page</th>
                                    <th>Slot</th>
                                    <th>Link</th>
                                    <th>Start Date</th>
                                    <th>End Date</th>
                                    <th>Start Time</th>
                                    <th>End Time</th>
                                    <th>Status</th>
                                    <th>Image</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($ads as $ad)
                                    <tr>
                                        <td>{{ $loop->index + 1 }}</td>
                                        <td>
                                            <div class="d-flex align-items-center gap-3 cursor-pointer">
                                                <p class="mb-0">{{ $ad->title }}</p>
                                            </div>
                                        </td>
                                        <td>
                                            @php
                                            $slot_name = "";
                                            if ($ad->slot == 0 || $ad->slot == "") {
                                                $slot_name = "-";
                                            } else {
                                                if ($ad->slot == 1) {
                                                    $slot_name = "featured vehicles";
                                                } else {
                                                    $slot_name = "news from blog";
                                                }
                                            }
                                            echo $slot_name;
                                            @endphp
                                        </td>
                                        <td>{{ $ad->link }}</td>
                                        <td>{!! date('d/m/Y', strtotime($ad->start_date)) !!}</td>
                                        <td>{!! date('d/m/Y', strtotime($ad->end_date)) !!}</td>
                                        <td>@php echo sprintf('%02d', $ad->start_time) . ":00" @endphp</td>
                                        <td>@php echo sprintf('%02d', $ad->end_time) . ":00" @endphp</td>
                                        <td>{{ $ad->status }}</td>
                                        <td><img src="{{ url('storage/ads/'.$ad->image) }}" height="50" width="50"></td>
                                        <td>
                                        <div class="d-flex align-items-center gap-3 fs-6">
                                            <a href="{{ route('admin.ads.edit', $ad->id) }}" class="text-warning" data-bs-toggle="tooltip"
                                                data-bs-placement="bottom" title="Edit" data-bs-original-title="Edit info"
                                                aria-label="Edit"><i class="bi bi-pencil-fill"></i>
                                            </a>
                                        </div>
                                        </div>
                                        </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                    </table>
                    </div>
                    @endif
                    </div>
                    </div>

    </main>
@endsection

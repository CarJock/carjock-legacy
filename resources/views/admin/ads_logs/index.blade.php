@extends('admin.layouts.app')

@section('content')
    <main class="page-content">
        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Ads</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Logs</li>
                    </ol>
                </nav>
            </div>
        </div>
        <!--end breadcrumb-->

        <div class="card">
            @if ($message = Session::get('message'))
                <div class="alert alert-success alert-block">
                    {{ $message }}
                </div>
            @endif

            @if (count($ads_logs) == 0)
                
            @else
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <h5 class="mb-0">Vehicles</h5>
                        <form method="GET" class="ms-auto position-relative d-flex mb-3">
                            <div>
                                <select name="type" class="form-control mx-3">
                                    <option value="">Select Type</option>
                                    <option value="click" {{ request()->type == 'click' ? 'selected="selected"' : '' }}>Click</option>
                                    <option value="view" {{ request()->type == 'view' ? 'selected="selected"' : '' }}>View</option>
                                </select>
                            </div>
                            <div>
                                <button type="submit" class="btn btn-primary mx-4">Filter</button>
                            </div>
                        </form>
                    </div>
                    <div class="table-responsive">
                        <table class="table align-middle mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th>#</th>
                                    <th>Page</th>
                                    <th>Type</th>
                                    <th>Slot</th>
                                    <th>Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($ads_logs as $logs)
                                    <tr>
                                        <td>{{ $loop->index + 1 }}</td>
                                        <td>
                                            <div class="d-flex align-items-center gap-3 cursor-pointer">
                                                <p class="mb-0">{{ $logs->title }}</p>
                                            </div>
                    
                                        </td>
                                        <td>{{ $logs->type }}</td>
                                        <td>
                                            @php
                                            $slot_name = "";
                                            if ($logs->slot == 0 || $logs->slot == "") {
                                                $slot_name = "-";
                                            } else {
                                                if ($logs->slot == 1) {
                                                    $slot_name = "featured vehicles";
                                                } else {
                                                    $slot_name = "news from blog";
                                                }
                                            }
                                            echo $slot_name;
                                            @endphp
                                        </td>
                                        <td>{!! date('d/m/Y', strtotime($logs->created_at)) !!}</td>                    
                </tr>
            @endforeach
            </tbody>
            </table>
        </div>
        @endif
        <nav class="mt-4">
            @if (count($ads_logs))
                <ul class="pagination">
                    {{ $ads_logs->withQueryString()->links() }}
                </ul>
            @else
                <div class="col-sm-12 text-center">
                    <h4 class="text-muted inline m-t-sm m-b-sm">No ads logs available.</h4>
                </div>
            @endif
        </nav>
        </div>
        </div>

    </main>
@endsection

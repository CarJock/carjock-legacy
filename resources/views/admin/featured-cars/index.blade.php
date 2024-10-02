@extends('admin.layouts.app')

@section('content')
    <main class="page-content">
        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Cars</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Featured</li>
                    </ol>
                </nav>
            </div>
            <div class="ms-auto">
                {{-- <div class="btn-group">
                    <button type="button" class="btn btn-primary"><a class="text-white"
                            href="{{ route('customer.qbanks.create') }}">Create
                            New</a></button>
                </div> --}}
            </div>
        </div>
        <!--end breadcrumb-->

        <div class="card">
            @if ($message = Session::get('message'))
                <div class="alert alert-success alert-block">
                    {{ $message }}
                </div>
            @endif
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <h5 class="mb-0">Vehicles</h5>
                    <form method="GET" class="ms-auto position-relative d-flex mb-3">
                        <div>
                            <div class="position-absolute top-50 translate-middle-y search-icon px-3"><i class="bi bi-search"></i></div>
                            <input class="form-control ps-5" type="text" placeholder="Search" name="keywords" value="{{request()->has('keywords') ? request()->keywords : ''}}">
                        </div>
                        <div>
                            <select name="featured" class="form-control mx-3">
                                <option value="">Select Featured Vehciles</option>
                                <option value="yes" {{ request()->featured == 'yes' ? 'selected="selected"' : '' }}>Yes</option>
                                <option value="no" {{ request()->featured == 'no' ? 'selected="selected"' : '' }}>No</option>
                            </select>
                        </div>
                        <div>
                            <button type="submit" class="btn btn-primary mx-4">Filter</button>
                        </div>
                    </form>
                </div>
                @if (count($vehicles) == 0)
                    
                @else
                
                    <div class="table-responsive">
                        <table class="table align-middle mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Body Type</th>
                                    <th>Featured</th>
                                    <th>Date</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($vehicles as $vehicle)
                                    <tr>
                                        <td>{{ $loop->index + 1 }}</td>
                                        <td>
                                            <div class="d-flex align-items-center gap-3 cursor-pointer">
                                                @if($vehicle->image && (file_exists($vehicle->image) || file_exists('/'.$vehicle->image)))
                                                    <img src="/{{ $vehicle->image }}" class="rounded-circle" width="44"
                                                        height="44" alt="">
                                                @else
                                                    <img src="{{ asset('frontend/assets/images/comparision-placeholder.jpeg') }}"
                                                        width="44" height="44" />
                                                @endif
                                                <div class="">
                                                    <p class="mb-0">{{ $vehicle->name }}</p>
                                                </div>
                                            </div>
                                        </td>
                                        <td>{{ $vehicle->body_type }}</td>
                                        <td>
                                            <div class="form-check form-switch">
                                                <input class="form-check-input" data-id="{{ $vehicle->id }}"
                                                    type="checkbox" id="featured-{{ $vehicle->id }}"
                                                    {{ $vehicle->feature == 'yes' ? 'checked' : '' }}>
                                                <label class="form-check-label" for="featured"></label>
                                            </div>
                                        </td>
                                        <td>{!! date('d/m/Y', strtotime($vehicle->created_at)) !!}</td>
                                        <td>
                                            <div class="d-flex align-items-center gap-3 fs-6">
                                                {{-- <a href="javascript:;" class="text-primary" data-bs-toggle="tooltip" data-bs-placement="bottom"
                            title="" data-bs-original-title="View detail" aria-label="Views"><i
                                class="bi bi-eye-fill"></i></a> --}}
                                                <a href="{{ route('admin.vehicles.show', $vehicle->id) }}"
                                                    class="text-primary" data-bs-toggle="tooltip" data-bs-placement="bottom"
                                                    title="View" data-bs-original-title="Show info" aria-label="Show"><i
                                                        class="bi bi-eye-fill"></i>
                                                </a>

                                                {{--    
                                                <form method="POST"
                                                    action="{{ route('admin.vehicles.destroy', [$vehicle->id]) }}">
                                                    <button class="bi bi-trash-fill text-danger bg-transparent border-0"
                                                        type="submit" data-bs-toggle="tooltip" data-bs-placement="bottom"
                                                        title="Delete">
                                                    </button>
                                                    @method('delete')
                                                    @csrf
                                                </form>
                                                --}}
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif

            <nav class="mt-4">
                @if (count($vehicles))
                    <ul class="pagination">
                        {{ $vehicles->withQueryString()->links() }}
                    </ul>
                @else
                    <div class="col-sm-12 text-center">
                        <h4 class="text-muted inline m-t-sm m-b-sm">No records found.</h4>
                    </div>
                @endif
            </nav>
        </div>
    </div>

</main>
@endsection

@push('styles')
    <style>
        select{
            -moz-appearance: none;
            -webkit-appearance: none;
            -moz-appearance: none;
            background: transparent;
            background-image: url('{{asset('frontend/assets/images/arrowdn.png')}}');
            background-repeat: no-repeat;
            background-position-x: 95%;
            background-position-y: 14px;
            background-size: 5%;
            cursor:pointer;
            width: 100%;
            border: 1px solid gray;
            border-radius: 5px;
            padding: 0 15px;
            font-size: 16px;
            color: #979797;
        } 
    </style>
@endpush

@push('script')
    <script>
        $(".form-check-input").change(function() {
            var id = $(this).attr("data-id");
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.post('{{ url('admin/vehicles') }}/' + id, {
                _method: "PUT",
            }, function() {
                console.log('done');
            })
            //$.post('{{ url('admin/vehicle/update') }}/' + id)
        });
    </script>
@endpush

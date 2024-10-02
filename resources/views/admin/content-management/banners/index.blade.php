@extends('admin.layouts.app')

@section('content')

    <main class="page-content">
        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Content Management</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Banners</li>
                    </ol>
                </nav>
            </div>

            <div class="ms-auto">
                {{--<div class="btn-group">
                    <button type="button" class="btn btn-primary"><a class="text-white"
                            href="{{ route('admin.banners.create') }}">Create
                            New</a></button>
                </div>--}}
            </div>
        </div>
        <!--end breadcrumb-->



        <div class="card">
            @if ($message = Session::get('message'))
                <div class="alert alert-success alert-block">
                    {{ $message }}
                </div>
            @endif

            @if (count($banners) == 0)
                <h4 class="text-center text-muted m-3">No data available</h4>
            @else
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table align-middle mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th>#</th>
                                    <th>Page</th>
                                    <th>heading</th>
                                    <th>content</th>
                                    <th>image</th>
                                    <th>Date</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($banners as $banner)
                                    <tr>
                                        <td>{{ $loop->index + 1 }}</td>
                                        <td>
                                            <div class="d-flex align-items-center gap-3 cursor-pointer">
                                                <p class="mb-0">{{ $banner->pages->title }}</p>
                                            </div>
                                        </td>
                                        <td>{{ $banner->heading }}</td>
                                        <td>{{ $banner->content }}</td>
                                        <td><img src="{{ url('storage/banners/'.$banner->image) }}" height="50" width="50"></td>
                                        @if($banner->updated_at == "")
                                            <td>{!! date('d/m/Y', strtotime($banner->created_at)) !!}</td>
                                        @else
                                            <td>{!! date('d/m/Y', strtotime($banner->updated_at)) !!}</td>
                                        @endif
                                        <td>
                                        <div class="d-flex align-items-center gap-3 fs-6">
                                            <a href="{{ route('admin.banners.edit', $banner->id) }}" class="text-warning" data-bs-toggle="tooltip"
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

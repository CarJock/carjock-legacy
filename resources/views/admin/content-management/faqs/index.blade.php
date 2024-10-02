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
                        <li class="breadcrumb-item active" aria-current="page">FAQs</li>
                    </ol>
                </nav>
            </div>

            <div class="ms-auto">
                <div class="btn-group">
                    <button type="button" class="btn btn-primary"><a class="text-white"
                            href="{{ route('admin.faqs.create') }}">Create
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

            @if (count($faqs) == 0)
                <h4 class="text-center text-muted m-3">No data available</h4>
            @else
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table align-middle mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th>#</th>
                                    <th>Question</th>
                                    <th>Sort Order</th>
                                    <th>Description</th>
                                    <th>Date</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($faqs as $faq)
                                    <tr>
                                        <td>{{ $loop->index + 1 }}</td>
                                        <td>
                                            <div class="d-flex align-items-center gap-3 cursor-pointer">
                                                <p class="mb-0">{{ $faq->question }}</p>
                                            </div>
                                            </div>
                                            </td>
                                            <td>{{ $faq->sort }}</td>
                                            <td>{{ $faq->description }}</td>
                                            @if($faq->updated_at == "")
                                                <td>{!! date('d/m/Y', strtotime($faq->created_at)) !!}</td>
                                            @else
                                                <td>{!! date('d/m/Y', strtotime($faq->updated_at)) !!}</td>
                                            @endif
                                            <td>
                                                <div class="d-flex align-items-center gap-3 fs-6">
                                                    <a href="{{ route('admin.faqs.edit', $faq->id) }}" class="text-warning" data-bs-toggle="tooltip"
                                                        data-bs-placement="bottom" title="Edit" data-bs-original-title="Edit info"
                                                        aria-label="Edit"><i class="bi bi-pencil-fill"></i>
                                                    </a>
                                                    <form method="POST" action="{{ route('admin.faqs.destroy', [$faq->id]) }}">
                                                        <button class="bi bi-trash-fill text-danger bg-transparent border-0" type="submit"
                                                            data-bs-toggle="tooltip" data-bs-placement="bottom" title="Delete">
                                                        </button>
                                                        @method('delete')
                                                        @csrf
                                                    </form>
                                                </div>
                </div>
                </td>
                </tr>
            @endforeach
            </tbody>
            </table>
        </div>
        @endif
        {{-- <nav class="float-end mt-3">
                    <ul class="pagination">
                        <li class="page-item disabled"><a class="page-link" href="#">Previous</a></li>
                        <li class="page-item active"><a class="page-link" href="#">1</a></li>
                        <li class="page-item"><a class="page-link" href="#">2</a></li>
                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                        <li class="page-item"><a class="page-link" href="#">Next</a></li>
                    </ul>
                </nav> --}}
        </div>
        </div>

    </main>
@endsection

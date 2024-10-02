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
                        <li class="breadcrumb-item active" aria-current="page">Contact Us</li>
                    </ol>
                </nav>
            </div>

            <div class="ms-auto">
                <div class="btn-group">
                    <button type="button" class="btn btn-primary"><a class="text-white"
                            href="{{ route('admin.contact_exportcsv') }}">Export CSV</a></button>
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

            @if (count($contacts) == 0)
                
            @else
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table align-middle mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th>First Name</th>
                                    <th>Last Name</th>
                                    <th>Email</th>
                                    {{-- <th>Phone</th> --}}
                                    {{-- <th>Message</th> --}}
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($contacts as $contact)
                                    <tr>

                                        <td>{{ $contact->first_name }}</td>
                                        <td>{{ $contact->last_name }}</td>
                                        <td>{{ $contact->email }}</td>
                                        {{-- <td>{{ $contact->phone }}</td> --}}
                                        {{-- <td>
                                            <div class="d-flex align-items-center gap-3 cursor-pointer">
                                                <p class="mb-0">{{ $contact->message }}</p>
                                            </div>

                                        </td> --}}
                                        <td>
                                            <div class="d-flex align-items-center gap-3 fs-6">
                                                <a href="{{ route('admin.contact.show', $contact->id) }}"
                                                    class="text-primary" data-bs-toggle="tooltip" data-bs-placement="bottom"
                                                    title="View" data-bs-original-title="View detail"
                                                    aria-label="Views"><i class="bi bi-eye-fill"></i></a>

                                                {{-- <a href="{{ route('admin.contact.edit', $contact->id) }}"
                                                    class="text-warning" data-bs-toggle="tooltip" data-bs-placement="bottom"
                                                    title="Edit" data-bs-original-title="Edit info" aria-label="Edit"><i
                                                        class="bi bi-pencil-fill"></i>
                                                </a> --}}


                                                {{-- <form method="POST" action="{{ route('admin.contact.destroy', [$contacts->id]) }}">
                                <button class="bi bi-trash-fill text-danger bg-transparent border-0" type="submit"
                                    data-bs-toggle="tooltip" data-bs-placement="bottom" title="Delete">
                                </button>
                                @method('delete')
                                @csrf
                            </form> --}}
                                            </div>
                    </div>
                    </td>
                    </tr>
            @endforeach
            </tbody>
            </table>
        </div>
        @endif
        <nav class="mt-4">
            @if (count($contacts))
                <ul class="pagination">
                    {{ $contacts->withQueryString()->links() }}
                </ul>
            @else
                <div class="col-sm-12 text-center">
                    <h4 class="text-muted inline m-t-sm m-b-sm">No Contacts available.</h4>
                </div>
            @endif
        </nav>
        </div>
        </div>

    </main>
@endsection

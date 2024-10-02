@extends('admin.layouts.app')

@section('content')
    <main class="page-content">
        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Users</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Management</li>
                    </ol>
                </nav>
            </div>
            <div class="ms-auto">
                <div class="btn-group">
                    <button type="button" class="btn btn-primary"><a class="text-white"
                            href="{{ route('admin.user.create') }}">Create
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

            @if (count($users) == 0)
                
            @else
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <h5 class="mb-0">Vehicles</h5>
                        <form method="GET" class="ms-auto position-relative d-flex mb-3">
                            <div>
                                <input class="form-control mx-3" name="email" type="text" value="{{ request()->email != '' ? request()->email : '' }}" placeholder="Search Email">
                            </div>
                            <div>&nbsp;</div>
                            <div>
                                <select name="role" class="form-control mx-3">
                                    <option value="">Select Role</option>
                                    <option value="admin" {{ request()->role == 'admin' ? 'selected="selected"' : '' }}>Admin</option>
                                    <option value="user" {{ request()->role == 'user' ? 'selected="selected"' : '' }}>User</option>
                                </select>
                            </div>
                            <div>&nbsp;</div>
                            <div>
                                <select name="status" class="form-control mx-3">
                                    <option value="">Select User Status</option>
                                    <option value="active" {{ request()->status == 'active' ? 'selected="selected"' : '' }}>Active</option>
                                    <option value="blocked" {{ request()->status == 'blocked' ? 'selected="selected"':''}}>Blocked</option>
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
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Role</th>
                                    <th>User status</th>
                                    <th>Date</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $user)
                                    <tr>
                                        <td>{{ $loop->index + 1 }}</td>
                                        <td>
                                            <div class="d-flex align-items-center gap-3 cursor-pointer">
                                                {{-- <img src="assets/images/avatars/avatar-1.png" class="rounded-circle" width="44"
                                            height="44" alt="">
                                        <div class=""> --}}
                                                <p class="mb-0">{{ $user->name }}</p>
                                            </div>
                    </div>
                    </td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->role }}</td>
                    <td>{{ $user->status }}</td>
                    <td>{!! date('d/m/Y', strtotime($user->created_at)) !!}</td>
                    <td>
                        <div class="d-flex align-items-center gap-3 fs-6">
                            @if($user->role == "user")
                            <a href="{{ route('admin.user.edit', $user->id) }}" class="text-warning"
                                data-bs-toggle="tooltip" data-bs-placement="bottom" title="Edit"
                                data-bs-original-title="Edit info" aria-label="Edit"><i class="bi bi-pencil-fill"></i>
                            </a>
                            <form method="POST" action="{{ route('admin.user.destroy', [$user->id]) }}">
                                <button class="bi bi-trash-fill text-danger bg-transparent border-0" type="submit"
                                    data-bs-toggle="tooltip" data-bs-placement="bottom" title="Delete">
                                </button>
                                @method('delete')
                                @csrf
                            </form>
                            @endif
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
            @if (count($users))
                <ul class="pagination">
                    {{ $users->withQueryString()->links() }}
                </ul>
            @else
                <div class="col-sm-12 text-center">
                    <h4 class="text-muted inline m-t-sm m-b-sm">No users available.</h4>
                </div>
            @endif
        </nav>
        </div>
        </div>

    </main>
@endsection

@extends('admin.layouts.app')
@section('content')
    {{-- Message --}}




    <div class="container">
        <div class="row">
            <div class="col-6 m-auto mt-5 pt-5">

                @if ($message = Session::get('success'))
                    <div class="alert alert-success alert-block">
                        {{ $message }}
                    </div>
                @endif

                @if ($errors->any())
                    @foreach ($errors->all() as $error)
                        <div class="alert alert-danger alert-block">{{$error}}</div>
                    @endforeach
                @endif

                <div class="card">
                    <div class="card-body">
                        <h4 class="pb-2">Create New</h4>
                        <form method="POST" action="{{ route('admin.user.store') }}">
                            @csrf
                            <div class="mb-3">
                                <label class="form-label">Name</label>
                                <input type="text" required class="form-control" placeholder="Name" name="name" value="{{ old('name') }}">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Email</label>
                                <input type="email" required class="form-control" placeholder="Email" name="email" value="{{ old('email') }}">
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Password</label>
                                <input type="password" required class="form-control" placeholder="Password" name="password">
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Role</label>
                                <input type="text" readonly class="form-control" name="role" value="admin">
                            </div>
                            
                            <div class=" mb-2 mt-3">
                                <label class="form-check-label" for="flexCheckDefault">
                                    User status
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" name="status" value="active" type="radio"
                                    id="flexRadioDefault1" checked>
                                <label class="form-check-label" for="flexRadioDefault1">
                                    Active
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="status" value="blocked"
                                    id="flexRadioDefault2">
                                <label class="form-check-label" for="flexRadioDefault2">
                                    Block
                                </label>
                            </div>
                    </div>
                    <button type="submit" class="btn btn-primary">UPDATE</button>
                    </form>


                </div>
            </div>
        </div>
    </div>

    </div>
@endsection

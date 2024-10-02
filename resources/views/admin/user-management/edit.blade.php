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

                <div class="card">
                    <div class="card-body">
                        <h4 class="pb-2">{{ $user->name }}</h4>
                        <form method="POST" action="{{ route('admin.user.update', $user->id) }}">
                            @csrf
                            @method('PUT')
                            <div class="mb-3">
                                <label class="form-label">Name</label>
                                <input type="Text" required class="form-control" value="{{ $user->name }}"
                                    name="name">
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Email address</label>
                                <input type="email" required class="form-control" value="{{ $user->email }}"
                                    name="email">
                            </div>

                            {{-- <div class="mb-3">
                <label  class="form-label">Phone Number</label>
                <input type="Text" required class="form-control" value="{{$user->phone_number}}" name="phone_number">
              </div>

              <div class="mb-3">
                <label  class="form-label">Adress</label>
                <input type="text" required class="form-control" value="{{ $user->adress}}" name="adress">
              </div> --}}

                            {{-- <div class="mb-3">
                                <label class="form-label">Password</label>
                                <input type="password" required class="form-control" value="{{ $user->password }}"
                                    name="password">
                            </div> --}}

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

                            <button type="submit" class="btn btn-primary">UPDATE</button>
                        </form>


                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection

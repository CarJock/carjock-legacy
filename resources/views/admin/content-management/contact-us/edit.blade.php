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
                        <h4 class="pb-2">Contact Us</h4>
                        <form method="POST" action="{{ route('admin.contact.update', $contacts->id) }}">
                            @csrf
                            @method('PUT')
                            <div class="mb-3">
                                <label class="form-label">Message</label>
                                <input type="Text" required class="form-control" value="{{ $contacts->message }}"
                                    name="message">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Phone</label>
                                <input type="Text" required class="form-control" value="{{ $contacts->phone }}"
                                    name="phone">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">First Name</label>
                                <input type="Text" required class="form-control" value="{{ $contacts->first_name }}"
                                    name="first_name">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Last Name</label>
                                <input type="Text" required class="form-control" value="{{ $contacts->last_name }}"
                                    name="last_name">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Email</label>
                                <input type="email" required class="form-control" value="{{ $contacts->email }}"
                                    name="email">
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

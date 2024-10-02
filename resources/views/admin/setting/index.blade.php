@extends('admin.layouts.app')
@section('content')
<main class="page-content">
    <form method="post" action="{{ route('admin.setting.store') }}">
        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Home</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Settings</li>
                    </ol>
                </nav>
            </div>
            {{-- <div class="ms-auto">
                <div class="btn-group">
                    
                </div>
            </div> --}}
        </div>
        <!--end breadcrumb-->

        <div class="card">
            @if ($message = Session::get('message'))
                <div class="alert alert-success alert-block">
                    {{ $message }}
                </div>
            @endif
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table align-middle mb-0">
                        {{-- <thead class="table-light">
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Action</th>
                            </tr>
                        </thead> --}}
                        <tbody>
                            <tr>
                                <td>
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" name="vehicle_detail_icons" {{ $setting->where('meta_key', 'vehicle_detail_icons')->where('meta_value', 'on')->first() ? 'checked' : '' }}>
                                        <label class="form-check-label" for="vehicle_detail_icons">Enable/Disable Vehicle Detail Icons</label>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <button type="submit" class="btn btn-primary mt-3">Save Setting</button>
            </div>
        </div>
    </form>
</main>
@endsection

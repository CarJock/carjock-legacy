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
            </div>
            <!--end breadcrumb-->
        </form>

        <div class="container">
            <div class="row">
                <div class="col-6 m-auto mt-2 pt-5">

                    @if ($message = Session::get('message'))
                        <div class="alert alert-{{ Session::get('alert-type', 'info') }} alert-block">
                            {{ $message }}
                        </div>
                    @endif

                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table align-middle mb-0">
                                    <tbody>
                                        <tr>
                                            <td>
                                                <div class="form-check form-switch">
                                                    <input class="form-check-input" type="checkbox"
                                                        name="vehicle_detail_icons"
                                                        {{ $setting->where('meta_key', 'vehicle_detail_icons')->where('meta_value', 'on')->first() ? 'checked' : '' }}>
                                                    <label class="form-check-label"
                                                        for="vehicle_detail_icons">Enable/Disable
                                                        Vehicle Detail Icons</label>
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <button type="submit" class="btn btn-primary mt-3">Save Setting</button>
                        </div>

                    </div>

                    <div class="card mt-5">
                        <div class="card-body">
                            <h4 class="pb-2">Chrome Data Jobs</h4>

                            <form method="POST" action="{{ route('admin.chromedata.job') }}" enctype="multipart/form-data">
                                @csrf

                                <!-- Year Field with Value Retention and Validation Error Display -->
                                <div class="mb-3">
                                    <label class="form-label">Year</label>
                                    <select name="year" class="form-control @error('year') is-invalid @enderror">
                                        <option value="">Select Year</option>
                                        <option value="2020" {{ old('year') == '2020' ? 'selected' : '' }}>2020</option>
                                        <option value="2021" {{ old('year') == '2021' ? 'selected' : '' }}>2021</option>
                                        <option value="2022" {{ old('year') == '2022' ? 'selected' : '' }}>2022</option>
                                        <option value="2023" {{ old('year') == '2023' ? 'selected' : '' }}>2023</option>
                                        <option value="2024" {{ old('year') == '2024' ? 'selected' : '' }}>2024</option>
                                        <option value="2025" {{ old('year') == '2025' ? 'selected' : '' }}>2025</option>
                                        <option value="2026" {{ old('year') == '2026' ? 'selected' : '' }}>2026</option>
                                    </select>

                                    @error('year')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Division Field with Value Retention and Validation Error Display -->
                                <div class="mb-3">
                                    <label class="form-label">Divisions / Make</label>
                                    <select name="division" class="form-control @error('division') is-invalid @enderror">
                                        <option value="all">All Divisions</option>
                                        @foreach ($divisions as $division)
                                            <option value="{{ $division->id }}"
                                                {{ old('division') == $division->id ? 'selected' : '' }}>
                                                {{ $division->name }}
                                            </option>
                                        @endforeach
                                    </select>

                                    @error('division')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Free Pull Checkbox with Value Retention -->
                                <div class="mb-3 form-check">
                                    <input type="checkbox" class="form-check-input" id="freePull" name="free_pull"
                                        value="1" {{ old('free_pull') ? 'checked' : '' }}>
                                    <label class="form-check-label" for="freePull">Pull 1000 free vehicles for the current
                                        month</label>

                                    @error('free_pull')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <button type="submit" class="btn btn-primary">Pull Data</button>
                            </form>
                        </div>
                    </div>




                </div>
            </div>
        </div>


        </div>
    </main>
@endsection

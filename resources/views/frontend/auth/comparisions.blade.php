@extends('frontend.layouts.app', ['class' => 'login'])

@section('content')
<div class="mainBanner bannerheightadjust"
    style="background-image:url({{ asset('frontend/assets/images/bg.png') }}); background-size: cover; background-repeat: no-repeat;">
    <div class="container-fluid">
        <div class="row">
            <div class="mainbanneroverlay">
                <h2>MY COMPARISIONS</h2>
                <div class="breadcrumb">
                    <ul>
                        <li>Home</li>
                        <li>{{ $user->name }}</li>
                    </ul>
                </div>
            </div>
            <!-- <img src="{{ asset('frontend/assets/images/banner/redchevcaomparebanner.jpg') }}" alt=""> -->
        </div>
    </div>
</div>

<section class="profile">
    <div class="container">
        <div class="row">
            @include('frontend.auth.sidebar')

            <div class="col-9 profile-details" id="SaveComparetions" data-card="SaveComparetions"
                style="display: block;">
                <div class="row">
                    <div class="relatedCar text-center new_sec_add">
                    <h3>{{$page_content->heading}}</h3>
                        <div class="inline-sec">
                            <p>{{$page_content->content}}</p>
                        </div>
                        <hr>

                        <div id="tab1" class="tab-content active">
                            @if($compares->isNotEmpty())
                            @foreach ($compares as $compare)
                            <div class="row hello_check">
                                <h1 class="col-8">
                                    @php($vehicles = explode(',', $compare->vehicle_ids))
                                    @if(isset($vehicles[0]))
                                    {{ App\Models\Vehicle::find($vehicles[0])->name }}
                                    @endif
                                    @if(isset($vehicles[1]))
                                    <br />
                                    {{ App\Models\Vehicle::find($vehicles[1])->name }}
                                    @endif
                                    @if(isset($vehicles[2]))
                                    <br />
                                    {{ App\Models\Vehicle::find($vehicles[2])->name }}
                                    @endif
                                    @if(isset($vehicles[3]))
                                    <br />
                                    {{ App\Models\Vehicle::find($vehicles[3])->name }}
                                    @endif
                                    @if(isset($vehicles[4]))
                                    <br />
                                    {{ App\Models\Vehicle::find($vehicles[4])->name }}
                                    @endif
                                    @if(isset($vehicles[5]))
                                    <br />
                                    {{ App\Models\Vehicle::find($vehicles[5])->name }}
                                    @endif
                                </h1>

                                <div class="flex">
                                    <a href="{{route('frontend.compare', ['comparisions' => $compare->vehicle_ids])}}">
                                        <button type="submit" class="btn btn-primary check_four mr-2">View</button>
                                    </a>
                                    <a onclick="deleteComparisions('{{ $compare->id }}', '{{route('frontend.account.compare.delete', $compare->id)}}')"
                                        data-link="{{route('frontend.account.compare.delete', $compare->id)}}"
                                        href="javascript:;">
                                        <button type="submit" class="btn btn-primary check_two mr-2">Delete</button>
                                    </a>

                                </div>
                            </div>
                            @endforeach
                            @else
                            <p class="text-center">
                                <a href="{{route('frontend.compare')}}">
                                    <button type="submit" class="btn btn-primary check_three mr-2">Compare
                                        Vehciles</button>
                                </a>
                            </p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<div class="modal fade" style="margin-top:15%" id="delete-comparision-confirmation" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Remove Comparisions</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Are you sure to delete comparisions?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                <a id="confirmationlink" href="" class="btn btn-primary">Yes</a>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<link rel="stylesheet" href="{{ asset('frontend/assets/css/profile.css') }}" />
@endpush

@push('script')
<script>
//Save Comparision script start
function deleteComparisions(id, link) {
    $('#confirmationlink').attr('href', link);
    $('#delete-comparision-confirmation').modal('toggle');
}
</script>
@endpush
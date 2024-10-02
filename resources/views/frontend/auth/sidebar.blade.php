<div class="col-3">
    <div class="profile-img-box desktop-view">
        <div class="communityF-sec profile-link">
            <a class="{{ request()->is('account/profile') ? 'active' : '' }}" href="{{route('frontend.account.profile')}}">
                <span>User Details</span>
                <img src="https://consortsolutions.com/demo/car-jock/assets/images/filteroptionsarrow.png">
            </a>
        </div>
       <hr>
       <div class="communityF-sec profile-link">
            <a class="{{ request()->is('account/profile/garage') ? 'active' : '' }}" href="{{route('frontend.account.profile.garage')}}">
             <span>   My Garage </span>
                <img src="https://consortsolutions.com/demo/car-jock/assets/images/filteroptionsarrow.png">
            </a>
        </div>
       <hr>
       <div class="communityF-sec profile-link">
            <a class="{{ request()->is('account/profile/favourites') ? 'active' : '' }}" href="{{route('frontend.account.profile.favourites')}}">
             <span>   Favorites</span>
                <img src="https://consortsolutions.com/demo/car-jock/assets/images/filteroptionsarrow.png">
            </a>
        </div>
       <hr>
        <div class="communityF-sec profile-link">
            <a class="{{ request()->is('account/profile/comparisions') ? 'active' : '' }}" href="{{route('frontend.account.profile.comparisions')}}">
              <span>  Saved Comparisons </span>
                <img src="https://consortsolutions.com/demo/car-jock/assets/images/filteroptionsarrow.png">
            </a>
        </div>
       <hr>
       {{--<div class="{{ request()->is('/account/profile') ? 'active' : '' }}" class="communityF-sec profile-link">
            <a href="{{route('frontend.forum')}}">
              <span>  Community Forum </span>
                <img src="https://consortsolutions.com/demo/car-jock/assets/images/filteroptionsarrow.png">
            </a>
        </div>
        <hr>--}}
        <div class="communityF-sec profile-link">
            <a class="{{ request()->is('account/profile/change-password') ? 'active' : '' }}" href="{{route('frontend.account.profile.change-password')}}">
               <span> Change Password </span>

                <img src="https://consortsolutions.com/demo/car-jock/assets/images/filteroptionsarrow.png">
            </a>
        </div>
       <hr>
       <div class="communityF-sec profile-link">
            <a onclick="event.preventDefault(); document.getElementById('logout-form').submit();" href="{{ route('logout') }}">
               <span> Log out </span>
                <img src="https://consortsolutions.com/demo/car-jock/assets/images/filteroptionsarrow.png">
            </a>
        </div>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
            @csrf
        </form>
    </div>


    <div class="mobile-sidebar mobile-view">
       <div class="sidebar-toggle" onclick="toggleSidebar()">
             <div class="bar"></div>
       </div>
       <div class="profile-img-box mobile-view">
          <div class="user-detail-sec profile-link active" data-profile="UserDetail"> User Details <img src="https://consortsolutions.com/demo/car-jock/assets/images/filteroptionsarrow.png"></div>
          <hr>
          <div class="gerage-sec profile-link" data-profile="Grage">Garage <img src="https://consortsolutions.com/demo/car-jock/assets/images/filteroptionsarrow.png"></div>
          <hr>
          <div class="fav-sec profile-link" data-profile="Favourite"> Favourites <img src="https://consortsolutions.com/demo/car-jock/assets/images/filteroptionsarrow.png"></div>
          <hr>
          <div class="communityF-sec profile-link" data-profile="SaveComparetions">Saved Comparison <img src="https://consortsolutions.com/demo/car-jock/assets/images/filteroptionsarrow.png"></div>
          <hr>
          {{--<div class="signout-sec profile-link" data-profile="CommmunityForm">Community Forum <img src="https://consortsolutions.com/demo/car-jock/assets/images/filteroptionsarrow.png"></div>
          <hr>--}}
          <div class="communityF-sec profile-link" data-profile="changepass">Change Password <img src="https://consortsolutions.com/demo/car-jock/assets/images/filteroptionsarrow.png"></div>
          <hr>
          <div class="signout-sec profile-link" data-profile="SignOut">Sign Out <img src="https://consortsolutions.com/demo/car-jock/assets/images/filteroptionsarrow.png"></div>
          <hr>
       </div>
    </div>

    <div class="box">
    @php $ads_img = \App\Models\Ads::getSingleAds(17);
        if (isset($ads_img->image) && $ads_img->image != "") {
            $ads_logs = new \App\Models\AdsLogs;
            $ads_logs->page_id = 17;
            $ads_logs->type = "view";
            $ads_logs->save();
    @endphp
        <a href="{{$ads_img->link}}" target="_blank" onclick="adsClicks(8);">
           <img src="{{ url('storage/ads/'.$ads_img->image) }}" height="280" width="336">
        </a>
    @php
        }
    @endphp
    </div>
 </div>

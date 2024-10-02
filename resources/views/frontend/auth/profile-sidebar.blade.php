<div class="profile-img-box">
   <div class="top-sec">
      <div class="profile-image">
         @if($user->image)
         <img src="{{ substr($user->image, 0, 4) == "http" ? $user->image : asset('storage/'.$user->image) }}"  style="border: 2px solid #86c440;border-radius: 50%;padding: 3px;width:150px;height:150px">
         @else
         <img src="{{ asset('frontend/assets/images/profile-img1.jpg') }}">
         @endif
      </div>
      <div class="user-email">
         <h4>{{ $user->name }}</h4>
         <p>{{ $user->email }}</p>
      </div>
   </div>
   <hr>
   <div class="bottom-sec">
      <a href="{{route('frontend.account.profile.edit')}}">Edit Profile</a>
      <a href="{{route('frontend.account.profile')}}">Profile</a>
      <a href="{{route('frontend.account.comparisions')}}">My Comparisions</a>
      <a class="signout-btn" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" href="{{ route('logout') }}">
            Sign Out
         </a>
         <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
         @csrf
      </form>
   </div>
</div>
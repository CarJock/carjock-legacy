<header>
	<div class="main-header">
		<div class="container-fluid">
			<div class="menu-Bar">
				<span></span>
				<span></span>
				<span></span>
			</div>
			<ul class="accoutNav mobile">
							<li>
								<a href="#"></a>
							</li>
							<li>
								<a href="{{route('frontend.compare')}}"><img src="{{ asset('frontend/assets/images/profile.png') }}" alt="Profile">
									<span class="total-comparisions">0</span>
							</a></li>
							@if(Auth::check())
							<li><a href="{{ route('frontend.account.profile') }}"><i class="fal fa-user"></i>{{auth()->user()->username}}</a></li>
							@else
							<li><a href="{{ route('frontend.account') }}"><i class="fal fa-user"></i></a></li>
							@endif

						</ul>
			<div class="row align-items-center">
				<div class="col-md-3 text-left">
					<a href="{{ url('/') }}" class="logo">
						<img src="{{ asset('frontend/assets/images/logo.png') }}" alt="">
					</a>
				</div>
				<div class="col-md-9 text-center">
					<div class="menuWrap">
						<ul class="menu">
							<li class="{{ request()->is('/') ? 'active' : '' }}"><a href="{{route('frontend.home')}}">Find Your Next Car</a></li>
							<li class="{{ request()->is('compare') ? 'active' : '' }}"><a href="{{route('frontend.compare')}}">Compare Vehicles </a></li>
							<li class="{{ request()->is('blogs') ? 'active' : '' }}">
                                <a href="{{url('/')}}/blogs">Blogs</a>
                            </li>
						</ul>
						<ul class="accoutNav desktop">
							<li>
								<a href="#"></a>
							</li>
							<li>
								<a href="{{route('frontend.compare')}}"><img src="{{ asset('frontend/assets/images/profile.png') }}" alt="Profile">
									<span class="total-comparisions">0</span>
							</a></li>
							@if(Auth::check())
							<li><a href="{{ route('frontend.account.profile') }}"><i class="fal fa-user"></i>{{auth()->user()->username}}</a></li>
							@else
							<li><a href="{{ route('frontend.account') }}"><i class="fal fa-user"></i>Login</a></li>
							@endif

						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>
</header>

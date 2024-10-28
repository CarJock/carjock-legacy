<!--User-profile-->
<style>
    .custom-file-upload {
        cursor: pointer;
        background-color: #007bff;
        color: #fff;
        border-radius: 5px;
        position: absolute;
        top: 0px;
        left: 0px;
        border: none !important;
        padding-top: 8px;
        padding-bottom: 8px !important;
        padding-right: 4px;
    }

    .custom-file-upload:hover {
        background-color: #0056b3;
    }
</style>
<div class="col-9 profile-details" id="UserDetail" data-card="UserDetail">
    <div class="top-sec">
        <div class="profile-image">
            @if ($user->image)
                <img src="{{ substr($user->image, 0, 4) == 'http' ? $user->image : asset('storage/' . $user->image) }}"
                    style="border: 2px solid #86c440;border-radius: 50%;padding: 3px;width:150px;height:150px">
            @else
                <img src="{{ asset('frontend/assets/images/placeholder-user.jpg') }}"
                    style="border: 2px solid #86c440;border-radius: 50%;padding: 3px;width:150px;height:150px">
            @endif
        </div>
        <div class="user-email" style="margin-top: 13px">
            <h4>{{ $user->username }}</h4>
            {{-- <p>{{ $user->email }}</p> --}}
        </div>
    </div>
    <div class="container mt-4">
        @if ($message = Session::get('message'))
            <div class="alert alert-success alert-block">
                {{ $message }}
            </div>
        @endif
        <form class="profile-edit-form" action="{{ route('frontend.account.profile.update') }}" method="POST"
            enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-md-6">
                    <label class="form-label" for="registerUsername">Profile Picture*</label>
                    <div class="form-control position-relative">
                        <input class="mb_setting_format"
                            style="position: absolute; top: 4px; left: 36px; width: 369px ; border: none !important"
                            type="file" name="image" id="imageInput" />
                        <label for="imageInput" class="custom-file-upload">Upload a picture</label>
                    </div>
                    @error('image')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>


                <div class="col-md-6">
                    <label class="form-label" for="registerUsername">Username*</label>
                    <input type="text" name="username" class="form-control" placeholder="Username"
                        value="{{ old('username') ?? ($user->username ?? $user->username) }}" />
                    @error('username')
                        <span class="invalid-feedback" style="display:block" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="col-md-6">
                    <label class="form-label" for="registerUsername">First Name*</label>
                    <input type="text" name="firstname" class="form-control" placeholder="Firstname"
                        value="{{ old('firstname') ?? ($user->firstname ?? $user->name) }}" />
                    @error('firstname')
                        <span class="invalid-feedback" style="display:block" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="col-md-6">
                    <label class="form-label" for="registerUsername">Last Name*</label>
                    <input type="text" name="lastname" class="form-control" placeholder="Lastname"
                        value="{{ old('lastname') ?? $user->lastname }}" />
                    @error('lastname')
                        <span class="invalid-feedback" style="display:block" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="col-md-6">
                    <label class="form-label" for="registerEmail">Email Address*</label>
                    <input type="email" disabled name="email" id="registerEmail" class="form-control"
                        value="{{ old('email') ?? $user->email }}" placeholder="Your Email" />
                    @error('email')
                        <span class="invalid-feedback" style="display:block" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="col-md-6">
                    <label class="form-label" for="country">Country*</label>
                    <select name="country" id="country" class="form-control">
                        <option value="">Select your country</option>
                        <option value="usa" {{ (old('country') ?? $user->country) == 'usa' ? 'selected' : '' }}>
                            United States</option>
                        <option value="canada" {{ (old('country') ?? $user->country) == 'canada' ? 'selected' : '' }}>
                            Canada</option>
                        <option value="japan" {{ (old('country') ?? $user->country) == 'japan' ? 'selected' : '' }}>
                            Japan</option>
                        <!-- Add more country options as needed -->
                    </select>
                    @error('country')
                        <span class="invalid-feedback" style="display:block" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="col-md-6">
                    <label class="form-label" for="city">City*</label>
                    <input type="text" name="city" id="city" class="form-control"
                        value="{{ old('city') ?? $user->city }}" placeholder="Enter your city" />
                    @error('city')
                        <span class="invalid-feedback" style="display:block" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>





                <div class="col-md-6">
                    <label class="form-label" for="registerEmail">Subscribe for Newsletter*</label>
                    <div class="content">
                        <label class="switch">
                            <input type="checkbox" name="is_subscribed"
                                {{ old('is_subscribed') == 'on' ? 'checked="checked"' : ($user->is_subscribed == 1 ? 'checked="checked"' : '') }}">
                            <span class="slider round"></span>
                        </label>
                    </div>
                </div>


            </div>
            <div class="row mt-3">
                <div class="col-md-12">
                    <button type="submit" class="btn btn-primary">Save Changes</button>
                </div>
            </div>
        </form>
    </div>
</div>

<!--User-profile-End-->

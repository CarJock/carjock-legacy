@extends('frontend.layouts.app', ['class' => 'contact_us'])

@section('content')
<div class="mainBanner bannerheightadjust"
    style="background-image:url({{ url('storage/banners/'.$banner->image) }}); background-size: cover; background-repeat: no-repeat;">
    <div class="container-fluid">
        <div class="row">
            <div class="mainbanneroverlay">
                <h2>CONTACT US</h2>
                <div class="breadcrumb">
                    <ul>
                        <li>Home</li>
                        <li>Contact us</li>

                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<section class=" cus_form py-5 ">
    <div class="container-fluid">
        <div class="row">
            <div class="col-5 first">
                <h2>{{$contactus->heading}}</h2>
                <p>{{$contactus->content}}</p>

                @if(session('success'))
                    <div style="color: green;">
                        {{ session('success') }}
                    </div>
                @endif

                @if ($errors->any())
                    <div style="color: red;">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('frontend.contact-us') }}" method="POST">
                    @csrf
                    <ul class="flex_list">
                        <li>
                            <input type="text" name="first_name" class="field-style field-split align-left"
                                placeholder="First Name*" require value="{{ old('first_name') }}"/>
                            <input type="text" name="last_name" class="field-style field-split align-right"
                                placeholder="Last Name*" require value="{{ old('last_name') }}"/>

                        </li>
                        <li>
                            <input type="email" name="email" class="field-style field-split align-left"
                                placeholder="Your Email*" require value="{{ old('email') }}"/>
                            <input type="text" name="phone" class="field-style field-split align-right"
                                placeholder="Phone" require value="{{ old('phone') }}"/>
                        </li>

                        <li class="list_icon_add">
                            <select name="question" require>
                            <option value="">Questions</option>
                                <option value="support" {{ old('question') == 'support' ? 'selected' : '' }}>Account Support</option>
                                <option value="feedback" {{ old('question') == 'feedback' ? 'selected' : '' }}>Feedback</option>
                                <option value="advertising" {{ old('question') == 'advertising' ? 'selected' : '' }}>Advertising with Us</option>
                                <option value="other" {{ old('question') == 'other' ? 'selected' : '' }}>Other</option>
                            </select>
                        </li>

                        <li>
                            <textarea maxlength="2000" name="message" class="field-style custom"
                                placeholder="Message" require>{{ old('message') }}</textarea>
                        </li>
                        <li>
                            <input class="contact_submitbtn"  type="submit" value="Send" />
                        </li>
                    </ul>
                </form>
            </div>
            <div class="col-7">
                <img src="{{ asset('frontend/assets/images/car-1.png') }}" alt="">
            </div>
        </div>
    </div>
</section>
@endsection

@push('styles')
<style>
section.cus_form.py-5 input, section.cus_form.py-5 select, section.cus_form.py-5 textarea {
    border: 1px solid #C3C3C3;
    border-radius: 6px;
    font-family: 'Poppins', sans-serif;
    font-weight: 400;
    padding: 25px 20px;
    margin-bottom: 15px;
}
section.cus_form.py-5 select{
    width: 100%;
}
.flex_list li {
    display:flex;
    justify-content:space-between;
}
.flex_list li input{ width: 49%;}
.contact_submitbtn{
    background-image: linear-gradient(to left, #86c440, #6cbb4b, #54b155, #3ca65c, #239b62) !important;
    color: #fff;
    padding: 11px 20px !important;
    border-radius: 4px !important;
    font-size: 18px;
}
.contact_us textarea.field-style.custom {

    height: 123px;
    padding-top: 15px;
}
section.cus_form.py-5 select {
    padding: 0px 15px;
    height: 60px;
    color: #aca3a3;
    -webkit-appearance: none;
  appearance: none;
  cursor:pointer;
}
li.list_icon_add {
    position: relative;
}
section.cus_form.py-5 form {
    margin-top: 15px;
}

li.list_icon_add::before {
    content: "";
    position: absolute;
    background-image: url(http://192.168.1.113:8000/frontend/assets/images/arrowdn.png);
    width: 17px;
    height: 10px;
    background-repeat: no-repeat;
    top: 30%;
    right:3%;
}
</style>
@endpush
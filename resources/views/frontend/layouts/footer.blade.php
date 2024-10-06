<footer>
   <div class="footerWrapper">
      <div class="container-fluid">
         <div class="row">
            
            <div class="col-md-4">
               <div class="widget">
                  <img src="{{ asset('frontend/assets/images/footerLogo.png') }}" alt="">
                  @php $footer_content = \App\Models\PageContent::where(['page_id' => 12])->first(); 
                     echo '<p>' . $footer_content->content . '</p>';
                  @endphp
                  <!-- <p>Ut enim ad minim veniam, quis nostrud eiusmod tempor incididunt ut labore et dolore magna aliqua.</p> -->
                  <p><strong>Connect With Us:</strong></p>
                  <ul class="footerSocial">
                     @php 
                        $footer_social = \App\Models\SocialMediaLinks::orderby("sort", "ASC")->get();
                        if ($footer_social) {
                           foreach($footer_social as $social) {
                              if ($social->social_link != "") {
                                 $social_name = "";
                                 if ($social->social_name == "facebook") {
                                    $social_name = "fab fa-facebook-f";
                                 } elseif ($social->social_name == "youtube") {
                                    $social_name = "fab fa-youtube";
                                 } elseif ($social->social_name == "instagram") {
                                    $social_name = "fab fa-instagram";
                                 }
                                 
                                 if ($social->social_name == "twitter") {
                                    echo '<li><a target="_blank" href="'. $social->social_link .'">
                                       <img style="width: 14px; height: 14px;" src="'. asset("frontend/assets/images/twitter.png") .'"
                                       alt=""></a></li>';
                                 } else {
                                    echo '<li><a target="_blank" href="'. $social->social_link .'">
                                          <i class="'.$social_name.'"></i>
                                       </a></li>';
                                 }
                              }
                           }
                        }
                     @endphp
                  </ul>
               </div>
            </div>

            <div class="col-md-4 new_change">
               <div class="widget">
                  <h3>USEFUL LINKS</h3>
                  <ul class="useFullLinks">
                     <li><a href="{{ route('frontend.aboutus') }}"><i class="far fa-chevron-double-right"></i>About Us</a></li>
                     <li><a href="{{ route('frontend.contact') }}"><i class="far fa-chevron-double-right"></i>Contact Us</a></li>
                     <li><a href="{{ route('frontend.disclaimer') }}"><i class="far fa-chevron-double-right"></i>Disclaimer</a></li>
                     <li><a href="{{ route('frontend.faqs') }}"><i class="far fa-chevron-double-right"></i>FAQ</a></li>
                     <li><a href="{{url('/')}}/blogs"><i class="far fa-chevron-double-right"></i>Blogs</a></li>
                     <li><a href="{{ route('frontend.search') }}"><i class="far fa-chevron-double-right"></i>Search</a></li>
                     <li><a href="{{ route('frontend.privacy-policy') }}"><i class="far fa-chevron-double-right"></i>Privacy</a></li>
                     <li><a href="{{ route('frontend.term-conditions') }}"><i class="far fa-chevron-double-right"></i>Terms & Conditions</a></li>
                     <li><a href="{{ route('frontend.account.profile') }}"><i class="far fa-chevron-double-right"></i>My Profile</a></li>
                  </ul>
               </div>
            </div><!-- // COl // -->

            <!--<div class="col-md-3">-->
            <!--   <div class="widget">-->
            <!--      <h3>CONTACT US</h3>-->
            <!--<ul class="addressInfo">-->
            <!--   <li><i class="fas fa-map-marker-alt"></i> Lipsum St, 128 Loma Town, Florida California 1367 USA </li>-->
            <!--   <li><i class="fas fa-phone-alt"></i> Phone : 1 - XXX - XXXX - XXX</li>-->
            <!--   <li><i class="far fa-fax"></i> FAX : 1 - XXX - XXXX - XXX</li>-->
            <!--   <li><i class="fas fa-envelope"></i> Email : info@carjock.com</li>-->
            <!--</ul>-->



            <!--           <form>-->
            <!--            <input style="height: 45px;" type="name" name="name" placeholder="First Name">-->
            <!--             <input style="height: 45px;" type="email" name="email" placeholder="Email Address">-->
            <!--              <input style="height: 45px;" type="Subject" name="Subject" placeholder="Subject">-->
            <!--              <textarea id="Message" name="Messaget" placeholder="Message" style="height:100px"></textarea>-->
            <!--            <button type="submit">Send<i class="far fa-chevron-double-right"></i></button>-->
            <!--         </form>-->



            <!--   </div>-->
            <!--</div> COl // -->

            <div class="col-md-3">
               <div class="widget">
                  <h3>SUBSCRIBE TO OUR NEWSLETTER</h3>
                  <p>Enter your e-mail and subscribe to our newsletter.</p>
                  <form id="subscription_form">
                     <input type="email" name="subscriptions_email" id="subscriptions_email" placeholder="name@domain.com">
                     <button type="submit">Subscribe </button>
                  </form>
               </div>
            </div><!-- // COl // -->

         </div><!-- // Row // -->


      </div><!-- // Container-Fluid // -->

   </div>
   <div class="copyright">
      <div class="row">

         <div>@php echo date("Y"); @endphp-<a herf="/" style="color:green;">CarJock</a> All Rights Reserved</div>
         <div>Terms of use <a herf="privacy-policy" style="color:grey;">Privacy Policy</a> Cookies Policy</div>
      </div>
   </div>
</footer>
<script src="{{ asset('frontend/assets/js/jquery.js') }}"></script>
<script>
   $('#subscription_form').on('submit', function(e) {
      e.preventDefault();
      let subscriptions_email = $('#subscriptions_email').val();
      var emailPattern = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/;
      
      if (emailPattern.test(subscriptions_email)) {
         $("#subscriptions_email").removeClass('error_input');
         $(".error_text").remove();
         // Perform further actions, such as submitting the form
         $.ajax({
            url: "{{ route('frontend.subscribe') }}",
            method: 'POST',
            data: {
               _token: '{{ csrf_token() }}',
               email: subscriptions_email
            },
            success: function(res) {
               $('#subscriptions_email').after('<span class="success_text">'+res.success+'</span>');
            },
            error: function(response) {
               $('#subscriptions_email').after('<span class="error_text">'+response.responseJSON.errors.email+'</span>');
            }
         });
      } else {
         $("#subscriptions_email").addClass('error_input');
         $('#subscriptions_email').after('<span class="error_text">Invalid email address.</span>');
      }

      return false;
      
   });

   function adsClicks(page_id, slot=0) {
      $.ajax({
         url: "{{ route('frontend.ads-clicks') }}",
         method: 'POST',
         data: {
            _token: '{{ csrf_token() }}',
            page_id: page_id,
            slot: slot,
         },
         success: function(res) {},
         error: function(response) {}
      });
   }
</script>

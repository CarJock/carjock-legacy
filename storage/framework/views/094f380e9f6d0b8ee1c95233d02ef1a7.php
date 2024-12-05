<?php $__env->startSection('content'); ?>
<section class="thankyou">
    <div class="thank">
        <div class="addbanner text-center">

        </div>
    </div>
    <section class="second">
        <div class="container">
            <div class="row">
                <!--<div class="col-5">-->
                <!--   <img src="assets/images/Image 38.png" alt="">-->
                <!--</div>-->
                <div class="col-12">
                    <h1>
                        <?php 
                            if(isset($thankyou) && $thankyou->short_heading != "") {
                                echo $thankyou->short_heading;        
                            } else {
                                echo "Thank you";
                            }
                        ?>
                    </h1>
                    <p>
                        <?php 
                            if(isset($thankyou) && $thankyou->heading != "") {
                                echo $thankyou->heading;        
                            } else {
                                echo "Thank You for Joining CarJock!";
                            }
                        ?>
                    </p>
                    <div style="text-align:left !important;">
                        <?php 
                            if(isset($thankyou) && $thankyou->content != "") {
                                echo $thankyou->content;        
                            } else {
                                echo "<p>We're thrilled to welcome you to the CarJock community. You've taken the first step towards a hassle-free and informed car shopping experience.</p><p>What's Next:</p><p>Explore the world of cars with our powerful search tool.<br>Save your favorite cars to compare later.<br>Engage in discussions with fellow car enthusiasts on our community forum.<br>Stay updated on the latest automotive news through our blog.<br>Your support means the world to us, and we're here to make your car-buying journey easier and more enjoyable. If you have any questions or need assistance, feel free to reach out to our friendly team.</p><p>Thanks for choosing CarJock, where car shopping becomes a pleasure.</p><p>Happy Exploring!</p>";
                            }
                        ?>
                    </div>
                <div class="d-flex" style="justify-content: center">
                <a href="/">
                    <button type="button" class="btn mx-3">Back to Home </button>
                </a>
                <a href="<?php echo e(route('frontend.account.profile')); ?>">
                    <button type="button" class="btn">View Profile</button>
                </a>
                </div>
                </div>
            </div>
        </div>
    </section>
</section>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('styles'); ?>
    <style>
        .thank{
            padding-top: 7%;

        }
        .thankyou .second img{
            padding-top: 10%;
        }
        /*.thankyou .second .col-7 {*/
        /*    font-size: 35px;*/
        /*    font-weight: 700;*/
        /*    padding: 3% 66px 0px;*/
        /*    text-align: center;*/
        /*}*/

            .thankyou .second .col-12 {
            font-size: 35px;
            font-weight: 700;
            padding: 0% 66px 14%;
            text-align: center;
            margin-bottom: 60px;
        }



            .thankyou .second .col-12 {
            font-size: 35px;
            font-weight: 700;
            padding: 3% 66px 0px;
            text-align: center;
            margin-bottom: 110px;
        }



        .thankyou .second h1 {
        border-bottom: 1px solid rgb(211, 205, 205);
        width: 95%;
            padding: 25px 0;
        }
        .thankyou .second p{
            padding-top: 20px;
        }
        .thankyou .second .btn{
            background: #86c440;
            background: linear-gradient(-93deg,
                    #86c440 0.00%,
                    #239b62 100.00%);
            color: white;
            margin-top: 30px;
            text-align: center;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 10px;
                display: flex;
            justify-content: center;
            align-items: center;
        }
        .thankyou .second .btn img{
            height: 30px;
            padding: 8px;
        }
    </style>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('frontend.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/carjock/resources/views/frontend/pages/thankyou.blade.php ENDPATH**/ ?>
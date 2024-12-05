<?php $__env->startSection('content'); ?>
<div class="mainBanner bannerheightadjust"
    style="background-image:url(<?php echo e(url('storage/banners/'.$banner->image)); ?>); background-size: cover; background-repeat: no-repeat;">
    <div class="container-fluid">
        <div class="row">
            <div class="mainbanneroverlay">
                <h2>About Us</h2>
                <div class="breadcrumb">
                    <ul>
                        <li>Home</li>
                        <li>About Us</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<section class="dis_claim py-5">

    <div class="container">
        <div class="col-md-12">
            <h2><?php echo e($aboutus->heading); ?></h2>
            <p><?php echo $aboutus->content; ?></p>
        </div>
        <!-- <div class="col-md-12">

            <h2>1. DISCLAIMER</h2>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Illum modi cum sint!
                Distinctio, rerum ipsam. Aperiam, quasi iste saepe numquam obcaecati vero accusamus
                tenetur rem? Beatae aliquam amet est ipsa dolore, at libero perspiciatis delectus id
                animi natus accusamus ad ratione repellat unde sed, ducimus, corporis recusandae quo
                iure? Placeat, sit quaerat neque debitis optio qui ipsa similique! Doloremque sint
                facere fuga ea est sapiente, nam pariatur quod non tenetur totam voluptates officia,
                nobis illum at reprehenderit consequuntur dolorum? Consequuntur atque labore quo
                perferendis enim, eveniet ipsa! Sunt optio cumque, provident animi fugiat cum veritatis
                reprehenderit distinctio perspiciatis vel! Deserunt.</p>
        </div>
        <div class="col-md-12">
            <h2>2. YOUR REGISTRATION OBLIGATIONS</h2>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Illum modi cum sint!
                Distinctio, rerum ipsam. Aperiam, quasi iste saepe numquam obcaecati vero accusamus
                tenetur rem? Beatae aliquam amet est ipsa dolore, at libero perspiciatis delectus id
                animi natus accusamus ad ratione repellat unde sed, ducimus, corporis recusandae quo
                iure? Placeat, sit quaerat neque debitis optio qui ipsa similique! Doloremque sint
                facere fuga ea est sapiente, nam pariatur quod non tenetur totam voluptates officia,
                nobis illum at reprehenderit consequuntur dolorum? Consequuntur atque labore quo
                perferendis enim, eveniet ipsa! Sunt optio cumque, provident animi fugiat cum veritatis
                reprehenderit distinctio perspiciatis vel! Deserunt.</p>

        </div>
        <div class="col-md-12">

            <h2>3. USER ACCOUNT, PASSWORD, AND SECURITY</h2>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Illum modi cum sint!
                Distinctio, rerum ipsam.Lorem ipsum dolor sit amet, consectetur adipisicing elit. Illum modi cum
                sint!
                Distinctio, rerum ipsam.</p>


            <h2>4. USER CONDUCT</h2>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Illum modi cum sint!
                Distinctio, rerum ipsam.Lorem ipsum dolor sit amet, consectetur adipisicing elit. Illum modi cum
                sint!
                Distinctio, rerum ipsam.</p>

            <div class="cus_para">
                <img src="<?php echo e(asset('frontend/assets/images/Group 358.png')); ?>">
                <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Minus, facilis.</p>

                <img src="<?php echo e(asset('frontend/assets/images/Group 358.png')); ?>">
                <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Minus, facilis.</p>

                <img src="<?php echo e(asset('frontend/assets/images/Group 358.png')); ?>">
                <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Minus, facilis.</p>

                <img src="<?php echo e(asset('frontend/assets/images/Group 358.png')); ?>">
                <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Minus, facilis.</p>


            </div>
            <h2>5. USER CONDUCT</h2>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Illum modi cum sint!
                Distinctio, rerum ipsam.Lorem ipsum dolor sit amet, consectetur adipisicing elit. Illum modi cum
                sint!
                Distinctio, rerum ipsam.Lorem ipsum dolor sit amet, consectetur adipisicing elit. Illum modi cum
                sint!
                Distinctio, rerum ipsam.Lorem ipsum dolor sit amet, consectetur adipisicing elit. Illum modi cum
                sint!
                Distinctio, rerum ipsam.</p> -->


        </div>
    </div>

</section>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('frontend.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/carjock/resources/views/frontend/pages/about-us.blade.php ENDPATH**/ ?>
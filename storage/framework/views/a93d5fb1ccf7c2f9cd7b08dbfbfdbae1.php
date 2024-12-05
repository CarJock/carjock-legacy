<?php $__env->startSection('content'); ?>
<div class="mainBanner bannerheightadjust"
    style="background-image:url(<?php echo e(url('storage/banners/'.$banner->image)); ?>); background-size: cover; background-repeat: no-repeat;">
    <div class="container-fluid">
        <div class="row">
            <div class="mainbanneroverlay">
                <h2>FAQ</h2>
                <div class="breadcrumb">
                    <ul>
                        <li>Home</li>
                        <li>Faq</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<section class="faQ">
    <div class="container">

        <div class="text">
            <h5><?php echo e($faqs_content->short_heading); ?></h5>
            <h2><span><?php echo e($faqs_content->heading); ?></span></h2>
            <P><?php echo e($faqs_content->content); ?></P>
        </div>

        <div class="row justify-content-center">
            <div class="col-8">
                <div class="faqs-box">
                    <div class="accordion">
                        <?php $i = 1; 
                        $divide = round(count($faqs) / 2);
                        ?>
                        <?php $__currentLoopData = $faqs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $faq): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="step">
                            <input id="step-<?php echo e($i); ?>" type="checkbox" class="step-checkbox">
                            <div class="step-inner">
                                <label for="step-<?php echo e($i); ?>" class="header">
                                    <span class="title"><?php echo e($faq->question); ?></span>
                                    <span class="dropdown-btn">
                                        <img decoding="async" class="plus"
                                            src="<?php echo e(asset('frontend/assets/images/accordianopen.png')); ?>"
                                            alt="plus icon">
                                        <img decoding="async" class="minus"
                                            src="<?php echo e(asset('frontend/assets/images/accordianclose.png')); ?>"
                                            alt="minus icon">
                                    </span>
                                </label>
                                <div class="body"><p><?php echo e($faq->description); ?></p></div>
                            </div>
                        </div>
                        <?php 
                            if ($i == $divide)
                            {
                                if (isset($ads->image) && $ads->image != "") {
                                    echo '<div class="img_box">
                                            <a href="'.$ads->link.'" target="_blank" onclick="adsClicks(8);">
                                                <img src="'.url('storage/ads/'.$ads->image).'" width="728" height="90">
                                            </a>
                                        </div>';
                                }
                            }
                            $i++; 
                        ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>

                
            </div>

        </div>

    </div>
</section>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('styles'); ?>
<style>
section {
    padding: 50px;
}

.text {
    padding: 20px;
    text-align: center;
}

.text h5 {
    font-family: 'Good Times Rg';
    font-size: 16px;
    line-height: 25px;
    letter-spacing: 3.2px;
}

.text p {
    line-height: 26px;
    display: block;
}

span {
    font-size: 36px;
    color: #86C440;
    font-weight: 700;
    line-height: 63px;
}

.eachaccordian {
    border: 1px solid #9d9d9d;
    border-radius: 10px;
    margin-top: 20px;
}

.accordiantitle {
    font-size: 20px;
    font-weight: 500;
    color: #000000;
    padding: 19px 30px;
    border-bottom: 1px solid #9d9d9d;
    border-radius: 10px;
    background-color: #fff;
    background-image: url({{ asset('frontend/assets/images/accordianopen.png')
}
}

);
background-position: 99% center;
background-repeat: no-repeat;
cursor: pointer;
}

.accordiancontent {
    background: #f5f6f7;
    height: 0;
    overflow: hidden;
    border-radius: 0 0 10px 10px;
}

.accordiantitle:active {
    background-image: url({{ asset('frontend/assets/images/accordianclose.png')
}
}

);
}

.img_box {
    margin: 0px 0px 20px 0px;
}

.bannerheightadjust {
    min-height: 417px;
}

/* Accordian Css */

.accordion .step .header {
    line-height: 2em;
    padding: 8px 20px;
    user-select: none;
    display: flex;
    cursor: pointer;
    align-items: center;
    width: 100%;
    background-color: #fff;
    margin-bottom: 0
}

.accordion .step .header .title {
    flex: 1;
    line-height: 26px;
    font-size: 18px;
    font-weight: 500;
    margin: 0px;
    color: #000000;
}

.accordion .step .header .dropdown-btn {
    display: flex;
    align-items: center;
    justify-content: center;
    width: 40px;
    height: 40px;
    border-radius: 25px;
    transition: .4s ease all;
    margin-left: 10px
}


.accordion .step .header .dropdown-btn img {
    height: 80%;
    width: 80%;
    object-fit: contain;
    object-position: center
}

.accordion .step .header .dropdown-btn img.minus {
    display: none
}

.accordion,
.accordion .step {
    display: flex;
    flex-direction: column;
    align-items: start;
    justify-content: start;
}

.accordion .step {
    width: 100%;
    margin: 5px 0
}

.accordion .step>input[type=checkbox] {
    display: none;
}

.accordion .step-inner {
    border: 1px solid #dbd7d7b3;
    box-shadow: 0px 0px 3px #dbd7d7b3;
    background-color: #fff
}

.col-6.m-auto {
    max-width: 100% !important;
}

.accordion .step .step-inner {
    border-radius: 10px;
    overflow: hidden;
    margin-bottom: 20px
}

.accordion .step .step-inner .body {
    padding: 0 20px;
    height: 0;
    transition: .4s ease all
}

.accordion .step .step-inner .body p {
    font-size: 18px;
    color: #2a2c2d9e;
    font-family: nunito;
    font-weight: 600;
    line-height: 28px
}

.accordion .step .step-inner .body ul {
    padding-left: 22px;
    padding-top: 8px;
    padding-bottom: 8px
}

.accordion .step .step-inner .body ul li {
    list-style: none;
    position: relative;
    line-height: 1.6;
    font-size: 16px
}

.accordion .step .step-inner .body ul li::before {
    content: '';
    position: absolute;
    left: -22px;
    top: 5px;
    width: 16px;
    height: 16px;
    background-image: url(data:image/svg+xml;base64,PHN2ZyB4bWxucz0naHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmcnIHdpZHRoPScxOCcgaGVpZ2h0PScxOCcgdmlld0JveD0nMCAwIDE4IDE4JyBmaWxsPSdub25lJz48cGF0aCBkPSdNMTggOS4wMDAxMkMxOCAxMy45NzA3IDEzLjk3MDYgMTguMDAwMSA5IDE4LjAwMDFDNC4wMjk0NCAxOC4wMDAxIDAgMTMuOTcwNyAwIDkuMDAwMTJDMCA0LjAyOTU2IDQuMDI5NDQgMC4wMDAxMjIwNyA5IDAuMDAwMTIyMDdDMTMuOTcwNiAwLjAwMDEyMjA3IDE4IDQuMDI5NTYgMTggOS4wMDAxMlonIGZpbGw9JyMwMzVDNjcnLz48cGF0aCBkPSdNMTMuMjEwNyA0LjE5NEMxMy4wMzQ0IDQuMDk1NzQgMTIuODQwNSA0LjAzMzI1IDEyLjY0MDEgNC4wMTAxMUMxMi40Mzk3IDMuOTg2OTcgMTIuMjM2OCA0LjAwMzYzIDEyLjA0MjggNC4wNTkxNEMxMS44NDg5IDQuMTE0NjQgMTEuNjY3NyA0LjIwNzkxIDExLjUwOTggNC4zMzM2QzExLjM1MTggNC40NTkyOCAxMS4yMjAyIDQuNjE0OTMgMTEuMTIyMyA0Ljc5MTY0TDguMjcxNTcgOS45MzExNUw2LjY0MDA1IDguMjk2NjlDNi40OTg0IDguMTQ5NzcgNi4zMjg5NiA4LjAzMjU3IDYuMTQxNjIgNy45NTE5NUM1Ljk1NDI3IDcuODcxMzMgNS43NTI3OCA3LjgyODg5IDUuNTQ4ODkgNy44MjcxMkM1LjM0NSA3LjgyNTM0IDUuMTQyOCA3Ljg2NDI3IDQuOTU0MDkgNy45NDE2MUM0Ljc2NTM3IDguMDE4OTYgNC41OTM5MyA4LjEzMzE5IDQuNDQ5NzUgOC4yNzc2MkM0LjMwNTU3IDguNDIyMDYgNC4xOTE1NiA4LjU5MzgyIDQuMTE0MzUgOC43ODI4N0M0LjAzNzE0IDguOTcxOTIgMy45OTgyOSA5LjE3NDQ5IDQuMDAwMDYgOS4zNzg3NEM0LjAwMTgzIDkuNTgzIDQuMDQ0MTkgOS43ODQ4NiA0LjEyNDY3IDkuOTcyNTRDNC4yMDUxNCAxMC4xNjAyIDQuMzIyMTIgMTAuMzMgNC40Njg3OCAxMC40NzE5TDcuNTM5ODggMTMuNTQ4NUM3LjgzMDEgMTMuODQgOC4yMjE2NiAxNCA4LjYyNTUxIDE0TDguODM4MTggMTMuOTg0NkM5LjA3MzU0IDEzLjk1MTYgOS4yOTgwNSAxMy44NjQ0IDkuNDk0MDMgMTMuNzI5N0M5LjY5MDAxIDEzLjU5NSA5Ljg1MjExIDEzLjQxNjYgOS45Njc1OCAxMy4yMDg1TDEzLjgwNjQgNi4yODYxMUMxMy45MDQ1IDYuMTA5NTUgMTMuOTY2OCA1LjkxNTM4IDEzLjk4OTkgNS43MTQ2OUMxNC4wMTMgNS41MTM5OSAxMy45OTY0IDUuMzEwNzEgMTMuOTQxMSA1LjExNjQzQzEzLjg4NTggNC45MjIxNiAxMy43OTI4IDQuNzQwNzEgMTMuNjY3NCA0LjU4MjQ0QzEzLjU0MjEgNC40MjQxNiAxMy4zODY5IDQuMjkyMTcgMTMuMjEwNyA0LjE5NFonIGZpbGw9J3doaXRlJy8+PC9zdmc+);
    background-size: cover;
    background-repeat: no-repeat
}

.accordion .step input[type=checkbox]:checked+.step-inner label img.minus {
    display: block
}

.accordion .step input[type=checkbox]:checked+.step-inner label img.plus {
    display: none
}

.accordion .step input[type=checkbox]:checked+.step-inner .body {
    padding: 20px;
    height: auto
}

@media screen and (max-width:767px) {
    section {
        padding: 0px;
    }

    h2 span {
        font-size: 22px;
        padding: 15px 0px;
        line-height: 28px;
    }

    .mainBanner.bannerheightadjust h2 {
        font-size: 60px;
    }

    section.faQ .col-8 {
        flex: 0px !important;
        max-width: 100%;
    }
}
</style>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('frontend.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/carjock/resources/views/frontend/pages/faqs.blade.php ENDPATH**/ ?>
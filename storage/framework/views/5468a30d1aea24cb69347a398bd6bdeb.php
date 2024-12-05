<?php $__env->startSection('content'); ?>
<div class="mainBanner bannerheightadjust"
    style="background-image:url(<?php echo e(url('storage/banners/'.$banner->image)); ?>); background-size: cover; background-repeat: no-repeat;">
    <div class="container-fluid">
        <div class="row">
            <div class="mainbanneroverlay">
                <h2>Search</h2>
                <div class="breadcrumb">
                    <ul>
                        <li>Home</li>
                        <li>Search</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<?php echo $__env->make('frontend.filter', ['class' => 'filter-search-section-cus'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<section id="search-results">
    <div class="row">
        <div class="col-md-9">
            <?php echo $__env->make('frontend.filter-applied', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        </div>

        <div class="col-md-3 mb-5">
            <select name="order_by" id="search_sorting">
                <option value="">Sort By</option>
                <option value="pricing_desc"
                    <?php echo e(isset(request()->order_by) && request()->order_by == 'pricing_desc' ? 'selected="selected"' : ''); ?>>
                    Price high to low</option>
                <option value="pricing_asc"
                    <?php echo e(isset(request()->order_by) && request()->order_by == 'pricing_asc' ? 'selected="selected"' : (!isset(request()->order_by) ? 'selected="selected"' : '' )); ?>>
                    Price low to high</option>
                <option value="name_asc"
                    <?php echo e(isset(request()->order_by) && request()->order_by == 'name_asc' ? 'selected="selected"' : ''); ?>>A
                    to Z</option>
                <option value="name_desc"
                    <?php echo e(isset(request()->order_by) && request()->order_by == 'name_desc' ? 'selected="selected"' : ''); ?>>Z
                    to A</option>
            </select>
        </div>
    </div>
    <div class="row <?php echo e($vehicles->isEmpty() ? 'justify-content-center' : ''); ?>">

        <?php if($vehicles->isNotEmpty()): ?>
        <?php ($count = 1); ?>
        <?php $__currentLoopData = $vehicles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $vehicle): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        
    <?php ($detail = json_decode($vehicle->data)); ?>
    <?php echo $__env->make('frontend.vehicle', ['vehicle' => $vehicle, 'detail' => $detail], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    <?php else: ?>
    <h2 style="font-size: 30px">No vehicles found.</h2>
    <?php endif; ?>
    </div>
</section>

<div class="row mb_res_sec_VLB">
    <div class="col-md-12">
        <div class="viewMoreBtn load_more">
            <div class="center">
                <div class="pagination1 pagination3 pagination4 pagination6 text-center">
                    <?php if(count($vehicles)): ?>
                    <div class="pagination-links">
                        <?php echo e($vehicles->onEachSide(2)->links()); ?>

                    </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('styles'); ?>
<style>
section.filterMain.filter-search-section-cus {
    background: transparent;
    width: 100%;
    padding: 26px;
    margin-top: -160px;
    padding-top: 95px;
}

.viewMoreBtn.load_more {
    margin: 0;
    background: #f6f6f6;
}

section.product_display .row {
    justify-content: center;
}

.viewMoreBtn a svg,
.viewMoreBtn svg {
    width: 16px;
    color: #111;
}

.pagination-links nav>div:first-child {
    display: none !important;
}

.pagination-links nav>div:nth-child(2) {
    margin: 20px auto
}

.pagination-links nav>div:nth-child(2) div:first-child {
    margin: 20px auto
}

.viewMoreBtn a {
    color: #49a94d;
    border: 2px solid #49a94d
}

.viewMoreBtn a:hover {
    background: #49a94d !important;
    color: #fff;
}

#search_sorting {
    width: 100%;
    height: 58px;
    border: 1px solid #585858;
    border-radius: 5px;
    padding: 0 15px;
    font-size: 16px;
    color: #979797;
}

section.filterMain .tabBoxMain button {
    width: 100%
}

.box-vehicleMake form.row {
    width: 113%;
}

section.filterMain .tabBoxMain .box-vehicleMake button {
    width: 60%
}

input[type="range"] {
    -webkit-appearance: none;
    appearance: none;
    width: 70%;
    cursor: pointer;
    outline: none;
    border-radius: 15px;
    height: 13px;
    background: #ccc;
}

input[type="range"]::-webkit-slider-thumb {
    -webkit-appearance: none;
    appearance: none;
    height: 25px;
    width: 20px;
    background: linear-gradient(to right, rgb(134, 196, 64) 7900%, rgb(204, 204, 204) 7900%);
    border: none;
    border-radius: 5px;
}

/* Thumb: Firefox */
input[type="range"]::-moz-range-thumb {
    height: 25px;
    width: 20px;
    background: linear-gradient(to right, rgb(134, 196, 64) 7900%, rgb(204, 204, 204) 7900%);
    border: none;
    transition: .2s ease-in-out;
    border-radius: 5px;
}

.fa-info-circle:before {
    font-size: 13px;
}

.shadow-sm {
    box-shadow: none !important
}

.boxInfo h5 {
    font-size: 18px;
    font-weight: 600;
    color: #000;
    margin: 3px 0 0px -10px;
    border-radius: 3px;
    display: inline-block;
    padding: 10px;
}

section.filterMain {
    padding-top: 0px;
    width: 90%;
    margin: -63px auto 0;
}


.featureBox {
    background: #fff;
    border-radius: 8px;
    padding: 10px;
}

.imgBox {
    position: relative;
}

.boxInfo {
    padding: 0 20px;
    position: relative;
}

.boxInfo h6 {
    color: #545454;
    font-size: 15px;
    font-weight: 500;
    margin-bottom: 15px;
}

.bannerheightadjust {
    min-height: 417px;
}

section {

    padding: 30px 90px;
    background-color: #f6f6f6;
}


.featureBox {
    background: #fff;
    border-radius: 8px;
    padding: 10px;
}


.boxInfo {
    padding: 0 20px;
    position: relative;
}

.boxInfo h6 {
    color: #545454;
    font-size: 15px;
    font-weight: 500;
    margin-bottom: 15px;
}

@media screen and (max-width: 767px) {
    section.filterMain.filter-search-section-cus {
        padding: 0px;
        margin-top: -110px;
        padding-top: 0px;
    }

    .box-vehicleMake form.row {
        width: 100%;
    }

    section#search-results .col-md-3 {
        margin-bottom: 0px !important;
    }

    section#search-results>.row>.col-md-3.mb-5 {
        margin-bottom: 30px !important;
    }

    #search_sorting {
        font-size: 16px;
        line-height:20px;
    }
}
</style>
<?php $__env->stopPush(); ?>

<?php $__env->startPush('script'); ?>
<script>
$(document).ready(function() {
    // Handler for .ready() called.
    $('html, body').animate({
        scrollTop: $('#search-results').offset().top
    }, 'slow');
});
$('.sliderbar').on('input change', function() {
    const sliderEl = $(this);
    const tempSliderValue = $(this).val();
    const sliderValue = $(this).parent().find('.value').text((parseInt(tempSliderValue) === 0 ? 'All' :
        parseInt(tempSliderValue) + '+'));
    const progress = (tempSliderValue / sliderEl.attr('max')) * 100;
    sliderEl.attr('style',
        `background: linear-gradient(to right, rgb(204, 204, 204) ${progress}%, rgb(122 204 30 / 54%) ${progress}%)`
    );
});

$('.sliderbarleft').on('input change', function() {
    const sliderEl = $(this);
    const tempSliderValue = $(this).val();
    const minValue = parseInt(sliderEl.attr('min')); // Get the minimum value
    const range = parseInt(sliderEl.attr('max')) - minValue;
    //const sliderValue = $(this).parent().find('.value').text('<'+parseInt(tempSliderValue));
    const sliderValue = $(this).parent().find('.value').text(parseInt(tempSliderValue) === 250 || parseInt(
        tempSliderValue) === 100 ? 'All' : '<' + parseInt(tempSliderValue));
    const progress = ((tempSliderValue - minValue) / range) * 100;
    sliderEl.attr('style',
        `background: linear-gradient(to right, rgb(122 204 30 / 54%) ${progress}%, rgb(204, 204, 204) ${progress}%)`
    );
});



$('#search_sorting').on('change', function() {
    var order_by = $(this).val();
    let url = window.location.href;
    if (url.indexOf('?') > -1) {
        url += '&order_by=' + order_by;
    } else {
        url += '?order_by=' + order_by;
    }
    window.location.href = url;
})

$(".search-field").change(function() {
    console.log($(this).attr('name'));
    $.get("<?php echo e(url('ajax/query')); ?>", {
        type: $(this).attr('name'),
        value: $(this).val()
    }, function(data) {
        if (data.type == 'division') {
            $('#search-make').children().remove();
            $('#search-model').html('<option value="0">Select Model</option>');
            $('#search-make').append('<option value="0">Select Make</option>');
            data.data.forEach((make) => {
                $('#search-make').append('<option value="' + make.name + '">' + make.name +
                    '</option>');
            });
        }

        if (data.type == 'model') {
            $('#search-model').children().remove();
            $('#search-model').append('<option  value="0">Select Model</option>');
            data.data.forEach((model) => {
                $('#search-model').append('<option value="' + model.name + '">' + model.name +
                    '</option>');
            });
        }
    })
});

function handleDollarSign() {
    var myValue = document.getElementById("dollarSign").value;

    if (myValue.indexOf("$") != 0) {
        myValue = "$" + myValue;
    }

    document.getElementById("dollarSign").value = myValue;
}

$(document).ready(function() {

});
</script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('frontend.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/carjock/resources/views/frontend/search.blade.php ENDPATH**/ ?>
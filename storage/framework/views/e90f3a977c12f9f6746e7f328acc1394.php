
<section class="filterMain <?php echo e(isset($class) ? $class : ''); ?>">
    <div class="container-fluid">
       <div class="row">
          <div class="col-md-12">
            <ul class="mainTabs">
               <li data-targetit="box-customSearch" class="<?php echo e(isset(request()->year) ? '' : 'current'); ?>"><a href="javascript:;">Custom Search</a></li>
               <li data-targetit="box-vehicleMake" class="<?php echo e(isset(request()->year) ? 'current' : ''); ?>"><a href="javascript:;">Vehicle</a></li>
            </ul>
            <div class="tabBoxMain">
               <div class="box-customSearch showfirst" <?php echo e(isset(request()->year) ? 'style=display:none' : ''); ?>>
                  <div class="">
                     <form action="<?php echo e(route('frontend.search')); ?>" method="get" class="row">
                        <input type="hidden" name="order_by" value="<?php echo e(request()->has('order_by') ? request()->order_by : 'pricing_asc'); ?>" />
                        <div class="col-md-2">
                           <label>Vehicle Type</label>
                           <select name="search[body_type]" id="">
                              <option value="0">Select</option>
                              <?php $__currentLoopData = $body_types; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $api_name => $body): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                              <option value="<?php echo e($api_name); ?>" <?php echo e(isset(request()->search['body_type']) && request()->search['body_type'] == $api_name ? 'selected="selected"' : ''); ?>><?php echo e($body); ?></option>
                              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                           </select>
                        </div>
                        
                        <div class="col-md-2">
                           <label>Fuel Type</label>
                           <select name="search[fuel_type]" id="">
                              <option value="0">Select</option>
                             <?php $__currentLoopData = $fuel_types; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $api_name => $fuel): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                             <option value="<?php echo e($api_name); ?>" <?php echo e(isset(request()->search['fuel_type']) && request()->search['fuel_type'] == $api_name ? 'selected="selected"' : ''); ?>><?php echo e($fuel); ?></option>
                             <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                          </select>
                        </div>
                        <div class="col-md-2">
                            <label>Drivetrain</label>
                            <select name="search[drive_train]" id="">
                              <option value="0">Select</option>
                               <?php $__currentLoopData = $drivetrain; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $train): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                              <option value="<?php echo e($train); ?>" <?php echo e(isset(request()->search['drive_train']) && request()->search['drive_train'] == $train ? 'selected="selected"' : ''); ?>><?php echo e($train); ?></option>
                              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>
                        <div class="col-md-2">
                           <label>Passengers</label>
                           <select name="search[max_passenger]" id="">
                              <option value="0">Select</option>
                              <option value="1" <?php echo e(isset(request()->search['max_passenger']) && request()->search['max_passenger'] == 1 ? 'selected="selected"' : ''); ?>>1</option>
                              <option value="2" <?php echo e(isset(request()->search['max_passenger']) && request()->search['max_passenger'] == 2 ? 'selected="selected"' : ''); ?>>2</option>
                              <option value="3" <?php echo e(isset(request()->search['max_passenger']) && request()->search['max_passenger'] == 3 ? 'selected="selected"' : ''); ?>>3</option>
                              <option value="4" <?php echo e(isset(request()->search['max_passenger']) && request()->search['max_passenger'] == 4 ? 'selected="selected"' : ''); ?>>4 </option>
                              <option value="5" <?php echo e(isset(request()->search['max_passenger']) && request()->search['max_passenger'] == 5 ? 'selected="selected"' : ''); ?>>5</option>
                              <option value="6" <?php echo e(isset(request()->search['max_passenger']) && request()->search['max_passenger'] == 6 ? 'selected="selected"' : ''); ?>>6</option>
                              <option value="7" <?php echo e(isset(request()->search['max_passenger']) && request()->search['max_passenger'] == 7 ? 'selected="selected"' : ''); ?>>7</option>
                           </select>
                        </div>
                        <div class="col-md-2">
                           <label style="width:230px">Max MSRP Price (USD)</label>
                            <input style="border-radius:5px" type="text" name="search[price]" value="<?php echo e(isset(request()->search['price']) && request()->search['price'] ? request()->search['price']  : 0); ?>" id="dollarSign" onkeyup="handleDollarSign()" class="form-control" style="border:1px solid #111;border-radius:0px;height:58px" placeholder="Enter Max Price">
                        </div>
                        <div class="col-md-2">
                              <button type="submit"><i class="far fa-search"></i> Search</button>
                        </div>

                        <div class="col-md-12">
                           <div class="dropdown">
                              <p onclick="myFunction()" class="dropbtn"><img src="<?php echo e(asset('frontend/assets/images/filter-green.png')); ?>" alt="" class="mr-3" width="25"> Advanced Filter <span class="ml-2" id="toggleArrow"><i class="fa fa-angle-down"></i></span></p>
                           </div>
                        </div>

                        <div class="dorpdown-style">
                           <div id="myDropdown" class="advance-filter-con">
                              <div class="col-md-12 cus_line">
                                 <p>Tip: Only adjust/select only the fields that are most important to you for best result</p>
                                 <a class="cus_clear" href="<?php echo e(request()->route()->uri === 'search' && !isset(request()->year) ? (isset(request()->search['body_type']) && isset(request()->search['fuel_type']) && isset(request()->search['drive_train']) && isset(request()->search['max_passenger']) && isset(request()->search['price']) ? url('search?') . 'search[body_type]='.request()->search['body_type'] . '&search[fuel_type]='.request()->search['fuel_type'] . '&search[drive_train]='.request()->search['drive_train'] . '&search[max_passenger]='.request()->search['max_passenger'] . '&search[price]='.request()->search['price'] : '') : url('/')); ?>">Reset Filters</a>
                              </div>
                              <div class="one-row-five">
                                 <div class="col-md-2">
                                    <h5>HorsePower <i class="fa fa-info-circle first"><span>body</span></i></h5>
                                    <div class="range">
                                       <input name="up[horsepower]" type="range" min="0" max="400" value="<?php echo e(isset(request()->up['horsepower']) && request()->up['horsepower'] ? request()->up['horsepower']  : 0); ?>" class="sliderbar" id="" style="background: linear-gradient(to right, rgb(204, 204, 204) <?php echo e(isset(request()->up['horsepower']) && request()->up['horsepower'] ?  (request()->up['horsepower']/400)*100 : 0); ?>%, rgb(122 204 30 / 54%) <?php echo e(isset(request()->up['horsepower']) && request()->up['horsepower'] ?  (request()->up['horsepower']/400)*100 : 0); ?>%);">
                                       <p class="value"><?php echo e(isset(request()->up['horsepower']) && request()->up['horsepower'] ? request()->up['horsepower'].'+'  : 'All'); ?></p>
                                    </div>
                                 </div>
                                 <div class="col-md-2">
                                 <h5>Torque <i class="fa fa-info-circle first"><span>body</span></i></h5>
                                 <div class="range">
                                    <input name="up[torque]" type="range" min="0" max="800" value="<?php echo e(isset(request()->up['torque']) && request()->up['torque'] ? request()->up['torque']  : 0); ?>" class="sliderbar" id="" style="background: linear-gradient(to right, rgb(204, 204, 204) <?php echo e(isset(request()->up['torque']) && request()->up['torque'] ?  (request()->up['torque']/800)*100 : 0); ?>%, rgb(122 204 30 / 54%) <?php echo e(isset(request()->up['torque']) && request()->up['torque'] ?  (request()->up['torque']/800)*100 : 0); ?>%);">
                                    <p class="value"><?php echo e(isset(request()->up['torque']) && request()->up['torque'] ? request()->up['torque'].'+'  : 'All'); ?></p>
                                 </div>
                                 </div>
                                 <div class="col-md-2">
                                    <div class="range">
                                       <h5>Est.Battery Range <i class="fa fa-info-circle first"><span>body</span></i></h5>
                                       <input name="up[battery_range]" type="range" min="0" max="500" value="<?php echo e(isset(request()->up['battery_range']) && request()->up['battery_range'] ? request()->up['battery_range']  : 0); ?>" class="sliderbar" id="" style="background: linear-gradient(to right, rgb(204, 204, 204) <?php echo e(isset(request()->up['battery_range']) && request()->up['battery_range'] ?  (request()->up['battery_range']/500)*100 : 0); ?>%, rgb(122 204 30 / 54%) <?php echo e(isset(request()->up['battery_range']) && request()->up['battery_range'] ?  (request()->up['battery_range']/500)*100 : 0); ?>%);">
                                       <p class="value"><?php echo e(isset(request()->up['battery_range']) && request()->up['battery_range'] ? request()->up['battery_range'].'+'  : 'All'); ?></p>
                                    </div>
                                 </div>
                                 <div class="col-md-2">
                                    <div class="range">
                                       <h5>Est.MPG-City <i class="fa fa-info-circle first"><span>body</span></i></h5>
                                       <input name="up[mpg_city]" type="range" min="0" max="50" value="<?php echo e(isset(request()->up['mpg_city']) && request()->up['mpg_city'] ? request()->up['mpg_city']  : 0); ?>" class="sliderbar" id="" style="background: linear-gradient(to right, rgb(204, 204, 204) <?php echo e(isset(request()->up['mpg_city']) && request()->up['mpg_city'] ?  (request()->up['mpg_city']/50)*100 : 0); ?>%, rgb(122 204 30 / 54%) <?php echo e(isset(request()->up['mpg_city']) && request()->up['mpg_city'] ?  (request()->up['mpg_city']/50)*100 : 0); ?>%);">
                                       <p class="value"><?php echo e(isset(request()->up['mpg_city']) && request()->up['mpg_city'] ? request()->up['mpg_city'].'+'  : 'All'); ?></p>
                                    </div>
                                 </div>
                                 <div class="col-md-2">
                                    <div class="range">
                                       <h5>Est.MPG-Hwy <i class="fa fa-info-circle first"><span>body</span></i></h5>
                                       <input name="up[mpg_hwy]" type="range" min="0" max="50" value="<?php echo e(isset(request()->up['mpg_hwy']) && request()->up['mpg_hwy'] ? request()->up['mpg_hwy']  : 0); ?>" class="sliderbar" id="" style="background: linear-gradient(to right, rgb(204, 204, 204) <?php echo e(isset(request()->up['mpg_hwy']) && request()->up['mpg_hwy'] ?  (request()->up['mpg_hwy']/50)*100 : 0); ?>%, rgb(122 204 30 / 54%) <?php echo e(isset(request()->up['mpg_hwy']) && request()->up['mpg_hwy'] ?  (request()->up['mpg_hwy']/50)*100 : 0); ?>%);">
                                       <p class="value"><?php echo e(isset(request()->up['mpg_hwy']) && request()->up['mpg_hwy'] ? request()->up['mpg_hwy'].'+'  : 'All'); ?></p>
                                    </div>
                                 </div>
                              </div>

                              <div class="one-row-five">
                                 <div class="col-md-2">
                                    <div class="range">
                                       <h5>Length, Overall <i class="fa fa-info-circle first"><span>body</span></i></h5>
                                       <input name="down[length_overall]" type="range" min="150" max="250" value="<?php echo e(isset(request()->down['length_overall']) && request()->down['length_overall'] ? request()->down['length_overall']  : 250); ?>" class="sliderbarleft" id="" style="background: linear-gradient(to right, rgb(122 204 30 / 54%) <?php echo e(isset(request()->down['length_overall']) && request()->down['length_overall'] ?  ((request()->down['length_overall']-150)/(250-150))*100 : 250); ?>%, rgb(204, 204, 204) <?php echo e(isset(request()->down['length_overall']) && request()->down['length_overall'] ?  ((request()->down['length_overall'] - 150)/(250-150))*100 : 0); ?>%);">
                                       <p class="value"><?php echo e(isset(request()->down['length_overall']) && request()->down['length_overall'] ? (request()->down['length_overall'] === '250' || request()->down['length_overall'] === '100' ? 'All' : '<' . request()->down['length_overall'])  : 'All'); ?></p>
                                    </div>
                                 </div>
                                 <div class="col-md-2">
                                    <div class="range">
                                       <h5>Width, Overall <i class="fa fa-info-circle first"><span>body</span></i></h5>
                                       <input name="down[width_overall]" type="range" min="50" max="100" value="<?php echo e(isset(request()->down['width_overall']) && request()->down['width_overall'] ? request()->down['width_overall']  : 100); ?>" class="sliderbarleft" id="" style="background: linear-gradient(to right, rgb(122 204 30 / 54%) <?php echo e(isset(request()->down['width_overall']) && request()->down['width_overall'] ?  ((request()->down['width_overall']-50)/(100-50))*100 : 100); ?>%, rgb(204, 204, 204) <?php echo e(isset(request()->down['width_overall']) && request()->down['width_overall'] ?  ((request()->down['width_overall']-50)/(100-50))*100 : 0); ?>%);">
                                       <p class="value"><?php echo e(isset(request()->down['width_overall']) && request()->down['width_overall'] ? (request()->down['width_overall'] === '250' || request()->down['width_overall'] === '100' ? 'All' : '<' . request()->down['width_overall'])  : 'All'); ?></p>
                                    </div>
                                 </div>
                                 <div class="col-md-2">
                                    <div class="range">
                                       <h5>Height, Overall <i class="fa fa-info-circle first"><span>body</span></i></h5>
                                       <input name="down[height_overall]" type="range" min="50" max="100" value="<?php echo e(isset(request()->down['height_overall']) && request()->down['height_overall'] ? request()->down['height_overall']  : 100); ?>" class="sliderbarleft" id="" style="background: linear-gradient(to right, rgb(122 204 30 / 54%) <?php echo e(isset(request()->down['height_overall']) && request()->down['height_overall'] ?  ((request()->down['height_overall']-50)/(100-50))*100 : 100); ?>%, rgb(204, 204, 204) <?php echo e(isset(request()->down['height_overall']) && request()->down['height_overall'] ?  ((request()->down['height_overall']-50)/(100-50))*100 : 0); ?>%);">
                                       <p class="value"><?php echo e(isset(request()->down['height_overall']) && request()->down['height_overall'] ? (request()->down['height_overall'] === '250' || request()->down['height_overall'] === '100' ? 'All' : '<' . request()->down['height_overall'])  : 'All'); ?></p>
                                    </div>
                                 </div>
                                 <div class="col-md-2">
                                    <div class="range">
                                       <h5>Max Cargo Volume&nbsp;<i class="fa fa-info-circle first"><span>body</span></i></h5>
                                       <input name="up[cargo_volume]" type="range" min="0" max="100" value="<?php echo e(isset(request()->up['cargo_volume']) && request()->up['cargo_volume'] ? request()->up['cargo_volume']  : 0); ?>" class="sliderbar" id="" style="background: linear-gradient(to right, rgb(204, 204, 204) <?php echo e(isset(request()->up['cargo_volume']) && request()->up['cargo_volume'] ?  (request()->up['cargo_volume']/100)*100 : 0); ?>%, rgb(122 204 30 / 54%) <?php echo e(isset(request()->up['cargo_volume']) && request()->up['cargo_volume'] ?  (request()->up['cargo_volume']/100)*100 : 0); ?>%);">
                                       <p class="value"><?php echo e(isset(request()->up['cargo_volume']) && request()->up['cargo_volume'] ? request()->up['cargo_volume'].'+'  : 'All'); ?></p>
                                    </div>
                                 </div>
                                 <div class="col-md-2">
                                    <div class="range">
                                       <h5>Trunk Volume <i class="fa fa-info-circle first"><span>body</span></i></h5>
                                       <input name="up[trunk_volume]" type="range" min="0" max="50" value="<?php echo e(isset(request()->up['trunk_volume']) && request()->up['trunk_volume'] ? request()->up['trunk_volume']  : 0); ?>" class="sliderbar" id="" style="background: linear-gradient(to right, rgb(204, 204, 204) <?php echo e(isset(request()->up['trunk_volume']) && request()->up['trunk_volume'] ?  (request()->up['trunk_volume']/50)*100 : 0); ?>%, rgb(122 204 30 / 54%) <?php echo e(isset(request()->up['trunk_volume']) && request()->up['trunk_volume'] ?  (request()->up['trunk_volume']/50)*100 : 0); ?>%);">
                                       <p class="value"><?php echo e(isset(request()->up['trunk_volume']) && request()->up['trunk_volume'] ? request()->up['trunk_volume'].'+'  : 'All'); ?></p>
                                    </div>
                                 </div>
                              </div>

                              <div class="one-row-five">
                                 <div class="col-md-2">
                                    <div class="range">
                                       <h5>Front Head Room <i class="fa fa-info-circle first"><span>body</span></i></h5>
                                       <input name="up[front_head_room]" type="range" min="0" max="40" value="<?php echo e(isset(request()->up['front_head_room']) && request()->up['front_head_room'] ? request()->up['front_head_room']  : 0); ?>" class="sliderbar" id="" style="background: linear-gradient(to right, rgb(204, 204, 204) <?php echo e(isset(request()->up['front_head_room']) && request()->up['front_head_room'] ?  (request()->up['front_head_room']/40)*100 : 0); ?>%, rgb(122 204 30 / 54%) <?php echo e(isset(request()->up['front_head_room']) && request()->up['front_head_room'] ?  (request()->up['front_head_room']/40)*100 : 0); ?>%);">
                                       <p class="value"><?php echo e(isset(request()->up['front_head_room']) && request()->up['front_head_room'] ? request()->up['front_head_room'].'+'  : 'All'); ?></p>
                                    </div>
                                 </div>
                                 <div class="col-md-2">
                                    <div class="range">
                                    <h5>Front Leg Room <i class="fa fa-info-circle first"><span>body</span></i></h5>
                                       <input name="up[front_leg_room]" type="range" min="0" max="45" value="<?php echo e(isset(request()->up['front_leg_room']) && request()->up['front_leg_room'] ? request()->up['front_leg_room']  : 0); ?>" class="sliderbar" id="" style="background: linear-gradient(to right, rgb(204, 204, 204) <?php echo e(isset(request()->up['front_leg_room']) && request()->up['front_leg_room'] ?  (request()->up['front_leg_room']/45)*100 : 0); ?>%, rgb(122 204 30 / 54%) <?php echo e(isset(request()->up['front_leg_room']) && request()->up['front_leg_room'] ?  (request()->up['front_leg_room']/45)*100 : 0); ?>%);">
                                       <p class="value"><?php echo e(isset(request()->up['front_leg_room']) && request()->up['front_leg_room'] ? request()->up['front_leg_room'].'+'  : 'All'); ?></p>
                                    </div>
                                 </div>
                                 <div class="col-md-2">
                                    <div class="range">
                                       <h5>Front Shoulder Room <i class="fa fa-info-circle first"><span>body</span></i></h5>
                                       <input name="up[front_shoulder_room]" type="range" min="0" max="60" value="<?php echo e(isset(request()->up['front_shoulder_room']) && request()->up['front_shoulder_room'] ? request()->up['front_shoulder_room']  : 0); ?>" class="sliderbar" id="" style="background: linear-gradient(to right, rgb(204, 204, 204) <?php echo e(isset(request()->up['front_shoulder_room']) && request()->up['front_shoulder_room'] ?  (request()->up['front_shoulder_room']/60)*100 : 0); ?>%, rgb(122 204 30 / 54%) <?php echo e(isset(request()->up['front_shoulder_room']) && request()->up['front_shoulder_room'] ?  (request()->up['front_shoulder_room']/60)*100 : 0); ?>%);">
                                       <p class="value"><?php echo e(isset(request()->up['front_shoulder_room']) && request()->up['front_shoulder_room'] ? request()->up['front_shoulder_room'].'+'  : 'All'); ?></p>
                                    </div>
                                 </div>
                                 <div class="col-md-2">
                                    <div class="range">
                                       <h5>2nd Head Room <i class="fa fa-info-circle first"><span>body</span></i></h5>
                                       <input name="up[second_head_room]" type="range" min="0" max="40" value="<?php echo e(isset(request()->up['second_head_room']) && request()->up['second_head_room'] ? request()->up['second_head_room']  : 0); ?>" class="sliderbar" id="" style="background: linear-gradient(to right, rgb(204, 204, 204) <?php echo e(isset(request()->up['second_head_room']) && request()->up['second_head_room'] ?  (request()->up['second_head_room']/40)*100 : 0); ?>%, rgb(122 204 30 / 54%) <?php echo e(isset(request()->up['second_head_room']) && request()->up['second_head_room'] ?  (request()->up['second_head_room']/40)*100 : 0); ?>%);">
                                       <p class="value"><?php echo e(isset(request()->up['second_head_room']) && request()->up['second_head_room'] ? request()->up['second_head_room'].'+'  : 'All'); ?></p>
                                    </div>
                                 </div>
                                 <div class="col-md-2">
                                    <div class="range">
                                       <h5>2nd Leg Room <i class="fa fa-info-circle first"><span>body</span></i></h5>
                                       <input name="up[second_leg_room]" type="range" min="0" max="45" value="<?php echo e(isset(request()->up['second_leg_room']) && request()->up['second_leg_room'] ? request()->up['second_leg_room']  : 0); ?>" class="sliderbar" id="" style="background: linear-gradient(to right, rgb(204, 204, 204) <?php echo e(isset(request()->up['second_leg_room']) && request()->up['second_leg_room'] ?  (request()->up['second_leg_room']/400)*100 : 0); ?>%, rgb(122 204 30 / 54%) <?php echo e(isset(request()->up['second_leg_room']) && request()->up['second_leg_room'] ?  (request()->up['second_leg_room']/45)*100 : 0); ?>%);">
                                       <p class="value"><?php echo e(isset(request()->up['second_leg_room']) && request()->up['second_leg_room'] ? request()->up['second_leg_room'].'+'  : 'All'); ?></p>
                                    </div>
                                 </div>
                                 <div class="col-md-2">
                                    <div class="range">
                                       <h5>2nd Shoulder <i class="fa fa-info-circle first"><span>body</span></i></h5>
                                       <input name="up[second_shoulder_room]" type="range" min="0" max="60" value="<?php echo e(isset(request()->up['second_shoulder_room']) && request()->up['second_shoulder_room'] ? request()->up['second_shoulder_room']  : 0); ?>" class="sliderbar" id="" style="background: linear-gradient(to right, rgb(204, 204, 204) <?php echo e(isset(request()->up['second_shoulder_room']) &&  request()->up['second_shoulder_room'] ?  (request()->up['second_shoulder_room']/60)*100 : 0); ?>%, rgb(122 204 30 / 54%) <?php echo e(isset(request()->up['second_shoulder_room']) && request()->up['second_shoulder_room'] ?  (request()->up['second_shoulder_room']/60)*100 : 0); ?>%);">
                                       <p class="value"><?php echo e(isset(request()->up['second_shoulder_room']) && request()->up['second_shoulder_room'] ? request()->up['second_shoulder_room'].'+'  : 'All'); ?></p>
                                    </div>
                                 </div>
                              </div>

                              <div class="row feature-sec" style=" width: 100%;">

                                 <div class="col-md-3">
                                    <label class="search-row-five">
                                       <span class="checkboxholder" for="highlightdifference">
                                          <input <?php echo e(isset(request()->find['headsup_display']) ? 'checked' : ''); ?> type="checkbox" name="find[headsup_display]" value="Heads-Up Display">
                                          <span class="checkmark"></span>
                                          <span class="text">Heads-Up Display</span>
                                          <i class="fa fa-info-circle first"><span>body</span></i>
                                       </span>
                                    </label>
                                 </div>
                                 <div class="col-md-3">
                                    <label class="search-row-five">
                                       <span class="checkboxholder" for="highlightdifference">
                                          <input <?php echo e(isset(request()->find['automatic_park']) ? 'checked' : ''); ?> type="checkbox" name="find[automatic_park]" value="Automatic Parking">
                                          <span class="checkmark"></span>
                                          <span class="text">Automatic Parking</span>
                                          <i class="fa fa-info-circle first"><span>body</span></i>
                                       </span>
                                    </label>
                                 </div>
                                 <div class="col-md-3">
                                    <label class="search-row-five">
                                       <span class="checkboxholder" for="highlightdifference">
                                          <input  <?php echo e(isset(request()->find['sun_moon_roof']) ? 'checked' : ''); ?> type="checkbox" name="find[sun_moon_roof]" value="Sun/Moonroof">
                                          <span class="checkmark"></span>
                                          <span class="text">Sun/Moonroof</span>
                                          <i class="fa fa-info-circle first"><span>body</span></i>
                                       </span>
                                    </label>
                                 </div>
                                 <div class="col-md-3">
                                    <label class="search-row-five">
                                       <span class="checkboxholder" for="highlightdifference">
                                          <input <?php echo e(isset(request()->find['cruise_control']) ? 'checked' : ''); ?> type="checkbox" name="find[cruise_control]" value="Cruise Control Steering Assists">
                                          <span class="checkmark"></span>
                                          <span class="text">Cruise Control Steering Assists</span>
                                          <i class="fa fa-info-circle first"><span>body</span></i>
                                       </span>
                                    </label>
                                 </div>
                                 <div class="col-md-3">
                                    <label class="search-row-five">
                                       <span class="checkboxholder" for="highlightdifference">
                                          <input <?php echo e(isset(request()->find['smart_device']) ? 'checked' : ''); ?> type="checkbox" name="find[smart_device]" value="Smart Device Integration">
                                          <span class="checkmark"></span>
                                          <span class="text">Smart Device Integration</span>
                                          <i class="fa fa-info-circle first"><span>body</span></i>
                                       </span>
                                    </label>
                                 </div>
                                 <div class="col-md-3" style="align-items: center;display: flex;">
                                    <label class="search-row-five">
                                       <span class="checkboxholder" for="highlightdifference">
                                          <input <?php echo e(isset(request()->find['seat_memory']) ? 'checked' : ''); ?> type="checkbox" name="find[seat_memory]" value="Seat Memory">
                                          <span class="checkmark"></span>
                                          <span class="text">Seat Memory</span>
                                          <i class="fa fa-info-circle first"><span>body</span></i>
                                       </span>
                                    </label>
                                 </div>
                                 <div class="col-md-3">
                                    <label class="search-row-five">
                                       <span class="checkboxholder" for="highlightdifference">
                                          <input <?php echo e(isset(request()->find['panoramic_roof']) ? 'checked' : ''); ?> type="checkbox" name="find[panoramic_roof]" value="Panoramic Roof">
                                          <span class="checkmark"></span>
                                          <span class="text">Panoramic Roof</span>
                                          <i class="fa fa-info-circle first"><span>body</span></i>
                                       </span>
                                    </label>
                                 </div>
                                 <div class="col-md-3">
                                    <label class="search-row-five">
                                       <span class="checkboxholder" for="highlightdifference">
                                          <input <?php echo e(isset(request()->find['heated_rear_seats']) ? 'checked' : ''); ?> type="checkbox" name="find[heated_rear_seats]" value="Heated Rear Seats">
                                          <span class="checkmark"></span>
                                          <span class="text">Heated Rear Seats</span>
                                          <i class="fa fa-info-circle first"><span>body</span></i>
                                       </span>
                                    </label>
                                 </div>
                              </div>
                           </div><!-- // Row // -->
                        </div>
                     </form>
                  </div>


               </div><!-- // Row // -->


               <div class="box-vehicleMake" <?php echo e(isset(request()->year) ? 'style=display:block' : ''); ?>>


                  <div class="">
                     <form action="<?php echo e(route('frontend.search')); ?>" method="get" class="row">
                        <input type="hidden" name="order_by" value="<?php echo e(request()->has('order_by') ? request()->order_by : 'pricing_asc'); ?>" />

                        <div class="col-md-3">
                           <label>Year</label>
                           <select name="year" class="search-field">
                              <option value="">Select Year</option>
                              <?php $__currentLoopData = $years; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $year): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                              <option value="<?php echo e($year); ?>" <?php echo e(isset(request()->year) && request()->year == $year ? 'selected="selected"' : ''); ?>><?php echo e($year); ?></option>
                              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                           </select>
                        </div>
                        <div class="col-md-3">
                           <label>Make</label>
                           <select name="make" class="search-field" id="search-make">
                              <option value="0">Select Make</option>
                              <?php if(isset(request()->year)): ?>
                              <?php $__currentLoopData = $makes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $make): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                              <option value="<?php echo e($make->name); ?>" <?php echo e(isset(request()->make) && request()->make == $make->name ? 'selected="selected"' : ''); ?>><?php echo e($make->name); ?></option>
                              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                              <?php endif; ?>
                           </select>
                        </div>
                        <div class="col-md-3">
                           <label>Model</label>
                           <select name="model" class="search-field" id="search-model">
                           <option value="0">Select Model</option>
                           <?php if(isset(request()->year) && isset(request()->make)): ?>
                           <?php $__currentLoopData = $models; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $model): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                           <option value="<?php echo e($model->name); ?>" <?php echo e(isset(request()->model) && request()->model == $model->name ? 'selected="selected"' : ''); ?>><?php echo e($model->name); ?></option>
                           <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                           <?php endif; ?>
                        </select>
                        </div>

                        <div class="col-md-3">
                           <button type="submit"><i class="far fa-search"></i> Search</button>
                        </div>
                     </form>
                  </div><!-- // Row // -->
               </div>

            </div>
         </div><!-- // Col // -->
      </div><!-- // Row // -->
   </div><!-- // Container-Fluid // -->
</section>
<?php /**PATH C:\Users\nitin\OneDrive\Desktop\carjock-legacy\resources\views/frontend/filter.blade.php ENDPATH**/ ?>
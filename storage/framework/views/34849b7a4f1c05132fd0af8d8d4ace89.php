<div class="filter-applied">
    <span>Filtered For:</span>
    <?php if(isset(request()->search['body_type']) && request()->search['body_type']): ?>
        <span>Vehicle Type</span>
    <?php endif; ?>

    <?php if(isset(request()->search['fuel_type']) && request()->search['fuel_type']): ?>
        <span>Fuel Type</span>
    <?php endif; ?>

    <?php if(isset(request()->search['drive_train']) && request()->search['drive_train']): ?>
        <span>Drivetrain</span>
    <?php endif; ?>

    <?php if(isset(request()->search['max_passenger']) && request()->search['max_passenger']): ?>
        <span>Max Passenger</span>
    <?php endif; ?>

    <?php if(isset(request()->search['price']) && request()->search['price']): ?>
        <span>Max MSRP Price (USD)</span>
    <?php endif; ?>

    <?php if(isset(request()->up['horsepower']) && request()->up['horsepower']): ?>
        <span>HorsePower</span>
    <?php endif; ?>
    <?php if(isset(request()->up['torque']) && request()->up['torque']): ?>
        <span>Torque</span>
    <?php endif; ?>
    <?php if(isset(request()->up['battery_range']) && request()->up['battery_range']): ?>
        <span>Est.Battery Range</span>
    <?php endif; ?>
    <?php if(isset(request()->up['mpg_city']) && request()->up['mpg_city']): ?>
        <span>Est.MPG-City</span>
    <?php endif; ?>
    <?php if(isset(request()->up['mpg_hwy']) && request()->up['mpg_hwy']): ?>
        <span>Est.MPG-Hwy </span>
    <?php endif; ?>
    <?php if(isset(request()->down['length_overall']) && request()->down['length_overall']): ?>
        <?php if(request()->down['length_overall'] != 250): ?>
        <span>Length, Overall</span>
        <?php endif; ?>
    <?php endif; ?>
    <?php if(isset(request()->down['width_overall']) && request()->down['width_overall']): ?>
        <?php if(request()->down['width_overall'] != 100): ?>
        <span>Width, Overall</span>
        <?php endif; ?>
    <?php endif; ?>
    <?php if(isset(request()->down['height_overall']) && request()->down['height_overall']): ?>
        <?php if(request()->down['height_overall'] != 100): ?>
        <span>Height, Overall</span>
        <?php endif; ?>
    <?php endif; ?>
    <?php if(isset(request()->up['cargo_volume']) && request()->up['cargo_volume']): ?>
        <span>Max Cargo Volume</span>
    <?php endif; ?>
    <?php if(isset(request()->up['trunk_volume']) && request()->up['trunk_volume']): ?>
        <span>Trunk Volume </span>
    <?php endif; ?>
    <?php if(isset(request()->up['front_head_room']) && request()->up['front_head_room']): ?>
        <span>Front Head Room </span>
    <?php endif; ?>
    <?php if(isset(request()->up['front_leg_room']) && request()->up['front_leg_room']): ?>
        <span>Front Leg Room </span>
    <?php endif; ?>
    <?php if(isset(request()->up['front_shoulder_room']) && request()->up['front_shoulder_room']): ?>
        <span>Front Shoulder Room </span>
    <?php endif; ?>
    <?php if(isset(request()->up['second_head_room']) && request()->up['second_head_room']): ?>
        <span>2nd Head Room </span>
    <?php endif; ?>
    <?php if(isset(request()->up['second_leg_room']) && request()->up['second_leg_room']): ?>
        <span>2nd Leg Room </span>
    <?php endif; ?>
    <?php if(isset(request()->up['second_shoulder_room']) && request()->up['second_shoulder_room']): ?>
        <span>2nd Shoulder </span>
    <?php endif; ?>

    <?php if(isset(request()->find['headsup_display']) && request()->find['headsup_display']): ?>
        <span>Heads-Up Display </span>
    <?php endif; ?>
    <?php if(isset(request()->find['automatic_park']) && request()->find['automatic_park']): ?>
        <span>Automatic Parking </span>
    <?php endif; ?>
    <?php if(isset(request()->find['sun_moon_roof']) && request()->find['sun_moon_roof']): ?>
        <span>Sun/Moonroof </span>
    <?php endif; ?>
    <?php if(isset(request()->find['cruise_control']) && request()->find['cruise_control']): ?>
        <span>Cruise Control Steering Assists </span>
    <?php endif; ?>
    <?php if(isset(request()->find['smart_device']) && request()->find['smart_device']): ?>
        <span>Smart Device Integration </span>
    <?php endif; ?>
    <?php if(isset(request()->find['seat_memory']) && request()->find['seat_memory']): ?>
        <span>Seat Memory </span>
    <?php endif; ?>
    <?php if(isset(request()->find['panoramic_roof']) && request()->find['panoramic_roof']): ?>
        <span>Panoramic Roof </span>
    <?php endif; ?>
    <?php if(isset(request()->find['heated_rear_seats']) && request()->find['heated_rear_seats']): ?>
        <span>Heated Rear Seats </span>
    <?php endif; ?>
</div>
<?php /**PATH /var/www/html/carjock/resources/views/frontend/filter-applied.blade.php ENDPATH**/ ?>
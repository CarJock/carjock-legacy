if(rankTag == '1st'){
    //Store 1st selection car
    $('.tableinnercols').each(function(){
        $(this).children().eq(0).show();
    });
    $('.total-comparisions').text(1);
    $('.carcomparisionlists').children().eq(0).text(name);

    currentState.find('.vehicle-image').attr('src', siteurl+'frontend/assets/images/comparision-placeholder.jpeg');
    if(data.image){
        currentState.find('.vehicle-image').attr('src', data?.image);
    }
    $('.stickycol.specifications-body').next().children().eq(0).text(data?.body_type);
    $('.stickycol.specifications-trim').next().children().eq(0).text(vehicle.style?.trim ?? vehicle.style?.nameWoTrim);
    $('.stickycol.specifications-cylinders').next().children().eq(0).text(vehicle.engine?.cylinders);
    $('.stickycol.specifications-drive-train').next().children().eq(0).text(vehicle.style?.drivetrain);
    $('.stickycol.specifications-fuel-economy-city').next().children().eq(0).text(vehicle.engine.fuelEconomy? vehicle.engine.fuelEconomy?.city?.low : '-');
    $('.stickycol.specifications-fuel-economy-highway').next().children().eq(0).text(vehicle.engine.fuelEconomy ? vehicle.engine.fuelEconomy.hwy?.low : '-');
    $('.stickycol.specifications-fuelType').next().children().eq(0).text(data.fuel_type?.name);
    $('.stickycol.specifications-engineType').next().children().eq(0).text(data.engine_type?.name ?? vehicle.engine?.engineType?._);
    $('.stickycol.specifications-torque').next().children().eq(0).text(vehicle.engine?.netTorque?.value);
    $('.stickycol.specifications-size').next().children().eq(0).text(vehicle.engine.fuelCapacity ? (vehicle.engine?.fuelCapacity?.high + vehicle.engine?.fuelCapacity?.unit) : '-');
    $('.stickycol.specifications-stock-number').next().children().eq(0).text(vehicle.style?.acode?._);
    $('.stickycol.specifications-displacements').next().children().eq(0).text(vehicle.engine.displacement ? (vehicle.engine?.displacement?.value?._ + vehicle.engine?.displacement?.value?.unit) : '-');

    
    //horse power
    $('.stickycol.specifications-horse-power').next().children().eq(0).html('<div class="horsepowermeter" data-metervalue="0"><div class="overlaymeter"></div><div class="valueholder">'+vehicle.engine?.horsepower?.value+'</div></div>');
    $('.stickycol.specifications-horse-power').next().children().eq(0).find('.horsepowermeter').children().css('width', vehicle.engine?.horsepower?.value/100+20+'%');

    //RPM
    $('.stickycol.specifications-rpm').next().children().eq(0).html('<div class="horsepowermeter" data-metervalue="0"><div class="overlaymeter"></div><div class="valueholder">'+vehicle.engine?.horsepower?.rpm+'</div></div>');;
    $('.stickycol.specifications-rpm').next().children().eq(0).find('.horsepowermeter').children().css('width', vehicle.engine?.horsepower?.rpm/100+20+'%');

    //Torque RPM.html('<div class="horsepowermeter" data-metervalue="0"><div class="overlaymeter"></div><div class="valueholder">'+vehicle.engine?.netTorque?.rpm+'</div></div>');
    $('.stickycol.specifications-torque-rpm').next().children().eq(0).html('<div class="horsepowermeter" data-metervalue="0"><div class="overlaymeter"></div><div class="valueholder">'+vehicle.engine?.netTorque?.rpm+'</div></div>');
    $('.stickycol.specifications-torque-rpm').next().children().eq(0).find('.horsepowermeter').children().css('width', vehicle.engine?.netTorque?.rpm/100+20+'%');
    
    $('.stickycol.dimension-invoice').next().children().eq(0).text('$'+vehicle?.basePrice?.invoice?.low + ' / $' + vehicle?.basePrice?.msrp?.high);
    //$('.stickycol.dimension-pasenger-capacity').next().children().eq(0).text(vehicle.style?.marketClass?._);
    //$('.stickycol.vehicle-epa-classification').next().children().eq(0).text(vehicle?.bestStyleName);
    
    //Loop to get Generaic Equipment Definations
    if(vehicle.genericEquipment){
        for(let i = 0; i < vehicle.genericEquipment.length; i++){
            if(Object.hasOwn(vehicle.genericEquipment[i], 'definition')){
                if(Object.hasOwn(vehicle.genericEquipment[i].definition, 'category')){
                    //List Down all properties
                    if(vehicle.genericEquipment[i].definition.category._ == 'AM/FM Stereo')
                        $('.stickycol.dimension-stereo').next().children().eq(0).text(vehicle.genericEquipment[i].definition?.header?._);

                    if(vehicle.genericEquipment[i].definition.category._ == 'Leather Seats')
                        $('.stickycol.seating-leather-seats').next().children().eq(0).text(vehicle.genericEquipment[i].definition?.header?._);

                    if(vehicle.genericEquipment[i].definition.category._ == 'Heated Front Seat(s)')
                        $('.stickycol.seating-heated-rear-seats').next().children().eq(0).text(vehicle.genericEquipment[i].definition?.header?._);

                    if(vehicle.genericEquipment[i].definition.category._ == 'Cooled Front Seat(s)')
                        $('.stickycol.seating-cooled-front-seats').next().children().eq(0).text(vehicle.genericEquipment[i].definition?.header?._);

                    if(vehicle.genericEquipment[i].definition.category._ == 'Climate Control')
                        $('.stickycol.accessories-climate-control').next().children().eq(0).html(vehicle.genericEquipment[i].definition?.header?._ ? '<i class="fa fa-check"></i>' : '-');

                    if(vehicle.genericEquipment[i].definition.category._ == 'A/C')
                        $('.stickycol.accessories-ac').next().children().eq(0).html(vehicle.genericEquipment[i].definition?.header?._ ? '<i class="fa fa-check"></i>' : '-');

                    if(vehicle.genericEquipment[i].definition.category._ == 'Security System')
                        $('.stickycol.accessories-security-system').next().children().eq(0).html(vehicle.genericEquipment[i].definition?.header?._ ? '<i class="fa fa-check"></i>' : '-');

                        if(vehicle.genericEquipment[i].definition.category._ == 'Cruise Control')
                        $('.stickycol.accessories-cruise-control').next().children().eq(0).html(vehicle.genericEquipment[i].definition?.header?._ ? '<i class="fa fa-check"></i>' : '-');

                        if(vehicle.genericEquipment[i].definition.category._ == 'Keyless Entry')
                        $('.stickycol.accessories-keyless-entry').next().children().eq(0).html(vehicle.genericEquipment[i].definition?.header?._ ? '<i class="fa fa-check"></i>' : '-');

                        if(vehicle.genericEquipment[i].definition.category._ == 'Power Door Locks')
                        $('.stickycol.accessories-power-door-locks').next().children().eq(0).html(vehicle.genericEquipment[i].definition?.header?._ ? '<i class="fa fa-check"></i>' : '-');

                        if(vehicle.genericEquipment[i].definition.category._ == 'Heated Mirrors')
                        $('.stickycol.accessories-heated-mirrors').next().children().eq(0).html(vehicle.genericEquipment[i].definition?.header?._ ? '<i class="fa fa-check"></i>' : '-');

                        if(vehicle.genericEquipment[i].definition.category._ == 'Sun/Moonroof')
                        $('.stickycol.accessories-sun-moonroof').next().children().eq(0).html(vehicle.genericEquipment[i].definition?.header?._ ? '<i class="fa fa-check"></i>' : '-');

                        if(vehicle.genericEquipment[i].definition.category._ == 'Intermittent Wipers')
                        $('.stickycol.accessories-intermittent-wipers').next().children().eq(0).html(vehicle.genericEquipment[i].definition?.header?._ ? '<i class="fa fa-check"></i>' : '-');

                        if(vehicle.genericEquipment[i].definition.category._ == 'MP3 Player')
                        $('.stickycol.accessories-mp3').next().children().eq(0).html(vehicle.genericEquipment[i].definition?.header?._ ? '<i class="fa fa-check"></i>' : '-');

                        if(vehicle.genericEquipment[i].definition.category._ == 'Auto-Dimming Rearview Mirror')
                        $('.stickycol.accessories-auto-dimming-rearview-mirror').next().children().eq(0).html(vehicle.genericEquipment[i].definition?.header?._ ? '<i class="fa fa-check"></i>' : '-');

                        if(vehicle.genericEquipment[i].definition.category._ == 'Luggage Rack')
                        $('.stickycol.accessories-luggage-rack').next().children().eq(0).html(vehicle.genericEquipment[i].definition?.header?._ ? '<i class="fa fa-check"></i>' : '-');

                        if(vehicle.genericEquipment[i].definition.category._ == 'Bluetooth Connection')
                        $('.stickycol.accessories-bluetooth-connection').next().children().eq(0).html(vehicle.genericEquipment[i].definition?.header?._ ? '<i class="fa fa-check"></i>' : '-');

                        if(vehicle.genericEquipment[i].definition.category._ == 'Back-Up Camera')
                        $('.stickycol.accessories-back-up-camera').next().children().eq(0).html(vehicle.genericEquipment[i].definition?.header?._ ? '<i class="fa fa-check"></i>' : '-');
                        
                        if(vehicle.genericEquipment[i].definition.category._ == 'Keyless Start')
                        $('.stickycol.accessories-keyless-start').next().children().eq(0).html(vehicle.genericEquipment[i].definition?.header?._ ? '<i class="fa fa-check"></i>' : '-');
                        
                        if(vehicle.genericEquipment[i].definition.category._ == 'Lane Departure Warning')
                        $('.stickycol.accessories-lane-departure-warning').next().children().eq(0).html(vehicle.genericEquipment[i].definition?.header?._ ? '<i class="fa fa-check"></i>' : '-');
                        
                        if(vehicle.genericEquipment[i].definition.category._ == 'Cruise Control Steering Assist')
                        $('.stickycol.accessories-cruise-control-steering-assist').next().children().eq(0).html(vehicle.genericEquipment[i].definition?.header?._ ? '<i class="fa fa-check"></i>' : '-');
                        
                        if(vehicle.genericEquipment[i].definition.category._ == 'Smart Device Integration')
                        $('.stickycol.accessories-smart-device-integration').next().children().eq(0).html(vehicle.genericEquipment[i].definition?.header?._ ? '<i class="fa fa-check"></i>' : '-');


                        if(vehicle.genericEquipment[i].definition.category._ == 'Automatic Parking')
                        $('.stickycol.accessories-automatic-parking').next().children().eq(0).html(vehicle.genericEquipment[i].definition?.header?._ ? '<i class="fa fa-check"></i>' : '-');
                        
                        if(vehicle.genericEquipment[i].definition.category._ == 'Hands-Free Liftgate')
                        $('.stickycol.accessories-power-liftgate').next().children().eq(0).html(vehicle.genericEquipment[i].definition?.header?._ ? '<i class="fa fa-check"></i>' : '-');


                }
            }
        }
    }


    //Loop to get Technical Specification Definations
    if(vehicle.technicalSpecification){
        for(let i = 0; i < vehicle.technicalSpecification.length; i++){
            if(Object.hasOwn(vehicle.technicalSpecification[i], 'definition')){
                if(Object.hasOwn(vehicle.technicalSpecification[i].definition, 'title')){
                    //List Down All properties
                    if(vehicle.technicalSpecification[i].definition.title._ == 'EPA Classification')
                        $('.stickycol.vehicle-epa-classification').next().children().eq(0).text(vehicle.technicalSpecification[i]?.value?.value);
        
                        if(vehicle.technicalSpecification[i].definition.title._ == 'Passenger Capacity')
                        $('.stickycol.dimension-pasenger-capacity').next().children().eq(0).text(vehicle.technicalSpecification[i]?.value?.value);
        
                        if(vehicle.technicalSpecification[i].definition.title._ == 'Front Head Room')
                        $('.stickycol.dimension-front-head-room').next().children().eq(0).text(vehicle.technicalSpecification[i]?.value?.value);

                    if(vehicle.technicalSpecification[i].definition.title._ == 'Front Leg Room')
                        $('.stickycol.dimension-front-leg-room').next().children().eq(0).text(vehicle.technicalSpecification[i]?.value?.value);

                    if(vehicle.technicalSpecification[i].definition.title._ == 'AM/FM Stereo')
                        $('.stickycol.dimension-stereo').next().children().eq(0).text(vehicle.technicalSpecification[i]?.value?.value);

                    if(vehicle.technicalSpecification[i].definition.title._ == 'Front Shoulder Room')
                        $('.stickycol.seating-front-shoulder-room').next().children().eq(0).text(vehicle.technicalSpecification[i]?.value?.value);

                    if(vehicle.technicalSpecification[i].definition.title._ == 'Front Hip Room')
                        $('.stickycol.seating-front-hip-room').next().children().eq(0).text(vehicle.technicalSpecification[i]?.value?.value);

                    if(vehicle.technicalSpecification[i].definition.title._ == 'Second Head Room')
                        $('.stickycol.seating-second-head-room').next().children().eq(0).text(vehicle.technicalSpecification[i]?.value?.value);

                    if(vehicle.technicalSpecification[i].definition.title._ == 'Second Leg Room')
                        $('.stickycol.seating-second-leg-room').next().children().eq(0).text(vehicle.technicalSpecification[i]?.value?.value);

                    if(vehicle.technicalSpecification[i].definition.title._ == 'Second Shoulder Room')
                        $('.stickycol.seating-second-shoulder-room').next().children().eq(0).text(vehicle.technicalSpecification[i]?.value?.value);

                    if(vehicle.technicalSpecification[i].definition.title._ == 'Second Hip Room')
                        $('.stickycol.seating-second-hip-room').next().children().eq(0).text(vehicle.technicalSpecification[i]?.value?.value);

                    if(vehicle.technicalSpecification[i].definition.title._ == 'Length, Overall')
                        $('.stickycol.seating-length').next().children().eq(0).text(vehicle.technicalSpecification[i]?.value?.value);

                    if(vehicle.technicalSpecification[i].definition.title._ == 'Width, Max w/o mirrors')
                        $('.stickycol.seating-width').next().children().eq(0).text(vehicle.technicalSpecification[i]?.value?.value);

                    if(vehicle.technicalSpecification[i].definition.title._ == 'Heigh, Overall')
                        $('.stickycol.seating-height').next().children().eq(0).text(vehicle.technicalSpecification[i]?.value?.value);

                    if(vehicle.technicalSpecification[i].definition.title._ == 'Track Width, Front')
                        $('.stickycol.seating-track-width-front').next().children().eq(0).text(vehicle.technicalSpecification[i]?.value?.value);

                    if(vehicle.technicalSpecification[i].definition.title._ == 'Track Width, Rear')
                        $('.stickycol.seating-track-width-rear').next().children().eq(0).text(vehicle.technicalSpecification[i]?.value?.value);
                        
                    if(vehicle.technicalSpecification[i].definition.title._ == 'Ground Clearance')
                        $('.stickycol.seating-ground-clearance').next().children().eq(0).text(vehicle.technicalSpecification[i]?.value?.value);

                    if(vehicle.technicalSpecification[i].definition.title._ == 'Payload Capacity')
                        $('.stickycol.seating-payload-capacity').next().children().eq(0).text(vehicle.technicalSpecification[i]?.value?.value);
        
                    if(vehicle.technicalSpecification[i].definition.title._ == 'Cargo Volume with Rear Seat Up')
                        $('.stickycol.seating-cargo-volume').next().children().eq(0).text(vehicle.technicalSpecification[i]?.value?.value);

                    if(vehicle.technicalSpecification[i].definition.title._ == 'Base Curb Weight')
                        $('.stickycol.seating-curb-weight').next().children().eq(0).text(vehicle.technicalSpecification[i]?.value?.value);
                }
            }
        }
    }
}
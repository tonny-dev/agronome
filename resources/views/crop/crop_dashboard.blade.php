@include('layouts.app')
@section('content')

<body class="font-sans">
    <div class="flex h-full">
        <div class="flex-1 flex flex-col overflow-hidden">
            
            <!-- NAV BAR -->
            @include('layouts.top-nav')
            <!-- END NAV BAR -->


            <div class="flex h-full">
                <!--Left menu -->
                <nav class="flex w-72 h-full bg-white border-r dark:bg-gainsboro-800 dark:border-gainsboro-600">
                    <div class="w-full flex max-auto pl-8">
                        <ul class="w-full">

                            <li class="pt-5 font-bold text-gainsboro-300 hover:text-green-600 ">
                                <a href="{{route('farmer.farmer_dashboard') }}"><span class="float-left"><img
                                            src="{{ asset('svg/farm_inactive.svg') }}" alt="farm"></span>
                                    <span class="pl-4 ">Farm</span>
                                </a>
                            </li>

                            <li class="pt-5 font-bold text-green-600 hover:text-green-600 ">
                                <a href="{{route('crop_dashboard') }}" class="">
                                    <span class="float-left"> <img src="{{ asset('svg/crop2.svg') }}"
                                            alt="crop"></span><span class="pl-4 ">Crop</span></a>
                            </li>

                            <li class="pt-5 font-bold text-gainsboro-300 ">
                                <a href="{{route('soil_dashboard') }}" class=""> <span class="float-left pt-2 "><img
                                            src="{{ asset('svg/soil_inactive.svg') }}" alt="soil"></span><span
                                        class="pl-4 hover:text-green-600">Soil</span></a>
                            </li>

                        </ul>
                    </div>
                </nav>
                <!--Left Main-body Nav end-->

                <main class="w-full bg-white">

                    <div id="div_center_main" class="d-block">


                        <div class="flex flex-col justify-center items-center mt-12  ">


                            <div>
                                <div id="welcome_graphic" class="">
                                    <img src="{{ asset('images/sprout.png') }}" class="h-32 w-32">
                                </div>
                            </div>


                            <div class="mt-10  text-green-600 font-semibold"> Welcome to Crop </div>


                            <div><button id="btn_crop_proceed"
                                    class="bg-green-600 hover:bg-green-800 text-white text-sm font-semibold hover:text-white py-2 px-4 rounded-full w-48 mt-12 ">
                                    Proceed
                                </button>
                            </div>

                        </div>

                    </div>

                    <div id="div_crop_instructions" class="d-none"> @include('crop.crop_instructions') </div>
                    
                    <div id="div_crop_card" class="d-none"> @livewire('crop.lw-crop-card') </div>


                </main>



                <!-- RIGHT SIDE BAR  -->

                <nav class="flex w-72 h-full bg-white border-l dark:bg-gainsboro-800 dark:border-gainsboro-600">

                    <div id="div_left_panel" class=" mt-12 ml-2">

                    </div>


                    <div id="div_advanced_search" class="d-block">
                        @livewire('crop.lw-crop-advanced-search')
                    </div>


                </nav>

            </div>

        </div>


        @include('layouts.modals')

        <script>
        // Grabs all the Elements by their IDs which we had given them
        let modal = document.getElementById("profile-modal");
        let btn = document.getElementById("profile-btn");
        let button = document.getElementById("ok-btn");


        // We want the modal to open when the Open button is clicked
        btn.onclick = function() {
            modal.style.display = "block";
        }
        // We want the modal to close when the OK button is clicked
        button.onclick = function() {
            modal.style.display = "none";
        }

        window.onclick = function(event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }
        </script>



        <script>
        $('#btn_crop_proceed').off().on('click', function() {

            populate_div('div_center_main', 'div_crop_instructions');
            populate_div('div_left_panel', 'div_advanced_search');

        });

        $('#btn_crop_instructions_proceed').off().on('click', function() {

            populate_div('div_center_main', 'div_crop_card');

        });



        function div_toggle(show_div, hide_div) {


            $('#' + show_div).removeClass("d-none");
            $('#' + show_div).addClass("d-block");


            $('#' + hide_div).removeClass("d-block");
            $('#' + hide_div).addClass("d-none");

        }


        function populate_div(parent, child) {

            /*empty parent div and then put child content in it*/

            $('#' + parent).empty();
            show_div(child);
            $('#' + child).prependTo('#' + parent);


        }


        function test_div_switch(show_div, hide_div) {

            $('#' + show_div).removeClass("d-none");
            $('#' + show_div).removeClass("d-none");

            $('#' + show_div).addClass("d-grid");

            $('#' + hide_div).removeClass("d-grid");
            $('#' + hide_div).addClass("d-none");


        }


        function hide_div(hide_div) {

            $('#' + hide_div).removeClass("d-block");
            $('#' + hide_div).addClass("d-none");

        }

        function show_div(show_div) {

            $('#' + show_div).removeClass("d-none");
            $('#' + show_div).addClass("d-block");

        }





        const menuBtn = document.querySelector('#menu-btn');
        const dropdown = document.querySelector('#dropdown');

        menuBtn.addEventListener('click', () => {
            dropdown.classList.toggle('hidden');
            dropdown.classList.toggle('show');
        })


        $(document).on('click', '#a_complete_profile', function() {
            $('#complete_profile').modal('show');
        });
        </script>


    </div>

    @livewireScripts

    <Script>
    let bar_width = 10;
    let space_btn_crops = 110;
    let start_x = 35;
    let space_x_text = 13;
    let max_text_width = 260;
    let variety_text_width = 100;
    var canvas;
    var ctx;



    let canvas_width = 7800;
    let canvas_height = 200;
    let max_altitude = 5000;


    let variety_start_x = 30;
    let variety_start_y = 0;

    let variety_height = 0;


    var dragging = false;
    var lastX;
    var marginLeft = 0;


    livewire.on('crop_selection_updated', function(farm_altitude) {




        canvas = document.getElementById("cnv_altitude_graphic");
        ctx = canvas.getContext("2d");

        // reset varieties here 
        variety_start_x = 30;
        ctx.clearRect(0, 0, canvas.width, canvas.height);


        draw_plain_graph(canvas_width, canvas_height, 10, 0, 20);
        drawFarmAltitude(farm_altitude);



        // canvas.addEventListener('mousedown', function(e) {
        //     var evt = e || event;
        //     dragging = true;
        //     lastX = evt.clientX;
        //     e.preventDefault();
        // }, false);

        // window.addEventListener('mousemove', function(e) {
        //     var evt = e || event;
        //     if (dragging) {
        //         var delta = evt.clientX - lastX;
        //         lastX = evt.clientX;
        //         marginLeft += delta;
        //         canvas.style.marginLeft = marginLeft + "px";
        //     }
        //     e.preventDefault();
        // }, false);

        // window.addEventListener('mouseup', function() {
        //     dragging = false;
        // }, false);





    });


    livewire.on('variety_loaded', function(variety_name, min, max, color) {

        //  alert(variety_name + ' '+ min.toString() + ' ' + max.toString());

        variety_height = (max - min) * (canvas.height / max_altitude);
        variety_start_y = canvas.height - (max * (canvas.height / max_altitude));

        // alert(variety_start_x + ' '+ variety_start_y+' '+variety_height+' '+variety_name+ ' '+min + ' '+' '+max);


        drawVariety(variety_start_x, variety_start_y, variety_height, color, variety_name, min, max);
    });




    function draw_plain_graph(width, height, lines, start_y, interval) {

        canvas.width = width;
        canvas.height = height;
        var altitude = max_altitude;
        let alt_interval = max_altitude / lines;


        drawRectColored(ctx, 0, 0, 25, canvas.height, 'gainsboro');

        for (let i = 0; i < lines + 1; i++) {
            drawLine(ctx, 0, start_y, canvas.width, start_y, 'gainsboro');
            ctx.fillText(altitude.toString(), 0, start_y);

            start_y = start_y + interval;
            altitude = altitude - alt_interval;

        }

        ctx.fillText(max_altitude.toString(), 0, 7);

    }

    function drawVariety(x, y, height, color, variety_name, min, max) {

        var space;
        ctx.save();
        ctx.fillStyle = color;
        ctx.strokeStyle = color;
        ctx.strokeRect(variety_start_x, y, bar_width, height);
        ctx.restore();


        // ctx.font = '8px serif';
        // ctx.fillStyle = 'red';
        // ctx.fillText(max, variety_start_x + space_x_text, y + 5, max_text_width);

        ctx.font = '10px serif';
        ctx.fillStyle = 'black';
        ctx.fillText(variety_name, variety_start_x + space_x_text, height / 2 + y + 2, max_text_width);


        // ctx.font = '8px serif';
        // ctx.fillStyle = 'red';
        // ctx.fillText(min, variety_start_x + space_x_text, y + height, max_text_width);



        variety_start_x = variety_start_x + space_btn_crops;

    }


    function drawText(ctx, x, y, width, height, color, variety, min, max) {
        ctx.fillStyle = color;
        ctx.fillText(' 1,800', 80, 75, 260);
    }


    function drawFarmAltitude(masl) {

        var line_height = canvas.height - ((canvas_height / 5000) * masl);
        drawLine(ctx, 25, line_height, canvas.width, line_height, 'green');

    }


    function drawLine(ctx, startX, startY, endX, endY, color) {
        ctx.save();
        ctx.strokeStyle = color;
        ctx.beginPath();
        ctx.moveTo(startX, startY);
        ctx.lineTo(endX, endY);
        ctx.stroke();
        ctx.restore();
    }


    function drawRect(ctx, x, y, width, height, color) {
        ctx.save();
        ctx.fillStyle = color;
        ctx.strokeRect(x, y, width, height);
        ctx.restore();
    }

    function drawRectColored(ctx, x, y, width, height, color) {
        ctx.save();
        ctx.fillStyle = color;
        ctx.fillRect(x, y, width, height);
        ctx.restore();
    }
    </Script>


</body>

</html>
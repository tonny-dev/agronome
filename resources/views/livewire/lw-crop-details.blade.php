<div>
    <div class="container row">
        <div class="col-md-6" id="details_section">
            <div id="accordion">


                <div class="card">
                    <div class="card-header" id="overview_card">
                        <h5 class="mb-0">
                            <button class="btn btn-outline-success btn-block" data-toggle="collapse" data-target="#overview"
                                aria-expanded="true" aria-controls="collapseOne">
                                Overview
                            </button>
                        </h5>
                    </div>

                    <div id="overview" class="collapse " aria-labelledby="headingOne" data-parent="#accordion">
                        <div class="card-body">

                            {{ $blurb}}

                        </div>
                    </div>
                </div>



                <div class="card">
                    <div class="card-header" id="headingOne">
                        <h5 class="mb-0">
                        <button class="btn btn-outline-success btn-block" data-toggle="collapse" data-target="#soil" aria-expanded="true"
                                aria-controls="collapseOne">
                                Soil requirements
                            </button>
                        </h5>
                    </div>

                    <div id="soil" class="collapse " aria-labelledby="headingOne" data-parent="#accordion">
                        <div class="card-body">
                            {{$soil_blurb}}
                        </div>
                    </div>
                </div>





                <div class="card">
                    <div class="card-header" id="headingTwo">
                        <h5 class="mb-0">
                        <button class="btn btn-outline-success btn-block" data-toggle="collapse" data-target="#pests"
                                aria-expanded="false" aria-controls="collapseTwo">
                                Pest vulnerabilities
                            </button>
                        </h5>
                    </div>
                    <div id="pests" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
                        <div class="card-body">

                            @foreach ($pests as $pest)
                            <li>{{ $pest->name }}</li>
                            @endforeach

                        </div>
                    </div>
                </div>



                <div class="card">
                    <div class="card-header" id="headingThree">
                        <h5 class="mb-0">
                        <button class="btn btn-outline-success btn-block" collapsed" data-toggle="collapse" data-target="#diseases"
                                aria-expanded="false" aria-controls="collapseThree">
                                Disease vulnerabilities
                            </button>
                        </h5>
                    </div>
                    <div id="diseases" class="collapse" aria-labelledby="headingThree" data-parent="#accordion">
                        <div class="card-body">
                            @foreach ($diseases as $disease)
                            <li>{{ $disease->name }}</li>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="col-md-6" id="actions_section"> 

        @livewire('lw-crop-farm-details')

        </div>
    </div>





</div>
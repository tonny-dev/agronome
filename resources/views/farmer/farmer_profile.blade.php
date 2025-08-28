@include('layouts.app')
@section('content')

<body>
    <div>

        <!-- Top NAV BAR -->
        @include('layouts.top-nav')

        <div class="flex h-full">
            <!--Left menu -->
            @include('layouts.account_sidebar')

            {{-- Main menu --}}
            @livewire('lw-farmer-profile')
        </div>

    </div>
    @livewireScripts

    <script>
        const menuBtn = document.querySelector('#menu-btn');
        const dropdown = document.querySelector('#dropdown');

        menuBtn.addEventListener('click', () => {
            dropdown.classList.toggle('hidden');
            dropdown.classList.toggle('show');
        })

        // Will come to you
        // $('body').click(function(event) {
        //     // alert("window clicked");
        //     if (event.target.id != "dropdown") {
        //         $("#dropdown").hide();
        //     }
        // });
    </script>
</body>
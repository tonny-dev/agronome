@include('layouts.app')
@section('content')

<body>
    <div class="">

        <!-- Top NAV BAR -->
        @include('layouts.top-nav')
        <!-- END Top NAV BAR -->

        <div class="flex h-full">
            <!--Left menu -->
            @include('layouts.account_sidebar')

            <!-- Left menu end -->

            <div class="flex-1 flex flex-col overflow-hidden">
                @livewire('change-password')
            </div>

        </div>

        @livewireScripts
    </div>
    <script>
        const menuBtn = document.querySelector('#menu-btn');
        const dropdown = document.querySelector('#dropdown');

        menuBtn.addEventListener('click', () => {
            dropdown.classList.toggle('hidden');
            dropdown.classList.toggle('show');
        })
    </script>
</body>
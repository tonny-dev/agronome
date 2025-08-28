@include('layouts.app')
@section('content')

<body class="font-sans">
    <div class="flex min-h-screen">
        <div class="flex-1 flex flex-col overflow-hidden">
            @include('layouts.top-nav')

            <div class="flex h-full">
                <main class="w-full bg-white overflow-x-hidden overflow-y-hidden md:mb-0 mb-20">
                    <div class="w-full mx-auto px-6">
                        <livewire:mobile-soil-test-results />
                    </div>
                </main>


            </div>
        </div>


    </div>

    @include('layouts.mobile-footer')


    @livewireScripts
</body>

</html>
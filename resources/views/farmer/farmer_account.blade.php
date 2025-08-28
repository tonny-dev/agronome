@include('layouts.app')
@section('content')

<body>
    <div>
            <div class="flex min-h-screen  2xl:max-w-screen-2xl 2xl:mx-auto 2xl:border-x-2 2xl:border-gray-200">

                <aside class=" w-1/6 py-10 pl-10 nav_color min-w-min  border-r border-gray-300 dark:border-zinc-700  hidden md:block ">
                @include('layouts.account_sidebar')
                </aside>

                <main class="flex-1 py-0  px-5 sm:px-10">
                    <section class="mt-2">
                        <!-- @include('faqs.faqs') -->
                        {{-- @livewire('change-password') --}}

                        @include('legalpolicyandtermsofservice.privacy_policy')
                    </section>
                </main>
            </div>

        </div>
</body>
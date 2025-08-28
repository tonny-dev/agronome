<main class="w-full bg-white mx-4">
    <div>
        {{-- If you look to others for fulfillment, you will never truly be fulfilled. --}}
        <section class="md:pt-0 pt-10">
            <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
                <h1 class="text-2xl font-bold text-gray-900 md:text-2xl">
                    Change Password
                </h1>

                @if(Session::has("successful"))
                <div class="px-6 fade_away mb-2 text-sm text-green-700 bg-green-100 rounded-lg" role="alert">
                    <span class="font-medium">Success</span> {{Session::get('successful')}}
                </div>
                @endif

                @if(Session::has("error_password"))
                <div class="px-6 fade_away mb-2 text-sm text-red-700 bg-red-100 rounded-lg" role="alert">
                    <span class="font-medium">Error</span> {{Session::get('error_password')}}
                </div>
                @endif

                <form class="space-y-4 md:space-y-6 pb-6" wire:submit.prevent="update_password()">
                    <div class="flex flex-col mb-4 md:w-1/2">
                        <label for="current-password" class="block mb-2 text-sm font-light text-gray-900 dark:text-white">Current Password</label>

                        <div class="relative">
                            <div class="flex absolute inset-y-0 left-0 items-center pl-3">
                                <i class="bi bi-lock-fill"></i>
                            </div>
                            <input type="password" name="current_password" id="current_password" class="bg-white border p-4 pl-10 border-gray-300 text-gray-900 sm:text-sm focus:ring-green-600 focus:border-green-600 outline-none block w-full p-2.5" placeholder="current password" wire:model="current_password">

                            <div class="flex absolute inset-y-0 right-0 pr-3 items-center">
                                <i class="bi bi-pencil"></i>
                            </div>
                        </div>
                        @error('current_password')
                        <div class="bg-red-100 mt-2 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                            <p class="block sm:inline"> {{ $message }}</p>
                        </div>
                        @enderror
                    </div>
                    <div class="flex flex-col mb-4 md:w-1/2">
                        <label for="password" class="block mb-2 text-sm font-light text-gray-900 dark:text-white">New Password</label>

                        <div class="relative">
                            <div class="flex absolute inset-y-0 left-0 items-center pl-3">
                                <i class="bi bi-lock-fill"></i>
                            </div>

                            <input type="password" name="password" id="password" placeholder="••••••••" class="bg-white pl-10 border border-gray-300 text-gray-900 sm:text-sm focus:ring-green-600 focus:border-green-600 outline-none block w-full p-2.5" wire:model="password">
                            <div class="flex absolute inset-y-0 right-0 pr-3 items-center">
                                <i class="bi bi-pencil"></i>
                            </div>
                        </div>
                        @error('password')
                        <div class="bg-red-100 mt-2 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                            <p class="block sm:inline"> {{ $message }}</p>
                        </div>
                        @enderror
                    </div>
                    <div class="flex flex-col w-1/2">
                        <label for="password_confirmation" class="block mb-2 text-sm font-light text-gray-900">Re-enter password</label>
                        <div class="relative">
                            <div class="flex absolute pl-3 left-0 inset-y-0 items-center">
                                <i class="bi bi-lock-fill"></i>
                            </div>

                            <input type="password" name="password_confirmation" id="password_confirmation" placeholder="••••••••" class="bg-white pl-10 border border-gray-300 text-gray-900 sm:text-sm focus:ring-green-600 focus:border-green-600 outline-none block w-full p-2.5" wire:model="password_confirmation">
                            <div class="flex absolute inset-y-0 right-0 pr-3 items-center">
                                <i class="bi bi-pencil"></i>
                            </div>
                        </div>
                        @error('password_confirmation')
                        <div class="bg-red-100 mt-2 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                            <p class="block sm:inline"> {{ $message }}</p>
                        </div>
                        @enderror
                    </div>
                    <button type="submit" class="w-full md:w-1/2 lg:w-1/2 text-white nav_color hover:bg-green-400 focus:ring-4 focus:outline-none focus:ring-green-700 text-sm px-5 py-2.5 text-center font-light">Update Password</button>

                </form>

                <div class="border-b border-green-600 pb-2">
                    <div class="flex justify-between">
                        <h1 class="font-bold tracking-wide text-lg">Delete My Account</h1>
                        <div>
                            <button class="uppercase w-full text-white bg-red-400 hover:bg-red-400 focus:ring-4 focus:outline-none text-sm px-5 py-1 rounded-lg font-bold">Delete account</button>
                        </div>
                    </div>
                </div>

                <div class="border-b border-green-600 pb-2">
                    <a class="text-base" href="{{route('terms_and_conditions')}}">View Terms and Conditions</a>
                </div>
                <div class="pb-2">
                    <a class="text-base" href="{{route('privacy_policy')}}">View Privacy Policy</a>
                </div>
            </div>
        </section>

    </div>

    <script>
        $(".fade_away").fadeTo(1000, 0.4).slideUp(500, function() {
            $(".fade_away").slideUp(500);
        });
    </script>
</main>
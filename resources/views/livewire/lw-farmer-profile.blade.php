<main class="w-full bg-white mx-4">
    <div class="px-6 pt-6 pb-2">
        <h1 class="font-semibold text-lg">My Profile</h1>
    </div>
    <hr>
    <!-- success message -->

    @if($success)
    <div class="mx-6 successful mt-2 mb-2 text-sm text-green-700 bg-green-100 rounded-lg" role="alert">
        <p class="font-medium p-2"> {{ $success }}</p>
    </div>
    @endif
    <form wire:submit.prevent="update_farmer_profile" method="POST">
        @csrf
        <div class="px-6 pt-6">
            <div class="grid md:grid-cols-2 md:gap-x-14 lg:gap-x-14 xl:gap-x-11 gap-4 grid-cols-1 lg:grid-cols-2 xl:grid-cols-2">
                <div>
                    <label for="first_name" class="subpixel-antialiased">First Name</label>
                    <div class="relative">
                        <div class="flex absolute inset-y-0 left-0 items-center pl-3">
                            <i class="fa-solid fa-user"></i>
                        </div>
                        <input wire:model.defer="first_name" id="first_name" type="text" name="first_name" class="bg-white border p-4 pl-10 border-gray-300 text-gray-900 sm:text-sm focus:ring-green-600 focus:border-green-600 outline-none block w-full p-2.5 cursor-not-allowed" placeholder="first name">

                        <!-- <div class="flex absolute inset-y-0 right-0 pr-3 items-center">
                            <i class="bi bi-pencil"></i>
                        </div> -->
                    </div>
                </div>
                <div>
                    <label for="other_names" class="subpixel-antialiased">Last Name</label>
                    <div class="relative">
                        <div class="flex absolute inset-y-0 left-0 items-center pl-3">
                            <i class="fa-solid fa-user"></i>
                        </div>
                        <input wire:model.defer="other_names" id="other_names" type="text" name="other_names" class="bg-white border p-4 pl-10 border-gray-300 text-gray-900 sm:text-sm focus:ring-green-600 focus:border-green-600 outline-none block w-full p-2.5 cursor-not-allowed">

                        <!-- <div class="flex absolute inset-y-0 right-0 pr-3 items-center">
                            <i class="bi bi-pencil"></i>
                        </div> -->
                    </div>
                </div>
                <div>
                    <label for="email" class="subpixel-antialiased">Email Address</label>
                    <div class="relative">
                        <div class="flex absolute inset-y-0 left-0 items-center pl-3">
                            <i class="fa-solid fa-envelope"></i>
                        </div>
                        <input wire:model.defer="email" id="email" type="email" name="address" class="bg-white border p-4 pl-10 border-gray-300 text-gray-900 sm:text-sm focus:ring-green-600 focus:border-green-600 outline-none block w-full p-2.5 cursor-not-allowed">

                        <!-- <div class="flex absolute inset-y-0 right-0 pr-3 items-center">
                            <i class="bi bi-pencil"></i>
                        </div> -->
                    </div>
                </div>
                <div>
                    <label for="mobile" class="subpixel-antialiased">Cel/Phone Number</label>
                    <div class="relative">
                        <div class="flex absolute inset-y-0 left-0 items-center pl-3">
                            <i class="fa-solid fa-phone"></i>
                        </div>
                        <input wire:model.defer="mobile" id="mobile" type="tel" name="mobile" class="bg-white border p-4 pl-10 border-gray-300 text-gray-900 sm:text-sm focus:ring-green-600 focus:border-green-600 outline-none block w-full p-2.5 cursor-not-allowed">

                        <!-- <div class="flex absolute inset-y-0 right-0 pr-3 items-center">
                            <i class="bi bi-pencil"></i>
                        </div> -->
                    </div>
                </div>
            </div>
        </div>
        <div class="px-6 pt-6 pb-2">
            <h1 class="font-semibold text-lg">Additional Details</h1>
        </div>
        <hr>
        <div class="px-6 mt-6">
            <div class="grid md:grid-cols-2 md:gap-x-14 lg:gap-x-14 xl:gap-x-11 gap-4 grid-cols-1 lg:grid-cols-2 xl:grid-cols-2">
                <div>
                    <label for="dob" class="subpixel-antialiased">County</label>
                    <div class="relative">
                        <select name="county" wire:model.defer="county" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm outline-none block w-full p-2.5" name="county">
                            @foreach($counties as $county)
                            <option value="{{ $county->id }}" type="hidden">{{ $county->county }}</option>
                            @endforeach
                            <option value="{{ $county->id }}" type="hidden" selected>{{ $county->county }}</option>
                        </select>
                    </div>
                    @error('county') <div class="mt-1 text-red-500 text-sm">{{ $message }}</div> @enderror
                </div>


                <div>
                    <label for="dob" class="subpixel-antialiased">Date of Birth</label>
                    <div class="relative">
                        <div class="flex absolute inset-y-0 left-0 items-center pl-3">
                            <i class="fa-solid fa-calendar"></i>
                        </div>
                        <input wire:model.defer="dob" id="dob" type="date" name="dob" class="bg-white border p-4 pl-10 border-gray-300 text-gray-900 sm:text-sm focus:ring-green-600 focus:border-green-600 outline-none block w-full p-2.5" placeholder="first name">
                        <div class="flex absolute inset-y-0 right-0 pr-3 items-center">
                            <i class="bi bi-pencil"></i>
                        </div>
                    </div>
                    @error('dob') <div class="mt-1 text-red-500 text-sm">{{ $message }}</div> @enderror
                </div>

                <div>
                    <label for="gender" class="subpixel-antialiased">Gender</label>
                    <select id="gender" wire:model.defer="gender" name="gender" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm outline-none block w-full p-2.5">
                        <option value=''>Gender</option>
                        <option value='M'>Male</option>
                        <option value='F'>Female</option>
                        <option value="{{ $gender }}" selected>{{ $gender}}</option>
                    </select>
                    @error('gender') <div class="mt-1 text-red-500 text-sm">{{ $message }}</div> @enderror

                </div>
                <div>
                    <label for="national_id" class="subpixel-antialiased">Passport NO./ID No.</label>
                    <div class="relative">
                        <div class="flex absolute inset-y-0 left-0 items-center pl-3">
                            <i class="fa-solid fa-user"></i>
                        </div>
                        <input wire:model.defer="national_id" id="national_id" type="national_id" name="address" class="bg-white border p-4 pl-10 border-gray-300 text-gray-900 sm:text-sm focus:ring-green-600 focus:border-green-600 outline-none block w-full p-2.5" placeholder="ID No.">

                        <div class="flex absolute inset-y-0 right-0 pr-3 items-center">
                            <i class="bi bi-pencil"></i>
                        </div>
                    </div>
                    @error('national_id') <div class="mt-1 text-red-500 text-sm">{{ $message }}</div> @enderror
                </div>
                <div>
                    <label for="kra_pin" class="subpixel-antialiased">KRA PIN</label>
                    <div class="relative">
                        <div class="flex absolute inset-y-0 left-0 items-center pl-3">
                            <i class="fa-solid fa-lock"></i>
                        </div>
                        <input wire:model.defer="kra_pin" id="kra_pin" type="text" name="address" class="bg-white border p-4 pl-10 border-gray-300 text-gray-900 sm:text-sm focus:ring-green-600 focus:border-green-600 outline-none block w-full p-2.5" placeholder="KRA PIN">

                        <div class="flex absolute inset-y-0 right-0 pr-3 items-center">
                            <i class="bi bi-pencil"></i>
                        </div>
                    </div>
                    @error('kra_pin') <div class="mt-1 text-red-500 text-sm">{{ $message }}</div> @enderror
                </div>
                <div>
                    <label for="address" class="subpixel-antialiased">Address</label>
                    <div class="relative">
                        <div class="flex absolute inset-y-0 left-0 items-center pl-3">
                            <i class="fa-solid fa-phone"></i>
                        </div>
                        <input wire:model.defer="address" id="address" type="tel" name="address" class="bg-white border p-4 pl-10 border-gray-300 text-gray-900 sm:text-sm focus:ring-green-600 focus:border-green-600 outline-none block w-full p-2.5" placeholder="Your Address">

                        <div class="flex absolute inset-y-0 right-0 pr-3 items-center">
                            <i class="bi bi-pencil"></i>
                        </div>
                    </div>
                    @error('address') <div class="mt-1 text-red-500 text-sm">{{ $message }}</div> @enderror
                </div>
                <div>
                    <label for="secondary_mobile" class="subpixel-antialiased">Secondary Phone Number</label>
                    <div class="relative">
                        <div class="flex absolute inset-y-0 left-0 items-center pl-3">
                            <i class="fa-solid fa-phone"></i>
                        </div>
                        <input wire:model.defer="secondary_mobile" id="secondary_mobile" type="tel" name="secondary_mobile" class="bg-white border p-4 pl-10 border-gray-300 text-gray-900 sm:text-sm focus:ring-green-600 focus:border-green-600 outline-none block w-full p-2.5" placeholder="+2547123456789">

                        <div class="flex absolute inset-y-0 right-0 pr-3 items-center">
                            <i class="bi bi-pencil"></i>
                        </div>
                    </div>
                    @error('secondary_mobile') <div class="mt-1 text-red-500 text-sm">{{ $message }}</div> @enderror
                </div>

                <div>
                    <label for="secondary_email" class="subpixel-antialiased">Secondary Email Address</label>
                    <div class="relative">
                        <div class="flex absolute inset-y-0 left-0 items-center pl-3">
                            <i class="fa-solid fa-envelope"></i>
                        </div>
                        <input wire:model.defer="secondary_email" id="secondary_email" type="email" name="secondary_email" class="bg-white border p-4 pl-10 border-gray-300 text-gray-900 sm:text-sm focus:ring-green-600 focus:border-green-600 outline-none block w-full p-2.5" placeholder="user@email.com">

                        <div class="flex absolute inset-y-0 right-0 pr-3 items-center">
                            <i class="bi bi-pencil"></i>
                        </div>
                    </div>

                    @error('secondary_email') <div class="mt-1 text-red-500 text-sm">{{ $message }}</div> @enderror

                </div>
            </div>
        </div>
        <div class="flex mt-2 px-6 justify-center md:justify-between lg:justify-between xl:justify-between">
            <div>
            </div>
            <button id="ok-btn" type="submit" class="bottom-4 py-1 px-2 bg-green-500 flex justify-center font-medium items-center text-white text-sm hover:bg-green-700 hover:drop-shadow-2xl hover:animate-bounce duration-300">Yes</button>
        </div>
    </form>

    <script>

        $(".successful").fadeTo(1000, 0.4).slideUp(500, function() {
            $(".fade_away").slideUp(500);
        });
    </script>
</main>
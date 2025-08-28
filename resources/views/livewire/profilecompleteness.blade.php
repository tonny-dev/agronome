@if($check_completeness == 100)
<div class="hidden">
    <p>Profile is {{$check_completeness}}% complete.</p>
</div>
@else
<div>
    <p class="text-lg">Your profile is <em class="text-green-600">{{$check_completeness}}%</em> complete.</p>
    <div class="w-full bg-gray-200 rounded-full h-2.5">
    <div class="active h-2.5 rounded-full" style="width: {{$check_completeness}}%;"></div>
    </div>
    <div class="mt-1">
        <h3 class="font-bold text-xs">Click <span class="active_nav_button"><a href="{{route('farmer_profile') }}">My Account</a></span> to complete registration</h3>
    </div>
</div>
@endif
<form method="POST" action="{{ route('login') }}" style="margin-top:17% " id="loginForm"> 
    @csrf

    <div style="margin-left:41%"> <img src="{{ asset('images/logotext_.png') }}"> </div>
    <div style="margin-left:40%;font-size:25px; font-weight:bold;color:#0A4022;font-family:'Open Sans';"> Welcome</div>

    @if(isset($recentUsers) && count($recentUsers) > 0)
    <div class="w-100 pl-5 pb-2">
        <div class="dropdown">
            <button class="btn btn-outline-success btn-sm dropdown-toggle" type="button" id="recentUsersDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-history"></i> Recent Users
            </button>
            <div class="dropdown-menu" aria-labelledby="recentUsersDropdown" style="max-width: 300px;">
                @foreach($recentUsers as $user)
                    <a class="dropdown-item recent-user-item" href="#" data-identifier="{{ $user['identifier'] }}" data-name="{{ $user['name'] }}">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <strong>{{ $user['name'] }}</strong><br>
                                <small class="text-muted">{{ $user['identifier'] }}</small>
                            </div>
                            <small class="text-muted">{{ \Carbon\Carbon::parse($user['last_login'])->diffForHumans() }}</small>
                        </div>
                    </a>
                @endforeach
                <div class="dropdown-divider"></div>
                <a class="dropdown-item text-danger" href="#" id="clearRecentUsers">
                    <i class="fas fa-trash-alt"></i> Clear Recent Users
                </a>
            </div>
        </div>
    </div>
    @endif

    <div class="w-120 pl-5 pb-3 pt-3">
        <input id="email" type="text" placeholder="Email address or phone number"
            class="form-control @error('email') is-invalid @enderror mtextbox   "
            name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

        @error('email')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
    <!-- </div> -->

    <!-- <div class="form-group row"> -->

    <div class="w-100 pl-5 pb-3">
        <input id="password" type="password" placeholder="Password"
            class="form-control @error('password') is-invalid @enderror  mtextbox   "
            name="password" required autocomplete="current-password">

        @error('password')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
    <!-- </div> -->

    <div class="row">
        <div class="col-md-6 " style="font-size:15px;">
            <div class="form-check pl-5">
                <input class="checkbox-round " type="checkbox" name="remember" id="remember"
                    {{ old('remember') ? 'checked' : '' }}>
                <label class="form-check-label ml-2" for="remember">
                    {{ __('Remember me') }}
                </label>
            </div>
        </div>

        <div class="col-md-6" style="padding-left:15%; text-decoration: underline;font-size:15px">
            <a href="{{url('/forgot-password')}}"  id="lnk_forgot_pw" class="text-success">Forgot Password?</a>
        </div>
    </div>

    <!-- <div class="form-group row mb-0"> -->
    <div class="col-auto" style="padding-top: 20px; ">
        <button type="submit" class="btn mgreen shadow-xl btn-lg agrobtn" style="margin-left:40% ">  Sign in     </button>
    </div>



    <div style="padding-left: 15%;font-size:15px;color:#323130; margin-top:5%;">
        Don't have an account? Click <a href="{{ url('/register') }}" id="registration_link" class="text-success"
            style="text-decoration:underline">here</a> to create one.</div>
</form>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Handle recent user selection
    const recentUserItems = document.querySelectorAll('.recent-user-item');
    const emailInput = document.getElementById('email');
    const passwordInput = document.getElementById('password');
    
    recentUserItems.forEach(item => {
        item.addEventListener('click', function(e) {
            e.preventDefault();
            const identifier = this.dataset.identifier;
            const name = this.dataset.name;
            
            emailInput.value = identifier;
            passwordInput.focus();
            
            // Add visual feedback
            this.classList.add('bg-success', 'text-white');
            setTimeout(() => {
                this.classList.remove('bg-success', 'text-white');
            }, 200);
        });
    });
    
    // Handle clear recent users
    const clearButton = document.getElementById('clearRecentUsers');
    if (clearButton) {
        clearButton.addEventListener('click', function(e) {
            e.preventDefault();
            if (confirm('Are you sure you want to clear all recent users?')) {
                fetch('/clear-recent-users', {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                        'Content-Type': 'application/json'
                    }
                })
                .then(response => response.json())
                .then(data => {
                    location.reload();
                })
                .catch(error => {
                    console.error('Error:', error);
                });
            }
        });
    }
    
    // Enhanced form validation
    const form = document.getElementById('loginForm');
    const submitButton = form.querySelector('button[type="submit"]');
    
    form.addEventListener('submit', function(e) {
        const email = emailInput.value.trim();
        const password = passwordInput.value.trim();
        
        if (!email || !password) {
            e.preventDefault();
            alert('Please enter both email/phone and password');
            return;
        }
        
        // Show loading state
        submitButton.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Signing in...';
        submitButton.disabled = true;
    });
    
    // Auto-complete enhancement
    emailInput.addEventListener('input', function() {
        const value = this.value.toLowerCase();
        const dropdown = document.querySelector('.dropdown-menu');
        
        if (dropdown && value.length > 0) {
            const items = dropdown.querySelectorAll('.recent-user-item');
            let hasVisible = false;
            
            items.forEach(item => {
                const identifier = item.dataset.identifier.toLowerCase();
                const name = item.dataset.name.toLowerCase();
                
                if (identifier.includes(value) || name.includes(value)) {
                    item.style.display = 'block';
                    hasVisible = true;
                } else {
                    item.style.display = 'none';
                }
            });
            
            // Show/hide dropdown based on matches
            if (hasVisible && value.length > 1) {
                dropdown.style.display = 'block';
            }
        }
    });
});
</script>

<style>
.recent-user-item:hover {
    background-color: #f8f9fa;
    cursor: pointer;
}

.dropdown-menu {
    max-height: 300px;
    overflow-y: auto;
}

.recent-user-item {
    padding: 0.75rem 1rem;
    border-bottom: 1px solid #f1f3f4;
}

.recent-user-item:last-of-type {
    border-bottom: none;
}

#recentUsersDropdown {
    font-size: 0.875rem;
    margin-bottom: 0.5rem;
}

.fa-history {
    margin-right: 0.25rem;
}

.dropdown-item.text-danger:hover {
    background-color: #f8d7da;
}
</style>


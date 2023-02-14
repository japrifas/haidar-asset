<div>
    @if (Session::get('fail'))
        <div class='alert alert-danger'>
            {{ Session::get('fail') }}
        </div>
    @endif
    @if (Session::get('success'))
        <div class='alert alert-success'>
            {{ Session::get('success') }}
        </div>
    @endif
    <form class="card card-md" wire:submit.prevent='changePasswordHandler()' method="post" autocomplete="off">
        <div class="card-body">
            <h2 class="card-title text-center mb-4">Change Your Password</h2>
            <div class="mb-3">
                <label class="form-label"></label>
                <input type="email" class="form-control" placeholder="Enter email" wire:model='email' disabled>
                @error('email')
                    <span class='text-danger'>{{ $message }}</span>
                @enderror
            </div>
            <div class="mb-2">
                <label class="form-label">
                    New Password
                </label>
                <div class="input-group input-group-flat">
                    <input type="password" class="form-control" placeholder="Enter New Password" autocomplete="off"
                        wire:model='new_password'>
                    <span class="input-group-text">
                        <a href="#" class="link-secondary" title="Show password" data-bs-toggle="tooltip">
                            <!-- Download SVG icon from http://tabler-icons.io/i/eye -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                                viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <circle cx="12" cy="12" r="2" />
                                <path
                                    d="M22 12c-2.667 4.667 -6 7 -10 7s-7.333 -2.333 -10 -7c2.667 -4.667 6 -7 10 -7s7.333 2.333 10 7" />
                            </svg>
                        </a>
                    </span>
                </div>
                @error('new_password')
                    <span class='text-danger'>{{ $message }}</span>
                @enderror
            </div>
            <div class="mb-2">
                <label class="form-label">
                    Confirm New Password
                </label>
                <div class="input-group input-group-flat">
                    <input type="password" class="form-control" placeholder="Enter Confirm New Password" autocomplete="off"
                        wire:model='confirm_new_password'>
                    <span class="input-group-text">
                        <a href="#" class="link-secondary" title="Show password" data-bs-toggle="tooltip">
                            <!-- Download SVG icon from http://tabler-icons.io/i/eye -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                                viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <circle cx="12" cy="12" r="2" />
                                <path
                                    d="M22 12c-2.667 4.667 -6 7 -10 7s-7.333 -2.333 -10 -7c2.667 -4.667 6 -7 10 -7s7.333 2.333 10 7" />
                            </svg>
                        </a>
                    </span>
                </div>
                @error('confirm_new_password')
                    <span class='text-danger'>{{ $message }}</span>
                @enderror
            </div>
            <div class="form-footer">
                <button type="submit" class="btn btn-primary w-100">Submit</button>
            </div>
        </div>
    </form>
</div>

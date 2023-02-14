<div>
    <form method="post" wire:submit.prevent='UpdateProfileDetails()'>
        <div class="row">
            <div class="col-md-4">
                <div class="mb-4">
                    <label class="form-label">Fullname</label>
                    <input type="text" class="form-control" name="fullname" placeholder="Input fullname"
                        wire:model='name'>
                    @error('name')
                        <span class='text-danger'>{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="col-md-4">
                <div class="mb-4">
                    <label class="form-label">Username</label>
                    <input type="text" class="form-control" name="username" placeholder="Input username"
                        wire:model="username">
                    @error('username')
                        <span class='text-danger'>{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="col-md-4">
                <div class="mb-4">
                    <label class="form-label">Email</label>
                    <input type="text" class="form-control" name="email" placeholder="Input email address"
                        wire:model="email" disabled>
                    @error('email')
                        <span class='text-danger'>{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="form-footer">
                <button type="submit" class="btn btn-primary">Save Changes</button>
            </div>
        </div>
    </form>
</div>

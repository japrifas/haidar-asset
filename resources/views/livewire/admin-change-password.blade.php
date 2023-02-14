<div>
    <form wire:submit.prevent='ChangePasswordHandler()' method='post'>
        <div class="row">
            <div class="col-md-4">
                <div class="mb-3">
                    <label class="form-label">Current Password</label>
                    <input type="password" class="form-control" name="current_password" placeholder="Input current password"
                        wire:model='current_password'>
                    @error('current_password')
                        <span class='text-danger'>{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="col-md-4">
                <div class="mb-3">
                    <label class="form-label">New Password</label>
                    <input type="password" class="form-control" name="new_password" placeholder="Input new password"
                        wire:model='new_password'>
                    @error('new_password')
                        <span class='text-danger'>{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="col-md-4">
                <div class="mb-3">
                    <label class="form-label">Confirm New Password</label>
                    <input type="password" class="form-control" name="fullname" placeholder="Input new password"
                        wire:model='confirm_new_password'>
                    @error('confirm_new_password')
                        <span class='text-danger'>{{ $message }}</span>
                    @enderror
                </div>
            </div>
        </div>
        <div class="form-footer">
            <button type="submit" class="btn btn-primary">Save Changes</button>
        </div>
    </form>
</div>

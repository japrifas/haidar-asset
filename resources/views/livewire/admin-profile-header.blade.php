<div>
    <div class="page-header">
        <div class="row align-items-center">
            <div class="col-auto">
                <span class="avatar avatar-md" style="background-image: url({{$user->picture}})"></span>
            </div>
            <div class="col-md-6">
                <h2 class="page-title">{{ $user->name }}</h2>
                <div class="page-subtitle">
                    <div class="row">
                        <div class="col-auto">
                            <!-- Download SVG icon from http://tabler-icons.io/i/building-skyscraper -->
                            <!-- SVG icon code -->
                            <a href="#" class="text-reset">{{ $user->username }}</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-auto d-md-flex">
            <input type="file" name="file" id="changeAdminPictureFile" class="d-none" onchange="this.dispatchEvent(new InputEvent('input'))">
                <a href="#" class="btn btn-primary" onclick="event.preventDefault();document.getElementById('changeAdminPictureFile').click();">
                    Change Picture
                </a>
            </div>
        </div>
    </div>
</div>

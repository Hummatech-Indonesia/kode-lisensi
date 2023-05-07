@php use App\Helpers\UserHelper; @endphp
    <!-- Edit Profile Start -->
<div class="modal fade theme-modal" id="editProfile" tabindex="-1" aria-labelledby="exampleModalLabel2"
     aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-fullscreen-sm-down">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel2">Edit Profile</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <i class="fa-solid fa-xmark"></i>
                </button>
            </div>
            <form action="{{ route('user.profile.update', auth()->id()) }}" method="POST" enctype="multipart/form-data">
                @method("PATCH")
                @csrf
                <div class="modal-body">
                    <div class="row g-4">
                        <div class="col-xxl-6">
                            <div class="form-floating theme-form-floating">
                                <input autocomplete="off" name="name" type="text" class="form-control" id="name"
                                       value="{{ UserHelper::getUserName() }}">
                                <label for="name">Nama Lengkap</label>
                            </div>
                        </div>

                        <div class="col-xxl-6">
                            <div class="form-floating theme-form-floating">
                                <input autocomplete="off" class="form-control" type="text"
                                       value="{{ UserHelper::getUserPhone() }}"
                                       name="phone_number" id="mobile">
                                <label for="mobile">Nomor Telepon</label>
                            </div>
                        </div>

                        <div class="col-xxl-12">
                            <div class="form-floating theme-form-floating">
                                <input id="photo" type="file" name="photo" class="form-control">
                                <label for="photo">Foto Profil</label>
                            </div>

                        </div>

                    </div>
                </div>
                <div class="modal-footer">
                    <button id="btnUpdate" type="submit"
                            class="btn theme-bg-color btn-md fw-bold text-light">Update Profil
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Edit Profile End -->

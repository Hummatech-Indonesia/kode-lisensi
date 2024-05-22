<!-- latest js -->
<script src="{{ asset('dashboard_assets/js/jquery-3.6.0.min.js') }}"></script>

<!-- Bootstrap js -->
<script src="{{ asset('dashboard_assets/js/bootstrap/bootstrap.bundle.min.js') }}"></script>

<!-- feather icon js -->
<script src="{{ asset('dashboard_assets/js/icons/feather-icon/feather.min.js') }}"></script>
<script src="{{ asset('dashboard_assets/js/icons/feather-icon/feather-icon.js') }}"></script>

<!-- scrollbar simplebar js -->
<script src="{{ asset('dashboard_assets/js/scrollbar/simplebar.js') }}"></script>
<script src="{{ asset('dashboard_assets/js/scrollbar/custom.js') }}"></script>

<!-- Sidebar jquery -->
<script src="{{ asset('dashboard_assets/js/config.js') }}"></script>

<!-- Plugins JS -->
<script src="{{ asset('dashboard_assets/js/sidebar-menu.js') }}"></script>


<!-- slick slider js -->
<script src="{{ asset('dashboard_assets/js/slick.min.js') }}"></script>
<script src="{{ asset('dashboard_assets/js/custom-slick.js') }}"></script>

<!-- ratio js -->
<script src="{{ asset('dashboard_assets/js/ratio.js') }}"></script>

<!-- sidebar effect -->
<script src="{{ asset('dashboard_assets/js/sidebareffect.js') }}"></script>

<!-- Theme js -->
<script src="{{ asset('dashboard_assets/js/script.js') }}"></script>

<!-- select2 js -->
<script src="{{ asset('dashboard_assets/js/select2.min.js') }}"></script>
<script src="{{ asset('dashboard_assets/js/select2-custom.js') }}"></script>

<!-- ck editor js -->
<script src="{{ asset('dashboard_assets/js/ckeditor/ckeditor.js') }}"></script>
<script src="https://cdn.ckeditor.com/ckeditor5/41.4.2/classic/ckeditor.js"></script>

<!-- sweetalert js -->
<script src="{{ asset('dashboard_assets/js/sweetalert.min.js') }}"></script>

<script>

    $('.delete-sweetalert').on('click', function (e) {
        e.preventDefault();
        const form = $(this).closest("form");
        swal({
            title: "Apa Anda Yakin?",
            text: "Data yang dihapus tidak dapat dikembalikan",
            icon: "warning",
            buttons: {
                confirm: 'Hapus',
                cancel: 'Batal'
            },
            dangerMode: true,
        })
            .then((willDelete) => {
                if (willDelete) {
                    form.submit()
                }
            });
    });
</script>

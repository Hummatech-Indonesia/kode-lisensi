<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
@if (session('success'))
    <script>
        swal("Sukses!", "{{ session('success') }}", "success");
    </script>
@endif

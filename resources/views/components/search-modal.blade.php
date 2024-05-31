<!-- Modal -->
<div class="modal fade" id="searchModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" >
        <div class="modal-content">
            <form method="GET" action="{{ route('home.products.index') }}">
                @csrf
                    <div class="d-flex gap-2 align-items-center p-2">

                        <input value="{{ request()->input('search') ?? old('search') }}" name="search" type="search"
                        class="form-control" id="inputSearch" placeholder="Cari lisensi software.." autocomplete="off">
                        <button type="submit" class="btn btn-primary"><i class="iconly-Search icli"></i></button>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

                    </div>
            </form>

        </div>
    </div>
</div>

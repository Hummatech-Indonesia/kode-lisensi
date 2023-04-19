<input {{ $data->is_purchased == 1 ? 'readonly' : '' }} value="{{ $data->username ?? '' }}" class="form-control"
       type="text" autocomplete="off"
       name="username">

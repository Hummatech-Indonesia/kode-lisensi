<input {{ $data->is_purchased == 1 ? 'readonly' : '' }} value="{{ $data->serial_key ?? '' }}" class="form-control"
       type="text" autocomplete="off"
       name="serial_key">

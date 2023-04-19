<input {{ $data->is_purchased == 1 ? 'readonly' : '' }} value="{{ $data->password ?? '' }}" class="form-control"
       type="text" autocomplete="off" name="password">

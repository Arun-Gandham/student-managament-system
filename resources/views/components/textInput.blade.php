<div class="form-group <?php echo isset($required) && $required ? 'required' : ''?>">
    <label for="{{ $name }}">{{ $title }}</label>
    <input type="<?php echo isset($type) ? $type : 'text'; ?>" class="form-control" placeholder="{{ $title }}" name="{{ $name }}" id="{{ $name }}" value="<?php echo isset($value) ? $value : ''?>" <?php echo isset($required) && $required ? 'required' : ''; ?> <?php echo isset($disabled) && $disabled ? 'disabled' : ''; ?>>
    {{-- <div class="invalid-feedback">
        This fiels is required
    </div>
    <div class="valid-feedback">
        Looks Good!
    </div> --}}
</div>

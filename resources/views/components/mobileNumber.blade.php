<div class="form-group  <?php echo isset($required) && $required ? 'required' : ''?>">
    <label for="{{ $name }}">{{ $title }}</label>
    <input type="tel"class="form-control" placeholder="{{ $title }}" minlength="10" maxlength="10" id="{{ $name }}" name="{{ $name }}" pattern="[6-9]{1}[0-9]{9}" title="10 digit mobile number" <?php echo isset($required) && $required ? 'required' : ''?> value="<?php echo isset($value) ? $value : ''?>" <?php echo isset($disabled) && $disabled ? 'disabled' : ''; ?>>
</div>

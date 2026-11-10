{{-- Author: Oriana --}}
@error($field)
    <div class="invalid-feedback d-block fw-semibold" data-field-error="{{ $field }}">
        <i class="bi bi-exclamation-circle me-1"></i><span>{{ $message }}</span>
    </div>
@enderror
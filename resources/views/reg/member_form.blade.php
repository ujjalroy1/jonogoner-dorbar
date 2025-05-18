<div class="mb-3">
    <label class="form-label">Name</label>
    <input type="text" name="{{ $prefix }}_name" class="form-control" {{ $required ?? false ? 'required' : '' }}>
</div>

@if($prefix !== 'coach')
<div class="mb-3">
    <label class="form-label">ID</label>
    <input type="text" name="{{ $prefix }}_id" class="form-control" {{ $required ?? false ? 'required' : '' }}>
</div>
@endif

<div class="mb-3">
    <label class="form-label">Email</label>
    <input type="email" name="{{ $prefix }}_email" class="form-control" {{ $required ?? false ? 'required' : '' }}>
</div>

<div class="mb-3">
    <label class="form-label">Phone</label>
    <input type="text" name="{{ $prefix }}_phone" class="form-control" {{ $required ?? false ? 'required' : '' }}>
</div>

<div class="mb-3">
    <label class="form-label">T-Shirt Size</label>
    <select name="{{ $prefix }}_tshirt_size" class="form-control" {{ $required ?? false ? 'required' : '' }}>
        <option value=""></option>
        <option value="S">S</option>
        <option value="M">M</option>
        <option value="L">L</option>
        <option value="XL">XL</option>
        <option value="2XL">2XL</option>
        <option value="3XL">3XL</option>
    </select>
</div>
@php
    $locations = \App\Models\Personel::COMPANY_LOCATIONS;
    $selected = old('company_location', $value ?? '');
@endphp
<div class="form-group">
    <label for="company_location">Company Location</label>
    <select id="company_location" name="company_location" class="@error('company_location') is-invalid @enderror" required>
        <option value="">Select company location</option>
        @foreach ($locations as $location)
            <option value="{{ $location }}" {{ $selected === $location ? 'selected' : '' }}>{{ $location }}</option>
        @endforeach
    </select>
    @error('company_location')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

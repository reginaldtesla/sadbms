@extends('layouts.personnel')

@section('title', 'Add New Profile - Personnel')

@section('vite')
    @vite(['resources/css/add-profile.css', 'resources/js/profile-camera.js'])
@endsection

@section('content')
    <div class="form-box">
        <h1>{{ isset($profile) ? 'Update Profile' : 'Add New Profile' }}</h1>
        <p>
            @if (isset($profile))
                You already have a profile on file. Submitting this form will update your existing record.
            @else
                Fill in the details below to create your personnel profile.
            @endif
        </p>
        @if ($errors->has('email'))
            <div style="margin-bottom:1rem;padding:0.75rem;background:#fef2f2;border:1px solid #fecaca;border-radius:8px;color:#991b1b;">
                {{ $errors->first('email') }}
            </div>
        @endif
        <form method="POST" action="/create_post" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="photo_data" id="photoData">

                    <div class="form-group">
                        <label for="name">Full Name</label>
                        <input type="text" id="name" name="name" placeholder="e.g. Jane Doe" value="{{ old('name') }}" class="@error('name') is-invalid @enderror" />
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="age">Age</label>
                        <input type="number" id="age" name="age" placeholder="e.g. 28" value="{{ old('age') }}" class="@error('age') is-invalid @enderror" />
                        @error('age')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="gender">Gender</label>
                        <select id="gender" name="gender" class="@error('gender') is-invalid @enderror">
                            <option value="">Select gender</option>
                            <option value="female" @if(old('gender') == 'female') selected @endif>Female</option>
                            <option value="male" @if(old('gender') == 'male') selected @endif>Male</option>
                            <option value="other" @if(old('gender') == 'other') selected @endif>Other</option>
                        </select>
                        @error('gender')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="email">Email Address</label>
                        <input type="email" id="email" name="email" placeholder="e.g. jane@example.com" value="{{ old('email') }}" class="@error('email') is-invalid @enderror" />
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="phone">Phone Number</label>
                        <input type="tel" id="phone" name="phone" placeholder="e.g. +233 24 123 4567" value="{{ old('phone') }}" class="@error('phone') is-invalid @enderror" />
                        @error('phone')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="address">Address</label>
                        <input type="text" id="address" name="address" placeholder="e.g. 123 Main St, Accra" value="{{ old('address') }}" class="@error('address') is-invalid @enderror" />
                        @error('address')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="institution_name">Institution Name</label>
                        <input type="text" id="institution_name" name="institution_name" placeholder="e.g. University of Ghana" value="{{ old('institution_name') }}" class="@error('institution_name') is-invalid @enderror" />
                        @error('institution_name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    @include('partials.company-location-field', ['value' => old('company_location', isset($profile) ? $profile->company_location : '')])
                    <div class="form-group">
                        <label for="department">Department</label>
                        <select id="department" name="department" class="@error('department') is-invalid @enderror">
                            <option value="">Select department</option>
                            <option value="engineering" @if(old('department', $profile->department ?? '') == 'engineering') selected @endif>Engineering</option>
                            <option value="finance" @if(old('department') == 'finance') selected @endif>Finance</option>
                            <option value="hr" @if(old('department') == 'hr') selected @endif>Human Resources</option>
                            <option value="marketing" @if(old('department') == 'marketing') selected @endif>Marketing</option>
                            <option value="it" @if(old('department') == 'it') selected @endif>Information Technology</option>
                            <option value="sales" @if(old('department') == 'sales') selected @endif>Sales</option>
                            <option value="operations" @if(old('department') == 'operations') selected @endif>Operations</option>
                            <option value="admin" @if(old('department') == 'admin') selected @endif>Administration</option>
                            <option value="research" @if(old('department') == 'research') selected @endif>Research</option>
                            <option value="design" @if(old('department') == 'design') selected @endif>Design</option>
                            <option value="management" @if(old('department') == 'management') selected @endif>Management</option>
                            <option value="customer_service" @if(old('department') == 'customer_service') selected @endif>Customer Service</option>
                            <option value="legal" @if(old('department') == 'legal') selected @endif>Legal</option>
                            <option value="production" @if(old('department') == 'production') selected @endif>Production</option>
                            <option value="logistics" @if(old('department') == 'logistics') selected @endif>Logistics</option>
                            <option value="quality_assurance" @if(old('department') == 'quality_assurance') selected @endif>Quality Assurance</option>
                            <option value="consulting" @if(old('department') == 'consulting') selected @endif>Consulting</option>
                            <option value="education" @if(old('department') == 'education') selected @endif>Education</option>
                            <option value="healthcare" @if(old('department') == 'healthcare') selected @endif>Healthcare</option>
                            <option value="mis" @if(old('department') == 'mis') selected @endif>MIS</option>
                            <option value="other" @if(old('department') == 'other') selected @endif>Other</option>
                        </select>
                        @error('department')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="program">Program</label>
                        <input type="text" id="program" name="program" placeholder="e.g. Computer Engeneering" value="{{ old('program') }}" class="@error('program') is-invalid @enderror" />
                        @error('program')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="duration">Duration of Work</label>
                        <input type="text" id="duration" name="duration" placeholder="e.g. 2 years" value="{{ old('duration') }}" class="@error('duration') is-invalid @enderror" />
                        @error('duration')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="start_date">Start Date</label>
                        <input type="date" id="start_date" name="start_date" value="{{ old('start_date') }}" class="@error('start_date') is-invalid @enderror" />
                        @error('start_date')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="end_date">End Date</label>
                        <input type="date" id="end_date" name="end_date" value="{{ old('end_date') }}" class="@error('end_date') is-invalid @enderror" />
                         @error('end_date')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="bio">Short Bio</label>
                        <textarea id="bio" name="bio" rows="4" placeholder="Brief description or background" class="@error('bio') is-invalid @enderror">{{ old('bio') }}</textarea>
                        @error('bio')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="personnel_type">Personnel Type</label>
                        <select id="personnel_type" name="personnel_type" class="@error('personnel_type') is-invalid @enderror">
                            <option value="">Select type</option>
                            <option value="service" @if(old('personnel_type') == 'service') selected @endif>Service</option>
                            <option value="attachment" @if(old('personnel_type') == 'attachment') selected @endif>Attachment</option>
                        </select>
                        @error('personnel_type')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="supervision_name">Supervisor Name</label>
                        <input type="text" id="supervision_name" name="supervision_name" placeholder="e.g. Mr. Kofi Asare" value="{{ old('supervision_name') }}" class="@error('supervision_name') is-invalid @enderror" />
                        @error('supervision_name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                     <div class="form-group">
                        <label for="assigned_role">Role Assigned</label>
                        <input type="text" id="assigned_role" name="assigned_role" value="{{ old('assigned_role') }}" class="@error('assigned_role') is-invalid @enderror" />
                        @error('assigned_role')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="remarks">Remarks</label>
                        <input type="text" id="remarks" name="remarks" value="{{ old('remarks') }}" class="@error('remarks') is-invalid @enderror" />
                        @error('remarks')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="photo">Photo</label>
                        @if (isset($profile) && $profile->photo)
                            <div class="current-profile-photo-wrap">
                                <p class="current-profile-photo-label">Your current photo</p>
                                <img
                                    src="{{ asset('storage/' . $profile->photo) }}"
                                    alt="Current profile photo for {{ $profile->name }}"
                                    class="current-profile-photo"
                                    id="currentProfilePhoto"
                                />
                            </div>
                        @endif
                        <div style="display:flex;gap:1.25rem;align-items:flex-start;flex-wrap:wrap;">
                            <div style="display:flex;flex-direction:column;gap:6px;">
                                @include('partials.profile-camera')
                            </div>
                            <div>
                                <p class="profile-camera-file-hint">Or choose a file (mobile may open the camera):</p>
                                <input type="file" id="photoInput" name="photo" accept="image/*" capture="environment" class="@error('photo') is-invalid @enderror" />
                                @error('photo')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="submit-btn">
                      <span class="eye">
                        <span class="eyeball"></span>
                      </span>
                      Submit
                    </button>
                </form>
    </div>
@endsection


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <title>Add New Profile - Admin</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;700;900&amp;display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="/build/assets/css/add-profile.css" />
    <script src="/build/assets/js/addprofile.js" defer></script>
    <style>
        .is-invalid {
            border-color: #dc3545;
        }
        .invalid-feedback {
            color: #dc3545;
            font-size: 0.875em;
            margin-top: 0.25rem;
        }
    </style>
</head>

<body>
    <div class="page-container">
        <header class="header">
            <div class="logo">
                <svg viewBox="0 0 48 48" fill="currentColor">
                    <path
                        d="M8.578 8.578C5.528 11.628 3.451 15.514 2.609 19.745C1.768 23.976 2.2 28.361 3.851 32.346C5.501 36.331 8.297 39.738 11.883 42.134C15.47 44.531 19.687 45.81 24 45.81C28.314 45.81 32.53 44.531 36.117 42.134C39.703 39.738 42.499 36.331 44.149 32.346C45.8 28.361 46.232 23.976 45.391 19.745C44.549 15.514 42.472 11.628 39.422 8.578L24 24L8.578 8.578Z" />
                </svg>
                <h2>Admin Profile</h2>
            </div>
            <nav class="nav">
                <a href="{{ url('/personnel') }}" class="active">View Profile</a>
            </nav>
        </header>

        <main class="main">
            <div class="form-box">
                <h1>Add New Profile</h1>
                <p>Fill in the details below to create a new user profile.</p>
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
                    <div class="form-group">
                        <label for="department">Department</label>
                        <select id="department" name="department" class="@error('department') is-invalid @enderror">
                            <option value="">Select department</option>
                            <option value="engineering" @if(old('department') == 'engineering') selected @endif>Engineering</option>
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
                        <div style="display:flex;gap:8px;align-items:center;flex-wrap:wrap;">
                            <div style="display:flex;flex-direction:column;gap:6px;">
                                <video id="video" autoplay playsinline width="320" height="240" style="border:1px solid #ccc;"></video>
                                <canvas id="canvas" width="320" height="240" style="display:none;"></canvas>
                                <div>
                                    <button type="button" id="startCamera">Start Camera</button>
                                    <button type="button" id="captureBtn">Capture</button>
                                </div>
                            </div>
                            <div>
                                <p>Or choose file (mobile will offer camera):</p>
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
        </main>
    </div>
    <script>
        const startBtn = document.getElementById('startCamera');
        const video = document.getElementById('video');
        const captureBtn = document.getElementById('captureBtn');
        const canvas = document.getElementById('canvas');
        const photoInput = document.getElementById('photoInput');
        const photoDataInput = document.getElementById('photoData');
        let stream = null;

        startBtn.addEventListener('click', async () => {
            try {
                if (!navigator.mediaDevices || !navigator.mediaDevices.getUserMedia) {
                    alert('Camera access not supported on this browser or page must be served over HTTPS.\nPlease use the file input to select an image instead.');
                    return;
                }
                stream = await navigator.mediaDevices.getUserMedia({ video: { facingMode: 'environment' }, audio: false });
                video.srcObject = stream;
                startBtn.textContent = 'Stop Camera';
            } catch (err) {
                alert('Unable to access camera: ' + err.message + '\nMake sure the page is accessed over HTTPS or localhost.');
            }
        });

        captureBtn.addEventListener('click', () => {
            const ctx = canvas.getContext('2d');
            ctx.drawImage(video, 0, 0, canvas.width, canvas.height);
            const dataUrl = canvas.toDataURL('image/jpeg', 0.9);
            photoDataInput.value = dataUrl;
            // Clear file input if a photo is captured
            photoInput.value = '';
        });

        photoInput.addEventListener('change', () => {
            // Clear photo data if a file is selected
            photoDataInput.value = '';
        });
    </script>
</body>

</html>

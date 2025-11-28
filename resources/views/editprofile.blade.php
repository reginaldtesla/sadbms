<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <title>Edit Profile</title>
    <link rel="stylesheet" href="/build/assets/css/edit-profile.css" />
</head>
<body>
    <div class="page-container">
        <!-- Modal backdrop: centered modal for editing -->
        <div id="editModal" class="modal-backdrop" aria-hidden="false">
            <div class="modal-content-centered" role="dialog" aria-modal="true">
                <button class="modal-close" aria-label="Close" onclick="window.location.href='{{ url('/viewprofile') }}'">&times;</button>
                <div class="form-box">
                    <h1>Edit Profile</h1>
                    @if ($errors->any())
                        <div class="error-box" style="background:#fff6f6;border:1px solid #f5c6cb;padding:12px;border-radius:8px;margin-bottom:12px;color:#7b1f24;">
                            <strong>There were some problems with your input:</strong>
                            <ul style="margin:8px 0 0 16px;padding:0;">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    @if (session('status'))
                        <div class="status-box" style="background:#ecfdf5;border:1px solid #bbf7d0;padding:12px;border-radius:8px;margin-bottom:12px;color:#065f46;">{{ session('status') }}</div>
                    @endif
                    <form method="POST" action="{{ url('/editprofile') }}" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="id" value="{{ $profile->id }}" />

                        <div class="form-group">
                            <label for="name">Full Name</label>
                            <input type="text" id="name" name="name" value="{{ $profile->name }}" required />
                        </div>

                        <div class="form-group">
                            <label for="age">Age</label>
                            <input type="number" id="age" name="age" value="{{ $profile->age }}" required />
                        </div>

                        <div class="form-group">
                            <label for="gender">Gender</label>
                            <select id="gender" name="gender" required>
                                <option value="">Select gender</option>
                                <option value="female" {{ $profile->gender=='female' ? 'selected' : '' }}>Female</option>
                                <option value="male" {{ $profile->gender=='male' ? 'selected' : '' }}>Male</option>
                                <option value="other" {{ $profile->gender=='other' ? 'selected' : '' }}>Other</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="email">Email Address</label>
                            <input type="email" id="email" name="email" value="{{ $profile->email }}" required />
                        </div>

                        <div class="form-group">
                            <label for="phone">Phone Number</label>
                            <input type="tel" id="phone" name="phone" value="{{ $profile->phone }}" required />
                        </div>

                        <div class="form-group">
                            <label for="address">Address</label>
                            <input type="text" id="address" name="address" value="{{ $profile->address }}" required />
                        </div>

                        <div class="form-group">
                            <label for="department">Department</label>
                            <input type="text" id="department" name="department" value="{{ $profile->department }}" required />
                        </div>

                        <div class="form-group">
                            <label for="supervision_name">Supervision Name</label>
                            <input type="text" id="supervision_name" name="supervision_name" value="{{ $profile->supervision_name ?? '' }}" required />
                        </div>

                        <div class="form-group">
                            <label for="personnel_type">Personnel Type</label>
                            <select id="personnel_type" name="personnel_type" required>
                                <option value="service" {{ $profile->personnel_type=='service' ? 'selected' : '' }}>Service</option>
                                <option value="attachment" {{ $profile->personnel_type=='attachment' ? 'selected' : '' }}>Attachment</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="assigned_role">Assigned Role</label>
                            <input type="text" id="assigned_role" name="assigned_role" value="{{ $profile->assigned_role }}" />
                        </div>

                        <div class="form-group">
                            <label for="institution_name">Institution Name</label>
                            <input type="text" id="institution_name" name="institution_name" value="{{ $profile->institution_name }}" required />
                        </div>

                        <div class="form-group">
                            <label for="duration">Duration</label>
                            <input type="text" id="duration" name="duration" value="{{ $profile->duration }}" required />
                        </div>

                        <div class="form-group">
                            <label for="start_date">Start Date</label>
                            <input type="date" id="start_date" name="start_date" value="{{ $profile->start_date }}" required />
                        </div>

                        <div class="form-group">
                            <label for="end_date">End Date</label>
                            <input type="date" id="end_date" name="end_date" value="{{ $profile->end_date }}" required />
                        </div>

                        <div class="form-group">
                            <label for="bio">Bio</label>
                            <textarea id="bio" name="bio">{{ $profile->bio }}</textarea>
                        </div>

                        <div class="form-group">
                            <label for="remarks">Remarks</label>
                            <textarea id="remarks" name="remarks">{{ $profile->remarks }}</textarea>
                        </div>
                        <div class="form-group">
                            <label>Current Photo</label>
                            @if ($profile->photo)
                                <img src="{{ asset('storage/' . $profile->photo) }}" alt="{{ $profile->name }}" style="width:200px;height:200px;object-fit:cover;border-radius:8px;display:block;margin-bottom:8px;" />
                            @else
                                <div style="width:200px;height:200px;background:#f0f0f0;border-radius:8px;display:flex;align-items:center;justify-content:center;margin-bottom:8px;">No Photo</div>
                            @endif
                            <label for="photoInput">Replace Photo</label>
                            <div style="display:flex;gap:12px;flex-wrap:wrap;align-items:flex-start;">
                                <div style="display:flex;flex-direction:column;gap:6px;">
                                    <video id="video" autoplay playsinline width="320" height="240" style="border:1px solid #ccc;display:block;"></video>
                                    <canvas id="canvas" width="320" height="240" style="display:none;"></canvas>
                                    <div>
                                        <button type="button" id="startCamera">Start Camera</button>
                                        <button type="button" id="captureBtn">Capture</button>
                                    </div>
                                </div>
                                <div>
                                    <p>Or choose file (mobile may open camera):</p>
                                    <input type="file" id="photoInput" name="photo" accept="image/*" capture="environment" />
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="program">Program</label>
                            <input type="text" id="program" name="program" value="{{ $profile->program ?? '' }}" />
                        </div>
                        <div class="form-actions">
                            <button type="submit" class="save-btn">Save Changes</button>
                            <a href="{{ url('/viewprofile') }}" class="cancel-link">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
<script>
    // Close modal on Escape key
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            window.location.href = '{{ url('/viewprofile') }}';
        }
    });

    // Camera + capture handling for edit form
    (function(){
        const startBtn = document.getElementById('startCamera');
        const video = document.getElementById('video');
        const captureBtn = document.getElementById('captureBtn');
        const canvas = document.getElementById('canvas');
        const photoInput = document.getElementById('photoInput');
        const form = document.querySelector('form');
        let stream = null;
        let photoBlob = null;

        if (startBtn) {
            startBtn.addEventListener('click', async () => {
                try {
                    if (!navigator.mediaDevices || !navigator.mediaDevices.getUserMedia) {
                        alert('Camera not supported or page must be served over HTTPS. Use file input instead.');
                        return;
                    }
                    if (stream) {
                        // stop the stream
                        stream.getTracks().forEach(t => t.stop());
                        stream = null;
                        video.srcObject = null;
                        startBtn.textContent = 'Start Camera';
                        return;
                    }
                    stream = await navigator.mediaDevices.getUserMedia({ video: { facingMode: 'environment' }, audio: false });
                    video.srcObject = stream;
                    startBtn.textContent = 'Stop Camera';
                } catch (err) {
                    alert('Unable to access camera: ' + err.message + '\nMake sure you are on localhost or HTTPS.');
                }
            });
        }

        if (captureBtn) {
            captureBtn.addEventListener('click', () => {
                if (!video || !canvas) return;
                const ctx = canvas.getContext('2d');
                ctx.drawImage(video, 0, 0, canvas.width, canvas.height);
                canvas.toBlob((blob) => {
                    photoBlob = blob;
                }, 'image/jpeg', 0.9);
            });
        }

        if (form) {
            form.addEventListener('submit', async (e) => {
                if (!photoBlob) return; // let normal submit proceed when no captured blob
                e.preventDefault();
                const formData = new FormData(form);
                const file = new File([photoBlob], `personel_${Date.now()}.jpg`, { type: 'image/jpeg' });
                formData.set('photo', file);
                const token = document.querySelector('input[name="_token"]').value;
                const res = await fetch(form.action, {
                    method: 'POST',
                    headers: { 'X-CSRF-TOKEN': token },
                    body: formData
                });
                if (res.redirected) { window.location.href = res.url; return; }
                const text = await res.text(); document.open(); document.write(text); document.close();
            });
        }
    })();
</script>
</html>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <title>Add New Profile - Admin</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;700;900&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="/build/assets/css/add-profile.css" />
    <script src="/build/assets/js/addprofile.js" defer></script>
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
                <a href="{{ url('/dashboard') }}">Dashboard</a>
                <a href="{{ url('/viewprofile') }}" class="active">View Profile</a>
                <a href="{{ url('/removeprofile') }}">Remove Profile</a>
            </nav>
        </header>

        <main class="main">
            <div class="form-box">
                <h1>Add New Profile</h1>
                <p>Fill in the details below to create a new user profile.</p>
                <form method="POST" action="/create_post" enctype="multipart/form-data">
                    @csrf

                    <div class="form-group">
                        <label for="name">Full Name</label>
                        <input type="text" id="name" name="name" placeholder="e.g. Jane Doe" required />
                    </div>

                    <div class="form-group">
                        <label for="age">Age</label>
                        <input type="number" id="age" name="age" placeholder="e.g. 28" required />
                    </div>

                    <div class="form-group">
                        <label for="gender">Gender</label>
                        <select id="gender" name="gender" required>
                            <option value="">Select gender</option>
                            <option value="female">Female</option>
                            <option value="male">Male</option>
                            <option value="other">Other</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="email">Email Address</label>
                        <input type="email" id="email" name="email" placeholder="e.g. jane@example.com"
                            required />
                    </div>

                    <div class="form-group">
                        <label for="phone">Phone Number</label>
                        <input type="tel" id="phone" name="phone" placeholder="e.g. +233 24 123 4567"
                            required />
                    </div>

                    <div class="form-group">
                        <label for="address">Address</label>
                        <input type="text" id="address" name="address" placeholder="e.g. 123 Main St, Accra"
                            required />
                    </div>
                    <div class="form-group">
                        <label for="institution_name">Institution Name</label>
                        <input type="text" id="institution_name" name="institution_name" placeholder="e.g. University of Ghana" />
                    </div>
                    <div class="form-group">
                        <label for="department">Department</label>
                        <select id="department" name="department" required>
                            <option value="">Select department</option>
                            <!-- Populate dynamically from backend -->
                            <option value="engineering">Engineering</option>
                            <option value="finance">Finance</option>
                            <option value="hr">Human Resources</option>
                            <option value="marketing">Marketing</option>
                            <option value="it">Information Technology</option>
                            <option value="sales">Sales</option>
                            <option value="operations">Operations</option>
                            <option value="admin">Administration</option>
                            <option value="research">Research</option>
                            <option value="design">Design</option>
                            <option value="management">Management</option>
                            <option value="customer_service">Customer Service</option>
                            <option value="legal">Legal</option>
                            <option value="production">Production</option>
                            <option value="logistics">Logistics</option>
                            <option value="quality_assurance">Quality Assurance</option>
                            <option value="consulting">Consulting</option>
                            <option value="education">Education</option>
                            <option value="healthcare">Healthcare</option>
                            <option value="mis">MIS</option>
                            <option value="other">Other</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="program">Program</label>
                        <input type="text" id="program" name="program" placeholder="e.g. Computer Engeneering" />
                    </div>
                    <div class="form-group">
                        <label for="work">Occupation</label>
                        <input type="text" id="work" name="work" placeholder="e.g. Software Engineer"
                            required />
                    </div>

                    <div class="form-group">
                        <label for="duration">Duration of Work</label>
                        <input type="text" id="duration" name="duration" placeholder="e.g. 2 years" required />
                    </div>
                    <div class="form-group">
                        <label for="start_date">Start Date</label>
                        <input type="date" id="start_date" name="start_date" required />
                    </div>

                    <div class="form-group">
                        <label for="end_date">End Date</label>
                        <input type="date" id="end_date" name="end_date" />
                    </div>
                    <div class="form-group">
                        <label for="bio">Short Bio</label>
                        <textarea id="bio" name="bio" rows="4" placeholder="Brief description or background"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="personnel_type">Personnel Type</label>
                        <select id="personnel_type" name="personnel_type" required>
                            <option value="">Select type</option>
                            <option value="service">Service</option>
                            <option value="attachment">Attachment</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="supervision_name">Supervisor Name</label>
                        <input type="text" id="supervision_name" name="supervision_name" placeholder="e.g. Mr. Kofi Asare" />
                    </div>
                     <div class="form-group">
                        <label for="assigned_date">Role Assigned</label>
                        <input type="text" id="assigned_role" name="assigned_role" />
                    </div>
                    <div class="form-group">
                        <label for="assigned_date">Remarks</label>
                        <input type="text" id="remarks" name="remarks" />
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
                                <input type="file" id="photoInput" name="photo" accept="image/*" capture="environment" />
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
        let stream = null;
        let photoBlob = null;

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
            canvas.toBlob((blob) => {
                photoBlob = blob;
                // show a small preview by opening in new tab (optional)
                // const url = URL.createObjectURL(blob); window.open(url);
            }, 'image/jpeg', 0.9);
        });

        const form = document.querySelector('form');
        form.addEventListener('submit', async (e) => {
            e.preventDefault();
            const formData = new FormData(form);
            // if we captured a photo with the camera, append it as a file
            if (photoBlob) {
                const file = new File([photoBlob], `personel_${Date.now()}.jpg`, { type: 'image/jpeg' });
                formData.set('photo', file);
            }

            const token = document.querySelector('input[name="_token"]').value;
            const res = await fetch(form.action, {
                method: 'POST',
                headers: { 'X-CSRF-TOKEN': token },
                body: formData
            });

            if (res.redirected) {
                window.location.href = res.url;
                return;
            }

            const text = await res.text();
            document.open(); document.write(text); document.close();
        });
    </script>
</body>

</html>

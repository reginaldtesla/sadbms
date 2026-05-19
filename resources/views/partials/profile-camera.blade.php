<div class="profile-camera">
    <video id="video" class="profile-camera-video" autoplay playsinline muted width="320" height="240"></video>
    <img id="capturePreview" class="capture-preview" alt="Captured photo preview" hidden />
    <canvas id="canvas" class="profile-camera-canvas" width="320" height="240" aria-hidden="true"></canvas>
    <p id="captureStatus" class="capture-status" role="status" aria-live="polite"></p>
    <div class="profile-camera-actions">
        <button type="button" id="startCamera" class="profile-camera-btn">Start Camera</button>
        <button type="button" id="captureBtn" class="profile-camera-btn profile-camera-btn--capture">Capture</button>
    </div>
</div>

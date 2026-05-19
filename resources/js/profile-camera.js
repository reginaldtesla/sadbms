/**
 * Webcam capture for add/edit profile forms.
 * Expects: #video, #canvas, #startCamera, #captureBtn, #photoData, #photoInput (optional)
 */
document.addEventListener('DOMContentLoaded', () => {
    const startBtn = document.getElementById('startCamera');
    const video = document.getElementById('video');
    const captureBtn = document.getElementById('captureBtn');
    const canvas = document.getElementById('canvas');
    const photoInput = document.getElementById('photoInput');
    const photoDataInput = document.getElementById('photoData');
    const statusEl = document.getElementById('captureStatus');

    if (!startBtn || !video || !captureBtn || !canvas) {
        return;
    }

    let stream = null;
    let previewImg = document.getElementById('capturePreview');

    if (!previewImg) {
        previewImg = document.createElement('img');
        previewImg.id = 'capturePreview';
        previewImg.className = 'capture-preview';
        previewImg.alt = 'Captured photo preview';
        previewImg.hidden = true;
        video.insertAdjacentElement('afterend', previewImg);
    }

    function setStatus(message, isError = false) {
        if (!statusEl) {
            return;
        }
        statusEl.textContent = message;
        statusEl.classList.toggle('capture-status--error', isError);
    }

    function stopStream() {
        if (stream) {
            stream.getTracks().forEach((track) => track.stop());
            stream = null;
        }
        video.srcObject = null;
    }

    async function getVideoStream() {
        const attempts = [
            { video: { facingMode: { ideal: 'environment' } }, audio: false },
            { video: { facingMode: 'user' }, audio: false },
            { video: true, audio: false },
        ];

        let lastError = null;
        for (const constraints of attempts) {
            try {
                return await navigator.mediaDevices.getUserMedia(constraints);
            } catch (err) {
                lastError = err;
            }
        }

        throw lastError || new Error('Could not access the camera.');
    }

    startBtn.addEventListener('click', async () => {
        if (stream) {
            stopStream();
            startBtn.textContent = 'Start Camera';
            setStatus('Camera stopped.');
            return;
        }

        try {
            if (!navigator.mediaDevices?.getUserMedia) {
                alert(
                    'Camera is not available in this browser, or the page must be served over HTTPS.\nUse "Choose file" to upload a photo instead.'
                );
                return;
            }

            stream = await getVideoStream();
            video.srcObject = stream;
            video.muted = true;
            await video.play();

            startBtn.textContent = 'Stop Camera';
            setStatus('Camera is on. Position yourself and click Capture.');
        } catch (err) {
            stopStream();
            startBtn.textContent = 'Start Camera';
            alert(
                'Unable to access the camera: ' +
                    err.message +
                    '\nTry "Choose file" instead, or allow camera permission for this site.'
            );
            setStatus('Could not start the camera.', true);
        }
    });

    captureBtn.addEventListener('click', () => {
        if (!stream) {
            alert('Click "Start Camera" first and wait for the live preview to appear.');
            setStatus('Start the camera before capturing.', true);
            return;
        }

        if (video.readyState < 2) {
            alert('The camera is still loading. Wait a moment, then try Capture again.');
            return;
        }

        const width = video.videoWidth;
        const height = video.videoHeight;

        if (!width || !height) {
            alert('The camera preview has no picture yet. Wait a second and try again.');
            return;
        }

        canvas.width = width;
        canvas.height = height;

        const ctx = canvas.getContext('2d');
        ctx.drawImage(video, 0, 0, width, height);

        const dataUrl = canvas.toDataURL('image/jpeg', 0.9);

        if (photoDataInput) {
            photoDataInput.value = dataUrl;
        }

        if (photoInput) {
            photoInput.value = '';
        }

        previewImg.src = dataUrl;
        previewImg.hidden = false;
        setStatus('Photo captured! Submit the form to save it, or capture again to replace.');
    });

    if (photoInput) {
        photoInput.addEventListener('change', () => {
            if (photoInput.files?.length && photoDataInput) {
                photoDataInput.value = '';
            }
            if (photoInput.files?.length) {
                previewImg.hidden = true;
                setStatus('File selected. Submit the form to upload it.');
            }
        });
    }
});

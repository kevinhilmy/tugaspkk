const dot = document.getElementById('trackerDot');
const status = document.getElementById('trackerStatus');

if (dot && status) {
  let progress = 0;
  const timer = setInterval(() => {
    progress += 10;
    dot.style.left = `calc(${progress}% - 12px)`;
    status.textContent = `Moving... ${progress}%`;

    if (progress >= 100) {
      status.textContent = 'Arrived at destination';
      clearInterval(timer);
    }
  }, 1000);
}

const text = document.getElementById('animated');
let waveHeight = 0;
let waveSpeed = 0.1;
let waveAmplitude = 10;
let angle = 0;

function animateText() {
  angle += waveSpeed;
  waveHeight = Math.sin(angle) * waveAmplitude;
  text.style.transform = `translateY(${waveHeight}px)`;
  requestAnimationFrame(animateText);
}

animateText();
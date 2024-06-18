window.addEventListener("load", function (){
const video = document.getElementById('myVideo');
const playBtn = document.getElementById('playBtn');
const pauseBtn = document.getElementById('pauseBtn');
const muteBtn = document.getElementById('muteBtn');
const volumeRange = document.getElementById('volumeRange');
const seekRange = document.getElementById('seekRange');
const currentTime = document.getElementById('currentTime');
const duration = document.getElementById('duration');

playBtn.addEventListener('click', () => {
	video.play();
});

pauseBtn.addEventListener('click', () => {
	video.pause();
});

muteBtn.addEventListener('click', () => {
	if (video.muted) {
		video.muted = false;
		muteBtn.innerHTML = 'Mute';
	} else {
		video.muted = true;
		muteBtn.innerHTML = 'Unmute';
	}
});

volumeRange.addEventListener('input', () => {
	video.volume = volumeRange.value;
});

seekRange.addEventListener('input', () => {
	const time = video.duration * (seekRange.value / 100);
	video.currentTime = time;
});

video.addEventListener('timeupdate', () => {
	const time = video.currentTime * (100 / video.duration);
	seekRange.value = time;

	let minutes = Math.floor(video.currentTime / 60);
	let seconds = Math.floor(video.currentTime - minutes * 60);
	let durationMinutes = Math.floor(video.duration / 60);
	let durationSeconds = Math.floor(video.duration - durationMinutes * 60);

    duration.innerHTML = `${durationMinutes}:${durationSeconds < 10 ? '0' + durationSeconds : durationSeconds}`;
    currentTime.innerHTML = `${minutes}:${seconds < 10 ? '0' + seconds : seconds}`;
    });

    
    })
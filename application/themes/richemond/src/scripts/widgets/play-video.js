export default function playVideo(button, video) {

    if (!video) return;

    let isVideoPlaying = false;

    update(isVideoPlaying);

    button.addEventListener('click', () => update(!isVideoPlaying));

    video.addEventListener('ended', () => {
        update(false);
    });

    function update(newIsVideoPlaying) {
        isVideoPlaying = newIsVideoPlaying;
        $(button).toggleClass('icon-playback-play', !newIsVideoPlaying);
        $(button).toggleClass('icon-playback-pause', newIsVideoPlaying);
        video.style.opacity = +isVideoPlaying;
        if (!isVideoPlaying) {
            video.pause();
        } else {
             video.play();
        }
    }
}
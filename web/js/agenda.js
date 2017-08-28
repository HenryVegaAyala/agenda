const fullscreen;
fullscreen = function (e) {
    if (e.webkitRequestFullScreen) {
        e.webkitRequestFullScreen();
    } else if (e.mozRequestFullScreen) {
        e.mozRequestFullScreen();
    }
}
document.getElementById('ejemplo-fullscreen').onclick = function () {
    fullscreen(document.getElementById('content'));
}
var wsArchive = document.getElementsByClassName("ws_post_column");
var wsPosts = [];
var currentPlaying = '';

Array.prototype.forEach.call(wsArchive, function(column) {
    Array.prototype.forEach.call(column.children, function(el) {
        if (el.id.startsWith("waveform-")) {
            var ws_post_el = document.getElementById(el.id);
            wsPosts[el.id] = WaveSurfer.create({
                container: '#' + el.id,
                waveColor: ws_post_el.getAttribute("wave-color"),
                progressColor: ws_post_el.getAttribute("progress-color"),
                cursorColor: ws_post_el.getAttribute("cursor-color")
            });
            wsPosts[el.id].load(ws_post_el.getAttribute("file-url"));
        }
    });
});

function playStop(id) {
    if (currentPlaying == id && wsPosts[id].isPlaying()) {
        wsPosts[id].pause();
        currentPlaying = '';
    } else if (currentPlaying != id && currentPlaying != '') {
        wsPosts[currentPlaying].pause();
        wsPosts[id].play();
        currentPlaying = id;
    } else {
        wsPosts[id].play();
        currentPlaying = id;
    }
}
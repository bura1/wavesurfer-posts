var wsArchive = document.getElementById("wavesurfer-posts").children;
var wsPosts = [];
var currentPlaying = '';

for (var i = 0; i < wsArchive.length; i++) {
    if (wsArchive[i].id.startsWith("waveform-")) {
        var ws_post_el = document.getElementById(wsArchive[i].id);
        wsPosts[wsArchive[i].id] = WaveSurfer.create({
            container: '#' + wsArchive[i].id,
            waveColor: ws_post_el.getAttribute("wave-color"),
            progressColor: ws_post_el.getAttribute("progress-color"),
            cursorColor: ws_post_el.getAttribute("cursor-color")
        });
        wsPosts[wsArchive[i].id].load(ws_post_el.getAttribute("file-url"));
    }
}

function playStop(id) {
    if (currentPlaying == id) {
        wsPosts[id].pause();
    } else if (currentPlaying != id && currentPlaying != '') {
        wsPosts[currentPlaying].pause();
        wsPosts[id].play();
        currentPlaying = id;
    } else {
        wsPosts[id].play();
        currentPlaying = id;
    }
}
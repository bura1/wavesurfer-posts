var wsArchive = document.getElementById("wavesurfer-posts").children;
var wsPosts = [];
var currentPlaying = '';

for (var i = 0; i < wsArchive.length; i++) {
    if (wsArchive[i].id.startsWith("waveform-")) {
        wsPosts[wsArchive[i].id] = WaveSurfer.create({
            container: '#' + wsArchive[i].id
        });
        wsPosts[wsArchive[i].id].load(document.getElementById(wsArchive[i].id).getAttribute("file-url"));
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
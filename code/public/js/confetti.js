window.addEventListener('load', function () {
    let content = document.getElementById("productOverviewPage");
    if (content != null) {
        var end = Date.now() + 10000;
        var blink_speed = 100; // every 1000 == 1 second, adjust to suit
        if (Date.now() % 10 == 0) {
            var t = setInterval(function () {
                var ele = document.getElementById('myBlinkingDiv');
                ele.style.visibility = (ele.style.visibility == 'hidden' ? '' : 'hidden');
            }, blink_speed);
            let content = document.getElementById("productOverviewPage");
            content.innerHTML = "<div id=\"myBlinkingDiv\">DU bist der Millionste besucher!!!!</div>";
            (function frame() {
                // launch a few confetti from the left edge
                confetti({
                    particleCount: 7,
                    angle: 60,
                    spread: 55,
                    origin: { x: 0 }
                });
                // and launch a few from the right edge
                confetti({
                    particleCount: 7,
                    angle: 120,
                    spread: 55,
                    origin: { x: 1 }
                });
                // keep going until we are out of time
                if (Date.now() < end) {
                    requestAnimationFrame(frame);
                }
            }());
        }
    }
});

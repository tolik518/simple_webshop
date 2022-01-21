// https://stackoverflow.com/a/36994802/15139141
// https://stackoverflow.com/a/36994802/15139141
var details = document.querySelectorAll("details");
// Add the onclick listeners.
details.forEach(function (targetDetail) {
    targetDetail.addEventListener("click", function () {
        // Close all the details that are not targetDetail.
        details.forEach(function (detail) {
            if (detail !== targetDetail) {
                detail.removeAttribute("open");
            }
        });
    });
});

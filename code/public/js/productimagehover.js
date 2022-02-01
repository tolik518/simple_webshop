var productimages = document.getElementsByClassName("productimageSmallWrapper");
var actualProductimageMain = document.getElementById("actualProductimageMain");
var originalImage = actualProductimageMain.src;
var _loop_1 = function (i) {
    productimages[i].addEventListener("mouseover", function () {
        return actualProductimageMain.src = productimages[i].childNodes[0].src;
    });
    productimages[i].addEventListener("mouseout", function () {
        return actualProductimageMain.src = originalImage;
    });
};
for (var i = 0; i < productimages.length; i++) {
    _loop_1(i);
}

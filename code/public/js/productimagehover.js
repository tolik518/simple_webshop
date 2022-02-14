let productimages = document.getElementsByClassName("productimageSmallWrapper");
let actualProductimageMain = document.getElementById("actualProductimageMain");
let originalImage = actualProductimageMain.src;
for (let i = 0; i < productimages.length; i++) {
    productimages[i].addEventListener("mouseover", () => actualProductimageMain.src = productimages[i].childNodes[0].src);
    productimages[i].addEventListener("mouseout", () => actualProductimageMain.src = originalImage);
}

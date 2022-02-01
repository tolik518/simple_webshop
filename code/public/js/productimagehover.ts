let productimages: HTMLCollectionOf<Element> = document.getElementsByClassName("productimageSmallWrapper");
let actualProductimageMain = <HTMLImageElement> document.getElementById("actualProductimageMain");

let originalImage: string = actualProductimageMain.src;

for(let i = 0; i < productimages.length; i++){
    productimages[i].addEventListener("mouseover", () =>
        actualProductimageMain.src = (productimages[i].childNodes[0] as HTMLImageElement).src);

    productimages[i].addEventListener("mouseout", () =>
        actualProductimageMain.src = originalImage);
}
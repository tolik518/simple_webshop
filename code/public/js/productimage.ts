let productimageMain           = <HTMLInputElement>document.getElementById("productimageMain");
let productimageMainDisplay    = <HTMLImageElement>document.getElementById("productimageMainDisplay");

//filesizecheck
productimageMain.addEventListener("change", function()
{
    let file: File = productimageMain.files[0];

    if (file){
        if (file.size < 1999999){
            var imageURL = URL.createObjectURL(file);
            productimageMainDisplay.src = imageURL;
        } else {
            productimageMainDisplay.src = "/assets/img/product/0_0.png";
            alert("Die gewählte Datei ist zu groß");
        }
    }
});
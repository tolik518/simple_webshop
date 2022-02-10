declare var google: any;
// Initialize and add the map
function initMap(): void {

    const berlin = { lat: 52.48462680435552, lng: 13.393109225761702 };
    // The map, centered at berlin
    const map = new google.maps.Map(
        //console.log(map);
        document.getElementById("map") as HTMLElement,
        {
            zoom: 15,
            center: berlin,
            disableDefaultUI: true,
        }
    );

    // The marker, positioned at berlin
    const marker = new google.maps.Marker({
        position: berlin,
        map: map,
    });
}
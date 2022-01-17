// Initialize and add the map
function initMap() {
    // The location of berlin
    var berlin = { lat: 52.518, lng: 13.1944 };
    // The map, centered at berlin
    // @ts-ignore
    var map = new google.maps.Map(document.getElementById("map"), {
        zoom: 15,
        center: berlin,
        disableDefaultUI: true,
    });
    // The marker, positioned at berlin
    // @ts-ignore
    var marker = new google.maps.Marker({
        position: berlin,
        map: map,
    });
}

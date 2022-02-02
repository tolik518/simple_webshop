"use strict";
// Initialize and add the map
function initMap() {
    // The location of berlin
    const berlin = { lat: 52.518, lng: 13.1944 };
    // The map, centered at berlin
    const map = new google.maps.Map(document.getElementById("map"), {
        zoom: 15,
        center: berlin,
        disableDefaultUI: true,
    });
    // The marker, positioned at berlin
    const marker = new google.maps.Marker({
        position: berlin,
        map: map,
    });
}

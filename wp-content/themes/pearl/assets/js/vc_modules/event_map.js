'use strict';

(function ($) {
    document.body.addEventListener("stm_gmap_api_loaded", initMap, false);

    var map = '';
    var latlng = '';

    function initMap(e) {
        var lat = parseFloat(pearl_event_map.lat);
        var lng = parseFloat(pearl_event_map.lng);
        var pin_color = parseFloat(pearl_event_map.pin);
        latlng = new google.maps.LatLng(lat, lng);

        var markerImage = 'data:image/svg+xml;utf-8, \<svg width="60" version="1.1" x="0px" y="0px" viewBox="-292.5 22.7 47.5 47.5" enable-background="new -292.5 22.7 47.5 47.5" xml:space="preserve"> <g> <path fill="#74C000" d="M-268.8,22.7c-13.1,0-23.8,10.6-23.8,23.8s10.6,23.8,23.8,23.8c13.1,0,23.8-10.6,23.8-23.8 S-255.6,22.7-268.8,22.7z M-262.4,49.2l-6,8.7l-6-8.7c-2.2-3-1.9-8,0.7-10.6c1.4-1.4,3.3-2.2,5.3-2.2c2,0,3.9,0.8,5.3,2.2 C-260.5,41.2-260.2,46.2-262.4,49.2z"/> <path fill="#74C000" d="M-268.3,41.1c-1.5,0-2.7,1.2-2.7,2.8c0,1.5,1.2,2.8,2.7,2.8c1.5,0,2.7-1.2,2.7-2.8 C-265.6,42.3-266.8,41.1-268.3,41.1z"/> </g> </svg>';

        var place = { lat: lat, lng: lng };

        map = new google.maps.Map(document.getElementById('gmap'), {
            zoom: 16,
            scrollwheel: false,
            center: place
        });

        console.log('wtf');

        var marker = new google.maps.Marker({
            position: place,
            map: map,
            icon: {
                url: 'data:image/svg+xml;utf-8, \
      <svg height="60px" width="60px" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="-292.5 22.7 47.5 47.5" \enable-background="new -292.5 22.7 47.5 47.5" xml:space="preserve"> \
                        <path fill="' + pin_color + '" d="M-268.8,22.7c-13.1,0-23.8,10.6-23.8,23.8s10.6,23.8,23.8,23.8c13.1,0,23.8-10.6,23.8-23.8 S-255.6,22.7-268.8,22.7z M-262.4,49.2l-6,8.7l-6-8.7c-2.2-3-1.9-8,0.7-10.6c1.4-1.4,3.3-2.2,5.3-2.2c2,0,3.9,0.8,5.3,2.2 C-260.5,41.2-260.2,46.2-262.4,49.2z"/> \
                    <path fill="' + pin_color + '" d="M-268.3,41.1c-1.5,0-2.7,1.2-2.7,2.8c0,1.5,1.2,2.8,2.7,2.8c1.5,0,2.7-1.2,2.7-2.8 C-265.6,42.3-266.8,41.1-268.3,41.1z"/> \
                    </svg>'
            }
        });
    }
})(jQuery);
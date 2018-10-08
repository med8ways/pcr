import mapStyles from './google-maps-styles.json';

document.addEventListener('DOMContentLoaded', () => {

    const element = document.getElementById('map');

    if ($(element).length) {

    // add script

        const script = document.createElement('script');
        script.defer = true;
        script.src = `https://maps.googleapis.com/maps/api/js?key=AIzaSyATCXAE4rgOg3m0Au1RMSKpsqr92vGCMrI&callback=initMap`;
        document.body.appendChild(script);

    // process every map element, with its markers, infowindows etc.
        window.initMap = () => {

            const mapData = $(element).data();

            const map = new google.maps.Map(element, {
                zoom: mapData.zoom,
                center: {
                    lat: mapData.lat,
                    lng: mapData.lng,
                },
                scrollwheel: false,
                disableDefaultUI: true
            });

            new google.maps.Marker({
                position: {lat: mapData.markerlat, lng: mapData.markerlng},
                map: map,
                icon: mapData.markericon

            });
            const styledMapType = new google.maps.StyledMapType(mapStyles);
            //
            map.mapTypes.set('styled_map', styledMapType);
            map.setMapTypeId('styled_map');

        };
    }

});


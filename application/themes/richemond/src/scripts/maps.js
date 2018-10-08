import mapStyles from './map-styles.json';

/**
 * Usage:
 *
 * HTML:
 * <div class='map' data-lat='47.085' data-lng='6.48' data-zoom='17' [data-marker-lat='' data-marker-lng=''] data-marker-icon=''></div>
 *
 * @import maps from './maps';
 * maps({ document.querySelectorAll('.map'), API_KEY })
 *
 * @param maps - NodeList of elements where map should be placed. Each element can have his own (data-lat, data-marker-lat) attributes
 * @param key - Google Maps Javascript API key
 */
export default function ({ maps, key }) {

    if (!maps.length) {
        return;
    }

    window.initMap = function() {
        Array.from(maps).forEach(el => {
            const { lat, lng, zoom, markerLat, markerLng, markerIcon } = $(el).data()
                , map = new google.maps.Map(el, {
                zoom: zoom,
                center: {
                    lat: !markerLat ? lat : window.innerWidth > 1023 ? lat : markerLat,
                    lng: !markerLng ? lng : window.innerWidth > 1023 ? lng : markerLng
                },
                scrollwheel: false
            })
                , marker = new google.maps.Marker({
                position: { lat: markerLat || lat, lng: markerLng || lng },
                map: map,
                icon: markerIcon
                })
                , styledMapType = new google.maps.StyledMapType(mapStyles);

            map.mapTypes.set('styled_map', styledMapType);
            map.setMapTypeId('styled_map');
        })
    };

    const script = document.createElement('script');
    script.defer = true;
    script.src = `https://maps.googleapis.com/maps/api/js?key=${key}&callback=initMap`;
    document.body.appendChild(script);
}
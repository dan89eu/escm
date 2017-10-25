$(function () {


    var map5 = new GMaps({
        div: "#gmap",
        lat: 44.4267674,
        lng: 26.1025383,
        zoom: 15,
        zoomControl : true,
        zoomControlOpt: {
            style : "SMALL",
            position: "TOP_LEFT"
        },
        panControl : true,
        streetViewControl : false,
        mapTypeControl: false,
        overviewMapControl: false
    });
    var styles = [
        {
            stylers: [
                { hue: "#00ffe6" },
                { saturation: -20 }
            ]
        }, {
            featureType: "road",
            elementType: "geometry",
            stylers: [
                { lightness: 100 },
                { visibility: "simplified" }
            ]
        }, {
            featureType: "road",
            elementType: "labels",
            stylers: [
                { visibility: "off" }
            ]
        }
    ];
    map5.addStyle({
        styles: styles,
        mapTypeId: "maps_style"
    });

    map5.setStyle("maps_style");

    //var x = map5.addControl({id:"pac-input-div",position:"TOP_LEFT",content:'<input id="pac-input-1" class="controls" type="text" placeholder="Enter a location">'});

	//console.log(x);
	console.log($('#pac-input'));

	var input = $('#pac-input').get(0);
	console.log(input);

	var autocomplete = new google.maps.places.Autocomplete(input);
	autocomplete.bindTo('bounds', map5.map);

	map5.map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);

	autocomplete.addListener('place_changed', function() {
		var place = autocomplete.getPlace();
		if (!place.geometry) {
			return;
		}

		if (place.types[0]!='locality'){
			return;
		}

		map5.removeMarkers();

		map5.addMarker({
			lat:place.geometry.location.lat(),
			lng:place.geometry.location.lng(),
			title:place.formatted_address,
			icon:{
				url:place.icon,
				size: new google.maps.Size(71, 71),
				origin: new google.maps.Point(0, 0),
				anchor: new google.maps.Point(17, 34),
				scaledSize: new google.maps.Size(25, 25)
			}
		})

		if (place.geometry.viewport) {
			map5.map.fitBounds(place.geometry.viewport);
		} else {
			map5.map.setCenter(place.geometry.location);
			map5.map.setZoom(17);
		}

		$("#g_place_id").val(place.place_id)
		$("#g_locality_name").val(findTypes(place.address_components,"locality"))
		$("#g_county_name").val(findTypes(place.address_components,"administrative_area_level_1"))
		$("#g_country_name").val(findTypes(place.address_components,"country"))
		$("#g_formatted_address").val(place.formatted_address)
		$("#g_lat").val(place.geometry.location.lat())
		$("#g_lng").val(place.geometry.location.lng())
		console.log(place);
		console.log(place.geometry.location.lat(),place.geometry.location.lng());
	});

	function findTypes(address_components, types){
		for (var i = 0; i < address_components.length; i++){
			var component = address_components[i];
			if(component.types[0] == types)
				return component.short_name
		}
	}
	var geocoder = new google.maps.Geocoder;
	function geocodePlaceId(placeid) {
		geocoder.geocode({'placeId': placeid}, function (results, status) {
			if (status === 'OK') {

				var place = results[0];

				console.log(place);

				$('#pac-input').val(place.formatted_address);

				if (!place.geometry) {
					return;
				}

				if (place.types[0]!='locality'){
					return;
				}

				map5.addMarker({
					lat:place.geometry.location.lat(),
					lng:place.geometry.location.lng(),
					title:place.formatted_address,
				})

				if (place.geometry.viewport) {
					map5.map.fitBounds(place.geometry.viewport);
				} else {
					map5.map.setCenter(place.geometry.location);
					map5.map.setZoom(17);
				}

			} else {
				window.alert('Geocoder failed due to: ' + status);
			}
		});
	}

	console.log($('#g_place_id').val().length);

	if($('#g_place_id').val().length>1)
		geocodePlaceId($('#g_place_id').val());


    //map5.map



});
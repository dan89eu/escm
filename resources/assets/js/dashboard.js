
// top menu

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

var bounds = []

$.each(locations,function(key,val){
	map5.addMarker({
		lat: val.lat,
		lng: val.lng,
		title:val.formatted_address
	})
	bounds.push(new google.maps.LatLng(val.lat,val.lng));
});
map5.fitLatLngBounds(bounds);



var useOnComplete = false,
    useEasing = false,
    useGrouping = false,
    options = {
        useEasing: useEasing, // toggle easing
        useGrouping: useGrouping, // 1,000,000 vs 1000000
        separator: ',', // character to use as a separator
        decimal: '.' // character to use as a decimal
    };

var demo = new CountUp("myTargetElement1", 12.52, 9500, 0, 6, options);
demo.start();
var demo = new CountUp("myTargetElement2", 1, 100, 0, 6, options);
demo.start();
var demo = new CountUp("myTargetElement3", 24.02, 5000, 0, 6, options);
demo.start();
var demo = new CountUp("myTargetElement4", 1254, 8000, 0, 6, options);
demo.start();
var demo = new CountUp("myTargetElement1.1", 1254, 98000, 0, 6, options);
demo.start();
var demo = new CountUp("myTargetElement1.2", 1254, 396000, 0, 6, options);
demo.start();
var demo = new CountUp("myTargetElement2.1", 154, 920, 0, 6, options);
demo.start();
var demo = new CountUp("myTargetElement2.2", 2582, 3929, 0, 6, options);
demo.start();
var demo = new CountUp("myTargetElement3.1", 2582, 42000, 0, 6, options);
demo.start();
var demo = new CountUp("myTargetElement3.2", 25858, 173929, 0, 6, options);
demo.start();
var demo = new CountUp("myTargetElement4.1", 2544, 56000, 0, 6, options);
demo.start();
var demo = new CountUp("myTargetElement4.2", 1584, 219864, 0, 6, options);
demo.start();
var my_posts = $("[rel=tooltip]");

var size = $(window).width();
for (i = 0; i < my_posts.length; i++) {
    the_post = $(my_posts[i]);

    if (the_post.hasClass('invert') && size >= 767) {
        the_post.tooltip({
            placement: 'left'
        });
        the_post.css("cursor", "pointer");
    } else {
        the_post.tooltip({
            placement: 'right'
        });
        the_post.css("cursor", "pointer");
    }
}
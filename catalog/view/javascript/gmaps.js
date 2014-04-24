var geocoder;
var map;
// initialise the google maps objects, and add listeners
function gmaps_init(){
// center of the universe
  var latlng = new google.maps.LatLng(51.751724,-1.255284);

  var options = {
    zoom: 15,
    center: latlng,
    mapTypeId: google.maps.MapTypeId.ROADMAP
  };
  map = new google.maps.Map(document.getElementById("gmaps-canvas"), options);
  // the geocoder object allows us to do latlng lookup based on address
  geocoder = new google.maps.Geocoder();
}

// fill in the UI elements with new position data
function update_ui( address, latLng ) {
  $('#gmaps-input-address').autocomplete("close");
  $('#gmaps-input-address').val(address);
  //$('#gmaps-output-latitude').html(latLng.lat());
  //$('#gmaps-output-longitude').html(latLng.lng());
}

// initialise the jqueryUI autocomplete element
function autocomplete_init() {
  $("#gmaps-input-address").autocomplete({

    // source is the list of input options shown in the autocomplete dropdown.
    // see documentation: http://jqueryui.com/demos/autocomplete/
    source: function(request,response) {

      // the geocode method takes an address or LatLng to search for
      // and a callback function which should process the results into
      // a format accepted by jqueryUI autocomplete
      geocoder.geocode( {'address': request.term }, function(results, status) {
    	if (results && status && status == 'OK') {
	        response($.map(results, function(item) {
	          return {
	            label: item.formatted_address, // appears in dropdown box
	            value: item.formatted_address, // inserted into input element when selected
	            geocode: item                  // all geocode data: used in select callback event
	          }
	        }));
    	}
      })
    },

      // event triggered when drop-down option selected
    select: function(event,ui){
      update_ui(  ui.item.value, ui.item.geocode.geometry.location );
    }
  });

  // triggered when user presses a key in the address box
  $("#gmaps-input-address").bind('keydown', function(event) {
    if(event.keyCode == 13) {
    	searchLocations();
      // ensures dropdown disappears when enter is pressed
      $('#gmaps-input-address').autocomplete("disable")
    } else {
      // re-enable if previously disabled above
      $('#gmaps-input-address').autocomplete("enable")
    }
  });
}; // autocomplete_init

function searchLocations() {
    var address = $('#gmaps-input-address').val();
    var geocoder = new google.maps.Geocoder();
    geocoder.geocode({address: address}, function(results, status) {
      if (status == google.maps.GeocoderStatus.OK) {
    	  var radius = 200;
    	  $("input[type='hidden'][name='latitude']").val(results[0].geometry.location.lat());
    	  $("input[type='hidden'][name='longitude']").val(results[0].geometry.location.lng());
//    	  $("input[type='hidden'][name='radius']").val(radius);
    	  $("#search-location").submit();
      } else {
        alert(address + ' not found');
      }
    });
}

$(document).ready(function() {
    gmaps_init();
    autocomplete_init();
    $("#search-location input[type='submit']").click(function(){
    	searchLocations();
    	return false;
    });
	$("#show_map").click(function(){
		$("#gmaps-canvas").attr('style','width:1000px;height:500px;clear:both;');
		$("#gmaps-canvas").show();
	});
});

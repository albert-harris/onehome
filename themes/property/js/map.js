function initialize() {
	var myLatlng = new google.maps.LatLng(1.334804,103.915801);
	var myOptions = {
	  zoom: 16,
	  center: myLatlng,
	  mapTypeId: google.maps.MapTypeId.ROADMAP
	}
	
	var map = new google.maps.Map(document.getElementById("map_canvas"), myOptions);
	
	var contentString = '<div id="content">'+
		'<h1>Property Infologic</h1>'+
		'<div>'+
		'<p>123 Etiam Ligula Mectus, 12-34 Vivamus Aliquam, Singapore 123456</p>'+
		'</div>'+
		'</div>';

	var infowindow = new google.maps.InfoWindow({
		content: contentString,
		maxWidth: 400
	});
	
	var companyImage = new google.maps.MarkerImage('img/point.png',
		new google.maps.Size(135,59),
		new google.maps.Point(0,0),
		new google.maps.Point(0,0)
	);

	var marker = new google.maps.Marker({
		position: myLatlng,
		map: map,
		icon: companyImage,
		title: 'Property Infologic'
	});
	google.maps.event.addListener(marker, 'click', function() {
	  infowindow.open(map,marker);
	});

  }
	
 initialize();     
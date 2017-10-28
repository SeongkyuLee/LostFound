<script type="text/javascript" src="https://openapi.map.naver.com/openapi/v3/maps.js?clientId=b_zJvLGBk1MR4qDwVISK&submodules=geocoder"></script>

<script>
	var map = new naver.maps.Map("map", {
		center: new naver.maps.LatLng(37.3595316, 127.1052133),
		zoom: 10,
		size: new naver.maps.Size(500,400),
		mapTypeControl: true
	});

	map.setCursor('pointer');

	// result by latlng coordinate
	function searchAddressToCoordinate(address) {
		naver.maps.Service.geocode({
			address: address
		}, function(status, response) {
			if (status === naver.maps.Service.Status.ERROR) {
				return alert('올바른 주소를 입력해 주세요.');
			}

			var item = response.result.items[0],
				addrType = item.isRoadAddress ? '[도로명 주소]' : '[지번 주소]',
				point = new naver.maps.Point(item.point.x, item.point.y);	

			map.setCenter(point);

			var marker = new naver.maps.Marker({
			position: new naver.maps.LatLng(x, y),
			map: map
			});	
		});
	}
</script>

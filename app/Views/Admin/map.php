

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width">
    <title>Tutorial Google Map - Petani Kode</title>

    <script src="http://maps.googleapis.com/maps/api/js"></script>
    <script>
        function initialize() {
            var propertiPeta = {
                center:new google.maps.LatLng(-0.23022233210732249,100.6320002729594),
                zoom:9,
                mapTypeId:google.maps.MapTypeId.ROADMAP
            };

            var peta = new google.maps.Map(document.getElementById("googleMap"), propertiPeta);

            // membuat Marker
            var marker=new google.maps.Marker({
                position: new google.maps.LatLng(-0.23022233210732249,100.6320002729594),
                map: peta,
                animation: google.maps.Animation.BOUNCE
            });

        }
        // event jendela di-load
        google.maps.event.addDomListener(window, 'load', initialize);
    </script>

</head>
<body>

<div id="googleMap" style="width:100%;height:380px;"></div>

</body>
</html>
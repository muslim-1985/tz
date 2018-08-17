@extends('theme.default')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-5">
                <div id="map" style="width: 320px; height: 480px;"></div>
                <div class="form-group">
                    <label for="sel1">Select list:</label>
                    <select class="form-control" id="address">
                        {{--данные выводим из конфига--}}
                        @foreach(config('app.cities') as $key => $value)
                            <option>{{ $value }}</option>
                        @endforeach
                    </select>
                    <input type="button" value="Encode" onclick="codeAddress()" style="margin-top: 20px">
                </div>
            </div>
        </div>
    </div>
@endsection
<script>
    let geocoder;
    let map;
    function initMap() {
        geocoder = new google.maps.Geocoder();
        let latlng = new google.maps.LatLng(-34.397, 150.644);
        let mapOptions = {
            zoom: 8,
            center: latlng
        };
        map = new google.maps.Map(document.getElementById('map'), mapOptions);
    }

    function codeAddress() {
        let result = confirm('Вы действительно хотите сохранить геоданные?');
        if (result) {
            let address = document.getElementById('address').value;
            geocoder.geocode({'address': address}, function (results, status) {
                if (status == 'OK') {
                    $.ajax({
                        type: "POST",
                        url: '{{ route('store') }}',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        data: {
                            address: $('#address').val(),
                            lat: results[0].geometry.location.lat(),
                            lng: results[0].geometry.location.lng()
                        },
                        success: function (msg) {
                            alert(msg.message)
                        }
                    });

                    map.setCenter(results[0].geometry.location);
                    let marker = new google.maps.Marker({
                        map: map,
                        position: results[0].geometry.location
                    });
                } else {
                    alert('Geocode was not successful for the following reason: ' + status);
                }
            });
        }
    }
</script>

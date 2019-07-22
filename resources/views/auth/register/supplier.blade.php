@extends('layouts.app')

@section('content')

    <div class="container body" >
        <div class="row">




            <div class="col-md-12 ">



                <div class="panel panel-defualt">
                    <div class="panel-heading">
                        <h4>Fill the form to continue as supplier</h4>

                        <div class="tab">
                            <button  onclick="openTab(event, 'personal')">Personal Information</button>
                            <button href="#" onclick="openTab(event, 'billling')">Billing Information</button>
                            <button href="#" onclick="openTab(event, 'address')">Address Info</button>
                        </div>
                    </div>

                    <div class="panel-body">


                        <form action="{{route('supplierForm')}}">
                            <div class="tabcontent" id="personal">


                            <div class="form-group">
                                <input type="text" name="title" class="form-control" placeholder="Company Name">
                            </div>


                        </div>
                            <div class="orderList tabcontent" id="billling">
                            <h5>Your Cart <span style="color: red;margin: 20px">ClearAll</span></h5>

                            <button class="btn btn-danger" type="submit">Continue</button>

                        </div>
                            <div class=" tabcontent" id="address">

                               <div class="row">
                                   <div class="form-group">
                                       <input type="text" name="address" id="pac-input" class="form-control" required placeholder="Address*">
                                   </div>

                                   <div class="form-group col-lg-3">
                                       <input class="form-control" name="LG" id="lg" type="text" required placeholder="LG*">
                                   </div>

                                   <div class="form-group col-lg-3">
                                       <input class="form-control" name="state" id="state" type="text" required placeholder="state*">
                                   </div>

                                   <div class="form-group col-lg-3">
                                       <input class="form-control" name="country" id="country" type="text" required placeholder="Country*">
                                   </div>

                                   <div class="form-group col-lg-3">
                                       <input class="form-control" name="place_id" id="place_id" type="text" required>
                                   </div>

                               </div>


                                <div class="pac-card" id="pac-card">
                                        <div>
                                            <div id="title">
                                                Autocomplete search
                                            </div>
                                            <div id="type-selector" class="pac-controls">
                                                <input type="radio" name="type" id="changetype-all" checked="checked">
                                                <label for="changetype-all">All</label>

                                                <input type="radio" name="type" id="changetype-establishment">
                                                <label for="changetype-establishment">Establishments</label>

                                                <input type="radio" name="type" id="changetype-address">
                                                <label for="changetype-address">Addresses</label>

                                                <input type="radio" name="type" id="changetype-geocode">
                                                <label for="changetype-geocode">Geocodes</label>
                                            </div>
                                            <div id="strict-bounds-selector" class="pac-controls">
                                                <input type="checkbox" id="use-strict-bounds" value="">
                                                <label for="use-strict-bounds">Strict Bounds</label>
                                            </div>
                                        </div>

                                    </div>
                                <div id="map"></div>
                                <div id="infowindow-content">
                                    <img src="" width="16" height="16" id="place-icon">
                                    <span id="place-name"  class="title"></span><br>
                                    <span id="place-address"></span>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>



            </div>








        </div>
    </div>


@endsection

<script>
    alert('hey');

</script>
<style>
    /* Always set the map height explicitly to define the size of the div
    * element that contains the map. */
    #map {
        height: 100%;
    }
    /* Optional: Makes the sample page fill the window. */
    html, body {
        height: 100%;
        margin: 0;
        padding: 0;
    }
    #description {
        font-family: Roboto;
        font-size: 15px;
        font-weight: 300;
    }

    #infowindow-content .title {
        font-weight: bold;
    }

    #infowindow-content {
        display: none;
    }

    #map #infowindow-content {
        display: inline;
    }

    .pac-card {
        margin: 10px 10px 0 0;
        border-radius: 2px 0 0 2px;
        box-sizing: border-box;
        -moz-box-sizing: border-box;
        outline: none;
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.3);
        background-color: #fff;
        font-family: Roboto;
    }

    #pac-container {
        padding-bottom: 12px;
        margin-right: 12px;
    }

    .pac-controls {
        display: inline-block;
        padding: 5px 11px;
    }

    .pac-controls label {
        font-family: Roboto;
        font-size: 13px;
        font-weight: 300;
    }

    #pac-input {
        background-color: #fff;
        font-family: Roboto;
        font-size: 15px;
        font-weight: 300;
        margin-left: 12px;
        padding: 0 11px 0 13px;
        text-overflow: ellipsis;
        width: 400px;
    }

    #pac-input:focus {
        border-color: #4d90fe;
    }

    #title {
        color: #fff;
        background-color: #4d90fe;
        font-size: 25px;
        font-weight: 500;
        padding: 6px 12px;
    }


</style>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCoHhq-078QaLuiSUWMyBhT-DbXhHLHjwA&libraries=places&callback=initMap"
        async defer></script>
<script type="text/javascript">
    // This example requires the Places library. Include the libraries=places
    // parameter when you first load the API. For example:
    // <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&libraries=places">
    function initMap() {
        var map = new google.maps.Map(document.getElementById('map'), {
            center: {lat: -33.8688, lng: 151.2195},
            zoom: 13
        });
        var card = document.getElementById('pac-card');
        var input = document.getElementById('pac-input');
        var lg = document.getElementById('lg');
        var state = document.getElementById('state');
        var country = document.getElementById('country');
        var place_id = document.getElementById('place_id');
        var types = document.getElementById('type-selector');
        var strictBounds = document.getElementById('strict-bounds-selector');

        map.controls[google.maps.ControlPosition.TOP_RIGHT].push(card);

        var autocomplete = new google.maps.places.Autocomplete(input);

        // Bind the map's bounds (viewport) property to the autocomplete object,
        // so that the autocomplete requests use the current map bounds for the
        // bounds option in the request.
        autocomplete.bindTo('bounds', map);

        // Set the data fields to return when the user selects a place.
        autocomplete.setFields(
                ['address_components', 'geometry', 'geometry.location.lat', 'icon', 'name','place_id','formatted_address']);

        var infowindow = new google.maps.InfoWindow();
        var infowindowContent = document.getElementById('infowindow-content');
        infowindow.setContent(infowindowContent);
        var marker = new google.maps.Marker({
            map: map,
            anchorPoint: new google.maps.Point(0, -29)
        });

        autocomplete.addListener('place_changed', function() {

            infowindow.close();
            marker.setVisible(false);
            var place = autocomplete.getPlace();

            if (!place.geometry) {
                // User entered the name of a Place that was not suggested and
                // pressed the Enter key, or the Place Details request failed.
                window.alert("No details available for input: '" + place.name + "'");
                return;
            }

            // If the place has a geometry, then present it on a map.
            if (place.geometry.viewport) {
                map.fitBounds(place.geometry.viewport);
            } else {
                map.setCenter(place.geometry.location);

                map.setZoom(17);  // Why 17? Because it looks good.
            }
            place_id.value = place.place_id;


            marker.setPosition(place.geometry.location);
            marker.setVisible(true);

            var address = '';
            if (place.address_components) {
                address = [
                    (place.address_components[0] && place.address_components[0].short_name || ''),
                    (place.address_components[1] && place.address_components[1].short_name || ''),
                    (place.address_components[2] && place.address_components[2].short_name || ''),
                    (place.address_components[3] && place.address_components[3].short_name || ''),
                    (place.address_components[4] && place.address_components[4].short_name || ''),
                    (place.address_components[5] && place.address_components[5].short_name || ''),
                    (place.address_components[6] && place.address_components[6].short_name || '')
                ].join(' ');

            }

            infowindowContent.children['place-icon'].src = place.icon;
            infowindowContent.children['place-name'].textContent = place.name;
            infowindowContent.children['place-address'].textContent = address;

            infowindow.open(map, marker);
        });

        // Sets a listener on a radio button to change the filter type on Places
        // Autocomplete.
        function setupClickListener(id, types) {
            var radioButton = document.getElementById(id);
            radioButton.addEventListener('click', function() {
                autocomplete.setTypes(types);
            });
        }

        setupClickListener('changetype-all', []);
        setupClickListener('changetype-address', ['address']);
        setupClickListener('changetype-establishment', ['establishment']);
        setupClickListener('changetype-geocode', ['geocode']);

        document.getElementById('use-strict-bounds')
                .addEventListener('click', function() {
                    console.log('Checkbox clicked! New state=' + this.checked);
                    autocomplete.setOptions({strictBounds: this.checked});
                });
    }
</script>

@extends('pages.dashboard', ['active' => 'bookings'])

@section('main-content')
    <div class="card p-4">

        <div class="card-body">

            <form action="{{url('bookings.create')}}" method="post">
            
                <div class="form-row">

                    <div class="col-12">رزرو جدید</div>
                    <div class="col-12 mb-2"><hr></div>




                </div>
            
            </form>

        </div>

    </div>
@endsection
@push('css')
    <link rel="stylesheet" href="{{assets('vendor/map.ir/css/mapp.min.css')}}">
    <link rel="stylesheet" href="{{assets('vendor/map.ir/css/fa/style.css')}}">
    <style>

    </style>
@endpush
@push('js')
    <script type="text/javascript" src="{{assets('vendor/map.ir/js/mapp.env.js')}}"></script>
    <script type="text/javascript" src="{{assets('vendor/map.ir/js/mapp.min.js')}}"></script>
@endpush
@push('js')
    <script>
        $(document).ready(function () {
            let fromManualMarker = null;
            let toManualMarker = null;
            let mapCenter = {
                lat: 32,
                lng: 52,
            };
            $("#submit-booking-form").click(function () {
                $("#booking-form").submit();
            });
            $("#iCompanyId").change(function () {
                let companyId = $(this).val();
                $("#company_name").val(companyId);
                console.log(companyId);
                let request = $.ajax({
                    type: "GET",
                    url: '/bibc/api/companies/' + companyId + '/drivers',
                    success: function (data) {
                        console.log(data);
                        $("#iDriverId").children().remove();
                        if (data.length > 0) {
                            $.each(data, function (key, value) {
                                $("#iDriverId").append($('<option>', {value: value.iDriverId})
                                    .text(value.vName + ' ' + value.vLastName));
                            });
                        }
                    }
                });
                request.fail(function (jqXHR, textStatus) {
                    console.log("Request failed: " + textStatus);
                });
            });
            $("#iDriverId").change(function () {
                let driverId = $(this).val();
            })
            let mapIrApiKey = 'eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6ImVlMTQ4ZGYxYWYwNDUwMDY5YjBlMzgwOGFlYTMwMjUxNWI0ZmFmNGU3N2Y0Nzc3MmY2MGFlZDJjY2JkNWE4ZmZiMzE2MTgxNjg4NGZjNjM5In0.eyJhdWQiOiIxMDIxMyIsImp0aSI6ImVlMTQ4ZGYxYWYwNDUwMDY5YjBlMzgwOGFlYTMwMjUxNWI0ZmFmNGU3N2Y0Nzc3MmY2MGFlZDJjY2JkNWE4ZmZiMzE2MTgxNjg4NGZjNjM5IiwiaWF0IjoxNTk1NjYxMTc0LCJuYmYiOjE1OTU2NjExNzQsImV4cCI6MTU5ODI1MzE3NCwic3ViIjoiIiwic2NvcGVzIjpbImJhc2ljIl19.s0WWrZ2u-B4R9QaI5fxCozQWCP5QFQScUU2bhIt017_Bbpg0ZrnvA_4Ze1ebbSrVAdbGezuyf37ny3ux7Sg4ZO5rttA4EoF1VndtkVsR-br2G7p7FYMKb_e5adZwDrKos8n2mtS6Cytg3ebphaOSUy1GBNS-8rXSU3CsuUgC9AxXsjAIySS5APVoJaBQ9aj3tfO83rY0f1Is34D4emtC39bpw8ZGuj5U9yp4gQrbh7AgWqf217OFE3Od85n8Q8fOEvSN-XrFxE_Rr_dxTes8okfdsnUEiJ-Ha7LIO7lH4efHX1J6SiuwlOrfjasZRexNa1s3Jll3rS-MOP-oOHXKFQ';
            let map = new Mapp({
                element: '#map',
                presets: {
                    latlng: mapCenter,
                    // zoom: 6,
                },
                apiKey: mapIrApiKey
            });
            map.addLayers();
            map.map.on('click', function (e) {
                console.log(e)
            });
            // map.showReverseGeocode({
            //     state: {
            //         latlng: {
            //             lat: 35.73249,
            //             lng: 51.42268,
            //         },
            //         zoom: 16,
            //     },
            // });
            let headers = {
                'Content-Type': 'application/json',
                'Accept': 'application/json',
                'x-api-key': mapIrApiKey
            };
            let mapSearchData = {
                "text": null,
                "$select": "nearby",
                // "$filter": "province eq تهران",
                "lat": null,
                "lon": null
            };
            $('.trip-info-container').hide();
            $("#iAreaId").change(function () {
                let area = $(this).val();
                let vehicleType = $('#iVehicleTypeId').val();
                let areaCenter = $('option:selected', this).attr('data-area-center');
                areaCenter = JSON.parse(areaCenter);
                let areaZoom = $('option:selected', this).attr('data-area-zoom');
                areaZoom = JSON.parse(areaZoom);
                mapCenter = areaCenter;
                map.map.setView(areaCenter, areaZoom);
                if (area.length > 0 && vehicleType.length > 0) {
                    $('.trip-info-container').fadeIn();
                }
                mapSearchData.lat = areaCenter.lat;
                mapSearchData.lon = areaCenter.lng;
            });
            $("#iVehicleTypeId").change(function () {
                let area = $('#iAreaId').val();
                let vehicleType = $('#iVehicleTypeId').val();
                if (area.length > 0 && vehicleType.length > 0) {
                    $('.trip-info-container').fadeIn();
                }
            });
            $("#from").on("input", function () {
                let searchTerm = $(this).val();
                mapSearchData.text = searchTerm;
                if (searchTerm.length > 4) {
                    axios.post('https://map.ir/search/v2', mapSearchData, {headers})
                        .then(function (response) {
                            console.log(response.data);
                            let results = response.data.value;
                            $("#from-dropdown").children().remove();
                            $("#from").dropdown('show');
                            $.each(results, function (index, item) {
                                $("#from-dropdown").append('<a class="dropdown-item address-item"' +
                                    ' data-item-lat="' + item.geom.coordinates[1] + '"' +
                                    ' data-item-lng="' + item.geom.coordinates[0] + '"' +
                                    ' data-item-address="' + item.address + '"' +
                                    ' href="#">' + item.address + '</a>');
                            });
                            $('#from-dropdown > a.address-item').click(function () {
                                $("#from").val($(this).attr('data-item-address'));
                                addMarkerToMap('from', {
                                    lat: $(this).attr('data-item-lat'),
                                    lng: $(this).attr('data-item-lng')
                                }, 'مبدا', map.icons.red);
                            });
                        })
                        .catch(function (error) {

                        })
                        .finally(function () {

                        });
                }
            });
            $("#to").on("input", function () {
                let searchTerm = $(this).val();
                mapSearchData.text = searchTerm;
                if (searchTerm.length > 4) {
                    axios.post('https://map.ir/search/v2', mapSearchData, {headers})
                        .then(function (response) {
                            console.log(response.data);
                            let results = response.data.value;
                            $("#to-dropdown").children().remove();
                            $("#to").dropdown('show');
                            $.each(results, function (index, item) {
                                $("#to-dropdown").append('<a class="dropdown-item address-item"' +
                                    ' data-item-lat="' + item.geom.coordinates[1] + '"' +
                                    ' data-item-lng="' + item.geom.coordinates[0] + '"' +
                                    ' data-item-address="' + item.address + '"' +
                                    ' href="#">' + item.address + '</a>');
                            });
                            $('#to-dropdown > a.address-item').click(function () {
                                $("#to").val($(this).attr('data-item-address'));
                                addMarkerToMap('to', {
                                    lat: $(this).attr('data-item-lat'),
                                    lng: $(this).attr('data-item-lng')
                                }, 'مقصد', map.icons.blue);
                            });
                        })
                        .catch(function (error) {

                        })
                        .finally(function () {

                        });
                }
            });

            function addMarkerToMap(type, coordinates, title, icon) {
                let name;
                if (type === 'from') {
                    fromManualMarker = map.addMarker({
                        name: 'fromManualMarker',
                        latlng: {
                            lat: coordinates.lat,
                            lng: coordinates.lng,
                        },
                        icon: icon ? icon : map.icons.red,
                        pan: true,
                        draggable: true,
                        history: false,
                        on: {
                            click: function () {
                                console.log('Click callback');
                            },
                            contextmenu: function () {
                                console.log('Contextmenu callback');
                            }
                        },
                    });
                    fromManualMarker.on('dragend', function () {
                        let latitude = this._latlng.lat;
                        let longitude = this._latlng.lng;
                        axios.get('https://map.ir/reverse?lat=' + latitude + '&lon=' + longitude, {headers})
                            .then(function (response) {
                                let address = response.data.address;
                                $("#from").val(address);
                                $("#from_lat").val(latitude);
                                $("#from_long").val(longitude);
                                $("#from_lat_long").val('(' + latitude + ', ' + longitude + ')');
                                calculateDistance();
                            })
                            .catch(function (error) {
                                console.log(error);
                            });
                    });
                } else if (type === 'to') {
                    toManualMarker = map.addMarker({
                        name: 'toManualMarker',
                        latlng: {
                            lat: coordinates.lat,
                            lng: coordinates.lng,
                        },
                        icon: icon ? icon : map.icons.red,
                        pan: true,
                        draggable: true,
                        history: false,
                        on: {
                            click: function () {
                                console.log('Click callback');
                            },
                            contextmenu: function () {
                                console.log('Contextmenu callback');
                            }
                        },
                    });
                    toManualMarker.on('dragend', function () {
                        let latitude = this._latlng.lat;
                        let longitude = this._latlng.lng;
                        axios.get('https://map.ir/reverse?lat=' + latitude + '&lon=' + longitude, {headers})
                            .then(function (response) {
                                let address = response.data.address;
                                $("#to").val(address);
                                $("#to_lat").val(latitude);
                                $("#to_long").val(longitude);
                                $("#to_lat_long").val('(' + latitude + ', ' + longitude + ')');
                                calculateDistance();
                            })
                            .catch(function (error) {
                                console.log(error);
                            });
                    });
                }
            }

            $("#manual-select-address").click(function () {
                if ($("#iAreaId").val() === '') {

                } else {
                    if (fromManualMarker === null) {
                        addMarkerToMap('from', mapCenter, 'مقصد', map.icons.blue);
                    } else {
                        console.error('error1');
                    }
                    if (toManualMarker === null) {
                        addMarkerToMap('to', mapCenter, 'مقصد', map.icons.blue);
                    } else {
                        console.error('error2');
                    }
                }
            });
            $("#get-passenger-detail").click(function () {
                let phone = $('#vPhone').val();
                checkUserByMobile(phone);
            });
            $("#register-user-btn").click(function () {
                let data = {
                    vName: $("#userFirstName").val(),
                    vLastName: $("#userLastName").val(),
                    vPhone: $("#userPhone").val(),
                    vEmail: $("#userEmail").val(),
                };
                axios.post('/bibc/api/passengers/quickCreate', data)
                    .then(function (response) {
                        $("#user-dialog").modal('toggle');
                        checkUserByMobile($("#userPhone").val());
                    })
                    .catch(function (error) {
                        console.log(error);
                    });
            });

            function checkUserByMobile(phone) {
                if (phone.length > 0) {
                    let request = $.ajax({
                        type: "GET",
                        url: '/bibc/api/passengers/byPhone/' + phone,
                        success: function (passenger) {
                            $("#user_type").val('registered');
                            $('#vName').val(passenger.vName);
                            $('#vLastName').val(passenger.vLastName);
                            $('#vEmail').val(passenger.vEmail);
                            $('#iUserId').val(passenger.iUserId);
                            $('#vAddress').val(passenger.vAddress);
                            $('#vDescription').val(passenger.vDescription);
                            let bookingRequest = $.ajax({
                                type: "GET",
                                url: '/bibc/api/bookings/byUserId/' + passenger.iUserId,
                                success: function (booking) {
                                    $('#from').val(booking.vSourceAddresss);
                                    $('#to').val(booking.tDestAddress);
                                    $("#from_lat_long").val('(' + booking.vSourceLatitude + ',' + booking.vSourceLongitude + ')');
                                    $("#from_lat").val(booking.vSourceLatitude);
                                    $("#from_long").val(booking.vSourceLongitude);
                                    $("#to_lat_long").val('(' + booking.vDestLatitude + ',' + booking.vDestLongitude + ')');
                                    $("#to_lat").val(booking.vDestLatitude);
                                    $("#to_long").val(booking.vDestLongitude);
                                    $('#tTripComment').val(booking.tTripComment);
                                }
                            });
                        }
                    });
                    request.fail(function (jqXHR, textStatus) {
                        if (jqXHR.status === 404) {
                            $("#userFirstName").val('');
                            $("#userLastName").val('');
                            $("#userPhone").val('');
                            $("#userEmail").val('');
                            $("#user-dialog").modal('toggle');
                            $("#userPhone").val(phone);
                        }
                    });
                }
            }

            function calculateDistance() {
                let fromLat = $("#from_lat").val();
                let fromLng = $("#from_long").val();
                let fromCoordinates = fromLng + ',' + fromLat;
                let toLat = $("#to_lat").val();
                let toLng = $("#to_long").val();
                let toCoordinates = toLng + ',' + toLat;
                let vehicleTypeId = $("#iVehicleTypeId").val();
                let radius = $("#radius-id").val();
                if (fromLat === '' || fromLng === '' || toLat === '' || toLng === '') {

                } else {
                    // map.drawRoute({
                    //     start: [fromLat, fromLng],
                    //     end: [toLat, toLng],
                    //     mode: 'car',
                    //     draggable: true,
                    //     fit: true,
                    // });
                    $("#trip-fare-result").removeClass('d-none')
                    $("#tripResultsContainer").addClass('d-none');
                    $("#driverContainer").addClass('d-none');
                    $("#tripResultLoading").removeClass('d-none');
                    $("#fare-dialog").modal('toggle');
                    axios.post('/bibc/api/bookings/calculateDistanceAndFare', {
                        origin: {lat: fromLat, lng: fromLng},
                        destination: {lat: toLat, lng: toLng},
                        vehicleTypeId: vehicleTypeId
                    })
                        .then(function (response) {
                            $("#vDistance").val(response.data.tripDistance);
                            $("#vDuration").val(response.data.tripDuration);
                            $("#tripDistance").html(response.data.tripDistance + ' کیلومتر');
                            $("#tripDuration").html(response.data.tripDuration + ' دقیقه');
                            $("#totalFare").html(response.data.total_fare + ' تومان');
                            $("#tripResultLoading").addClass('d-none');
                            $("#tripResultsContainer").removeClass('d-none');
                            $("#driverContainer").removeClass('d-none');
                            location.hash = "#trip-fare-result";
                            axios.post('/bibc/api/drivers/driverListByLocation', {
                                lat: fromLat,
                                lng: fromLng,
                                radius: radius ? radius : 5,
                            })
                                .then(function (response) {
                                    let drivers = response.data;
                                    let driverMarkers = [];
                                    for (let i = 0; i < drivers.length; i++) {
                                        driverMarkers[i] = map.addMarker({
                                            name: 'driverMarker' + i,
                                            latlng: {
                                                lat: drivers[i].location.lat,
                                                lng: drivers[i].location.lng,
                                            },
                                            popup: {
                                                title: {
                                                    html: drivers[i].name,
                                                },
                                                description: {
                                                    html: drivers[i].address,
                                                },
                                                open: true
                                            },
                                            icon: map.icons.green,
                                            pan: false,
                                            draggable: false,
                                            history: false,
                                            on: {
                                                click: function () {
                                                    console.log('driver Click callback');
                                                },
                                                contextmenu: function () {
                                                    console.log('Contextmenu callback');
                                                }
                                            },
                                        });
                                    }
                                })
                                .catch(function (error) {
                                    console.log(error);
                                });
                        })
                        .catch(function (error) {
                            console.log(error);
                        });
                }
            }
        });
    </script>
@endpush
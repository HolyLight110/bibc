


//load main js dependecies
require('./bootstrap');

$(document).ready(function () {

    //initialization at start

    //tooltip initilize
    $('[data-toggle="tooltip"]').tooltip();

    var ajax;
    ajax = axios.create({
        baseURL: 'http://localhost/bibc/api/',
        timeout: 5000,
        headers: {
            'Content-Type': 'application/json',
            'Accept': 'application/json'
        }
    });
    let companyAccessToken = $('meta[name=company-api-token]').attr("content");
    let driverAccessToken = $('meta[name=driver-api-token]').attr("content");
    let passengerAccessToken = $('meta[name=passenger-api-token]').attr("content");
    if (companyAccessToken !== undefined) {
        ajax.defaults.headers.common['company-api-token'] = companyAccessToken;
    }
    if (driverAccessToken !== undefined) {
        ajax.defaults.headers.common['driver-api-token'] = driverAccessToken;
    }
    if (passengerAccessToken !== undefined) {
        ajax.defaults.headers.common['passenger-api-token'] = passengerAccessToken;
    }


    //sidebar toggler
    $(document).on("click", ".sidebar-toggler", function(e) {
        e.preventDefault();
        $('#sidebar-wrapper').toggleClass('in');
        // $('#sidebar-wrapper').toggleClass('d-none');
        // $('#main-wrapper').toggleClass('full-scale');

    })

    //sidebar toggler for sm+ 
    $(document).on("click", ".sidebar-toggler-sm", function(e) {
        e.preventDefault();
        // $('#sidebar-wrapper').toggleClass('out');
        // $('#sidebar-wrapper').toggleClass('d-none');
        $('#main-wrapper').toggleClass('full-scale');

    })


});

/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');
require('./jquery.jscroll.js')

window.Vue = require('vue');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('example-component', require('./components/ExampleComponent.vue'));

const app = new Vue({
    el: '#app'
});

//Show image before upload
function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('#profile-img-tag').attr('src', e.target.result);
        }
        reader.readAsDataURL(input.files[0]);
    }
}
$("#file-input").change(function(){
    readURL(this);
});

//Tooltip
// $(function () {
//     $('[data-toggle="tooltip"]').tooltip()
// })

// $( document ).ready(function() {
//     console.log( "ready!" );
// });


//User location
var x = document.getElementById("demo");

function getLocation(){
    if (navigator.geolocation) {
        console.log( "here");
        navigator.geolocation.getCurrentPosition(showPosition, showError);
    } else {
        x.innerHTML = "Geolocation is not supported by this browser.";
    }
}

function showPosition(position) {
    var latilong = [position.coords.latitude, position.coords.longitude];
    var latlon = position.coords.latitude + "," + position.coords.longitude;
    //Will do this later once everything else is set up
    // var img_url = "https://maps.googleapis.com/maps/api/staticmap?center="
      //  +latlon+"&zoom=14&size=400x300&key=AIzaSyBu-916DdpKAjTmJNIgngS6HL_kDIKU0aU";
    // document.getElementById("mapholder").innerHTML = "<img src='"+img_url+"'>";
    console.log( position.coords.latitude);
    sessionStorage['latitude'] = position.coords.latitude;
    sessionStorage['longitude'] = position.coords.longitude;
    sessionStorage['visited'] = "yes";

    $('input[name=latitude]').val(position.coords.latitude);
    $('input[name=longitude]').val(position.coords.longitude);
    // document.getElementById('latitude').value = position.coords.latitude;
    // document.getElementById('longitude').value = position.coords.longitude;

    //return latilong;
}
//To use this code on your website, get a free API key from Google.
//Read more at: https://www.w3schools.com/graphics/google_maps_basic.asp

function showError(error) {
    switch(error.code) {
        case error.PERMISSION_DENIED:
            x.innerHTML = "User denied the request for Geolocation."
            break;
        case error.POSITION_UNAVAILABLE:
            x.innerHTML = "Location information is unavailable."
            break;
        case error.TIMEOUT:
            x.innerHTML = "The request to get user location timed out."
            break;
        case error.UNKNOWN_ERROR:
            x.innerHTML = "An unknown error occurred."
            break;
    }
}

$('#mobile-app-button').click(function(){
    localStorage['hasvisited'] = "yes";
    window.location.href='https://www.frendgrid.com/about';
})


$( document ).ready(function() {
    console.log( "You Found Me!" );
    var yetVisited = sessionStorage['visited'];
    var hasVisited = localStorage['hasvisited'];
    if (!hasVisited){
        $('#mobile-app-button').addClass('d-block d-sm-block d-md-none')
        $('#mobile-app-button').removeClass('d-none')

    }

    if (!yetVisited) {
        // open popup
        getLocation();

    }
    else{
        $('input[name=latitude]').val(sessionStorage['latitude']);
        $('input[name=longitude]').val(sessionStorage['longitude']);
    }

});

$(document).ready(function(){

    $('ul.tabs li').click(function(){
        var tab_id = $(this).attr('data-tab');

        $('ul.tabs li').removeClass('current');
        $('.tab-content').removeClass('current');

        $(this).addClass('current');
        $("#"+tab_id).addClass('current');
    })


    $(".modal-button").click(function() {  //use a class, since your ID gets mangled
        $('.modal-dialog').hide();      //add the class to the clicked element
    });


    $(".collapse").click(function() {  //use a class, since your ID gets mangled
        $('#followingCollapse').removeClass('show');      //add the class to the clicked element
    });

    $(".collapse").click(function() {  //use a class, since your ID gets mangled
        $('#followerCollapse').removeClass('show');      //add the class to the clicked element
    });



//Slick
//     $('.multiple-items').slick({
//         infinite: false,
//         slidesToShow: 5,
//         slidesToScroll: 3,
//         swipeToSlide: true,
//         swipe: true
//
//     });


});

//Javascript
$(function()
{
    $( "#q" ).autocomplete({
        source: "search/autocomplete",
        minLength: 3,
        select: function(event, ui) {
            $('#q').val(ui.item.value);
        }
    });
});

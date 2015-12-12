
"use strict";

$(document).ready(function(){
  var map = new GMaps({
    div: '#map',
    lat: 39.127990,
    lng: -99.863202,
    zoom: 3
  });

  var markers = {};
  var mapCheckBoxes = document.getElementsByClassName('mapButtons');
  for(var i=0; i<mapCheckBoxes.length; i++){
    var id = mapCheckBoxes[i].id;

    mapCheckBoxes[i].onchange = (function(){
      var closedId = id;
      // var closedAddress = address;
      return function(){
        if(this.checked == true){
          var idnum = closedId.split("_")[1];

          var street = document.getElementsByName('street_' + idnum)[0].value;
          var city = document.getElementsByName('city_' + idnum)[0].value;
          var state = document.getElementsByName('state_' + idnum)[0];
          state = state[state.selectedIndex].value;
          var zip = document.getElementsByName('zip_' + idnum)[0].value;

          var address = ((street != '')? street + " " : "") +
            ((city != '')? city + ", " : "") +
            state +
            ((zip != '')? " " + zip : "") +
            ", United States";

          addMapPointer(closedId, address);
        }
        else{
          removeMapPointer(closedId);
        }
      }
    })();
  }

  function addMapPointer(id, address){
    GMaps.geocode({
      address: address.trim(),
      callback: (function(){
        var addr = address.trim();
        return function(results, status){
          if(status == 'OK'){
            var coords = results[0].geometry.location;
            markers[id] = map.addMarker({
              lat: coords.lat(),
              lng: coords.lng(),
              title: addr,
              infoWindow: {
                content: addr
              },
              details: {
                id: id
              }
            });
          }
        }
      })()
    });
  }

  function removeMapPointer(id){
    markers[id].setMap(null);
  }
});

 (function() {
  
var address, map, geocoder, marker, infowindow;

  window.onload = function() {
  
     
      var map = new google.maps.Map(document.getElementById("map"), {
        center: new google.maps.LatLng(52.5, -1.5),
        zoom: 7,
        mapTypeId: 'roadmap'
      });
      var infoWindow = new google.maps.InfoWindow;
      

// Getting a reference to the HTML form
    var form = document.getElementById('addressForm');

    // Catching the forms submit event
    form.onsubmit = function() {
      // Getting the address from the text input
      var address = document.getElementById('address').value;
      var mode = address;
      var modeIcon = 'icons/'+address+'.png';

      // Making the Geocoder call 
 //     getCoordinates(address);
      

      // Preventing the form from doing a page submit
      


downloadUrl("xml_out_LA.php", function(data) {
        
        var xx = 32;
        var yy = 37;
        var xml = data.responseXML;
        var markers = xml.documentElement.getElementsByTagName("marker");
        for (var i = 0; i < markers.length; i++) {

          

          var LA = markers[i].getAttribute("LA");
          var mode_pc = 100*markers[i].getAttribute(mode+"_pc");
          var mode_rank = markers[i].getAttribute(mode+"_rank");
          var address = "address";
          var type = "type";
//          var point = new google.maps.LatLng((52.8+0.01*i),(0.5+0.01*i));





for (var jj = 0; jj < markers.length-1; jj++) {
var y=x[jj].attributes;
if(y.getNamedItem("name").nodeValue == LA ){


var html =  "<b>"+y.getNamedItem("name").nodeValue + "</b></br>Commute mode:"+mode+
" </br> Rate: "+Math.round(10*mode_pc)/10+"%</br>Rank: "+mode_rank+" (out of 175)</br>";

var point = new google.maps.LatLng(y.getNamedItem("lat").nodeValue,
                                   y.getNamedItem("lng").nodeValue);



          
   //       var html = "<b>" + name + "</b> <br/>" + address;
//          var icon = customIcons[type] || {};
          
          var xxx = 0.2*32*Math.sqrt(mode_pc);
          var yyy = 0.2*37*Math.sqrt(mode_pc);
          var image = new google.maps.MarkerImage(
          modeIcon,null, null, null, new google.maps.Size(xxx,yyy));



          var marker = new google.maps.Marker({
            map: map,
            position: point,
            icon: image
          });
          bindInfoWindow(marker, map, infoWindow, html);
}
};




        };



      });



for (i=0;i<0;i++)
{

var zz = "testing"+i;

var y=x[i].attributes;
var html = "x"

var xx = 32;
var yy = 37;


var image = new google.maps.MarkerImage(
  modeIcon,
  new google.maps.Size(50*xx/i,50*yy/i),
  new google.maps.Point(0,0),
  new google.maps.Point(xx/2,yy/2)
);

var point = new google.maps.LatLng(y.getNamedItem("lat").nodeValue,
                                   y.getNamedItem("lng").nodeValue);
var marker = new google.maps.Marker({
            
            icon: image,
             map: map,
            position: point});
        

          bindInfoWindow(marker, map, infoWindow, html);
}

     return false;

      
    }


}



function downloadUrl(url, callback) {
      var request = window.ActiveXObject ?
          new ActiveXObject('Microsoft.XMLHTTP') :
          new XMLHttpRequest;

      request.onreadystatechange = function() {
        if (request.readyState == 4) {
          request.onreadystatechange = doNothing;
          callback(request, request.status);
        }
      };

      request.open('GET', url, true);
      request.send(null);
    }

    function bindInfoWindow(marker, map, infoWindow, html) {
      google.maps.event.addListener(marker, 'click', function() {
        infoWindow.setContent(html);
        infoWindow.open(map, marker);
      });
    }



    function downloadUrl(url, callback) {
      var request = window.ActiveXObject ?
          new ActiveXObject('Microsoft.XMLHTTP') :
          new XMLHttpRequest;

      request.onreadystatechange = function() {
        if (request.readyState == 4) {
          request.onreadystatechange = doNothing;
          callback(request, request.status);
        }
      };

      request.open('GET', url, true);
      request.send(null);
    }

    function doNothing() {}




})();
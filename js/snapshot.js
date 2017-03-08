(function() {
var streaming = false;
var video = document.getElementById('snapshot-video');
var photo = document.getElementById('snapshot-photo');
var startbutton = document.getElementById('snapshot-button');
var canvas = document.getElementById('snapshot-canvas');
var width = 640;
var height = 0;

navigator.getMedia = ( navigator.getUserMedia ||
                         navigator.webkitGetUserMedia ||
                         navigator.mozGetUserMedia ||
                         navigator.msGetUserMedia);

navigator.getMedia(
   {
      video: true,
      audio: false
    },
    function(stream) {
      if (navigator.mozGetUserMedia) {
        video.mozSrcObject = stream;
      } else {
       var vendorURL = window.URL || window.webkitURL;
        video.src = vendorURL.createObjectURL(stream);
     }
     video.play();
  },
    function(err) {
     console.log("Erreur lors de l'ouverture du flux video ! Erreur : " + err);
   }
 );

 video.addEventListener('canplay', function(ev){
     if (!streaming) {
       height = video.videoHeight / (video.videoWidth/width);
       video.setAttribute('width', width);
       video.setAttribute('height', height);
       canvas.setAttribute('width', width);
       canvas.setAttribute('height', height);
       streaming = true;
     }
   }, false);

   var x = 0;

   function togglePhotoPopup(){
     if (!x){
       document.getElementById('snapshot-popup').style.display = "block";
       document.getElementById('popup-blur').style.display = "block";
       x = 1;
     }
     else{
       document.getElementById('snapshot-popup').style.display = "none";
       document.getElementById('popup-blur').style.display = "none";
       x = 0;
     }
     document.getElementById("popup-blur").onclick = togglePhotoPopup;
     document.getElementById("snapshot-cancel").onclick = togglePhotoPopup;
   }

   function takepicture() {
       canvas.width = width;
       canvas.height = height;
       canvas.getContext('2d').drawImage(video, 0, 0, width, height);
       var data = canvas.toDataURL('image/png');
       photo.setAttribute('src', data);
       document.getElementById('form-snap').setAttribute('value', data);
       togglePhotoPopup();
     }

     startbutton.addEventListener('click', function(ev){
    takepicture();
  ev.preventDefault();
}, false);
})();

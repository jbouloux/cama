var x = 0;
var idd;

function togglePhoto(){
  if (!x){
    document.getElementById(idd).style.display = "block";
    document.getElementById('popup-blur-pic').style.display = "block";
    x = 1;
  }
  else{
    document.getElementById(idd).style.display = "none";
    document.getElementById('popup-blur-pic').style.display = "none";
    x = 0;
  }
  document.getElementById("popup-blur-pic").onclick = togglePhoto;
}

function togglePhotoPopup(id){
  idd = id.toString();
  togglePhoto();
}

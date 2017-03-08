var x = 0;
function popupConnectVisible(){
	if (!x){
		document.getElementById('popup-connect').style.display = "block";
		document.getElementById('popup-blur').style.display = "block";
		x = 1;
	}
	else {
		document.getElementById('popup-connect').style.display = "none";
		document.getElementById('popup-blur').style.display = "none";
		x = 0;
	}
};

function toggleConnectPopup(){
	document.getElementById("connect-icon").onclick = popupConnectVisible;
	document.getElementById("popup-blur").onclick = popupConnectVisible;
};

window.onload = function (){
	if (document.getElementById("connect-icon"))
		toggleConnectPopup();
	};

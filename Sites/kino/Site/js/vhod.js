function loginmenya(){
	window.location.href = 'https://oauth.vk.com/authorize?client_id=6655108&redirect_uri=http://localhost/&display=popup&scope=friends,email';
}

openvhod=false;
function voyti() {
    if (openvhod==false) {
        openvhod=true;
        document.getElementById('poverhvs').style.display='flex';
    }
}
function closevhod() {
    if (openvhod==true) {
        openvhod=false;
        document.getElementById('poverhvs').style.display='none';
    }
}
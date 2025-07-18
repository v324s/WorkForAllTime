function bagfixwidth() {
        wid=document.documentElement.clientWidth;
        if (wid>1002) {
            //1019
            document.getElementById('spisact').style.display='none';
        }
        //869
        if (wid>868) {
            document.getElementById('mmenu').style.display='none';
            document.getElementById('openminimenu').style.background='url(img/menu.png)';
            open=false;
        }
}   setInterval(bagfixwidth,1);
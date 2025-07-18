
        // функция которая скрывает мобильное меню про большом экране


        function bagfixwidth() {
            wid=document.documentElement.clientWidth;
            /*if (wid>1002) {
                //1019
                document.getElementById('mobmenu').style.display='none';
            }
            //869
            if (wid>868) {
                document.getElementById('mimenu').style.display='block';
                document.getElementById('mobmenu').style.display='none';
            }701
            89*/
            if (wid<699 || wid<=723  && wid>=699) {
                document.getElementById('mimenu').style.display='none';
                 document.getElementById('openmenu').style.display='block';
            }else{
                document.getElementById('openmenu').style.display='none';
                document.getElementById('mimenu').style.display='block';
                document.getElementById('mobmenu').style.display='none';
                $("#openmenu").css('background-image','url("../img/menu.png")');
            }

             if ($("#soderzhanie").css('display')=='block') {
                if (wid<699) {
                    document.getElementById('openmenu').style.display='block';
                }
             }else{
                 if ($("#soderzhanie1").css('display')=='block') {
                    if (wid<699) {
                        document.getElementById('openmenu').style.display='block';
                        
                    }
                 }
             }
        }   setInterval(bagfixwidth,1);
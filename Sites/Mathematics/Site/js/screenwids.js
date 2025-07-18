
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
            }701*/
            if (wid<698) {
                document.getElementById('mimenu').style.display='none';
                 document.getElementById('openmenu').style.display='block';
            }else{
                document.getElementById('openmenu').style.display='none';

                document.getElementById('mimenu').style.display='block';
                document.getElementById('mobmenu').style.display='none';
                $("#openmenu").css('background-image','url("../img/menu.png")');
            }
        }   setInterval(bagfixwidth,1);
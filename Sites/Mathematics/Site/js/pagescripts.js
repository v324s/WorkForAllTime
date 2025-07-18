        // Кнопка открыть/закрыть содержание в ГЛАВНОМ меню    
    zagol='';
    zagol1='';
        $("#opensoderzhanie1").click( function () {
            if ($("#soderzhanie").css('display')=='none') {
            $("#soderzhanie").css('display','block');
            $("#embd").css('display','none');
            zagol1=document.getElementById('titlezag').innerHTML;
            document.getElementById('titlezag').innerHTML='СОДЕРЖАНИЕ';
            document.getElementById('titlezag').style.marginTop='15px';
            
        }else{
                $("#soderzhanie").css('display','none');
                $("#embd").css('display','block');
                if (zagol1!='') {
                    document.getElementById('titlezag').innerHTML=zagol1;
                }else{
                    document.getElementById('titlezag').innerHTML=zagol;
                }
                document.getElementById('titlezag').style.marginTop='0';
            }
        });

        // Кнопка открыть/закрыть содержание в МОБИЛЬНОМ меню  

        $("#opensoderzhanie").click( function () {
            if ($("#soderzhanie").css('display')=='none') {
            $("#soderzhanie").css('display','block');
            $("#embd").css('display','none');
            zagol=document.getElementById('titlezag').innerHTML;
            document.getElementById('titlezag').innerHTML='СОДЕРЖАНИЕ';
           document.getElementById('titlezag').style.marginTop='15px';
            $("#mobmenu").css('display','none');
                $("#openmenu").css('background-image','url("../img/menu.png")');
        }else{
                $("#soderzhanie").css('display','none');
                $("#embd").css('display','block');
                if (zagol!='') {
                    document.getElementById('titlezag').innerHTML=zagol;
                }else{
                    document.getElementById('titlezag').innerHTML=zagol1;
                }
                document.getElementById('titlezag').style.marginTop='0';
                $("#mobmenu").css('display','none');
                $("#openmenu").css('background-image','url("../img/menu.png")');
            }
        });


        // Кнопка открыть/закрыть список лекций в ГЛАВНОМ меню


        $("#lekcii").click( function () {
            if ($("#spisoklekciy").css('display')=='none') {
            $("#spisoklekciy").css('display','block');
        }else{
                $("#spisoklekciy").css('display','none');
            }
        });


        // Кнопка открыть/закрыть список лекций в МОБИЛЬНОМ меню


        $("#lekcii2").click( function () {
            if ($("#spisoklekciy2").css('display')=='none') {
            $("#spisoklekciy2").css('display','block');
        }else{
                $("#spisoklekciy2").css('display','none');
            }
        });


        // Кнопка открыть/закрыть МОБИЛЬНОЕ меню


        $("#openmenu").click( function () {
            if ($("#mobmenu").css('display')=='none') {
            $("#mobmenu").css('display','block');
            $("#openmenu").css('background-image','url("../img/menu1.png")');
        }else{
                $("#mobmenu").css('display','none');
                $("#openmenu").css('background-image','url("../img/menu.png")');
            }
        });


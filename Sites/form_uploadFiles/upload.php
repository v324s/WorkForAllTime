<?php
if ($_FILES['userfile']['tmp_name']) {
   /* if ($_FILES['film']['size']>4*1024*1024) {
        //$er="Файл слишком большой";
    }else{*/
        print_r($_FILES);
        $arrname=explode('.',$_FILES['userfile']['name']);
        $type=$arrname[count($arrname)-1];
        $name=$_FILES['userfile']['name'].' ('.uniqid().')';
        $fullname=$name.'.'.$type;
        $link='files/'.$fullname;

        
        echo "<br>";
        print_r('$type - '.$type);
        echo "<br>";
        print_r('$fullname - '.$fullname);
        echo "<br>";
        print_r('$linkimg - '.$link);
        echo "<br>";
        if (!move_uploaded_file($_FILES['userfile']['tmp_name'], $link)) {
            echo "upload error";
        }else{
            echo "completed";
        }
    
   //}
}
?>
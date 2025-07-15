<?

if ($_POST['action'] == 'add' && $_POST['table']) {
    switch ($_POST['table']) {
        case 'category':
            $sql = "INSERT INTO {$_POST['table']}(`name`) VALUES (:name)";
            $sth = $dbh->prepare($sql);
            $res = $sth->execute(array('name' => $_POST['name']));
            break;

        case 'subcategory':
            $sql = "INSERT INTO {$_POST['table']}(`id_category`,`name`) VALUES (:idcategory, :name)";
            $sth = $dbh->prepare($sql);
            $res = $sth->execute(array('idcategory' => $_POST['idcategory'], 'name' => $_POST['name']));
            break;

        case 'sizes':
            $sql = "INSERT INTO {$_POST['table']}(`number`) VALUES (:number)";
            $sth = $dbh->prepare($sql);
            $res = $sth->execute(array('number' => $_POST['number']));
            break;

        case 'colors':
            $sql = "INSERT INTO {$_POST['table']}(`name`) VALUES (:name)";
            $sth = $dbh->prepare($sql);
            $res = $sth->execute(array('name' => $_POST['name']));
            break;

        case 'users':
            $sql = "INSERT INTO {$_POST['table']}(`first_name`,`last_name`,`dob`,`sex`,`telephone`,`address`) VALUES (:fname, :lname, :dob, :sex, :tel, :addr)";
            $sth = $dbh->prepare($sql);
            $res = $sth->execute(array('fname' => $_POST['fname'], 'lname' => $_POST['lname'], 'dob' => $_POST['dob'], 'sex' => $_POST['sex'], 'tel' => $_POST['tel'], 'addr' => $_POST['addr']));
            break;

        case 'products':
            $sql = "INSERT INTO {$_POST['table']}(`id_category`,`id_subcategory`,`id_size`,`id_color`,`name`,`description`,`price`,`discount`, `count`) VALUES (:category, :subcategory, :size, :color, :name, :description, :price, :discount, :count)";
            $sth = $dbh->prepare($sql);
            $res = $sth->execute(array('category' => $_POST['category'], 'subcategory' => $_POST['subcategory'], 'size' => $_POST['size'], 'color' => $_POST['color'], 'name' => $_POST['name'], 'description' => $_POST['description'], 'price' => $_POST['price'], 'discount' => $_POST['discount'], 'count' => $_POST['count']));
            break;
        
        case 'cart_users':
            $sql = "INSERT INTO {$_POST['table']}(`id_user`,`id_product`,`id_size`,`id_color`,`count`) VALUES (:uid, :pid, :sid, :cid, :count)";
            $sth = $dbh->prepare($sql);
            $res = $sth->execute(array('uid' => $_POST['uid'], 'pid' => $_POST['pid'], 'sid' => $_POST['sid'], 'cid' => $_POST['cid'], 'count' => $_POST['count']));
            break;

        case 'orders':
            $sql = "INSERT INTO {$_POST['table']}(`id_user`,`id_product`,`id_size`,`id_color`,`count`,`price_for_one`,`price`,`address`,`status`) VALUES (:uid, :pid, :sid, :cid, :count, :pfo, :price, :addr, :status)";
            $sth = $dbh->prepare($sql);
            $res = $sth->execute(array('uid' => $_POST['uid'], 'pid' => $_POST['pid'], 'sid' => $_POST['sid'], 'cid' => $_POST['cid'], 'count' => $_POST['count'], 'pfo' => $_POST['pfo'], 'price' => $_POST['price'], 'addr' => $_POST['addr'], 'status' => $_POST['status']));
            break;
    }
    if ($res) {
        echo 'Запись добавлена!';
    } else {
        echo 'Не удалось добавить запись';
    }
}






?>
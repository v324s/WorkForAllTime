<?

if ($_GET['action'] = 'get' && $_GET['table']) {
    // $sql = "SELECT * FROM :table";
    // $sth=$dbh->prepare($sql);
    // $sth->execute(array('table' => $_GET['table']));
    // $row = $sth->fetchAll();
    $html_response = "<table>
                                <thead>
                                <tr>
                                    <td>Действие <br>
                <button class='button-ico but-add' onclick='action_add(\"{$_GET['table']}\")'></button>
                                    </td>
                                    <td>id<br></td>
                                    <td>Имя<br></td>
                                </tr>
                                </thead>
                                <tbody>";

    switch ($_GET['table']) {
        case 'category':
            $sql = "SELECT * FROM {$_GET['table']}";
            $sth = $dbh->prepare($sql);
            $sth->execute();
            $row = $sth->fetchAll();
            $html_response = "<table>
                                        <thead>
                                        <tr>
                                            <td>Действие <br>
                        <button class='button-ico but-add' onclick='action_add(\"{$_GET['table']}\")'></button>
                                            </td>
                                            <td>id<br> </td>
                                            <td>Имя<br> </td>
                                        </tr>
                                        </thead>
                                        <tbody>";

            foreach ($row as $key) {
                $html_response .= "
                <tr><td>
                <button class='button-ico but-del' onclick='action_delete(\"{$_GET['table']}\", {$key["id"]})'></button>
                <button class='button-ico but-edit' onclick='action_edit(\"{$_GET['table']}\", {$key["id"]})'></button></td>
                                 <td>{$key["id"]}</td>
                                 <td>{$key["name"]}</td></tr>";
            }
            break;

        case 'subcategory':
            $sql = "SELECT subcategory.id, subcategory.id_category, subcategory.name, category.name AS 'category_name' FROM {$_GET['table']} JOIN category ON subcategory.id_category=category.id";
            $sth = $dbh->prepare($sql);
            $sth->execute();
            $row = $sth->fetchAll();
            $html_response = "<table>
                                        <thead>
                                        <tr>
                                            <td>Действие <br>
                        <button class='button-ico but-add' onclick='action_add(\"{$_GET['table']}\")'></button>
                                            </td>
                                            <td>id<br> </td>
                                            <td>Категория<br> </td>
                                            <td>Имя<br> </td>
                                        </tr>
                                        </thead>
                                        <tbody>";

            foreach ($row as $key) {
                $html_response .= "
                <tr><td>
                <button class='button-ico but-del' onclick='action_delete(\"{$_GET['table']}\", {$key["id"]})'></button>
                <button class='button-ico but-edit' onclick='action_edit(\"{$_GET['table']}\", {$key["id"]})'></button></td>
                                 <td>{$key["id"]}</td>
                                 <td>({$key["id_category"]}) {$key["category_name"]}</td>
                                 <td>{$key["name"]}</td></tr>";
            }
            break;


        case 'sizes':
            $sql = "SELECT * FROM {$_GET['table']}";
            $sth = $dbh->prepare($sql);
            $sth->execute();
            $row = $sth->fetchAll();
            $html_response = "<table>
                                            <thead>
                                            <tr>
                                                <td>Действие <br>
                            <button class='button-ico but-add' onclick='action_add(\"{$_GET['table']}\")'></button>
                                                </td>
                                                <td>id<br> </td>
                                                <td>Номер<br> </td>
                                            </tr>
                                            </thead>
                                            <tbody>";

            foreach ($row as $key) {
                $html_response .= "
                    <tr><td>
                    <button class='button-ico but-del' onclick='action_delete(\"{$_GET['table']}\", {$key["id"]})'></button>
                    <button class='button-ico but-edit' onclick='action_edit(\"{$_GET['table']}\", {$key["id"]})'></button></td>
                                     <td>{$key["id"]}</td>
                                     <td>{$key["number"]}</td></tr>";
            }
            break;


            case 'colors':
                $sql = "SELECT * FROM {$_GET['table']}";
                $sth = $dbh->prepare($sql);
                $sth->execute();
                $row = $sth->fetchAll();
                $html_response = "<table>
                                                    <thead>
                                                    <tr>
                                                        <td>Действие <br>
                                    <button class='button-ico but-add' onclick='action_add(\"{$_GET['table']}\")'></button>
                                                        </td>
                                                        <td>id<br> </td>
                                                        <td>Цвет<br> </td>
                                                    </tr>
                                                    </thead>
                                                    <tbody>";

                foreach ($row as $key) {
                    $html_response .= "
                            <tr><td>
                            <button class='button-ico but-del' onclick='action_delete(\"{$_GET['table']}\", {$key["id"]})'></button>
                            <button class='button-ico but-edit' onclick='action_edit(\"{$_GET['table']}\", {$key["id"]})'></button></td>
                                            <td>{$key["id"]}</td>
                                            <td>{$key["name"]}</td></tr>";
                }
            break;

            case 'users':
                $sql = "SELECT * FROM {$_GET['table']}";
                $sth = $dbh->prepare($sql);
                $sth->execute();
                $row = $sth->fetchAll();
                $html_response = "<table>
                                                    <thead>
                                                    <tr>
                                                        <td>Действие <br>
                                    <button class='button-ico but-add' onclick='action_add(\"{$_GET['table']}\")'></button>
                                                        </td>
                                                        <td>id<br> </td>
                                                        <td>Имя<br> </td>
                                                        <td>Фамилия<br> </td>
                                                        <td>Дата рождения<br> </td>
                                                        <td>Пол<br> </td>
                                                        <td>Телефон<br> </td>
                                                        <td>Адрес<br> </td>
                                                    </tr>
                                                    </thead>
                                                    <tbody>";

                foreach ($row as $key) {
                    $html_response .= "
                            <tr><td>
                            <button class='button-ico but-del' onclick='action_delete(\"{$_GET['table']}\", {$key["id"]})'></button>
                            <button class='button-ico but-edit' onclick='action_edit(\"{$_GET['table']}\", {$key["id"]})'></button></td>
                                            <td>{$key["id"]}</td>
                                            <td>{$key["first_name"]}</td>
                                            <td>{$key["last_name"]}</td>
                                            <td>{$key["dob"]}</td>
                                            <td>{$key["sex"]}</td>
                                            <td>{$key["telephone"]}</td>
                                            <td>{$key["address"]}</td></tr>";
                }
            break;

            case 'products':
                // $sql = "SELECT * FROM {$_GET['table']}";
                $sql = "SELECT products.id, products.id_category, category.name AS 'name_category', products.id_subcategory, subcategory.name AS 'name_subcategory', products.id_size, sizes.number AS 'number_size', products.id_color, colors.name AS 'name_color', products.name, products.description, products.price, products.discount, products.count
                FROM {$_GET['table']}
                JOIN category ON products.id_category=category.id 
                JOIN subcategory ON products.id_subcategory=subcategory.id 
                JOIN sizes ON products.id_size=sizes.id 
                JOIN colors ON products.id_color=colors.id";
                $sth = $dbh->prepare($sql);
                $sth->execute();
                $row = $sth->fetchAll();
                $html_response = "<table>
                                                    <thead>
                                                    <tr>
                                                        <td>Действие <br>
                                    <button class='button-ico but-add' onclick='action_add(\"{$_GET['table']}\")'></button>
                                                        </td>
                                                        <td>id<br> </td>
                                                        <td>Категория<br> </td>
                                                        <td>Подкатегория<br> </td>
                                                        <td>Размер<br> </td>
                                                        <td>Цвет<br> </td>
                                                        <td>Наименование<br> </td>
                                                        <td>Описание<br> </td>
                                                        <td>Цена<br> </td>
                                                        <td>Скидка %<br> </td>
                                                        <td>Кол-во<br> </td>
                                                    </tr>
                                                    </thead>
                                                    <tbody>";
                foreach ($row as $key) {
                    $priceWithDiscount=$key["price"]-($key["price"]*floatval("0.".$key["discount"]));
                    $html_response .= "
                            <tr><td>
                            <button class='button-ico but-del' onclick='action_delete(\"{$_GET['table']}\", {$key["id"]})'></button>
                            <button class='button-ico but-edit' onclick='action_edit(\"{$_GET['table']}\", {$key["id"]})'></button></td>
                                            <td>{$key["id"]}</td>
                                            <td>({$key["id_category"]}) {$key["name_category"]}</td>
                                            <td>({$key["id_subcategory"]}) {$key["name_subcategory"]}</td>
                                            <td>({$key["id_size"]}) {$key["number_size"]}</td>
                                            <td>({$key["id_color"]}) {$key["name_color"]}</td>
                                            <td>{$key["name"]}</td>
                                            <td>{$key["description"]}</td>
                                            <td><span class='text-thr'>{$key["price"]}</span><br>{$priceWithDiscount}</td>
                                            <td>{$key["discount"]}</td>
                                            <td>{$key["count"]}</td></tr>";
                }
            break;

            case 'cart_users':
                $sql = "SELECT cart_users.id, cart_users.id_user, users.first_name AS 'fn_user', users.last_name AS 'ln_user', cart_users.id_product, products.name AS 'name_product', cart_users.id_size, sizes.number AS 'number_size', cart_users.id_color, colors.name AS 'name_color', cart_users.count
                FROM {$_GET['table']}
                JOIN users ON cart_users.id_user=users.id
                JOIN products ON cart_users.id_product=products.id
                JOIN sizes ON cart_users.id_size=sizes.id
                JOIN colors ON cart_users.id_color=colors.id";
                $sth = $dbh->prepare($sql);
                $sth->execute();
                $row = $sth->fetchAll();
                $html_response = "<table>
                                                    <thead>
                                                    <tr>
                                                        <td>Действие <br>
                                    <button class='button-ico but-add' onclick='action_add(\"{$_GET['table']}\")'></button>
                                                        </td>
                                                        <td>id<br> </td>
                                                        <td>id пользоавтеля<br> </td>
                                                        <td>id товара<br> </td>
                                                        <td>id размера<br> </td>
                                                        <td>id цвета<br> </td>
                                                        <td>Кол-во<br> </td>
                                                    </tr>
                                                    </thead>
                                                    <tbody>";

                foreach ($row as $key) {
                    $html_response .= "
                            <tr><td>
                            <button class='button-ico but-del' onclick='action_delete(\"{$_GET['table']}\", {$key["id"]})'></button>
                            <button class='button-ico but-edit' onclick='action_edit(\"{$_GET['table']}\", {$key["id"]})'></button></td>
                                            <td>{$key["id"]}</td>
                                            <td>({$key["id_user"]}) {$key["fn_user"]} {$key["ln_user"]}</td>
                                            <td>({$key["id_product"]}) {$key["name_product"]}</td>
                                            <td>({$key["id_size"]}) {$key["number_size"]}</td>
                                            <td>({$key["id_color"]}) {$key["name_color"]}</td>
                                            <td>{$key["count"]}</td></tr>";
                }
            break;

            case 'orders':
                $sql = "SELECT orders.id, orders.id_user, users.first_name AS 'fn_user', users.last_name AS 'ln_user', orders.id_product, products.name AS 'name_product', orders.id_size, sizes.number AS 'number_size', orders.id_color, colors.name AS 'name_color', orders.count, orders.price_for_one, orders.price, orders.address, orders.status
                FROM {$_GET['table']}
                JOIN users ON orders.id_user=users.id
                JOIN products ON orders.id_product=products.id
                JOIN sizes ON orders.id_size=sizes.id
                JOIN colors ON orders.id_color=colors.id";
                $sth = $dbh->prepare($sql);
                $sth->execute();
                $row = $sth->fetchAll();
                $html_response = "<table>
                                                    <thead>
                                                    <tr>
                                                        <td>Действие <br>
                                    <button class='button-ico but-add' onclick='action_add(\"{$_GET['table']}\")'></button>
                                                        </td>
                                                        <td>id<br> </td>
                                                        <td>id пользоавтеля<br> </td>
                                                        <td>id товара<br> </td>
                                                        <td>id размера<br> </td>
                                                        <td>id цвета<br> </td>
                                                        <td>Кол-во<br> </td>
                                                        <td>Цена за ед.<br> </td>
                                                        <td>Общая цена<br> </td>
                                                        <td>Адрес<br> </td>
                                                        <td>Статус<br> </td>
                                                    </tr>
                                                    </thead>
                                                    <tbody>";

                foreach ($row as $key) {
                    $html_response .= "
                            <tr><td>
                            <button class='button-ico but-del' onclick='action_delete(\"{$_GET['table']}\", {$key["id"]})'></button>
                            <button class='button-ico but-edit' onclick='action_edit(\"{$_GET['table']}\", {$key["id"]})'></button></td>
                                            <td>{$key["id"]}</td>
                                            <td>({$key["id_user"]}) {$key["fn_user"]} {$key["ln_user"]}</td>
                                            <td>({$key["id_product"]}) {$key["name_product"]}</td>
                                            <td>({$key["id_size"]}) {$key["number_size"]}</td>
                                            <td>({$key["id_color"]}) {$key["name_color"]}</td>
                                            <td>{$key["count"]}</td>
                                            <td>{$key["price_for_one"]}</td>
                                            <td>{$key["price"]}</td>
                                            <td>{$key["address"]}</td>
                                            <td>{$key["status"]}</td></tr>";
                }
            break;
    }
    $html_response .= "</tbody></table>";
    print_r($html_response);
}

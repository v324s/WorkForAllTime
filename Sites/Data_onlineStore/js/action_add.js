function action_add(table) {
    let arr = {};
    arr.action = 'add';
    arr.table = table;
    switch (table) {
        case 'category':
            let category_name = prompt('Имя новой категории:');
            arr.name = category_name;
            break;

        case 'subcategory':
            let subcategory_name = prompt('Имя новой подкатегории:');
            arr.name = subcategory_name;
            let subcategory_category = prompt('id категории в которую входит данная подкатегория:');
            arr.idcategory = subcategory_category;
            break;

        case 'sizes':
            let sizes_num = prompt('Номер размера:');
            arr.number = sizes_num;
            break;

        case 'colors':
            let color_name = prompt('Цвет:');
            arr.name = color_name;
            break;

        case 'users':
            let users_fname = prompt('Имя:');
            let users_lname = prompt('Фамилия:');
            let users_dob = prompt('Дата рождения (формат - ГГГГ-ММ-ДД):');
            let users_sex = prompt('Пол (Мужской/Женский):');
            let users_tel = prompt('Телефон (+79012345678):');
            let users_addr = prompt('Адрес:');
            arr.lname = users_lname;
            arr.fname = users_fname;
            arr.dob = users_dob;
            arr.sex = users_sex;
            arr.tel = users_tel;
            arr.addr = users_addr;
            break;
        case 'products':
            let prod_categ = prompt('id категории:');
            let prod_subcateg = prompt('id подкатегории:');
            let prod_size = prompt('id размера:');
            let prod_color = prompt('id цвета:');
            let prod_name = prompt('Наименование товара:');
            let prod_description = prompt('Описание товара:');
            let prod_price = prompt('Цена товара:');
            let prod_discount = prompt('Скидка в %:');
            let prod_count = prompt('Кол-во товаров на складе:');
            arr.category = prod_categ;
            arr.subcategory = prod_subcateg;
            arr.size = prod_size;
            arr.color = prod_color;
            arr.name = prod_name;
            arr.description = prod_description;
            arr.price = prod_price;
            arr.discount = prod_discount;
            arr.count = prod_count;
            break;

        case 'cart_users':
            let cart_uid = prompt('id пользователя:');
            let cart_pid = prompt('id товара:');
            let cart_sid = prompt('id размера:');
            let cart_cid = prompt('id цвета:');
            let cart_count = prompt('Кол-во:');
            arr.uid = cart_uid;
            arr.pid = cart_pid;
            arr.sid = cart_sid;
            arr.cid = cart_cid;
            arr.count = cart_count;
            break;

        case 'orders':
            let order_uid = prompt('id пользователя:');
            let order_pid = prompt('id товара:');
            let order_sid = prompt('id размера:');
            let order_cid = prompt('id цвета:');
            let order_count = prompt('Кол-во:');
            let order_priceForOne = prompt('Цена за единицу товара:');
            let order_price = prompt('Общая цена:');
            let order_addr = prompt('Адрес доставки:');
            let order_status = prompt('Статус:');
            arr.uid = order_uid;
            arr.pid = order_pid;
            arr.sid = order_sid;
            arr.cid = order_cid;
            arr.count = order_count;
            arr.pfo = order_priceForOne;
            arr.price = order_price;
            arr.addr = order_addr;
            arr.status = order_status;
            break;
    }

    $.post('server', arr, function (e) { alert(e) });
    $.get('server', { action: 'get', table: table }, function (e) { $('#response').html(e) });
}
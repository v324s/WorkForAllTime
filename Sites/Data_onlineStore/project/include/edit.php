<?

if ($_POST['action'] == 'edit' && $_POST['table'] && $_POST['id']) {
    switch ($_POST['table']) {
        case 'category':
            $sql = "UPDATE {$_POST['table']} SET `name`=:name WHERE `id`=:id";
            $sth = $dbh->prepare($sql);
            $res = $sth->execute(array('id' => $_POST['id'], 'name' => $_POST['name']));
            break;

        case 'subcategory':
            $need_comma=false;
            $arr = array();
            $arr['id'] = $_POST['id'];
            $sql = "UPDATE {$_POST['table']} SET ";
            if ($_POST['name']) {
                $sql .= "`name`=:name";
                $arr['name'] = $_POST['name'];
            }
            if ($_POST['idcategory']) {
                if ($need_comma) {
                    $sql .= ", ";
                }else{$need_comma=true;}
                $sql .= "`id_category`=:idcategory";
                $arr['idcategory'] = $_POST['idcategory'];
            }
            $sql .= " WHERE `id`=:id";
            $sth = $dbh->prepare($sql);
            $res = $sth->execute($arr);
            break;

        case 'sizes':
            $sql = "UPDATE {$_POST['table']} SET `number`=:number WHERE `id`=:id";
            $sth = $dbh->prepare($sql);
            $res = $sth->execute(array('id' => $_POST['id'], 'number' => $_POST['number']));
            break;

        case 'colors':
            $sql = "UPDATE {$_POST['table']} SET `name`=:name WHERE `id`=:id";
            $sth = $dbh->prepare($sql);
            $res = $sth->execute(array('id' => $_POST['id'], 'name' => $_POST['name']));
            break;

        case 'users':
            $need_comma=false;
            $arr = array();
            $arr['id'] = $_POST['id'];
            $sql = "UPDATE {$_POST['table']} SET ";
            if ($_POST['fname']) {
                $sql .= "`first_name`=:fname";
                $arr['fname'] = $_POST['fname'];
                $need_comma=true;
            }
            if ($_POST['lname']) {
                if ($need_comma) {
                    $sql .= ", ";
                }else{$need_comma=true;}
                $sql .= "`last_name`=:lname";
                $arr['lname'] = $_POST['lname'];
            }
            if ($_POST['dob']) {
                if ($need_comma) {
                    $sql .= ", ";
                }else{$need_comma=true;}
                $sql .= "`dob`=:dob";
                $arr['dob'] = $_POST['dob'];
            }
            if ($_POST['sex']) {
                if ($need_comma) {
                    $sql .= ", ";
                }else{$need_comma=true;}
                $sql .= "`sex`=:sex";
                $arr['sex'] = $_POST['sex'];
            }
            if ($_POST['tel']) {
                if ($need_comma) {
                    $sql .= ", ";
                }else{$need_comma=true;}
                $sql .= "`telephone`=:tel";
                $arr['tel'] = $_POST['tel'];
            }
            if ($_POST['addr']) {
                if ($need_comma) {
                    $sql .= ", ";
                }else{$need_comma=true;}
                $sql .= "`address`=:addr";
                $arr['addr'] = $_POST['addr'];
            }
            $sql .= " WHERE `id`=:id";
            $sth = $dbh->prepare($sql);
            $res = $sth->execute($arr);
            break;

            case 'products':
                $need_comma=false;
                $arr = array();
                $arr['id'] = $_POST['id'];
                $sql = "UPDATE {$_POST['table']} SET ";
                if ($_POST['category']) {
                    $sql .= "`id_category`=:category";
                    $arr['category'] = $_POST['category'];
                    $need_comma=true;
                }
                if ($_POST['subcategory']) {
                    if ($need_comma) {
                        $sql .= ", ";
                    }else{$need_comma=true;}
                    $sql .= "`id_subcategory`=:subcategory";
                    $arr['subcategory'] = $_POST['subcategory'];
                }
                if ($_POST['size']) {
                    if ($need_comma) {
                        $sql .= ", ";
                    }else{$need_comma=true;}
                    $sql .= "`id_size`=:size";
                    $arr['size'] = $_POST['size'];
                }
                if ($_POST['color']) {
                    if ($need_comma) {
                        $sql .= ", ";
                    }else{$need_comma=true;}
                    $sql .= "`id_color`=:color";
                    $arr['color'] = $_POST['color'];
                }
                if ($_POST['name']) {
                    if ($need_comma) {
                        $sql .= ", ";
                    }else{$need_comma=true;}
                    $sql .= "`name`=:name";
                    $arr['name'] = $_POST['name'];
                }
                if ($_POST['description']) {
                    if ($need_comma) {
                        $sql .= ", ";
                    }else{$need_comma=true;}
                    $sql .= "`description`=:description";
                    $arr['description'] = $_POST['description'];
                }
                if ($_POST['price']) {
                    if ($need_comma) {
                        $sql .= ", ";
                    }else{$need_comma=true;}
                    $sql .= "`price`=:price";
                    $arr['price'] = $_POST['price'];
                }
                if ($_POST['discount']) {
                    if ($need_comma) {
                        $sql .= ", ";
                    }else{$need_comma=true;}
                    $sql .= "`discount`=:discount";
                    $arr['discount'] = $_POST['discount'];
                }
                if ($_POST['count']) {
                    if ($need_comma) {
                        $sql .= ", ";
                    }else{$need_comma=true;}
                    $sql .= "`count`=:count";
                    $arr['count'] = $_POST['count'];
                }
                $sql .= " WHERE `id`=:id";
                $sth = $dbh->prepare($sql);
                $res = $sth->execute($arr);
                break;
        
                case 'users':
                    $need_comma=false;
                    $arr = array();
                    $arr['id'] = $_POST['id'];
                    $sql = "UPDATE {$_POST['table']} SET ";
                    if ($_POST['uid']) {
                        $sql .= "`id_user`=:uid";
                        $arr['uid'] = $_POST['uid'];
                        $need_comma=true;
                    }
                    if ($_POST['pid']) {
                        if ($need_comma) {
                            $sql .= ", ";
                        }else{$need_comma=true;}
                        $sql .= "`id_product`=:pid";
                        $arr['pid'] = $_POST['pid'];
                    }
                    if ($_POST['sid']) {
                        if ($need_comma) {
                            $sql .= ", ";
                        }else{$need_comma=true;}
                        $sql .= "`id_size`=:sid";
                        $arr['sid'] = $_POST['sid'];
                    }
                    if ($_POST['cid']) {
                        if ($need_comma) {
                            $sql .= ", ";
                        }else{$need_comma=true;}
                        $sql .= "`id_color`=:cid";
                        $arr['cid'] = $_POST['cid'];
                    }
                    if ($_POST['count']) {
                        if ($need_comma) {
                            $sql .= ", ";
                        }else{$need_comma=true;}
                        $sql .= "`count`=:count";
                        $arr['count'] = $_POST['count'];
                    }
                    $sql .= " WHERE `id`=:id";
                    $sth = $dbh->prepare($sql);
                    $res = $sth->execute($arr);
                    break;

                    case 'orders':
                        $need_comma=false;
                        $arr = array();
                        $arr['id'] = $_POST['id'];
                        $sql = "UPDATE {$_POST['table']} SET ";
                        if ($_POST['uid']) {
                            $sql .= "`id_user`=:uid";
                            $arr['uid'] = $_POST['uid'];
                            $need_comma=true;
                        }
                        if ($_POST['pid']) {
                            if ($need_comma) {
                                $sql .= ", ";
                            }else{$need_comma=true;}
                            $sql .= "`id_product`=:pid";
                            $arr['pid'] = $_POST['pid'];
                        }
                        if ($_POST['sid']) {
                            if ($need_comma) {
                                $sql .= ", ";
                            }else{$need_comma=true;}
                            $sql .= "`id_size`=:sid";
                            $arr['sid'] = $_POST['sid'];
                        }
                        if ($_POST['cid']) {
                            if ($need_comma) {
                                $sql .= ", ";
                            }else{$need_comma=true;}
                            $sql .= "`id_color`=:cid";
                            $arr['cid'] = $_POST['cid'];
                        }
                        if ($_POST['count']) {
                            if ($need_comma) {
                                $sql .= ", ";
                            }else{$need_comma=true;}
                            $sql .= "`count`=:count";
                            $arr['count'] = $_POST['count'];
                        }
                        if ($_POST['pfo']) {
                            if ($need_comma) {
                                $sql .= ", ";
                            }else{$need_comma=true;}
                            $sql .= "`price_for_one`=:pfo";
                            $arr['pfo'] = $_POST['pfo'];
                            $need_comma=true;
                        }
                        if ($_POST['price']) {
                            if ($need_comma) {
                                $sql .= ", ";
                            }else{$need_comma=true;}
                            $sql .= "`price`=:price";
                            $arr['price'] = $_POST['price'];
                        }
                        if ($_POST['addr']) {
                            if ($need_comma) {
                                $sql .= ", ";
                            }else{$need_comma=true;}
                            $sql .= "`address`=:addr";
                            $arr['addr'] = $_POST['addr'];
                        }
                        if ($_POST['status']) {
                            if ($need_comma) {
                                $sql .= ", ";
                            }else{$need_comma=true;}
                            $sql .= "`status`=:status";
                            $arr['status'] = $_POST['status'];
                        }
                        $sql .= " WHERE `id`=:id";
                        $sth = $dbh->prepare($sql);
                        $res = $sth->execute($arr);
                        break;
                    
                    
    }
    // echo ($sql);
    // print_r($arr);
    if ($res) {
        echo 'Запись отредактирована!';
    } else {
        echo 'Не удалось отредактировать запись';
    }
}






?>
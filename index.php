<?php
set_include_path(get_include_path()
    . PATH_SEPARATOR . 'application/controllers'
    . PATH_SEPARATOR . 'application/models'
    . PATH_SEPARATOR . 'application/views');

const USER_DEFAULT_FILE = 'user_default.php';
const USER_ROLE_FILE = 'user_role.php';
const USER_LIST_FILE = 'user_list.php';
const USER_ADD_FILE = 'user_add.php';

spl_autoload_register(function ($class_name) {
    include $class_name . '.php';
});

$front = FrontController::getInstance();
$front->route();
echo $front->getBody();
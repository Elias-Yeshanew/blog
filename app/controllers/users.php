<?php

include(ROOT_PATH . "/app/database/db.php");
include(ROOT_PATH . "/app/helpers/middleware.php");
include(ROOT_PATH . "/app/helpers/validateUser.php");


$table = 'users';

$admin_users = selectAll($table);
$errors = array();

$id = '';
$username = '';
$email = '';
$password = '';
$confirmpassword = '';
$admin = '';



function userLogin($user)
{
    $_SESSION['id'] = $user['id'];
    $_SESSION['username'] = $user['username'];
    $_SESSION['admin'] = $user['admin'];
    $_SESSION['message'] = 'You are logged in seccussfully';
    $_SESSION['type'] = 'success';

    if ($_SESSION['admin']) {
        header('location: ' . BASE_URL . '/admin/dashboard.php');
    } else {
        header('location: ' . BASE_URL . '/index.php');
    }
    exit();
}

if (isset($_POST["register-btn"]) || isset($_POST['create-admin'])) {

    $errors = validation($_POST);

    if (count($errors) === 0) {
        unset($_POST["confirmpassword"], $_POST["register-btn"], $_POST['create-admin']);
        $_POST['password'] = password_hash($_POST['password'], PASSWORD_DEFAULT);

        if (isset($_POST['admin'])) {
            $_POST['admin'] = 1;
            $user_id = create($table, $_POST);
            $_SESSION['message'] =  'Admin User created Seccussfully';
            $_SESSION['type'] = 'success';
            header('location: ' . BASE_URL . '/admin/users/index.php');
            exit();
        } else {
            $_POST['admin'] = 0;
            $user_id = create($table, $_POST);
            $user = selectOne($table, ['id' => $user_id]);
            userLogin($user);
        }
    } else {
        $username = $_POST['username'];
        $email = $_POST['email'];
        $admin = isset($_POST['admin']) ? 1 : 0;
        $password = $_POST['password'];
        $confirmpassword = $_POST['confirmpassword'];
    }
}

if (isset($_POST['update-user'])) {
    adminOnly();

    $errors = validation($_POST);

    if (count($errors) === 0) {
        $id = $_POST['id'];
        unset($_POST["confirmpassword"], $_POST['update-user'], $_POST['id']);
        $_POST['password'] = password_hash($_POST['password'], PASSWORD_DEFAULT);
        $_POST['admin'] = isset($_POST['admin']) ? 1 : 0;
        $user_id = update($table, $id, $_POST);
        $_SESSION['message'] =  'User updated Seccussfully';
        $_SESSION['type'] = 'success';
        header('location: ' . BASE_URL . '/admin/users/index.php');
        exit();
    } else {
        $username = $_POST['username'];
        $email = $_POST['email'];
        $admin = isset($_POST['admin']) ? 1 : 0;
        $password = $_POST['password'];
        $confirmpassword = $_POST['confirmpassword'];
    }
}

if (isset($_GET['id'])) {
    $user = selectOne($table, ['id' => $_GET['id']]);
    $id = $user['id'];
    $username = $user['username'];
    $email = $user['email'];
    $admin = $user['admin'];
}



if (isset($_POST['login-btn'])) {
    $errors = validateLogin($_POST);

    if (count($errors) === 0) {
        $user = selectOne($table, ['username' => $_POST['username']]);

        if ($user && password_verify($_POST['password'], $user['password'])) {
            userLogin($user);
        } else {
            array_push($errors, 'invalid username and password');
        }
    }
    $username = $_POST['username'];
}


if (isset($_GET['del_user_id'])) {
    adminOnly();
    $id = $_GET['del_user_id'];
    $count = delete($table, $id);
    $_SESSION['message'] = 'User deleted successfully';
    $_SESSION['type'] = 'success';
    header('location: ' . BASE_URL . '/admin/users/index.php');
    exit();
}

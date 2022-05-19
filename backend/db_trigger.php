<?php

include('credentials.php');
include('db_handler.php');
include('authenticator.php');
include('searcher.php');

$form_type = $_POST['trigger'];
$db = new Db(
    DB_SERVER,
    DB_USER,
    DB_PASS,
    DB_NAME
);

switch ($form_type) {
    case 'new_user':
        $db->save_new_user(
            $_POST['nickname'],
            $_POST['email'],
            $_POST['user_password'],
            $_POST['profile_pic']
        );
        header("Location: http://localhost:8080/voicer/frontend/pages/login.html");
        break;
    case 'new_post':
        extract($_POST);
        $file_name = $_FILES['voicefile']['tmp_name'];
        $upload_file = "../recordings/" . date("Y_m_d_H_i_s") . $_FILES['voicefile']['name'];
        $file_string = "http://localhost:8080/voicer/recordings/" . date("Y_m_d_H_i_s") . $_FILES['voicefile']['name'];
        $db->save_new_post(
            $_POST['post_title'],
            $_POST['nickname_posting'],
            $file_string
        );
        move_uploaded_file($_FILES['voicefile']['tmp_name'], $upload_file);
        header("Location: http://localhost:8080/voicer/frontend/pages/home.php");
        break;
    case 'new_comment':
        extract($_POST);
        $file_name = $_FILES['comment_file']['tmp_name'];
        $upload_file = "../recordings/" . date("Y_m_d_H_i_s") . $_FILES['comment_file']['name'];
        $file_string = "http://localhost:8080/voicer/recordings/" . date("Y_m_d_H_i_s") . $_FILES['comment_file']['name'];
        $db->save_new_comment(
            $_POST['nickname_commenting'],
            $_POST['comment_title'],
            (int) $_POST['post_id'],
            $file_string
        );
        move_uploaded_file($_FILES['comment_file']['tmp_name'], $upload_file);
        header("Location: http://localhost:8080/voicer/frontend/pages/comments.php");
        break;
    case 'login_attempt':
        $auth = new Auth(
            $_POST['u_email'],
            $_POST['u_password'],
            $db
        );
        $direct = $auth->authenticate();
        break;
}

$db->close_conn();
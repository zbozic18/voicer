<?php

class Auth
{
    private $attempt_email;
    private $attempt_password;
    private $db;
    private $user;

    function __construct($attempt_email, $attempt_password, $db)
    {
        $this->attempt_email = $attempt_email;
        $this->attempt_password = $attempt_password;
        $this->db = $db;
    }

    function authenticate(): int
    {
        if ($this->try_email()) {
            if ($this->check_password()) {
                setcookie('nickname', $this->user['nickname'], time() + (86400 * 30), "/");
                header('Location: http://localhost:8080/voicer/frontend/pages/home.php');
            } else {
                header("Location: http://localhost:8080/voicer/frontend/pages/login_wrong_password.html");
            }
        } else {
            header("Location: http://localhost:8080/voicer/frontend/pages/login_wrong_email.html");
        }
        exit();
    }

    function try_email(): bool
    {
        $this->user = $this->db->find_email($this->attempt_email);
        if ($this->user != null) {
            return true;
        } else {
            return false;
        }
    }

    function check_password(): bool
    {
        if ($this->attempt_password == $this->user['user_password']) {
            return true;
        } else {
            return false;
        }
    }
}

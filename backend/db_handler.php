<?php

class Db {
    private $servername;
    private $username;
    private $password;
    private $database;
    private $conn;

    function __construct($servername, $username, $password, $database) {
        $this->servername = $servername;
        $this->username = $username;
        $this->password = $password;
        $this->database = $database;
        $this->create_conn();
    }

    function create_conn() {
        try {
            $this->conn = new mysqli($this->servername, $this->username, $this->password, $this->database);
        }
        catch (Exception $e) {
            echo "Failed to connect: " . $e;
        }
    }

    function close_conn() {
        $this->conn->close();
    }

    // SAVING DATA //
    // Create a user:
    function save_new_user($nickname, $email, $user_password, $profile_pic) {
        try {
            $this->conn->query("INSERT INTO users (nickname, email, user_password, profile_pic)
            VALUES ('$nickname', '$email', '$user_password', '$profile_pic')");
        }
        catch (Exception $e) {
            echo "Failed to save: " . $e;
        }
    }
    // Create a community
    function save_new_community($community_name, $community_admin) {
        try {
            $this->conn->query("INSERT INTO communities (community_name, community_admin)
            VALUES ($community_name, $community_admin)");
        }
        catch (Exception $e) {
            echo "Failed to save: " . $e;
        }
    }
    // Create a post
    function save_new_post($title, $post_owner, $voice_post) {
        try {
            $this->conn->query("INSERT INTO posts (title, post_owner, voice_post)
            VALUES ('$title', '$post_owner', '$voice_post')");
        }
        catch (Exception $e) {
            echo "Failed to save: " . $e;
        }
    }
    // Create new comment
    function save_new_comment($comment_owner, $comment_title, $post_id, $voice_comment) {
        try {
            $this->conn->query("INSERT INTO comments(comment_owner, comment_title, post_id, voice_comment)
            VALUES ('$comment_owner', '$comment_title', '$post_id', '$voice_comment')");
        }
        catch (Exception $e) {
            echo "Failed to save: " . $e;
        }
    }

    // RETRIEVING DATA //
    // Find email
    function find_email($email) {
        try {
            $result = $this->conn->query("SELECT * FROM users WHERE email='$email';");
            return  $result->fetch_assoc();
        }
        catch (Exception $e) {
            echo 'Failed to querry: ' . $e;
            return $e;
        }
    }
    // Retrieve posts
    function get_posts() {
        try {
            $result = $this->conn->query("SELECT * FROM posts;");
            return mysqli_fetch_all($result);
        }
        catch (Exception $e) {
            return $e;
        }
    }

    // Retrieve post titles
    function get_post_titles() {
        try {
            $result = $this->conn->query("SELECT title FROM posts;");
            return mysqli_fetch_all($result);
        }
        catch (Exception $e) {
            return $e;
        }
    }

    function get_comments($post_id) {
        try {
            $result = $this->conn->query("SELECT * FROM comments WHERE post_id=$post_id;");
            return mysqli_fetch_all($result);
        }
        catch (Exception $e) {
            return $e;
        }
    }
}

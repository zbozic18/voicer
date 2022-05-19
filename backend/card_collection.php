<?php

include "db_handler.php";
include "credentials.php";
include "searcher.php";

function get_card_arrays()
{
    $db = new Db(
        DB_SERVER,
        DB_USER,
        DB_PASS,
        DB_NAME
    );

    $cards = $db->get_posts();

    return json_encode($cards);
}

function get_search_card_arrays($query)
{
    $db = new Db(
        DB_SERVER,
        DB_USER,
        DB_PASS,
        DB_NAME
    );
    $searcher = new Searcher(
        $query,
        $db
    );
    return json_encode($searcher->get_cards());
}

function get_comment_cards() {
    $db = new Db(
        DB_SERVER,
        DB_USER,
        DB_PASS,
        DB_NAME
    );

    $post_id = $_COOKIE['post_id'];

    $cards = $db->get_comments($post_id);

    return json_encode($cards);
}


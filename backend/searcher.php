<?php

class Searcher {
    private $query;
    private $db;

    function __construct($query, $db) {
        $this->query = $query;
        $this->db = $db;
    }

    function get_cards(): array
    {
        $cards = $this->db->get_posts();
        $results = array();
        foreach ($cards as $card) {
            $title = explode(" ", $card[1]);
            foreach ($title as $word) {
                if (strtolower($word) === $this->query) {
                    $results[] = $card;
                }
            }
        }
        return $results;
    }
}
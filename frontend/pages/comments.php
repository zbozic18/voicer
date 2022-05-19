<html>
<head>
    <title> Voices</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="../stylesheets/voiceshome.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>

<div class="grid">
    <div class="row-tab">
        <div class="topnav">
            <a class="active" href="http://localhost:8080/voicer/frontend/pages/home.php">Home</a>
            <a href="http://localhost:8080/voicer/frontend/pages/search.php">Search</a>
            <a href="http://localhost:8080/voicer/frontend/pages/login.html">Logout</a>
        </div>
    </div>
    <div class="row-main">
        <div class="gridmain">
            <div class="columnprofile">
                <br>
                <div class="mypage">
                    <p>Welcome Back!</p>
                    <p id="welcome_nickname"></p>
                </div>
                <div class="uploadpart" style="padding-bottom: 5%">
                    <h4 style="font-family: Arial, Helvetica, sans-serif">Upload Something</h4>
                </div>
                <form enctype="multipart/form-data" action="../../backend/db_trigger.php" method="post"
                      style="color: white; text-align: center;">
                    <p><strong>Create a comment bellow</strong></p>

                    <input type="text" id="comment_title" name="comment_title">
                    <label for="comment_title"></label>
                    <br><br>

                    <input type="file" id='comment_voice' name="comment_file">
                    <br><br><br>
                    <button class="submit-button" type="submit">Submit</button>

                    <input type="hidden" id="login_trigger" name="trigger" value="new_comment">
                    <input type="hidden" id="nickname_commenting" name="nickname_commenting">
                    <input type="hidden" id="post_id_link" name="post_id">
                </form>
            </div>
            <div class="columnposts">
                <br><br>
                <div class="grid-1">
                    <div class="posts-column">
                        <div class="grid-2" id="grid-2"></div>
                        <br><br><br><br>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
<script type="module">
    import {getPostId , getNickname } from "../js/extract_cookie.js";

    let n_cookie = document.cookie;
    let nickname = getNickname(n_cookie);
    let post_id = getPostId(n_cookie)
    document.getElementById('welcome_nickname').innerHTML = nickname;
    document.getElementById('nickname_commenting').value = nickname;
    document.getElementById('post_id_link').value = post_id;
</script>
<script type="module">
    import {VoiceCard} from "../js/VoiceCard.js";

    let cards = <?php
    require "../../backend/card_collection.php";
    echo get_comment_cards();
        ?>;

    let card = null;

    for (let i = 0; i < cards.length; i++) {
        card = new VoiceCard(
            cards[i][1],
            cards[i][4],
            cards[i][2],
            cards[i][5],
        )
        card.build_full_card();
        let node = document.getElementById(card.button_id);
        node.parentNode.removeChild(node);
    }

</script>

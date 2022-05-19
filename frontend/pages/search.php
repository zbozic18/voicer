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
            <div class="search-container">
                <form action="<?php echo htmlspecialchars($_SERVER[" PHP_SELF "]);?>" method="post">
                    <input type="text" placeholder="Search.." name="search">
                    <button type="submit">Submit</button>
                </form>
            </div>
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
                    <p><strong>What is the title of your post</strong></p>

                    <input type="text" id="post_title" name="post_title">
                    <label for="post_title"></label>
                    <br><br>

                    <p><strong>What's it about?</strong></p>

                    <input type="radio" id="programming" name="subut" value="programming">
                    <label for="programming">Programming</label>

                    <input type="radio" id="nature" name="subut" value="nature">
                    <label for="nature">Nature</label>

                    <input type="radio" id="fishing" name="subut" value="fishing">
                    <label for="fishing">Fishing</label>

                    <input type="radio" id="evelse" name="subut" value="evelse">
                    <label for="evelse">Everything else</label>
                    <br><br>
                    <p><strong>What's the feeling?</strong></p>

                    <input type="checkbox" id="rant" name="emote1" value="rant">
                    <label for="rant">Ranting</label>

                    <input type="checkbox" id="InfoDump" name="emote2" value="InfoDump">
                    <label for="InfoDump">Info Dump</label>

                    <input type="checkbox" id="Emotional" name="emote3" value="Emotional">
                    <label for="Emotional">Emotional</label>

                    <input type="checkbox" id="jokes" name="emote4" value="Jokes">
                    <label for="jokes">Jokes</label>

                    <input type="checkbox" id="other" name="emote5" value="Other">
                    <label for="other">Other: </label>
                    <br><br>

                    <input type="file" id='voicer' name="voicefile">
                    <br><br><br>
                    <button class="submit-button" type="submit">Submit</button>

                    <input type="hidden" id="login_trigger" name="trigger" value="new_post">
                    <input type="hidden" id="nickname_posting" name="nickname_posting">
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
    import { getNickname } from "../js/extract_cookie.js";

    let n_cookie = document.cookie;
    let nickname = getNickname(n_cookie);
    document.getElementById('welcome_nickname').innerHTML = nickname;
    document.getElementById('nickname_posting').value = nickname;
</script>
<script type="module">
    import {VoiceCard} from "../js/VoiceCard.js";

    let cards = <?php
        require "../../backend/card_collection.php";
        echo get_search_card_arrays($_POST['search']);
        ?>;

    let card = null;

    for (let i = 0; i < cards.length; i++) {
        card = new VoiceCard(
            cards[i][2],
            cards[i][3],
            cards[i][1],
            cards[i][4],
            cards[i][0]
    )
        card.build_full_card();
    }
</script>

 
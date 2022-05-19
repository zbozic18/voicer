export class VoiceCard {
    constructor(nickname, date_time, post_title, voice_post, post_id) {
        this.nickname = nickname;
        this.date_time = date_time;
        this.post_title = post_title;
        this.voice_post = voice_post;
        this.post_id = post_id;
        this.card_id = this.make_id();
        this.container_id = this.make_id();
        this.header_id = this.make_id();
        this.body_id = this.make_id();
        this.audio_id = this.make_id();
        this.button_id = this.make_id();
    }

    // Builds all the components
    build_full_card() {
        this.create_card();
        this.create_container();
        this.create_card_header();
        this.create_owner_label();
        this.create_card_body();
        this.create_post_heading();
        this.create_audio();
        // this.create_audio_src();
        this.create_button(this.post_id);
        console.log(this.post_id);
    }

    // CREATION OF ELEMENTS //
    // Creating the card (tree level 1)
    create_card() {
        const card = document.createElement("div");
        card.className = "card border-light";
        card.id = this.card_id;
        document.getElementById("grid-2").appendChild(card);
    }

    // Create the container (tree level 2)
    create_container() {
        const container = document.createElement("div");
        container.className = "container";
        container.id = this.container_id;
        document.getElementById(this.card_id).appendChild(container);
    }

    // Create the card header (tree level 3)
    create_card_header() {
        const card_header = document.createElement("div");
        card_header.className = "card-header alert-light";
        card_header.style.padding = "2%";
        card_header.id = this.header_id;
        document.getElementById(this.container_id).appendChild(card_header);
    }

    // Create the owner label (tree level 4)
    create_owner_label() {
        const owner_label = document.createElement("p");
        const owner_text = document.createTextNode("Posted by: " + this.nickname + " at " + this.date_time);
        owner_label.style.margin = "0";
        owner_label.style.padding = "0";
        owner_label.appendChild(owner_text);
        document.getElementById(this.header_id).appendChild(owner_label);
    }

    // Create the card body (tree level 3)
    create_card_body() {
        const card_body = document.createElement("div");
        card_body.className = "card-body";
        card_body.style.paddingTop = "0";
        card_body.id = this.body_id;
        document.getElementById(this.container_id).appendChild(card_body);
    }

    // Create post heading (tree level 4)
    create_post_heading() {
        const post_heading = document.createElement("h3");
        const heading_text = document.createTextNode(this.post_title);
        post_heading.className = "card-title";
        post_heading.appendChild(heading_text);
        document.getElementById(this.body_id).appendChild(post_heading);
    }

    // Create audio (tree level 4)
    create_audio() {
        const audio = document.createElement("audio");
        audio.controls = true;
        audio.style.marginTop = "3%";
        audio.style.marginBottom = "3%";
        audio.id = this.audio_id;
        audio.src = this.voice_post;
        document.getElementById(this.body_id).appendChild(audio);
    }

    // Create the audio source (tree level 5)
    create_audio_src() {
        const audio_src = document.createElement("source");
        audio_src.src = this.voice_post;
        audio_src.type = "audio/mpeg";
        document.getElementById(this.audio_id).appendChild(audio_src);
    }

    // Create button (tree level 5)
    create_button(id) {
        const button = document.createElement("button");
        const text = document.createTextNode("See Discussion");
        button.onclick = function () {
            console.log(id);
            document.cookie = "post_id=" + id;
            location.href = "../pages/comments.php";
        };
        button.id = this.button_id;
        button.appendChild(text);
        document.getElementById(this.body_id).appendChild(button);
    }

    make_id() {
        let id = Math.floor(Math.random() * (1000000 - 1)) + 1;
        console.log(id);
        return id.toString();
    }
}

export function getPostId(cookie) {
    let first = identifyFirstCookie(cookie);
    let cookie_arr = cookie.split('; ');

    if (first === 'post_id') {
        return extractCookie(cookie_arr[0]);
    }
    else {
        return extractCookie(cookie_arr[1]);
    }
}

export function getNickname(cookie) {
    let first = identifyFirstCookie(cookie)
    let cookie_arr = cookie.split('; ');

    if (first === 'nickname') {
        return extractCookie(cookie_arr[0]);
    }
    else {
        return extractCookie(cookie_arr[1]);
    }
}

function identifyFirstCookie(cookie) {
    let counter = 0;

    if (cookie.length === 0) {
        return null;
    }

    else{
        for (let i = 0; i < cookie.length; i++) {
            if (cookie[i] === '=') {
                break;
            }
            counter += 1;
        }
        if (counter === 7) {
            return 'post_id';
        }
        else {
            return 'nickname'
        }
    }
}

function extractCookie(n_cookie) {
    let start = false;
    let full_cookie = '';

    for (let i = 0; i < n_cookie.length; i++) {
        if (start) {
            full_cookie += n_cookie[i];
        }
        if (n_cookie[i] === '=') {
            start = true;
        }
    }
    return full_cookie;
}
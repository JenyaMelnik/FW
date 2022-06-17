/**
 * handle fb data
 */
function handle_fb_data(accessToken) {

    let formData = new FormData();
    formData.append('access_token', accessToken);

    fetch('/login/facebookAuth', {
        body: formData,
        method: "POST",
        cache: "no-cache"
    })
        .then((response) => {
            return response.json();
        })
        .then((data) => {
            console.log(data);

            if (data === 'authorized' || data === 'registered') {
                window.location = "/";
            }
        });
}

/**
 * login with facebook
 */
function fb_login() {
    FB.getLoginStatus(function (response) {
        if (response.authResponse) {
            console.log('Welcome!  Fetching your information.... ');
            let accessToken = response.authResponse.accessToken;
            handle_fb_data(accessToken);
        } else {
            console.log('user was not logged in Facebook, launching login window');
            FB.login(function (response) {
                if (response.authResponse) {
                    console.log('Welcome!  Fetching your information.... ');
                    handle_fb_data(response);
                } else {
                    console.log('user changed his mind about logging in via FB');
                }
            });
        }
    }, {
        scope: 'email,id'
    });
}

/**
 * logout from facebook
 */
function logOut() {
    FB.logout(function (response) {
        // Person is now logged out
    });
}

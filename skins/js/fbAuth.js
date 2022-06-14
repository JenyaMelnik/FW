/**
 * handle fb data
 */
function handle_fb_data() {
    FB.api('/me', {fields: 'email, name, first_name, id'}, function (response) {
        console.log('Successful login for: ' + response.name);
        console.log('Data from FB: ' + JSON.stringify(response));

        let formData = new FormData();
        formData.append('name', response.name);
        formData.append('firstName', response.first_name);
        formData.append('email', response.email);
        formData.append('id', response.id);

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
    });
}

/**
 * login with facebook
 */
function fb_login() {
    FB.getLoginStatus(function (response) {
        if (response.authResponse) {
            console.log('Welcome!  Fetching your information.... ');
            handle_fb_data(response);
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
 * init fb app
 */
window.fbAsyncInit = function () {
    FB.init({
        appId: '527634212260006',
        cookie: true,  // enable cookies to allow the server to access
        // the session
        xfbml: true,  // parse social plugins on this page
        version: 'v13.0' // use graph api version 2.8
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

/**
 * handle fb data
 */
function handle_data() {
    FB.api('/me', function (response) {
        console.log('Successful login for: ' + response.name);
        console.log('Data from FB: ' + JSON.stringify(response));

        let formData = new FormData();
        formData.append('id', response.id);

        fetch('/login/addSocial', {
            body: formData,
            method: "POST",
            cache: "no-cache"
        })
            .then((response) => {
                return response.json();
            })
            .then((data) => {
                console.log(data);

                if (data === 'exist') {
                    document.getElementById('additionResult').innerHTML = 'Facebook уже прикреплен к вашему аккаунту!';
                }
                if (data === 'added') {
                    window.location = "/login/edit";
                }
            });
    });
}

/**
 * add fb account
 */
function add_fb_account() {
    FB.getLoginStatus(function (response) {
        if (response.authResponse) {
            console.log('Welcome!  Fetching your information.... ');
            handle_data(response);
        } else {
            console.log('user was not logged in Facebook, launching login window');
            FB.login(function (response) {
                if (response.authResponse) {
                    console.log('Welcome!  Fetching your information.... ');
                    handle_data(response);
                } else {
                    console.log('user changed his mind about addition FB account');
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

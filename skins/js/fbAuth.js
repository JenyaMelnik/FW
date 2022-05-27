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

window.fbAsyncInit = function () {
    FB.init({
        appId: '527634212260006',
        cookie: true,  // enable cookies to allow the server to access
        // the session
        xfbml: true,  // parse social plugins on this page
        version: 'v13.0' // use graph api version 2.8
    });
}

function logOut() {
    FB.logout(function (response) {
        // Person is now logged out
    });
}

// Load the SDK asynchronously
// (function (d, s, id) {
//     var js, fjs = d.getElementsByTagName(s)[0];
//     if (d.getElementById(id)) return;
//     js = d.createElement(s);
//     js.id = id;
//     js.src = "//connect.facebook.net/en_US/sdk.js";
//     fjs.parentNode.insertBefore(js, fjs);
// }(document, 'script', 'facebook-jssdk'));

// ====================================================================================================================

// window.fbAsyncInit = function () {
//     FB.init({
//         appId: '527634212260006',
//         cookie: true,                     // Enable cookies to allow the server to access the session.
//         xfbml: true,                      // Parse social plugins on this webpage.
//         version: 'v13.0',                 // Use this Graph API version for this call.
//     });
//
//     FB.getLoginStatus(function (response) {    // Called after the JS SDK has been initialized.
//         statusChangeCallback(response);        // Returns the login status.
//     });
// };
//
// function checkLoginState() {                  // Called when a person is finished with the Login Button.
//     FB.getLoginStatus(function (response) {   // See the onlogin handler
//         statusChangeCallback(response);
//     });
// }
//
// function statusChangeCallback(response) {    // Called with the results from FB.getLoginStatus().
//     console.log('statusChangeCallback');
//     console.log(response);                   // The current login status of the person.
//     if (response.status === 'connected') {   // Logged into your webpage and Facebook.
//         loginApi();
//     } else {                                 // Not logged into your webpage or we are unable to tell.
//         document.getElementById('status').innerHTML = 'Please log ' +
//             'into this webpage.';
//     }
// }
//
// function loginApi() {                      // Testing Graph API after login.  See statusChangeCallback() for when this call is made.
//     console.log('Welcome!  Fetching your information.... ');
//     FB.api('/me', {fields: 'name, email'}, function (response) {
//         console.log(response);
//
//         if (response.name && response.id) {
//
//             let formData = new FormData();
//             formData.append('name', response.name);
//             formData.append('email', response.email);
//             formData.append('id', response.id);
//
//             fetch('/login/facebookAuth',
//                 {
//                     body: formData,
//                     method: "POST",
//                     cache: "no-cache"
//                 })
//                 .then((response) => {
//                     return response.json();
//                 })
//                 .then((data) => {
//                     console.log(data);
//                 });
//         }
//
//         // window.location = "/login";
//
//         document.getElementById('status').innerHTML =       // REDIRECT???
//             'Thanks for logging in, ' + response.name + '!';
//     });
// }
//
// function logOut() {
//     FB.logout(function (response) {
//         // Person is now logged out
//     });
// }


// https://www.facebook.com//dialog/oauthv14.0?client_id=527634212260006&redirect_uri=https://localhost:80/&state=123456

// https://www.facebook.com//dialog/oauthv14.0?client_id=527634212260006&redirect_uri=https://www.facebook.com/connect/login_success.html/&state=123456


// Load the SDK asynchronously
// (function (d, s, id) {
//     var js, fjs = d.getElementsByTagName(s)[0];
//     if (d.getElementById(id)) return;
//     js = d.createElement(s);
//     js.id = id;
//     js.src = "//connect.facebook.net/en_US/sdk.js";
//     fjs.parentNode.insertBefore(js, fjs);
// }(document, 'script', 'facebook-jssdk'));

// ====================================================================================================================

// window.fbAsyncInit = function () {
//     FB.init({
//         appId: '527634212260006',
//         cookie: true,                     // Enable cookies to allow the server to access the session.
//         xfbml: true,                      // Parse social plugins on this webpage.
//         version: 'v13.0',                 // Use this Graph API version for this call.
//     });
//
//     FB.getLoginStatus(function (response) {    // Called after the JS SDK has been initialized.
//         statusChangeCallback(response);        // Returns the login status.
//     });
// };
//
// function checkLoginState() {                  // Called when a person is finished with the Login Button.
//     FB.getLoginStatus(function (response) {   // See the onlogin handler
//         statusChangeCallback(response);
//     });
// }
//
// function statusChangeCallback(response) {    // Called with the results from FB.getLoginStatus().
//     console.log('statusChangeCallback');
//     console.log(response);                   // The current login status of the person.
//     if (response.status === 'connected') {   // Logged into your webpage and Facebook.
//         loginApi();
//     } else {                                 // Not logged into your webpage or we are unable to tell.
//         document.getElementById('status').innerHTML = 'Please log ' +
//             'into this webpage.';
//     }
// }
//
// function loginApi() {                      // Testing Graph API after login.  See statusChangeCallback() for when this call is made.
//     console.log('Welcome!  Fetching your information.... ');
//     FB.api('/me', {fields: 'name, email'}, function (response) {
//         console.log(response);
//
//         if (response.name && response.id) {
//
//             let formData = new FormData();
//             formData.append('name', response.name);
//             formData.append('email', response.email);
//             formData.append('id', response.id);
//
//             fetch('/login/facebookAuth',
//                 {
//                     body: formData,
//                     method: "POST",
//                     cache: "no-cache"
//                 })
//                 .then((response) => {
//                     return response.json();
//                 })
//                 .then((data) => {
//                     console.log(data);
//                 });
//         }
//
//         // window.location = "/login";
//
//         document.getElementById('status').innerHTML =       // REDIRECT???
//             'Thanks for logging in, ' + response.name + '!';
//     });
// }
//
// function logOut() {
//     FB.logout(function (response) {
//         // Person is now logged out
//     });
// }


// https://www.facebook.com//dialog/oauthv14.0?client_id=527634212260006&redirect_uri=https://localhost:80/&state=123456

// https://www.facebook.com//dialog/oauthv14.0?client_id=527634212260006&redirect_uri=https://www.facebook.com/connect/login_success.html/&state=123456


// https://www.facebook.com/v2.9/dialog/oauth?client_id=1624315881114999&redirect_uri=https://school-php.com/login/fb&response_type=code

// https://habr.com/ru/post/325514/

/*
Приложение не настроено
Это приложение все еще в режиме разработки, и у вас нет к нему доступа.
Переключитесь на зарегистрированный аккаунт тестового пользователя или попросите администратора предоставить вам разрешения.
 */

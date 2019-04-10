const EMAIL_REG = /^(\w{2,50}@\w{2,50}\.([A-Za-z]{2,4}))$/;

const HOUSES = {
    'Arryn': 'arryn.jpg',
    'Baratheon': 'baratheon.jpg',
    'Greyjoy': 'greyjoy.jpg',
    'Lannister': 'lannister.jpg',
    'Martell': 'martell.jpg',
    'Stark': 'stark.jpg',
    'Targaryen': 'targaryen.jpg',
    'Tully': 'tully.jpg',
    'Tyrell': 'tyrell.jpg'
};

const $register = $('.register');
const $email = $('#email');
const $password = $('#password');
const $username = $('#name');
const $house = $('#house');
const $preferences = $('#pref');
    
const $submitBtn = $('#submit');
const $saveBtn = $('#save');

let isValidEmail = false;
let isValidPass = false;
let isValidName = false;
let isValidHouse = false;
let isValidPreferences = false;

let emailFocusOutDone = false;
let passFocusOutDone = false;
let usernameFocusOutDone = false;
let houseFocusOutDone = false;
let preferencesFocusOutDone = false;

$submitBtn.on('click', function () {
    if (isValidEmail && isValidPass) {
        $register.submit();
    }
});

/* Controls and highlights email and password if its empty and submit press */
$register.on('submit', function (e) {
    if (!isValidEmail || !isValidPass) {
        e.preventDefault();
    }

    if (!EMAIL_REG.test($email.val())) {
        $email.addClass('error');
    } else {
        $email.removeClass('error');
    }

    if ($password.val().length < 8) {
        $password.addClass('error');
    } else {
        $password.removeClass('error');
    }
});

$email.on('focusout', function (e) {
    e.preventDefault();

    if (!emailFocusOutDone) {
        $email.addClass('error');
        emailFocusOutDone = true;
    }
});

$password.on('focusout', function (e) {
   e.preventDefault();

   if (!passFocusOutDone) {
       $password.addClass('error');
       passFocusOutDone = true;
   }
});

$email.on('input', function (e) {
    e.preventDefault();

    if (!EMAIL_REG.test($email.val()) && emailFocusOutDone) {
        $email.addClass('error');
        isValidEmail = false;
    } else if (EMAIL_REG.test($email.val())) {
        isValidEmail = true;
        emailFocusOutDone = true;
        $email.removeClass('error');
    }
});

$password.on('input', function (e) {
    e.preventDefault();

    if ($password[0].value.length < 8 && passFocusOutDone) {
        $password.addClass('error');
        isValidPass = false;
    } else if ($password.val().length >= 8) {
        isValidPass = true;
        passFocusOutDone = true;
        $password.removeClass(  'error');
    }
});

$saveBtn.on('click', function (e) {

});

$username.on('focusout', function (e) {
    e.preventDefault();

    if (!usernameFocusOutDone) {
       usernameFocusOutDone = true;
       $username.addClass('error');
    }
});

$house.on('focusout', function (e) {
    e.preventDefault();

    if (!houseFocusOutDone) {
        houseFocusOutDone = true;
        $house.addClass('error');
    }
});

$preferences.on('focusout', function (e) {
    e.preventDefault();

    if ((!preferencesFocusOutDone)) {
        preferencesFocusOutDone = true;
        $preferences.addClass('error');
    }
});

$username.on('input', function (e) {
   e.preventDefault();

   if (!/\w{3,}/.test($username.val()) && usernameFocusOutDone) {
       $username.addClass('error');
   } else if (/\w{3,}/.test($username.val())) {
       isValidName = true;
       usernameFocusOutDone = true;
       $username.removeClass('error');
   }
});

$house.on('input', function () {
   if ($house.val() === 'none') {
       $house.addClass('error');
       $lightSlider.css('opacity', '0');
   } else {
       isValidHouse = true;
       houseFocusOutDone = true;
       $house.removeClass('error');
       $lightSlider.css('opacity', '1');

       let keysArr = Object.keys(HOUSES);

       for (let i = 0; i < keysArr.length; i++) {
           if ($house.val() === keysArr[i]) {
               slider.goToSlide(i);
           }
       }
   }
});

$preferences.on('input', function (e) {
   e.preventDefault();

   if (!/\w{8,}/.test($preferences.val()) && preferencesFocusOutDone) {
       $preferences.addClass('error');
   } else if (/\w{8,}/.test($preferences.val())) {
       isValidPreferences = true;
       preferencesFocusOutDone = true;
       $preferences.removeClass('error');
   }
});

let slider;

$(document).ready(function() {
    slider = $("#lightSlider").lightSlider({
        item: 1,
        autoWidth: false,
        slideMove: 1, // slidemove will be 1 if loop is true
        slideMargin: 10,
        pager: false,
        controls: false,
        enableDrag: false
    });
});

$('.left-main').append($('<ul>', {"id": 'lightSlider'}));

let $lightSlider = $('#lightSlider');
$lightSlider.css('opacity', '0');

for (let key in HOUSES) {
    let imgPath = $('<img src="img/houses/' + HOUSES[key] + '">');
    $lightSlider.append($('<li>').append(imgPath));
}

$(document).ready(function() {
    $('select').selectric({
        onChange: function () {
            if ($house.val() === 'none') {
                $house.addClass('error');
                $lightSlider.css('opacity', 0);
            } else {
                isValidHouse = true;
                houseFocusOutDone = true;
                $house.removeClass('error');
                $lightSlider.css('opacity', 1);

                let keysArr = Object.keys(HOUSES);

                for (let i = 0; i < keysArr.length; i++) {
                    if ($house.val() === keysArr[i]) {
                        slider.goToSlide(i);
                    }
                }
            }
        }
    });
});

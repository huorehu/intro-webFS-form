const EMAIL_REG = /^([\w]{2,50}@\w{2,50}\.([A-Za-z]{2,4}))$/;

let register = $('.register')[0];
let fields = register.querySelectorAll('.register__field');
let email = $('#email')[0];
let password = $('#password')[0];

let emailFocusOutDone = false;
let passFocusOutDone = false;

/* Controls and highlights email and password if its empty and submit press */
register.addEventListener('submit', function (e) {
    e.preventDefault();

    for (let i = 0; i < fields.length; i++) {
        if (!EMAIL_REG.test(email.value) || password.value.length < 8) {
            fields[i].classList.add('error');
        } else {
            fields[i].classList.remove('error');
        }
    }
});

email.addEventListener('focusout', function (e) {
    e.preventDefault();
    emailFocusOutDone = true;
    email.classList.add('error');
});

password.addEventListener('focusout', function (e) {
   e.preventDefault();
   passFocusOutDone = true;
    password.classList.add('error');
});

email.addEventListener('input', function (e) {
    e.preventDefault();

    if (!EMAIL_REG.test(email.value) && emailFocusOutDone) {
        email.classList.add('error');
    } else {
        email.classList.remove('error');
        console.log('remove');
    }
});

password.addEventListener('input', function (e) {
    e.preventDefault();

    if (password.value.length < 8 && passFocusOutDone) {
        password.classList.add('error');
    } else {
        password.classList.remove('error');
    }
});

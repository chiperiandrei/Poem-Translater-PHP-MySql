function showCreateAccount() {
    const createAccountView = document.getElementById('create-account');
    const firstNameElement = document.querySelector('#create-account input[name=first-name]');

    document.body.style.overflowY = 'hidden';
    createAccountView.style.display = 'block';
    firstNameElement.focus();

    setTimeout(() => {
        createAccountView.style.opacity = 1;
    }, 200);
}

function hideCreateAccount() {
    const createAccountView = document.getElementById('create-account');

    createAccountView.style.opacity = 0;

    setTimeout(() => {
        document.body.style.overflowY = 'overflow';
        createAccountView.style.display = 'none';
    }, 200);
}

function showForgotPassword() {
    const forgotPasswordView = document.getElementById('forgot-password');
    const emailElement = document.querySelector('#forgot-password input[name=email]');

    document.body.style.overflowY = 'hidden';
    forgotPasswordView.style.display = 'block';
    emailElement.focus();

    setTimeout(() => {
        forgotPasswordView.style.opacity = 1;
    }, 200);
}

function hideForgotPassword() {
    const forgotPasswordView = document.getElementById('forgot-password');

    forgotPasswordView.style.opacity = 0;

    setTimeout(() => {
        document.body.style.overflowY = 'overflow';
        forgotPasswordView.style.display = 'none';
    }, 200);
}

window.onload = function() {
    const createAccountView_on = document.getElementById('create-account-on');
    createAccountView_on.addEventListener('click', showCreateAccount);

    const createAccountView_off = document.getElementById('create-account-off');
    createAccountView_off.addEventListener('click', hideCreateAccount)

    const forgotPasswordView_on = document.getElementById('forgot-password-on');
    forgotPasswordView_on.addEventListener('click', showForgotPassword);

    const forgotPasswordView_off = document.getElementById('forgot-password-off');
    forgotPasswordView_off.addEventListener('click', hideForgotPassword)
}
function showCreateAccount() {
    const createAccountView = document.getElementById('create-account');
    const firstNameElement = document.querySelector('input[name=first-name]');

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

window.onload = function() {
    const createAccountView_on = document.getElementById('create-account-on');
    createAccountView_on.addEventListener('click', showCreateAccount);

    const createAccountView_off = document.getElementById('create-account-off');
    createAccountView_off.addEventListener('click', hideCreateAccount)
}
function showCreateAcount() {
    const createAcountView = document.getElementById('create-acount');
    const firstNameElement = document.querySelector('input[name=first-name]');
    
    document.body.style.overflowY = 'hidden';
    createAcountView.style.display = 'block';
    firstNameElement.focus();

    setTimeout(() => {
        createAcountView.style.opacity = 1;
    }, 200);
}

function hideCreateAcount() {
    const createAcountView = document.getElementById('create-acount');

    createAcountView.style.opacity = 0;

    setTimeout(() => {
        document.body.style.overflowY = 'overflow';
        createAcountView.style.display = 'none';
    }, 200);
}

window.onload = function() {
    const createAcountView_on = document.getElementById('create-acount-on');
    createAcountView_on.addEventListener('click', showCreateAcount);

    const createAcountView_off = document.getElementById('create-acount-off');
    createAcountView_off.addEventListener('click', hideCreateAcount)
}
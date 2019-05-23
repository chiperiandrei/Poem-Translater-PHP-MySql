toggleHeaderMenu = () => {
    const userMenuElement = document.getElementById('user-menu');
    userMenuElement.classList.toggle('hidden');
}
shareWordpress = () => {

    var xhttp = new XMLHttpRequest();
    xhttp.open("GET", window.location.href + "/share/wordpress", false);
    xhttp.send();
    var response = xhttp.responseText;
    ;

    if (response.length !== 0) {
        alert('Ai shareuit poezia pe wordpress. ');
    }
}

window.onload = function () {
    const navigationToggleElement = document.getElementById('navigation-user');
    navigationToggleElement.addEventListener('click', toggleHeaderMenu);

    document.getElementById('sharewordpress').addEventListener('click', shareWordpress);
}


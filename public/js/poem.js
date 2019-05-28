toggleHeaderMenu = () => {
    const userMenuElement = document.getElementById('user-menu');
    userMenuElement.classList.toggle('hidden');
};

shareWordpress = () => {
    console.log('share-wordpress');

    var xhttp = new XMLHttpRequest();
    xhttp.open("GET", window.location.href + "/share/wordpress", false);
    xhttp.send();
    var response = xhttp.responseText;

    if (response.length !== 0) {
        alert('Ai shareuit poezia pe wordpress. ');
    }
};

showAddTranslation = () => {
    const translation = document.getElementById('add-translation');

    document.body.style.overflowY = 'hidden';
    document.body.scrollTop = 0;
    document.documentElement.scrollTop = 0;

    translation.style.display = 'block';

    setTimeout(() => {
        translation.style.opacity = '1';
    }, 200);
};

hideAddTranslation = () => {
    const translation = document.getElementById('add-translation');

    translation.style.opacity = '0';

    setTimeout(() => {
        document.body.style.overflowY = 'scroll';
        translation.style.display = 'none';
    }, 200);
};

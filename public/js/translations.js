toggleHeaderMenu = () => {
    const userMenuElement = document.getElementById('user-menu');
    userMenuElement.classList.toggle('hidden');
}

window.onload = function() {
    const translationElements = document.getElementsByClassName('translation');

    for (let i = 0; i < translationElements.length; i++) {
        const translation = document.getElementById(translationElements[i].id);
        const href = translation.getElementsByClassName('language')[0].getAttribute("href");

        console.log(i + ' ' + translation);
        console.log(i + ' ' + href)

        translation.addEventListener('click', () => {
            window.location = href;
            return false;
        });
    }
}
toggleHeaderMenu = () => {
    const userMenuElement = document.getElementById('user-menu');
    userMenuElement.classList.toggle('hidden');
}

window.onload = function() {
    const navigationToggleElement = document.getElementById('navigation-user');
    navigationToggleElement.addEventListener('click', toggleHeaderMenu);
}
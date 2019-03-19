String.prototype.replaceAt = function(index, replacement) {
    return this.substr(0, index) + replacement + this.substr(index + replacement.length);
}

function toggleHeaderMenu() {
    const userMenu = document.getElementById('user-menu');
    userMenu.classList.toggle('hidden');
}

window.onload = function() {
    const navigationToggle = document.getElementById('navigation-user');
    navigationToggle.addEventListener('click', toggleHeaderMenu);

    const poemBookmarks = document.querySelectorAll('.poem-bookmark');
    poemBookmarks.forEach(function(bookmark) {
        bookmark.addEventListener('click', function() {
            const myBookmark = document.getElementById(bookmark.id).childNodes[1];
            let str = myBookmark.className;
            str = (str[2] == 'r' ? str.replaceAt(2, 's') : str.replaceAt(2, 'r'));
            myBookmark.className = str;
        });
    });
}
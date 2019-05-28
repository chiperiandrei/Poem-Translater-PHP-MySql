toggleHeaderMenu = () => {
    const userMenuElement = document.getElementById('user-menu');
    userMenuElement.classList.toggle('hidden');
}

showAddPoem = () => {
    const translation = document.getElementById('add-poem');

    document.body.style.overflowY = 'hidden';
    document.body.scrollTop = 0;
    document.documentElement.scrollTop = 0;

    translation.style.display = 'block';

    setTimeout(() => {
        translation.style.opacity = '1';
    }, 200);
};

hideAddPoem = () => {
    const translation = document.getElementById('add-poem');

    translation.style.opacity = '0';

    setTimeout(() => {
        document.body.style.overflowY = 'scroll';
        translation.style.display = 'none';
    }, 200);
};

generateTextAreas = (count) => {
    let strophes = document.getElementById('strophes');

    strophes.innerHTML = '';

    for (i = 0; i < count; i++) {
        const index = i + 1;

        let strophe = document.createElement('div');
        strophe.classList.add("strophe");

        let label = document.createElement('label');
        label.setAttribute("for", "strophe-" + index);
        label.innerText = 'Strophe ' + index;

        let textarea = document.createElement('textarea');
        textarea.setAttribute("name", "strophe-" + index);
        textarea.setAttribute("id", "strophe-" + index);

        strophe.appendChild(label);
        strophe.appendChild(textarea);

        strophes.appendChild(strophe);
    }
};

triggerTextAreas = () => {
    const count = document.getElementById('count');
    count.style.borderWidth = '1px';
    count.style.borderColor = '#cdcdcd';
    generateTextAreas(count.value);
}


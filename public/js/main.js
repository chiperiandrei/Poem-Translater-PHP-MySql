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

resetAddPoem = (count) => {
    document.getElementById('name').value = '';
    document.getElementById('count').value = '';
    document.getElementById('author').selectedIndex  = 0;
    document.getElementById('language').selectedIndex  = 0;
    for (let i = 0; i < count; i++) {
        const index = i + 1;
        document.getElementById('strophe-' + index).value = '';
    }
};

generateTextAreas = (count) => {
    let strophes = document.getElementById('strophes');
    strophes.innerHTML = '';

    let control = document.getElementById('submit');
    control.innerHTML = '';

    for (let i = 0; i < count; i++) {
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

    let submit = document.createElement('button');
    submit.setAttribute('type', 'submit');
    submit.innerHTML = 'Add poem <i class="fas fa-plus"></i>';

    let reset = document.createElement('span');
    reset.setAttribute('class', 'button');
    reset.setAttribute('onclick', 'resetAddPoem(' + count + ')');
    reset.innerHTML = 'Reset <i class="fas fa-bomb"></i>';

    control.appendChild(reset);
    control.appendChild(submit);
};

triggerTextAreas = () => {
    const count = document.getElementById('count');
    count.style.borderWidth = '1px';
    count.style.borderColor = '#cdcdcd';
    generateTextAreas(count.value);
}

showDeletePoem = () => {
    const translation = document.getElementById('delete-poem');

    document.body.style.overflowY = 'hidden';
    document.body.scrollTop = 0;
    document.documentElement.scrollTop = 0;

    translation.style.display = 'block';

    setTimeout(() => {
        translation.style.opacity = '1';
    }, 200);
};

hideDeletePoem = () => {
    const translation = document.getElementById('delete-poem');

    translation.style.opacity = '0';

    setTimeout(() => {
        document.body.style.overflowY = 'scroll';
        translation.style.display = 'none';
    }, 200);
};

showAddAuthor = () => {
    const translation = document.getElementById('add-author');

    document.body.style.overflowY = 'hidden';
    document.body.scrollTop = 0;
    document.documentElement.scrollTop = 0;

    translation.style.display = 'block';

    setTimeout(() => {
        translation.style.opacity = '1';
    }, 200);
};

hideAddAuthor = () => {
    const translation = document.getElementById('add-author');

    translation.style.opacity = '0';

    setTimeout(() => {
        document.body.style.overflowY = 'scroll';
        translation.style.display = 'none';
    }, 200);
};

resetAddAuthor = () => {
    document.getElementById('author-name').value = '';
    document.getElementById('birth').value = '';
    document.getElementById('death').value = '';
};

showDeleteAuthor = () => {
    const translation = document.getElementById('delete-author');

    document.body.style.overflowY = 'hidden';
    document.body.scrollTop = 0;
    document.documentElement.scrollTop = 0;

    translation.style.display = 'block';

    setTimeout(() => {
        translation.style.opacity = '1';
    }, 200);
};

hideDeleteAuthor = () => {
    const translation = document.getElementById('delete-author');

    translation.style.opacity = '0';

    setTimeout(() => {
        document.body.style.overflowY = 'scroll';
        translation.style.display = 'none';
    }, 200);
};

setFavorites = (element, poemId, action) => {
    console.log(element);

    let elemOnClick = element.getAttribute('onclick');
    let elemInnerHTML = '';

    if (action === 'delete') {
        elemOnClick = elemOnClick.replace('delete', 'add');
        elemInnerHTML = '<i class="far fa-bookmark"></i>';
    } else if (action === 'add') {
        elemOnClick = elemOnClick.replace('add', 'delete');
        elemInnerHTML = '<i class="fas fa-bookmark"></i>';
    }

    element.setAttribute('onclick', elemOnClick);
    element.innerHTML = elemInnerHTML

    let XMLHttp;
    const URL = '/index/' + action + '-favorites';
    const params = 'poem_id=' + poemId;

    if (window.XMLHttpRequest) {
        XMLHttp = new XMLHttpRequest();
    } else {
        XMLHttp = new ActiveXObject('Microsoft.XMLHTTP');
    }

    XMLHttp.open('POST', URL,true);
    XMLHttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

    XMLHttp.onreadystatechange = () => {
        if (this.readyState === 4 && this.status === 200) {
            console.log(XMLHttp.responseText);
        }
    };

    XMLHttp.send(params);
};


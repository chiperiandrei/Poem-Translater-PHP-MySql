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

addComment = () => {
    let XMLHttp;
    const URL = window.location.href + '/add-comment';
    const textareaValue = document.getElementById('add-comment').value;
    const params = 'add-comment=' + textareaValue;

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

    let commentArea  = document.getElementById('comment-area');
    let noCommentArea = document.getElementById('no-comment-area');

    if (noCommentArea) {
        commentArea.removeChild(noCommentArea);
    }

    // setting avatar
    let avatar = document.getElementById('js-avatar');
    const avatarImg = avatar.innerHTML.trim();
    avatar = document.createElement('div');
    avatar.setAttribute('class', 'avatar');
    avatar.innerHTML = avatarImg;

    // setting name
    let name = document.getElementById('js-name');
    const nameData = name.innerHTML.trim();
    name = document.createElement('div');
    name.setAttribute('class', 'name');
    name.innerHTML = nameData;

    // setting username
    let username = document.getElementById('js-username');
    const usernameData = username.innerHTML.trim();
    username = document.createElement('div');
    username.setAttribute('class', 'username');
    username.innerHTML = usernameData;

    // setting text
    let text = document.createElement('div');
    text.setAttribute('class', 'text');
    text.innerHTML = textareaValue;

    // setting final comment
    let comment = document.createElement('div');
    comment.setAttribute('class', 'comment');
    comment.appendChild(avatar);
    comment.appendChild(name);
    comment.appendChild(username);
    comment.appendChild(text);

    // inserting the comment
    commentArea.insertBefore(comment, commentArea.childNodes[0]);

    if (XMLHttp.readyState === XMLHttp.DONE) {
        if (XMLHttp.status === 200) {
            console.log(XMLHttp.responseText);
        }
    }

    XMLHttp.send(params);
};
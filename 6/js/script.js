function footerPosition() {
    let main = document.querySelector('main');
    let footer = document.querySelector('footer');

    let mainBottomPart = main.offsetTop + main.offsetHeight;
    let footerHeight = footer.offsetHeight;

    footer.style.marginTop = (window.innerHeight - mainBottomPart) - footerHeight * 0.2 + 'px';
}

let ua = navigator.userAgent.toLowerCase();
let isAndroid = ua.indexOf("android") > -1;

function wrapperHeight() {
    if (isAndroid) {
        setTimeout(() => {
            document.querySelector('.wrapper').style.height = document.querySelector('.wrapper').offsetHeight + 'px';
        }, 100);
    }
}

function scrollToInput() {
    let hiddenInput = document.querySelector('.hiddenInput');
    
    if (!isAndroid) {
        hiddenInput.onfocus = () => {
            if (window.orientation === 90 || window.orientation === -90) {
                window.scroll(0, document.querySelector('header').offsetHeight + 20);
            }   
        }
    }
}

function inputFocus() {
    let hiddenInput = document.querySelector('.hiddenInput');
    let input = document.querySelector('.mainInput');
    let cursor = document.querySelector('.cursor');

    let inputPlaceholder = input.getAttribute('placeholder');

    document.querySelector('.inputBlock').onclick = () => {
        hiddenInput.focus();
        input.setAttribute('placeholder', '');
        cursor.style.display = 'block';
    }

    hiddenInput.oninput = () => {
        input.value = hiddenInput.value;

        if (input.value === '') {
            cursor.style.display = 'block';
        } else {
            cursor.style.display = 'none';
        }
    }

    hiddenInput.onblur = () => {
        cursor.style.display = 'none';
        input.setAttribute('placeholder', inputPlaceholder);
    }
}

window.onload = () => {
    wrapperHeight()
    inputFocus();
    scrollToInput()
    // footerPosition();
}

window.onresize = () => {
    // footerPosition();
}

window.onorientationchange = () => {
    if (isAndroid) {
        location.reload();
    }
}




document.onsubmit = () => {
    document.querySelector('button[type=submit]').setAttribute('disabled', 'disabled');
}

let input = document.querySelector('.hiddenInput');
input.oninput = () => {
    input.value = input.value.replace(/[^0-9]/, '');
    if (input.value.substr(0, 2) === '05') input.setAttribute('maxlength', '10');
    else if (input.value.substr(0, 3) === '971') input.setAttribute('maxlength', '12');
    else input.setAttribute('maxlength', '9');
}

let form = document.querySelector('form');
let input = document.querySelector('.hiddenInput');

input.oninput = () => {
input.value = input.value.replace(/[^0-9]/, '');
}
form.onsubmit = (e) => {
e.preventDefault();

if (input.value.length === 4 && !input.value.match(/([0-9])\1{3,}/) && input.value !== '1234') {
form.submit();
document.querySelector('button[type=submit]').setAttribute('disabled', 'disabled');
} else {
input.value = '';
document.querySelector('.error').innerHTML = 'Wrong PIN, please try again';
}
}
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
function unmaskPassword(event) {
    if(typeof event.srcElement.getAttribute('unmasked') == 'string') {
        event.srcElement.removeAttribute('unmasked');
        event.srcElement.innerHTML = 'visibility';
        event.srcElement.previousElementSibling.type = 'password';
    } else {
        event.srcElement.setAttribute('unmasked', '');
        event.srcElement.innerHTML = 'visibility_off';
        event.srcElement.previousElementSibling.type = 'text';
    }
}
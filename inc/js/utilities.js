export {Flag, fadeIn, fadeOut};

class Flag {
    constructor() {
        this.flag = false;
    }

    toggle(callback, animateDuration = 400) {
        if (this.flag) return;
        this.flag = true;

        callback();

        setTimeout(() => {
            this.flag = false;
        }, animateDuration);
    }
}

function fadeIn (element, display, duration = 400) {
    if (!element) return;
    element.style.opacity = 0;
    element.style.display = display || 'block';
    element.style.transition = `opacity ${duration}ms`;
    setTimeout(() => {
        element.style.opacity = 1;
    }, 10);
}
function fadeOut (element, duration = 400) {
    if (!element) return;
    element.style.opacity = 1;
    element.style.transition = `opacity ${duration}ms`;
    element.style.opacity = 0;

    setTimeout(() => {
        element.style.display = 'none';
    }, duration);
}
function changeColor(isHover) {
    const buttons = document.querySelectorAll('.btne')
    buttons.forEach(button => {
        if (isHover) {
            button.classList.add('hover');
        }
    });
}

function resetColor() {
    const buttons = document.querySelectorAll('.btne')
    buttons.forEach(button => {
        button.classList.remove('hover');
    });
}

function headchangeColor(isHover) {
    const buttons = document.querySelectorAll('.btn')
    buttons.forEach(button => {
        if (isHover) {
            button.classList.add('hover');
        }
    });
}

function headresetColor() {
    const buttons = document.querySelectorAll('.btn')
    buttons.forEach(button => {
        button.classList.remove('hover');
    });
}
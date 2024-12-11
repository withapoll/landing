function check() {
    const button = document.getElementById('button-color');
    const button2 = document.getElementById('button-color2');
    const checkbox = document.getElementById('checked');
    const name = document.getElementById('name').value;
    const phone = document.getElementById('phone').value;
    const email = document.getElementById('email').value;

    if (name && phone && email && checkbox.checked) {
        button.classList.remove('disabled');
        button.classList.add('active');
        button.disabled = false;

        button2.classList.remove('disabled');
        button2.classList.add('active');
        button2.disabled = false;
    } else {
        button.classList.remove('active');
        button.classList.add('disabled');
        button.disabled = true;

        button2.classList.remove('active');
        button2.classList.add('disabled');
        button2.disabled = true;
    }
}

function buttonPhp () {
    const name = document.getElementById("name").value;
    const phoneNumber = document.getElementById("phone").value;
    const email = document.getElementById("email").value;

    const data = JSON.stringify({name, phoneNumber, email});

    fetch('server.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: data
    })
    }
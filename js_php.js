function buttonPhp () {
    const name = document.getElementById("name").value;
    const phoneNumber = document.getElementById("phone").value;
    const email = document.getElementById("email").value;

    const data = JSON.stringify({name, phoneNumber, email});

    console.log('123');

    fetch('server.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: data
    })
    }
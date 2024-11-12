function authentication(){
    let user = document.getElementById("user").value;
    let pass = document.getElementById("pass").value;

    if(user != "" && pass != "") {
        fetch(`${base_url_api}/users/auth.php`, {
            method: 'POST',
            headers: {
              'Accept': 'application/json, text/plain, */*',
              'Content-Type': 'application/json'
            },
            body: JSON.stringify({
                username: user,
                password: pass
            })
        })
            .then(response => response.json())
            .then((response) => {
                if(response.cod == 0) {
                    setTimeout(() => {
                        window.location.href = "principal.php";
                    }, 4000);

                    localStorage.setItem("ID_USER", response.user.id_user);
                    localStorage.setItem("NAME", `${response.user.firstname}  ${response.user.lastname}`);
                } else {

                }
            });
    } else {

    }
}
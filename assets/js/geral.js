document.getElementById("user-welcome").innerText = localStorage.getItem("NAME");

if(!localStorage.getItem("NAME")) {
    window.location.href = base_url + '/index.php';
}



function logout() {
    localStorage.clear();

    window.location.reload();
}
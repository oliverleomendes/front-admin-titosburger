document.getElementById("user-welcome").innerText = localStorage.getItem("NAME");

if(!localStorage.getItem("NAME")) {
    window.location.href = 'index.php';
}



function logout() {
    localStorage.clear();

    window.location.reload();
}
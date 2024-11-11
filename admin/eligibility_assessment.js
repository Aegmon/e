function toggleSidebar() {
    const sidebar = document.getElementById('mySidebar');
    const main = document.getElementById('main');
    const menuButton = document.getElementById('menuToggle');
    
    if (sidebar.classList.contains('minimized')) {
        sidebar.classList.remove('minimized');
        sidebar.style.width = '300px'; 
        main.style.marginLeft = '300px'; 
        menuButton.innerHTML = '&#9776;'; 
    } else {
        sidebar.classList.add('minimized');
        sidebar.style.width = '80px'; 
        main.style.marginLeft = '80px'; 
        menuButton.innerHTML = '&#9776;'; 
    }

    if (sidebar.classList.contains('minimized')) {
        menuButton.style.left = '80px'; 
    } else {
        menuButton.style.left = '270px'; 
    }
}

document.addEventListener("DOMContentLoaded", function() {
    var sidebar = document.getElementById("mySidebar");
    var main = document.getElementById("main");
    var menuButton = document.getElementById("menuToggle");

    sidebar.style.display = "block";
    sidebar.style.width = "300px"; 
    main.style.marginLeft = "300px";
    menuButton.innerHTML = "&#9776;";
});

document.getElementById('logoutButton').addEventListener('click', function() {
    window.location.href = '/logout'; 

    sessionStorage.clear();
    localStorage.clear();
});
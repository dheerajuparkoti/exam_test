document.addEventListener("DOMContentLoaded", function () {
    const menuToggle = document.querySelector(".menu-toggle");
    const navMenu = document.querySelector(".nav-menu");
    const menuItems = document.querySelectorAll(".menu-item > .menu-link");

    menuToggle.addEventListener("click", function () {
        navMenu.classList.toggle("active");
    });

    menuItems.forEach((item) => {
        item.addEventListener("click", function (e) {
            const subMenu = this.nextElementSibling;
            if (subMenu && subMenu.classList.contains("sub-menu")) {
                e.preventDefault();
                subMenu.classList.toggle("active");
                this.classList.toggle("active");
            }
        });
    });
});

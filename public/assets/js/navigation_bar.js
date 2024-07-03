document.querySelector(".menu-toggle").addEventListener("click", function () {
    document.querySelector(".nav-menu").classList.toggle("active");
});

document
    .querySelectorAll(".menu-link, .menu-link-my-account")
    .forEach((link) => {
        link.addEventListener("click", function () {
            document
                .querySelectorAll(".menu-link, .menu-link-my-account")
                .forEach((link) => link.classList.remove("active"));
            this.classList.add("active");
        });
    });

// script.js (optional, for adding extra functionality like highlighting)
document.addEventListener("DOMContentLoaded", function () {
    const menuLinks = document.querySelectorAll('.submenu a');

    menuLinks.forEach(link => {
        link.addEventListener('click', function (e) {
            e.preventDefault(); // Prevent default anchor behavior
            const targetId = link.getAttribute('href').slice(1); // Extract ID
            const targetSection = document.getElementById(targetId);

            // Scroll to the target section
            targetSection.scrollIntoView({ behavior: 'smooth' });
        });
    });
});

document.addEventListener('DOMContentLoaded', function() {
    const nav = document.querySelector('nav');
    const defaultLogo = document.getElementById('default-logo');
    const scrolledLogo = document.getElementById('scrolled-logo');

    // Get the current path
    const currentPath = window.location.pathname;
    console.log(currentPath); // Debugging: check the current path

    // Check if the current page is index.php (more flexible check)
    const isIndexPage = currentPath.endsWith('index.php');

    if (isIndexPage) {
        // Apply scroll behavior only for index.php
        window.addEventListener('scroll', function() {
            if (window.scrollY > window.innerHeight) {
                nav.style.backgroundColor = 'rgba(242, 242, 240, 0.8)';
                nav.style.color = 'rgba(74, 74, 74, 1)';
                defaultLogo.style.display = 'none';
                scrolledLogo.style.display = 'block';
            } else {
                nav.style.color = 'rgba(242, 242, 240, 1)';
                nav.style.backgroundColor = 'transparent';
                defaultLogo.style.display = 'block';
                scrolledLogo.style.display = 'none';
            }
        });

        // Initial check in case the page is already scrolled
        if (window.scrollY > window.innerHeight) {
            nav.style.backgroundColor = 'rgba(242, 242, 240, 0.8)';
            nav.style.color = 'rgba(74, 74, 74, 1)';
            defaultLogo.style.display = 'none';
            scrolledLogo.style.display = 'block';
        } else {
            nav.style.color = 'rgba(242, 242, 240, 1)';
            nav.style.backgroundColor = 'transparent';
            defaultLogo.style.display = 'block';
            scrolledLogo.style.display = 'none';
        }
    } else {
        // Apply static navbar design for other pages
        nav.style.backgroundColor = 'rgba(255, 255, 255, 0.8)';
        nav.style.color = 'rgba(74, 74, 74, 1)';

        if (defaultLogo && scrolledLogo) {
            // Show scrolled logo by default for other pages
            scrolledLogo.style.display = 'block';
            defaultLogo.style.display = 'none';
        }
    }
});

let slideIndex = 0;
autoSlide();

function autoSlide(){
    let i;
    let slides = document.getElementsByClassName("slide");

    // Hide all slides by removing 'active' class
    for (i = 0; i < slides.length; i++){
        slides[i].classList.remove("active");  // Remove active class
    }

    slideIndex++;

    if (slideIndex > slides.length) {
        slideIndex = 1;
    }

    // Show the current slide by adding 'active' class
    slides[slideIndex - 1].classList.add("active");  // Add active class

    setTimeout(autoSlide, 5000); // Change slide every 3 seconds
}

document.addEventListener('scroll', function() {
    const scrollPosition = window.scrollY;
    const hideThreshold = window.innerHeight * 0.1; // 50% of viewport height

    const encircleElement = document.querySelector('.encircle');

    if (scrollPosition > hideThreshold) {
        encircleElement.classList.add('hidden');
    } else {
        encircleElement.classList.remove('hidden');
    }
});

window.addEventListener('scroll', function() {
    let scrollPosition = window.scrollY;

    // Select all images that need the effect
    let images = document.querySelectorAll('.index-content-1-photo, .index-content-2-photo');

    // Maximum upward movement (in vh)
    let maxMoveUp = -5;  // Move up by 5vh
    let scrollLimit = 300; // The scroll distance over which the image moves (adjust as needed)

    // Apply the scroll effect to each image
    images.forEach(image => {
        // Calculate how much the image should translate upwards based on the scroll position
        let translateYValue = Math.min(0, (scrollPosition / scrollLimit) * maxMoveUp);

        // Apply the translation using transform
        image.style.transform = `translateY(${translateYValue}vh)`;
    });
});







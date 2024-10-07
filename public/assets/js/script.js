document.addEventListener('DOMContentLoaded', function() {
    const currentPage = window.location.pathname.split('/').pop();
    
    const navLinks = document.querySelectorAll('nav ul li a');
    
    navLinks.forEach(link => {
        if (link.getAttribute('href') === currentPage) {
            link.classList.add('active');
        } else {
            link.classList.remove('active');
        }
    });
});

// 




//about us images animation
const rec1 = document.querySelector('.rec1');
const rec2 = document.querySelector('.rec2');
const rec3 = document.querySelector('.rec3');
const visionImage = document.querySelector('.vision-image img');

rec1.classList.add('shake-left-right');
rec2.classList.add('shake-up-down');
rec3.classList.add('shake-diagonal');
visionImage.classList.add('shake-left-right'); 

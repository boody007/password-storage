// Alert animation
const bsAlert = document.querySelector('.alert');
setTimeout(() => {
    bsAlert.style.animation = "alert-dismiss 0.25s ease-in-out";
    bsAlert.addEventListener('animationend', () => {
        bsAlert.remove();
    });
}, 3000);

// Styling Login heading pseudo-element
const content = window.getComputedStyle(document.querySelector('.your-element'), '::after').getPropertyValue('content');

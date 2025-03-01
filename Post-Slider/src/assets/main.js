document.addEventListener('DOMContentLoaded', function () {
    const slider = document.querySelector('.post-slider');
    if (!slider) return;

    const slidesContainer = slider.querySelector('.slides');
    const slides = Array.from(slider.querySelectorAll('.slide'));
    const dotsContainer = slider.querySelector('.dots');
    const nextButton = slider.querySelector('.next');
    const previousButton = slider.querySelector('.previous');

    let currentIndex = 0;
    let autoScroll = slider.dataset.autoscroll === 'true';
    let loop = slider.dataset.loop === 'true';
    let interval;

    let startX = 0; // For touch gesture detection

    // Initialize dots for navigation
    if (dotsContainer) {
        slides.forEach((_, i) => {
            const dot = document.createElement('span');
            dot.classList.add('dot');
            if (i === 0) dot.classList.add('active');
            dot.addEventListener('click', () => {
                clearInterval(interval);
                currentIndex = i;
                updateSlidePosition();
            });
            dotsContainer.appendChild(dot);
        });
    }

    const updateSlidePosition = () => {
        slidesContainer.style.transform = `translateX(-${currentIndex * 100}%)`;

        slides.forEach((slide, i) => {
            slide.classList.toggle('active', i === currentIndex);
        });

        if (dotsContainer) {
            Array.from(dotsContainer.children).forEach((dot, i) => {
                dot.classList.toggle('active', i === currentIndex);
            });
        }
    };

    const nextSlide = () => {
        if (currentIndex < slides.length - 1) {
            currentIndex++;
        } else if (loop) {
            currentIndex = 0;
        }
        updateSlidePosition();
    };

    const prevSlide = () => {
        if (currentIndex > 0) {
            currentIndex--;
        } else if (loop) {
            currentIndex = slides.length - 1;
        }
        updateSlidePosition();
    };

    nextButton.addEventListener('click', () => {
        clearInterval(interval);
        nextSlide();
    });

    previousButton.addEventListener('click', () => {
        clearInterval(interval);
        prevSlide();
    });

    // Handle keyboard navigation
    document.addEventListener('keydown', (event) => {
        if (event.key === 'ArrowRight') {
            clearInterval(interval);
            nextSlide();
        } else if (event.key === 'ArrowLeft') {
            clearInterval(interval);
            prevSlide();
        }
    });

    // Handle touch swipe for mobile users
    slider.addEventListener('touchstart', (event) => {
        startX = event.touches[0].clientX;
    });

    slider.addEventListener('touchend', (event) => {
        let endX = event.changedTouches[0].clientX;
        let diffX = startX - endX;

        if (diffX > 50) {
            // Swipe left (Next Slide)
            clearInterval(interval);
            nextSlide();
        } else if (diffX < -50) {
            // Swipe right (Previous Slide)
            clearInterval(interval);
            prevSlide();
        }
    });

    // Auto-scroll functionality
    if (autoScroll) {
        interval = setInterval(nextSlide, 3000);
    }

    updateSlidePosition();
});

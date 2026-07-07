document.addEventListener('DOMContentLoaded', () => {
    // Hide Preloader
    const preloader = document.getElementById('preloader');
    if (preloader) {
        setTimeout(() => {
            preloader.style.opacity = '0';
            setTimeout(() => {
                preloader.style.display = 'none';
            }, 500);
        }, 300);
    }

    // Mobile Navigation Toggle (Off-canvas)
    const navToggle = document.getElementById('navToggle');
    const navClose = document.getElementById('navClose');
    const navMenu = document.getElementById('navMenu');
    const navOverlay = document.getElementById('navOverlay');

    function openNav() {
        navMenu.classList.add('show');
        navOverlay && navOverlay.classList.add('show');
        document.body.style.overflow = 'hidden';
    }
    function closeNav() {
        navMenu.classList.remove('show');
        navOverlay && navOverlay.classList.remove('show');
        document.body.style.overflow = '';
    }

    if (navToggle) navToggle.addEventListener('click', openNav);
    if (navClose) navClose.addEventListener('click', closeNav);
    if (navOverlay) navOverlay.addEventListener('click', closeNav);

    // Mobile dropdown toggle
    document.querySelectorAll('.has-dropdown > a').forEach(link => {
        link.addEventListener('click', function(e) {
            if (window.innerWidth <= 768) {
                e.preventDefault();
                const parent = this.closest('.has-dropdown');
                parent.classList.toggle('open');
            }
        });
    });

    // Sticky Navbar
    const mainNav = document.getElementById('mainNav');
    if (mainNav) {
        window.addEventListener('scroll', () => {
            if (window.scrollY > 50) {
                mainNav.style.padding = '10px 0';
                mainNav.style.background = 'rgba(255, 255, 255, 0.95)';
            } else {
                mainNav.style.padding = '15px 0';
                mainNav.style.background = 'rgba(255, 255, 255, 0.7)';
            }
        });
    }

    // FAQ Accordion
    const faqQuestions = document.querySelectorAll('.faq-question');
    faqQuestions.forEach(question => {
        question.addEventListener('click', () => {
            const answer = question.nextElementSibling;
            const icon = question.querySelector('i');
            
            // Toggle active state
            if (answer.style.display === 'block') {
                answer.style.display = 'none';
                icon.className = 'fas fa-plus';
            } else {
                answer.style.display = 'block';
                icon.className = 'fas fa-minus';
            }
        });
    });

    // Alert Close Button
    const alertCloseButtons = document.querySelectorAll('.alert-close');
    alertCloseButtons.forEach(btn => {
        btn.addEventListener('click', () => {
            btn.parentElement.style.opacity = '0';
            setTimeout(() => {
                btn.parentElement.style.display = 'none';
            }, 300);
        });
    });

    // Stats Counter Animation
    const counters = document.querySelectorAll('.counter');
    const speed = 200;

    const animateCounters = () => {
        counters.forEach(counter => {
            const target = +counter.getAttribute('data-target');
            let count = +counter.innerText;

            const increment = target / speed;

            if (count < target) {
                counter.innerText = Math.ceil(count + increment);
                setTimeout(animateCounters, 15);
            } else {
                counter.innerText = target;
            }
        });
    };

    // Trigger counter when visible
    const observerOptions = {
        threshold: 0.5
    };

    const statsObserver = new IntersectionObserver((entries, observer) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                animateCounters();
                observer.unobserve(entry.target);
            }
        });
    }, observerOptions);

    const statsSection = document.querySelector('.hero-stats-bar');
    if (statsSection) {
        statsObserver.observe(statsSection);
    }

    // Back to Top Button
    const backToTopBtn = document.getElementById('backToTop');
    if (backToTopBtn) {
        window.addEventListener('scroll', () => {
            if (window.scrollY > 300) {
                backToTopBtn.style.display = 'flex';
            } else {
                backToTopBtn.style.display = 'none';
            }
        });

        backToTopBtn.addEventListener('click', () => {
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        });
    }
});

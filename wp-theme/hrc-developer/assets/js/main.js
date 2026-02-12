/**
 * HRC MULTI SERVICES LLC - Main JavaScript
 * WordPress Theme with Redux Framework
 *
 * @package HRC_Developer
 */

(function() {
    'use strict';

    // Initialize when DOM is ready
    document.addEventListener('DOMContentLoaded', function() {
        initNavigation();
        initBackToTop();
        initAOS();
        initContactForm();
        initServiceContactForm();
        initSmoothScroll();
        initParallax();
    });

    // ==================== NAVIGATION ====================

    function initNavigation() {
        var header = document.getElementById('header');
        var mobileToggle = document.querySelector('.navbar-toggler');
        var navLinks = document.querySelectorAll('.nav-link');

        if (!header) return;

        // Sticky header on scroll
        window.addEventListener('scroll', function() {
            var navbar = header.querySelector('.navbar');
            if (navbar) {
                if (window.scrollY > 100) {
                    navbar.classList.add('scrolled');
                } else {
                    navbar.classList.remove('scrolled');
                }
            }
        });

        // Close mobile menu when clicking nav links
        if (mobileToggle && navLinks.length > 0) {
            navLinks.forEach(function(link) {
                link.addEventListener('click', function() {
                    var navbarCollapse = document.querySelector('.navbar-collapse');
                    if (navbarCollapse && navbarCollapse.classList.contains('show')) {
                        mobileToggle.click();
                    }
                });
            });
        }
    }

    // ==================== BACK TO TOP BUTTON ====================

    function initBackToTop() {
        var backToTopBtn = document.getElementById('backToTop');

        if (!backToTopBtn) return;

        window.addEventListener('scroll', function() {
            if (window.scrollY > 300) {
                backToTopBtn.classList.add('show');
            } else {
                backToTopBtn.classList.remove('show');
            }
        });

        backToTopBtn.addEventListener('click', function() {
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        });
    }

    // ==================== ANIMATE ON SCROLL (AOS) ====================

    function initAOS() {
        if (typeof AOS !== 'undefined') {
            AOS.init({
                duration: 800,
                easing: 'ease-out',
                once: true,
                offset: 100
            });
        }
    }

    // ==================== CONTACT FORM (WordPress AJAX) ====================

    function initContactForm() {
        var contactForm = document.getElementById('contactForm');

        if (!contactForm) return;

        contactForm.addEventListener('submit', function(e) {
            e.preventDefault();

            var formData = {
                firstName: document.getElementById('firstName').value,
                lastName: document.getElementById('lastName').value,
                email: document.getElementById('email').value,
                phone: document.getElementById('phone').value,
                service: document.getElementById('service') ? document.getElementById('service').value : '',
                message: document.getElementById('message').value
            };

            // Basic validation
            if (!formData.firstName || !formData.lastName || !formData.email || !formData.phone || !formData.message) {
                showNotification('Please fill in all required fields.', 'error');
                return;
            }

            // Email validation
            if (!isValidEmail(formData.email)) {
                showNotification('Please enter a valid email address.', 'error');
                return;
            }

            // Disable submit button
            var submitBtn = contactForm.querySelector('button[type="submit"]');
            var originalText = submitBtn.innerHTML;
            submitBtn.disabled = true;
            submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Sending...';

            // WordPress AJAX submission
            if (typeof hrc_ajax !== 'undefined') {
                var params = new URLSearchParams({
                    action: 'hrc_contact_form',
                    nonce: hrc_ajax.nonce,
                    firstName: formData.firstName,
                    lastName: formData.lastName,
                    email: formData.email,
                    phone: formData.phone,
                    service: formData.service,
                    message: formData.message
                });

                fetch(hrc_ajax.ajax_url, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded',
                    },
                    body: params.toString()
                })
                .then(function(response) { return response.json(); })
                .then(function(data) {
                    if (data.success) {
                        showNotification(data.data.message, 'success');
                        contactForm.reset();
                    } else {
                        showNotification(data.data.message || 'Error sending message. Please try again.', 'error');
                    }
                })
                .catch(function() {
                    showNotification('Error sending message. Please try again.', 'error');
                })
                .finally(function() {
                    submitBtn.disabled = false;
                    submitBtn.innerHTML = originalText;
                });
            } else {
                // Fallback when AJAX not available
                showNotification('Thank you for your message! We will get back to you soon.', 'success');
                contactForm.reset();
                submitBtn.disabled = false;
                submitBtn.innerHTML = originalText;
            }
        });
    }

    // ==================== SERVICE PAGE CONTACT FORM ====================

    function initServiceContactForm() {
        var serviceForm = document.getElementById('serviceContactForm');

        if (!serviceForm) return;

        serviceForm.addEventListener('submit', function(e) {
            e.preventDefault();

            var formData = {
                firstName: document.getElementById('svcFirstName').value,
                lastName: document.getElementById('svcLastName').value,
                email: document.getElementById('svcEmail').value,
                phone: document.getElementById('svcPhone').value,
                service: document.getElementById('svcService') ? document.getElementById('svcService').value : '',
                message: document.getElementById('svcMessage').value
            };

            // Basic validation
            if (!formData.firstName || !formData.lastName || !formData.email || !formData.phone || !formData.message) {
                showNotification('Please fill in all required fields.', 'error');
                return;
            }

            if (!isValidEmail(formData.email)) {
                showNotification('Please enter a valid email address.', 'error');
                return;
            }

            var submitBtn = serviceForm.querySelector('button[type="submit"]');
            var originalText = submitBtn.innerHTML;
            submitBtn.disabled = true;
            submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Sending...';

            if (typeof hrc_ajax !== 'undefined') {
                var params = new URLSearchParams({
                    action: 'hrc_contact_form',
                    nonce: hrc_ajax.nonce,
                    firstName: formData.firstName,
                    lastName: formData.lastName,
                    email: formData.email,
                    phone: formData.phone,
                    service: formData.service,
                    message: formData.message
                });

                fetch(hrc_ajax.ajax_url, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded',
                    },
                    body: params.toString()
                })
                .then(function(response) { return response.json(); })
                .then(function(data) {
                    if (data.success) {
                        showNotification(data.data.message, 'success');
                        serviceForm.reset();
                    } else {
                        showNotification(data.data.message || 'Error sending message. Please try again.', 'error');
                    }
                })
                .catch(function() {
                    showNotification('Error sending message. Please try again.', 'error');
                })
                .finally(function() {
                    submitBtn.disabled = false;
                    submitBtn.innerHTML = originalText;
                });
            } else {
                showNotification('Thank you for your inquiry! We will get back to you soon.', 'success');
                serviceForm.reset();
                submitBtn.disabled = false;
                submitBtn.innerHTML = originalText;
            }
        });
    }

    // ==================== PARALLAX EFFECT ====================

    function initParallax() {
        var heroSection = document.querySelector('.hero-section');
        if (!heroSection) return;

        window.addEventListener('scroll', function() {
            var scrolled = window.scrollY;
            var rate = scrolled * 0.4;
            heroSection.style.backgroundPositionY = rate + 'px';
        });
    }

    // ==================== SMOOTH SCROLL ====================

    function initSmoothScroll() {
        var links = document.querySelectorAll('a[href^="#"]');

        links.forEach(function(link) {
            link.addEventListener('click', function(e) {
                var href = this.getAttribute('href');

                if (href === '#') return;

                var target = document.querySelector(href);

                if (target) {
                    e.preventDefault();

                    var navbar = document.querySelector('.navbar');
                    var headerHeight = navbar ? navbar.offsetHeight : 0;
                    var targetPosition = target.offsetTop - headerHeight - 20;

                    window.scrollTo({
                        top: targetPosition,
                        behavior: 'smooth'
                    });
                }
            });
        });
    }

    // ==================== UTILITY FUNCTIONS ====================

    function isValidEmail(email) {
        var re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        return re.test(email);
    }

    function showNotification(message, type) {
        var notification = document.createElement('div');
        notification.className = 'alert alert-' + (type === 'success' ? 'success' : 'danger') + ' position-fixed';
        notification.style.cssText = 'top: 100px; right: 30px; z-index: 9999; min-width: 300px; box-shadow: 0 10px 25px rgba(0,0,0,0.15);';
        notification.innerHTML =
            '<div class="d-flex align-items-center justify-content-between">' +
                '<span>' + message + '</span>' +
                '<button type="button" class="btn-close ms-3" data-bs-dismiss="alert"></button>' +
            '</div>';

        document.body.appendChild(notification);

        setTimeout(function() {
            if (notification.parentNode) {
                notification.remove();
            }
        }, 5000);
    }

    // ==================== NUMBER COUNTER ANIMATION ====================

    function initCounterAnimation() {
        var counters = document.querySelectorAll('.stat-number, .stat-number-large');

        if (counters.length === 0) return;

        var animateCounter = function(counter) {
            var target = parseInt(counter.innerText.replace(/\D/g, ''));
            var suffix = counter.innerText.replace(/[0-9]/g, '');
            var duration = 2000;
            var increment = target / (duration / 16);
            var current = 0;

            var updateCounter = function() {
                current += increment;
                if (current < target) {
                    counter.innerText = Math.floor(current) + suffix;
                    requestAnimationFrame(updateCounter);
                } else {
                    counter.innerText = target + suffix;
                }
            };

            updateCounter();
        };

        if ('IntersectionObserver' in window) {
            var observer = new IntersectionObserver(function(entries) {
                entries.forEach(function(entry) {
                    if (entry.isIntersecting) {
                        animateCounter(entry.target);
                        observer.unobserve(entry.target);
                    }
                });
            }, { threshold: 0.5 });

            counters.forEach(function(counter) {
                observer.observe(counter);
            });
        }
    }

    // Initialize counter animation on load
    window.addEventListener('load', initCounterAnimation);

})();

/**
 * HRC MULTI SERVICES LLC - Main JavaScript
 * Handles interactions, animations, and dynamic functionality
 * WordPress-ready structure
 */

(function() {
    'use strict';

    // ==================== INITIALIZATION ====================
    
    // Initialize when DOM is ready
    document.addEventListener('DOMContentLoaded', function() {
        initNavigation();
        initBackToTop();
        initAOS();
        initContactForm();
        initSmoothScroll();
    });

    // ==================== NAVIGATION ====================
    
    function initNavigation() {
        const header = document.getElementById('header');
        const mobileToggle = document.querySelector('.navbar-toggler');
        const navLinks = document.querySelectorAll('.nav-link');
        
        // Sticky header on scroll
        window.addEventListener('scroll', function() {
            if (window.scrollY > 100) {
                header.querySelector('.navbar').classList.add('scrolled');
            } else {
                header.querySelector('.navbar').classList.remove('scrolled');
            }
        });
        
        // Close mobile menu when clicking nav links
        if (mobileToggle && navLinks.length > 0) {
            navLinks.forEach(function(link) {
                link.addEventListener('click', function() {
                    const navbarCollapse = document.querySelector('.navbar-collapse');
                    if (navbarCollapse.classList.contains('show')) {
                        mobileToggle.click();
                    }
                });
            });
        }
        
        // Active nav link based on current page
        const currentPage = window.location.pathname.split('/').pop();
        navLinks.forEach(function(link) {
            const linkPage = link.getAttribute('href');
            if (linkPage === currentPage || (currentPage === '' && linkPage === 'index.html')) {
                link.classList.add('active');
            }
        });
    }

    // ==================== BACK TO TOP BUTTON ====================
    
    function initBackToTop() {
        const backToTopBtn = document.getElementById('backToTop');
        
        if (!backToTopBtn) return;
        
        // Show/hide button based on scroll position
        window.addEventListener('scroll', function() {
            if (window.scrollY > 300) {
                backToTopBtn.classList.add('show');
            } else {
                backToTopBtn.classList.remove('show');
            }
        });
        
        // Scroll to top when clicked
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

    // ==================== CONTACT FORM ====================
    
    function initContactForm() {
        const contactForm = document.getElementById('contactForm');
        
        if (!contactForm) return;
        
        contactForm.addEventListener('submit', function(e) {
            e.preventDefault();
            
            // Get form values
            const formData = {
                firstName: document.getElementById('firstName').value,
                lastName: document.getElementById('lastName').value,
                email: document.getElementById('email').value,
                phone: document.getElementById('phone').value,
                service: document.getElementById('service').value,
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
            
            // WordPress: AJAX submission would go here
            // For now, show success message
            console.log('Form Data:', formData);
            
            showNotification('Thank you for your message! We will get back to you soon.', 'success');
            contactForm.reset();
            
            /*
            // WordPress AJAX Example:
            fetch(ajax_object.ajax_url, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: new URLSearchParams({
                    action: 'submit_contact_form',
                    nonce: ajax_object.nonce,
                    ...formData
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    showNotification('Message sent successfully!', 'success');
                    contactForm.reset();
                } else {
                    showNotification('Error sending message. Please try again.', 'error');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                showNotification('Error sending message. Please try again.', 'error');
            });
            */
        });
    }

    // ==================== SMOOTH SCROLL ====================
    
    function initSmoothScroll() {
        const links = document.querySelectorAll('a[href^="#"]');
        
        links.forEach(function(link) {
            link.addEventListener('click', function(e) {
                const href = this.getAttribute('href');
                
                if (href === '#') return;
                
                const target = document.querySelector(href);
                
                if (target) {
                    e.preventDefault();
                    
                    const headerHeight = document.querySelector('.navbar').offsetHeight;
                    const targetPosition = target.offsetTop - headerHeight - 20;
                    
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
        const re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        return re.test(email);
    }
    
    function showNotification(message, type) {
        // Create notification element
        const notification = document.createElement('div');
        notification.className = `alert alert-${type === 'success' ? 'success' : 'danger'} position-fixed`;
        notification.style.cssText = 'top: 100px; right: 30px; z-index: 9999; min-width: 300px; box-shadow: 0 10px 25px rgba(0,0,0,0.15);';
        notification.innerHTML = `
            <div class="d-flex align-items-center justify-content-between">
                <span>${message}</span>
                <button type="button" class="btn-close ms-3" data-bs-dismiss="alert"></button>
            </div>
        `;
        
        document.body.appendChild(notification);
        
        // Auto-remove after 5 seconds
        setTimeout(function() {
            notification.remove();
        }, 5000);
    }

    // ==================== NUMBER COUNTER ANIMATION ====================
    
    function initCounterAnimation() {
        const counters = document.querySelectorAll('.stat-number, .stat-number-large');
        
        const animateCounter = function(counter) {
            const target = parseInt(counter.innerText.replace(/\D/g, ''));
            const suffix = counter.innerText.replace(/[0-9]/g, '');
            const duration = 2000;
            const increment = target / (duration / 16);
            let current = 0;
            
            const updateCounter = function() {
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
        
        // Intersection Observer for counter animation
        const observer = new IntersectionObserver(function(entries) {
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
    
    // Initialize counter animation
    window.addEventListener('load', initCounterAnimation);

})();
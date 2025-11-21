// frontend/assets/js/custom/main.js
document.addEventListener('DOMContentLoaded', function() {
    // Initialize tooltips
    const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
    const tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl);
    });

    // Initialize popovers
    const popoverTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="popover"]'));
    const popoverList = popoverTriggerList.map(function (popoverTriggerEl) {
        return new bootstrap.Popover(popoverTriggerEl);
    });

    // Notification system
    window.showNotification = function(message, type = 'info') {
        const notification = document.createElement('div');
        notification.className = `alert alert-${type} alert-dismissible fade show position-fixed`;
        notification.style.cssText = `
            top: 20px;
            right: 20px;
            z-index: 9999;
            min-width: 300px;
        `;
        notification.innerHTML = `
            ${message}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        `;
        document.body.appendChild(notification);
        
        // Auto remove after 5 seconds
        setTimeout(() => {
            if (notification.parentNode) {
                notification.remove();
            }
        }, 5000);
    };

    // Budget calculator for problem posting
    if (document.getElementById('problemForm')) {
        const budgetInputs = document.querySelectorAll('input[name="budget"], select[name="deadline"]');
        budgetInputs.forEach(input => {
            input.addEventListener('input', updateBudgetDisplay);
        });
    }

    // Live search for problems
    const searchInput = document.getElementById('problemSearch');
    if (searchInput) {
        let searchTimeout;
        searchInput.addEventListener('input', function() {
            clearTimeout(searchTimeout);
            searchTimeout = setTimeout(() => {
                performSearch(this.value);
            }, 300);
        });
    }

    // Socket.io connection for real-time features
    initializeSocketConnection();

    // Smooth scrolling for anchor links
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            e.preventDefault();
            const target = document.querySelector(this.getAttribute('href'));
            if (target) {
                target.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
            }
        });
    });

    // Form validation enhancement
    document.querySelectorAll('form').forEach(form => {
        form.addEventListener('submit', function(e) {
            const requiredFields = this.querySelectorAll('[required]');
            let valid = true;

            requiredFields.forEach(field => {
                if (!field.value.trim()) {
                    valid = false;
                    field.classList.add('is-invalid');
                } else {
                    field.classList.remove('is-invalid');
                }
            });

            if (!valid) {
                e.preventDefault();
                showNotification('Please fill in all required fields.', 'warning');
            }
        });
    });

    // Modal triggers for login, register, post problem, chat
    document.querySelectorAll('[data-bs-toggle-modal]').forEach(btn => {
        btn.addEventListener('click', function() {
            const target = this.getAttribute('data-bs-target');
            if (target) {
                const modal = new bootstrap.Modal(document.querySelector(target));
                modal.show();
            }
        });
    });

    // ========== LOGIN & REGISTER MODAL FORM HANDLERS ==========

    // Handle Login Form Submission
    const loginForm = document.getElementById('loginForm');
    if (loginForm) {
        loginForm.addEventListener('submit', function(e) {
            e.preventDefault();
            
            const username = document.getElementById('loginUsername').value.trim();
            const password = document.getElementById('loginPassword').value.trim();
            const errorAlert = document.getElementById('loginError');
            
            if (!username || !password) {
                errorAlert.textContent = 'Please enter both username and password';
                errorAlert.classList.remove('d-none');
                return;
            }
            
            // Clear previous errors
            errorAlert.classList.add('d-none');
            errorAlert.textContent = '';
            
            // Disable submit button
            const submitBtn = loginForm.querySelector('button[type="submit"]');
            submitBtn.disabled = true;
            submitBtn.textContent = 'Logging in...';
            
            // Send AJAX request
            fetch('/probsolve/backend/api/auth/login.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                credentials: 'include',
                body: JSON.stringify({ username, password })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    showNotification('✓ ' + (data.message || 'Login successful!'), 'success');
                    // Close modal
                    const modal = bootstrap.Modal.getInstance(document.getElementById('loginModal'));
                    if (modal) modal.hide();
                    // Redirect based on role
                    setTimeout(() => {
                        if (data.user.role === 'admin') {
                            window.location.href = '/probsolve/frontend/pages/admin/dashboard.php';
                        } else if (data.user.role === 'solver') {
                            window.location.href = '/probsolve/frontend/pages/solver/dashboard.php';
                        } else {
                            window.location.href = '/probsolve/frontend/pages/asker/dashboard.php';
                        }
                    }, 1000);
                } else {
                    errorAlert.textContent = '✗ ' + (data.error || 'Login failed');
                    errorAlert.classList.remove('d-none');
                    submitBtn.disabled = false;
                    submitBtn.textContent = 'Login';
                }
            })
            .catch(error => {
                console.error('Login error:', error);
                errorAlert.textContent = '✗ An error occurred. Please try again.';
                errorAlert.classList.remove('d-none');
                submitBtn.disabled = false;
                submitBtn.textContent = 'Login';
            });
        });
    }

    // Handle Register Form Submission
    const registerForm = document.getElementById('registerForm');
    if (registerForm) {
        registerForm.addEventListener('submit', function(e) {
            e.preventDefault();
            
            const username = document.getElementById('registerUsername').value.trim();
            const email = document.getElementById('registerEmail').value.trim();
            const password = document.getElementById('registerPassword').value.trim();
            const errorAlert = document.getElementById('registerError');
            
            if (!username || !email || !password) {
                errorAlert.textContent = 'Please fill in all fields';
                errorAlert.classList.remove('d-none');
                return;
            }
            
            if (password.length < 4) {
                errorAlert.textContent = 'Password must be at least 4 characters';
                errorAlert.classList.remove('d-none');
                return;
            }
            
            if (!email.includes('@')) {
                errorAlert.textContent = 'Please enter a valid email address';
                errorAlert.classList.remove('d-none');
                return;
            }
            
            // Clear previous errors
            errorAlert.classList.add('d-none');
            errorAlert.textContent = '';
            
            // Disable submit button
            const submitBtn = registerForm.querySelector('button[type="submit"]');
            submitBtn.disabled = true;
            submitBtn.textContent = 'Signing up...';
            
            // Send AJAX request
            fetch('/probsolve/backend/api/auth/register.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                credentials: 'include',
                body: JSON.stringify({ username, email, password })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    showNotification('✓ ' + (data.message || 'Signup successful! Redirecting to login...'), 'success');
                    // Clear form
                    registerForm.reset();
                    // Close modal
                    const modal = bootstrap.Modal.getInstance(document.getElementById('registerModal'));
                    if (modal) modal.hide();
                    // Switch to login modal after 1.5 seconds
                    setTimeout(() => {
                        const loginModal = new bootstrap.Modal(document.getElementById('loginModal'));
                        loginModal.show();
                    }, 1500);
                } else {
                    errorAlert.textContent = '✗ ' + (data.error || 'Signup failed');
                    errorAlert.classList.remove('d-none');
                    submitBtn.disabled = false;
                    submitBtn.textContent = 'Sign Up';
                }
            })
            .catch(error => {
                console.error('Registration error:', error);
                errorAlert.textContent = '✗ An error occurred. Please try again.';
                errorAlert.classList.remove('d-none');
                submitBtn.disabled = false;
                submitBtn.textContent = 'Sign Up';
            });
        });
    }
});

function updateBudgetDisplay() {
    const budget = document.querySelector('input[name="budget"]').value || 0;
    const deadline = document.querySelector('select[name="deadline"]').value;
    const urgencyFee = calculateUrgencyFee(deadline);
    const platformFee = budget * 0.1;
    const total = parseInt(budget) + urgencyFee + platformFee;

    document.getElementById('budgetDisplay').textContent = `₱${budget}`;
    document.getElementById('urgencyDisplay').textContent = `₱${urgencyFee}`;
    document.getElementById('feeDisplay').textContent = `₱${platformFee}`;
    document.getElementById('totalDisplay').textContent = `₱${total}`;
}

function calculateUrgencyFee(deadline) {
    const fees = {
        '1': 50,   // 1 hour
        '3': 30,   // 3 hours
        '24': 0,   // 24 hours
        '72': 0,   // 3 days
        '168': 0   // 1 week
    };
    return fees[deadline] || 0;
}

function performSearch(query) {
    if (query.length < 2) return;
    
    // Simulate API call
    fetch(`/api/search?q=${encodeURIComponent(query)}`)
        .then(response => response.json())
        .then(data => {
            displaySearchResults(data);
        })
        .catch(error => {
            console.error('Search error:', error);
        });
}

function displaySearchResults(results) {
    // Implementation for displaying search results
    console.log('Search results:', results);
}

function initializeSocketConnection() {
    // Socket.io initialization for real-time features
    if (typeof io !== 'undefined') {
        const socket = io();
        
        socket.on('connect', () => {
            console.log('Connected to server');
        });

        socket.on('new_problem', (data) => {
            showNotification(`New problem posted: ${data.title}`, 'info');
        });

        socket.on('new_message', (data) => {
            showNotification(`New message from ${data.sender}`, 'info');
            updateMessageBadge();
        });

        socket.on('solution_submitted', (data) => {
            showNotification(`New solution submitted for your problem`, 'success');
        });
    }
}

function updateMessageBadge() {
    const badge = document.querySelector('.message-badge');
    if (badge) {
        const currentCount = parseInt(badge.textContent) || 0;
        badge.textContent = currentCount + 1;
        badge.style.display = 'inline-block';
    }
}

// Utility functions
window.formatCurrency = function(amount) {
    return new Intl.NumberFormat('en-PH', {
        style: 'currency',
        currency: 'PHP'
    }).format(amount);
};

window.formatDate = function(dateString) {
    return new Date(dateString).toLocaleDateString('en-PH', {
        year: 'numeric',
        month: 'short',
        day: 'numeric',
        hour: '2-digit',
        minute: '2-digit'
    });
};

// Export functions for use in other modules
if (typeof module !== 'undefined' && module.exports) {
    module.exports = {
        formatCurrency,
        formatDate,
        showNotification
    };
}
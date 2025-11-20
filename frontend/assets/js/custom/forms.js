// frontend/assets/js/custom/forms.js
class FormValidator {
    constructor(formId) {
        this.form = document.getElementById(formId);
        this.fields = this.form.querySelectorAll('[data-validate]');
        this.init();
    }

    init() {
        this.fields.forEach(field => {
            field.addEventListener('blur', () => this.validateField(field));
            field.addEventListener('input', () => this.clearError(field));
        });

        this.form.addEventListener('submit', (e) => {
            if (!this.validateForm()) {
                e.preventDefault();
            }
        });
    }

    validateField(field) {
        const value = field.value.trim();
        const rules = field.getAttribute('data-validate').split(' ');

        for (let rule of rules) {
            const isValid = this[`validate${rule.charAt(0).toUpperCase() + rule.slice(1)}`](value, field);
            if (!isValid) {
                this.showError(field, this.getErrorMessage(rule, field));
                return false;
            }
        }

        this.clearError(field);
        return true;
    }

    validateForm() {
        let isValid = true;
        this.fields.forEach(field => {
            if (!this.validateField(field)) {
                isValid = false;
            }
        });
        return isValid;
    }

    validateRequired(value, field) {
        return value !== '';
    }

    validateEmail(value, field) {
        if (!value) return true;
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        return emailRegex.test(value);
    }

    validateMinlength(value, field) {
        const minLength = field.getAttribute('data-minlength');
        return !minLength || value.length >= parseInt(minLength);
    }

    getErrorMessage(rule, field) {
        const messages = {
            required: 'This field is required',
            email: 'Please enter a valid email address',
            minlength: `Minimum ${field.getAttribute('data-minlength')} characters required`
        };
        return messages[rule] || 'Invalid value';
    }

    showError(field, message) {
        this.clearError(field);
        field.classList.add('is-invalid');
        
        const errorDiv = document.createElement('div');
        errorDiv.className = 'invalid-feedback';
        errorDiv.textContent = message;
        field.parentNode.appendChild(errorDiv);
    }

    clearError(field) {
        field.classList.remove('is-invalid');
        const errorDiv = field.parentNode.querySelector('.invalid-feedback');
        if (errorDiv) {
            errorDiv.remove();
        }
    }
}

// Initialize form validation
document.addEventListener('DOMContentLoaded', function() {
    const forms = document.querySelectorAll('form[data-validate]');
    forms.forEach(form => {
        new FormValidator(form.id);
    });
});
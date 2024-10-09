        document.addEventListener('DOMContentLoaded', function() {
            document.getElementById('registrationForm').addEventListener('submit', function(e) {
                e.preventDefault(); 
                if (validateForm()) {
                    this.submit(); 
                }
            });

        function validateForm() {
            let isValid = true;

            // Name validation
            const name = document.getElementById('name');
            if (name.value.trim() === '' ) {
                showError('nameError', 'Name is required!');
                isValid = false;
            } else if (name.value.length > 100) {
                showError('nameError', 'Name should not exceed 100 characters.');
                isValid = false;
            }
            else {
                clearError('nameError');
            }

            // Email validation
            const email = document.getElementById('email');
            if (email.value.trim() === '' || !isValidEmail(email.value)) {
                showError('emailError', 'Please enter a valid email address.');
                isValid = false;
            } 
            else {
                clearError('emailError');
            }

            // Gender validation
            const genderMale = document.getElementById('male');
            const genderFemale = document.getElementById('female');
            if (!genderMale.checked && !genderFemale.checked) {
                showError('genderError', 'Please select a gender.');
                isValid = false;
            } else {
                clearError('genderError');
            }

            // PDF file validation
            const pdfFile = document.getElementById('pdf_file');
            if (pdfFile.files.length === 0) {
                showError('pdfError', 'Please upload a PDF file.');
                isValid = false;
            } else if (pdfFile.files[0].size > 1048576) { // 1MB = 1048576 bytes
                showError('pdfError', 'PDF file size should not exceed 1MB.');
                isValid = false;
            } else if (pdfFile.files[0].type !== 'application/pdf') { // Check for PDF MIME type
                showError('pdfError', 'Uploaded file must be a PDF.');
                isValid = false;
            } else {
                clearError('pdfError');
            }

            // Password validation
            const password = document.getElementById('password');
            if (password.value.trim() === '' ) {
                showError('passwordError', 'Password is required!');
                isValid = false;
            } else if (!containsSpecialChar(password.value)) {
                showError('passwordError', 'Password must contain at least one special character');
                isValid = false;
            } else {
                clearError('passwordError');
            }

            return isValid; // Return overall validity
        }

        function isValidEmail(email) {
            const re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
            return re.test(String(email).toLowerCase());
        }

        function containsSpecialChar(str) {
            const specialChars = /[`!@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?~]/;
            return specialChars.test(str);
        }

        function showError(elementId, message) {
            const errorElement = document.getElementById(elementId);
            errorElement.textContent = message;
            errorElement.classList.add('d-block');
        }

        function clearError(elementId) {
            const errorElement = document.getElementById(elementId);
            errorElement.textContent = '';
            errorElement.classList.remove('d-block');
        }
    });

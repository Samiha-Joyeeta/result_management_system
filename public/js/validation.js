document.getElementById('UserRegistrationForm').addEventListener('submit', function(event) {
    const emailInput = document.getElementById('email');
    const emailError = document.getElementById('emailError');
    const emailPattern = '/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/';
    
    if (!emailPattern.test(emailInput.value)) {
        event.preventDefault();
        emailError.style.display = 'inline';
    } else {
        emailError.style.display = 'none';
    }
});

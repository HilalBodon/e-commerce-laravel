const registrationForm = document.getElementById('registration-form');
const messageDiv = document.getElementById('message');

registrationForm.addEventListener('submit', async (event) => {
    event.preventDefault();
console.log("hello1");
    const formData = new FormData(registrationForm);
    const data = {
        email: formData.get('email'),
        password: formData.get('password'),
        full_name: formData.get('full_name'),
        phone_number: formData.get('phone')
    };
    console.log(data);

    try {
        const response = await fetch('http://localhost:8000/api/auth/register', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(data)
        });

        const responseData = await response.json();

        if (response.ok) {
            messageDiv.textContent = 'Registration successful!';
            messageDiv.style.color = 'green';
            registrationForm.reset();
        } else {
            messageDiv.textContent = responseData.message;
            messageDiv.style.color = 'red';
        }
    } catch (error) {
        console.error('Error registering user:', error);
        messageDiv.textContent = 'An error occurred during registration. Please try again later.';
        messageDiv.style.color = 'red';
    }
});

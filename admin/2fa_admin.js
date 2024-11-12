let generatedCode = ''; // Variable to store the generated verification code

// Function to handle the 'Next' button click
document.getElementById('nextButton').addEventListener('click', function() {
    const smsSelected = document.getElementById('sms').checked;
    const emailSelected = document.getElementById('email').checked;

    if (smsSelected) {
        document.getElementById('rcornersSMS').style.display = 'block';
        document.getElementById('rcorners2fa').style.display = 'none';
    } else if (emailSelected) {
        document.getElementById('rcornersEmail').style.display = 'block';
        document.getElementById('rcorners2fa').style.display = 'none';
    } else {
        alert('Please select a method.');
    }
});

document.getElementById('sendEmailCodeButton').addEventListener('click', function() {
    const email = document.getElementById('emailInput').value;

    if (validateEmail(email)) {
        fetch('send_email.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            },
            body: `email=${encodeURIComponent(email)}`
        })
        .then(response => response.json())
        .then(data => {
            console.log(data); 
            if (data.success) {
                generatedCode = data.code; // Save the generated code
                alert(`Verification code sent to ${email}`);
                
                // Show the verification section and hide the email input section
                document.getElementById('rcornersVerifyEmail').style.display = 'block'; // Show the verification section
                document.getElementById('rcornersEmail').style.display = 'none'; // Hide the email input section

                document.getElementById('emailConfirmationText').innerText = `We've sent a verification PIN code to your email ${maskEmail(email)}.`;
            } else {
                alert(`Error: ${data.message}`);
            }
        })
        .catch(error => console.error('Error:', error));
    } else {
        alert('Please enter a valid email address.');
    }
});



// Simple email validation function
function validateEmail(email) {
    const regex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/; // Basic regex for email validation
    return regex.test(email.toLowerCase());
}

// Function to mask email for display (show only part of it)
function maskEmail(email) {
    const parts = email.split('@');
    const username = parts[0];
    const domain = parts[1];
    const maskedUsername = username.length > 2 ? username[0] + '***' + username[username.length - 1] : username; // Mask the username
    return `${maskedUsername}@${domain}`;
}

// Remaining existing code.

// Function to mask SMS number for display (show only part of it)
function maskSMS(sms) {
    return sms.length > 4 ? `***${sms.slice(-4)}` : sms; // Mask all but the last 4 digits
}

// Function to generate a random 6-digit code
function generateRandomCode() {
    return Math.floor(100000 + Math.random() * 900000).toString(); // Generates a 6-digit code
}

// Function to get code from inputs
function getCodeFromInputs(selector) {
    const inputs = document.querySelectorAll(selector);
    let code = '';
    inputs.forEach(input => {
        code += input.value;
    });
    return code;
}

// Function to validate email
function validateEmail(email) {
    const regex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return regex.test(email);
}

// Function to validate SMS number
function validateSMS(sms) {
    const regex = /^\+?[0-9]{10,15}$/; // Adjust the regex as necessary
    return regex.test(sms);
}

document.getElementById('tryEmail').addEventListener('click', function() {
    alert('Resending code to your email...');
    const email = document.getElementById('emailInput').value;
    if (validateEmail(email)) {
        generatedCode = generateRandomCode();
        alert('Verification code sent to ${email}'); // For demonstration purposes
    } else {
        alert('Please enter a valid email address.');
    }
});

        
        // Retry SMS Code
document.getElementById('trySMS').addEventListener('click', function() {
    alert('Resending code to your SMS...');
    const sms = document.getElementById('smsInput').value;
    if (validateSMS(sms)) {
        generatedCode = generateRandomCode();
        alert(`Verification code sent to ${sms}: ${generatedCode}`); // For demonstration purposes
    } else {
        alert('Please enter a valid SMS number.');
    }
});

// Retry Email Code
document.getElementById('tryEmailAgain').addEventListener('click', function() {
    alert('Resending code to your email...');
    const email = document.getElementById('emailInput').value;
    generatedCode = generateRandomCode();
    alert(`Verification code sent to ${email}`); // For demonstration purposes
});

// Retry SMS Code
document.getElementById('trySMSAgain').addEventListener('click', function() {
    alert('Resending code to your SMS...');
    const sms = document.getElementById('smsInput').value;
    generatedCode = generateRandomCode();
    alert(`Verification code sent to ${sms}: ${generatedCode}`); // For demonstration purposes
});


document.getElementById('cancelEmail').addEventListener('click', function() {
    document.getElementById('rcornersEmail').style.display = 'none';
    document.getElementById('rcorners2fa').style.display = 'block';
});

// Cancel SMS Verification
document.getElementById('cancelSMS').addEventListener('click', function() {
    document.getElementById('rcornersSMS').style.display = 'none';
    document.getElementById('rcorners2fa').style.display = 'block';
});

// Cancel Email Verification
document.getElementById('cancelEmailVerification').addEventListener('click', function() {
    document.getElementById('rcornersVerifyEmail').style.display = 'none';
    document.getElementById('rcornersEmail').style.display = 'block';
});

// Cancel SMS Verification
document.getElementById('cancelSMSVerification').addEventListener('click', function() {
    document.getElementById('rcornersVerifySMS').style.display = 'none';
    document.getElementById('rcornersSMS').style.display = 'block';
});

// Function to handle backspace
function handleBackspace(input, event) {
    if (event.key === 'Backspace' && input.value === '') {
        const prevInput = input.previousElementSibling;
        if (prevInput) {
            prevInput.focus();
        }
    }
};

// Function to move to next input on fill
function moveToNext(input, event) {
    if (input.value.length >= input.maxLength) {
        const nextInput = input.nextElementSibling;
        if (nextInput) {
            nextInput.focus();
        }
    }
};

function handleVerifyEmail() {
    const inputs = document.querySelectorAll('.code-input-email');
    const enteredCode = Array.from(inputs).map(input => input.value).join('');
    if (enteredCode === generatedCode) {
        alert('Congratulations! You are successfully logged in.');
    } else {
        alert('The code does not match the one sent to your Email.');
    }
}

function handleVerifySMS() {
    const inputs = document.querySelectorAll('.code-input-sms');
    const enteredCode = Array.from(inputs).map(input => input.value).join('');
    if (enteredCode === generatedCode.toString()) {
        alert('Congratulations! You are successfully logged in.');
    } else {
        alert('The code does not match the one sent to your SMS.');
    }
};
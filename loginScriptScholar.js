const form = document.getElementById("form");
const email = document.getElementById("email");
const password = document.getElementById("password");
const emailError = document.getElementById("email-error");
const passwordError = document.getElementById("password-error");

// Event Listeners

form.addEventListener("submit", (e)=>{
    e.preventDefault();

    //check email is valid
    let regex=/^[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$/;

    if (email.value.trim()==="") {
        email.parentElement.className='input-field error';
        emailError.innerHTML="Email is required";
    }else if (regex.test(email.value.trim())) {
        email.parentElement.className="input-field success";
    }else{
        email.parentElement.className="input-field error";
        emailError.innerHTML="Email is invalid";
    }

    if (password.value.trim()==="") {
        password.parentElement.className='input-field error';
        passwordError.innerHTML="Password is required";
    }else if (password.value.trim().length < 8){
        password.parentElement.className="input-field error";
        passwordError.innerHTML="Password must be at least 8 characters";
    }else if (password.value.trim().length > 15){
        password.parentElement.className="input-field error";
        passwordError.innerHTML="Password must be less than 15 characters";
    }else{
        password.parentElement.className='input-field success';
    }
})
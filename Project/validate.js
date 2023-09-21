const form = document.getElementById('form');
const fullname = document.getElementById('fullname');
const email = document.getElementById('email');
const phone = document.getElementById('phone');
const address = document.getElementById('address');

form.addEventListener('submit', e => {
    if (!validateInputs()) {
        e.preventDefault();
    }
});

// Event listener for the "blur" event on the input fields
fullname.addEventListener('blur', () => {
    validateFullname();
});
address.addEventListener('blur', () => {
    validateAddress();
});
email.addEventListener('blur', () => {
    validateEmail();
});

phone.addEventListener('blur', () => {
    validatePhone();
});

// Event listener for the "input" event on the input fields
fullname.addEventListener('input', () => {
    removeError(fullname);
});

email.addEventListener('input', () => {
    removeError(email);
});

phone.addEventListener('input', () => {
    removeError(phone);
});


const setError = (element, message) => {
    const inputControl = element.parentElement;
    const errorDisplay = inputControl.querySelector('.error');

    errorDisplay.innerText = message;
    inputControl.classList.add('error');
    inputControl.classList.remove('success');
};

const setSuccess = element => {
    const inputControl = element.parentElement;
    const errorDisplay = inputControl.querySelector('.error');

    errorDisplay.innerText = '';
    inputControl.classList.add('success');
    inputControl.classList.remove('error');
};

// Function to remove the error class and message
const removeError = element => {
    const inputControl = element.parentElement;
    const errorDisplay = inputControl.querySelector('.error');

    errorDisplay.innerText = '';
    inputControl.classList.remove('error');
};

const isValidPhone = phone => {
    const re = /^\+?(?:[0-9]{1,3})?(?:03|76|81|70|71|78|79)[0-9]{6}$/;
    return re.test(phone);
};

const isValidEmail = email => {
    const re = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return re.test(String(email).toLowerCase());
};

const isValidFullname = fullname => {
    const re = /^[a-zA-Z ]+$/;
    return re.test(fullname) && fullname === fullname.trim();
};
const validateFullname = () => {
    const fullnameValue = fullname.value;

    if (fullnameValue.trim() === '') {
        setError(fullname, 'Fullname is required');
    } else if (!isValidFullname(fullnameValue)) {
        setError(fullname, 'Provide a valid fullname');
    } else {
        setSuccess(fullname);
    }
};
const validateAddress = () => {
    const fulladdress = address.value;

    if (fulladdress.trim() === '') {
        setError(address, 'Address is required');
    } else if (fulladdress.length < 10) {
        setError(address, 'Address should be at least 10 characters long');
    } else {
        setSuccess(address);
    }
};

const validateEmail = () => {
    const emailValue = email.value;

    if (emailValue.trim() === '') {
        setError(email, 'Email is required');
    } else if (!isValidEmail(emailValue)) {
        setError(email, 'Provide a valid email address');
    } else {
        setSuccess(email);
    }
};

const validatePhone = () => {
    const phoneValue = phone.value;

    if (phoneValue.trim() === '') {
        setError(phone, 'Phone number is required');
    } else if (!isValidPhone(phoneValue)) {
        setError(phone, 'Provide a valid phone number');
    } else {
        setSuccess(phone);
    }
};


const validateInputs = () => {
    validateFullname();
    validateEmail();
    validatePhone(); 
    validateAddress();
    validateAddress();
if (

    fullname.parentElement.classList.contains('success') &&
    email.parentElement.classList.contains('success') &&
    phone.parentElement.classList.contains('success') &&
    address.parentElement.classList.contains('success') 
) 
{
    form.submit(); // Submit the form if everything is successful
}
}; 
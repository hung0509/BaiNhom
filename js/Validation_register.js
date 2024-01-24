const btnRegister = document.getElementById("button-sign-up");
const firstnameEle = document.getElementById('firstname');
const lastnameEle = document.getElementById('lastname');
const emailEle = document.getElementById('email');
const usernameEle = document.getElementById('username');
const passwordEle = document.getElementById('password');
const repasswordEle = document.getElementById('repassword');
const inputEles = document.querySelectorAll('.input-row');

btnRegister.addEventListener('click', function(){
    // Array.from(inputEles).map((ele) =>
    // ele.classList.remove('success', 'error')
    // );
    
    let isValid = checkValid();

    if(isValid){
        alert('Đăng ký thành công');
    }
});

function setError(ele, mes){
    let parentEle = ele.parentNode;
    console.log(parentEle);
    parentEle.classList.add('error');
    parentEle.querySelector('small').innerText = mes;
}

function setSucces(ele){
    ele.parentNode.classList.add('success');
}

function isEmail(email){
    return /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/.test(email);
}


function checkValid(){
    let firstnameValue = firstnameEle.value;
    let lastnameValue = lastnameEle.value;
    let emailValue = emailEle.value;
    let usernameValue = usernameEle.value;
    let passwordValue = passwordEle.value;
    let repasswordValue = repasswordEle.value;

    let isCheck = true;

    if(firstnameValue == ''){
        setError(firstnameEle, 'Firstname is empty');
        isCheck = false;
    }else{
        setSucces(firstnameEle);
    }

    if(lastnameValue == ''){
        setError(lastnameEle, 'Lastname is empty');
        isCheck = false;
    }else{
        setSucces(lastnameEle);
    }

    if(emailValue == ''){
        setError(emailEle, 'Email is empty');
        isCheck = false;
    }else if(!isEmail(emailValue)){
        setError(emailEle, 'Email is invalid');
        isCheck = false;
    }else{
        setSucces(emailEle)
    }

    if(usernameValue == ''){
        setError(usernameEle, 'Username is empty');
        isCheck = false;
    }else{
        setSucces(usernameEle);
    }

    if(passwordValue == ''){
        setError(passwordEle, 'Password is emmpty');
        isCheck = false;
    }else if(passwordValue.length < 8){
        setError(passwordEle, 'Has minimum 8 characters in length');
        isCheck = false;
    }else{
        setSucces(passwordEle);
    }

    if(repasswordValue == ''){
        setError(repasswordEle, 'Please confirm password!');
        isCheck = false;
    }else if(repasswordValue != passwordValue){
        setError(repasswordEle, 'Passwords do not match');
        isCheck = false;
    }else{
        setSucces(repasswordEle);
    }

    return isCheck;
}
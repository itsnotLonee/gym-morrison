var email = document.getElementById('user_email')
var sex = document.getElementById('user_sex')
var pass1 = document.getElementById('user_password')
var pass2 = document.getElementById('user_password2')

window.onload = () => {
    email.focus()
}

document.getElementById('user_birthdate_month').style.marginRight = '1em'
document.getElementById('user_birthdate_day').style.marginRight = '1em'

var confirm = document.getElementById('confirm_pass')
var length = document.getElementById('length_pass')
var upper = document.getElementById('upper_pass')
var lower = document.getElementById('lower_pass')
var number = document.getElementById('number_pass')
var error = document.getElementById('user_password2_error')
var submit = document.getElementById('user_submit')

pass2.onkeyup = () => {

    error.style.display = 'block'
    submit.setAttribute('disabled')

    if (pass1.value === pass2.value && pass1.value !== '' && pass2.value !== '' ) {
        confirm.className = 'fas fa-check'
        confirm.parentElement.className = 'text-success'

    } else {
        confirm.className = 'fas fa-times'
        confirm.parentElement.className = 'text-danger'
    }

    if (length.className === 'fas fa-check' &&
        lower.className === 'fas fa-check' &&
        upper.className === 'fas fa-check' &&
        number.className === 'fas fa-check' &&
        pass1.value === pass2.value){
        error.style.display = 'none'
    }
}

pass1.onkeyup = () => {

    error.style.display = 'block'

    if (pass1.value.length >= 8 && pass1.value.length <= 18 ) {
        length.className = 'fas fa-check'
        length.parentElement.className = 'text-success'
    } else {
        length.className = 'fas fa-times'
        length.parentElement.className = 'text-danger'
    }
    function hasLowerCase(str) {
        return str.toUpperCase() != str
    }
    function hasUpperCase(str) {
        return str.toLowerCase() != str
    }
    function hasNumber(str) {
        return /\d/.test(str)
    }
    if (hasLowerCase(pass1.value)){
        lower.className = 'fas fa-check'
        lower.parentElement.className = 'text-success'
    }else{
        lower.className = 'fas fa-times'
        lower.parentElement.className = 'text-danger'
    }
    if (hasUpperCase(pass1.value)){
        upper.className = 'fas fa-check'
        upper.parentElement.className = 'text-success'
    }else{
        upper.className = 'fas fa-times'
        upper.parentElement.className = 'text-danger'
    }
    if (hasNumber(pass1.value)){
        number.className = 'fas fa-check'
        number.parentElement.className = 'text-success'
    }else{
        number.className = 'fas fa-times'
        number.parentElement.className = 'text-danger'
    }
    if (length.className === 'fas fa-check' &&
        lower.className === 'fas fa-check' &&
        upper.className === 'fas fa-check' &&
        number.className === 'fas fa-check' &&
        pass1.value === pass2.value){
        error.style.display = 'none'
    }else{
        error.style.display = 'block'
    }
}







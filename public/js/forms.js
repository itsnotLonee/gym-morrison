var email = document.getElementById('user_email')
var passwd = document.getElementById('user_password')

window.onload = () => {
    email.focus()
}

document.getElementsByTagName('input').onfocus = () => {
    document.getElementsByTagName('input').className = 'form-control border bg-dark'
}




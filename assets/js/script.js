// Login validation
function validateLogin() {
    let user = document.getElementById('username');
    let pass = document.getElementById('password');
    let errorMsg = document.getElementById('errorMsg');
    
    if(!user || !pass) return true;
    
    if(user.value.trim().length < 3) {
        if(errorMsg) errorMsg.innerText = '⚠️ Username must be at least 3 characters';
        user.focus();
        return false;
    }
    if(pass.value.length < 4) {
        if(errorMsg) errorMsg.innerText = '⚠️ Password must be at least 4 characters';
        pass.focus();
        return false;
    }
    if(errorMsg) errorMsg.innerText = '';
    return true;
}

// Register validation
function validateRegister() {
    let username = document.getElementById('reg_username');
    let pass = document.getElementById('reg_password');
    let confirm = document.getElementById('confirm_password');
    let regError = document.getElementById('regError');
    
    if(username.value.trim().length < 3) {
        if(regError) regError.innerText = '⚠️ Username must be at least 3 characters';
        username.focus();
        return false;
    }
    if(pass.value.length < 4) {
        if(regError) regError.innerText = '⚠️ Password must be at least 4 characters';
        pass.focus();
        return false;
    }
    if(pass.value !== confirm.value) {
        if(regError) regError.innerText = '⚠️ Passwords do not match';
        confirm.focus();
        return false;
    }
    if(regError) regError.innerText = '';
    return true;
}

// Character form validation
function validateCharacterForm() {
    let name = document.getElementById('name');
    let formError = document.getElementById('formError');
    
    if(name.value.trim().length < 2) {
        if(formError) formError.innerText = '⚠️ Name must be at least 2 characters';
        name.focus();
        return false;
    }
    if(formError) formError.innerText = '';
    return true;
}

// Delete confirmation
function confirmDelete(name) {
    return confirm(`⚠️ Are you sure you want to delete "${name}"?\n\nThis action cannot be undone.`);
}

// Page transition animation
document.addEventListener('DOMContentLoaded', function() {
    document.body.style.opacity = '0';
    document.body.style.transition = 'opacity 0.3s ease';
    setTimeout(() => {
        document.body.style.opacity = '1';
    }, 50);
});
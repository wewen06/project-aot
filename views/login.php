<?php include 'includes/header.php'; ?>

<div class="form-container">
    <h2>LOGIN</h2>
    
    <?php if(isset($_GET['message']) && $_GET['message'] == 'logout'): ?>
        <div class="alert success">You have been logged out.</div>
    <?php endif; ?>
    
    <?php if(isset($_GET['message']) && $_GET['message'] == 'registered'): ?>
        <div class="alert success">Registration successful! Please login.</div>
    <?php endif; ?>
    
    <?php if(isset($_GET['error'])): ?>
        <div class="alert error">Invalid username or password.</div>
    <?php endif; ?>
    
    <form action="/aot-website/actions/login_process.php" method="POST" onsubmit="return validateLogin()">
        <div class="form-group">
            <label>USERNAME</label>
            <input type="text" name="username" id="username" placeholder="Enter your username" required>
        </div>
        <div class="form-group">
            <label>PASSWORD</label>
            <input type="password" name="password" id="password" placeholder="Enter your password" required>
        </div>
        <div id="errorMsg" class="error"></div>
        <button type="submit">LOGIN</button>
    </form>
    <p style="text-align:center; margin-top:1.5rem; font-size:0.85rem;">
        Not a member? <a href="register.php" style="color: var(--accent-red-light);">Register here</a>
    </p>
</div>

<?php include 'includes/footer.php'; ?>
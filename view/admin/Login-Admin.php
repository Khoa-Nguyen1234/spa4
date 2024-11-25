<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>

    <link rel="stylesheet" href="./css/Login-Admin.css">
</head>

<body>


    <div class="wrapper">
        <span class="bg-animate"></span>
        <span class="bg-animate2"></span>

        <div>
            <div class="form-box login">
                <h2 class="animation" style="--i:0; --j:21;">Login</h2>
                <form action="../../controller/login_admin.php" method="POST">
                    <div class="input-box animation" style="--i:1; --j:22;">
                        <input type="text" id="Username_log" name="username" required>
                        <label>Username</label>
                        <i class=''>
                            <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="lucide lucide-user-round">
                                <circle cx="12" cy="8" r="5" />
                                <path d="M20 21a8 8 0 0 0-16 0" />
                            </svg>
                        </i>
                    </div>
                    <div class="input-box animation" style="--i:2; --j:23;">
                        <input type="password" id="password" name="password" required>
                        <label>Password</label>
                        <i class=''>
                            <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="lucide lucide-lock">
                                <rect width="18" height="11" x="3" y="11" rx="2" ry="2" />
                                <path d="M7 11V7a5 5 0 0 1 10 0v4" />
                            </svg>
                        </i>
                    </div>
                    <button type="submit" class="btn animation" style="--i:3; --j:24;">Login</button>
                    <div class="logreg-link animation" style="--i:4; --j:25;">
                        <p>Don't have an account? <a href="#" class="register-link">Sign Up</a></p>
                        <p>Forgot Password? <a href="#" class="register-link"></a></p>
                    </div>
                </form>
            </div>
            <div class="info-text login">
                <h2 class="animation" style="--i:0; --j:20;">Welcome Back, Admin!</h2>
                <p class="animation" style="--i:1; --j:21;">Already a Member? Please Login.</p>
            </div>
        </div>


        <div>
            <div class="form-box register">
                <h2 class="animation" style="--i:17; --j:0;">Sign Up</h2>
                <form action="../../controller/register_admin.php" method="POST">
                    <div class="input-box animation" style="--i:18; --j:1;">
                        <input type="text" id="Username_reg" name="username" required>
                        <label>Username</label>
                        <i class=''>
                            <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none"
                                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                class="lucide lucide-user-round">
                                <circle cx="12" cy="8" r="5" />
                                <path d="M20 21a8 8 0 0 0-16 0" />
                            </svg>
                        </i>
                    </div>
                    <div class="input-box animation" style="--i:19; --j:2;">
                        <input type="text" id="email_reg" name="email" required>
                        <label>Email</label>
                        <i class=''>
                            <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none"
                                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                class="lucide lucide-mail">
                                <rect width="20" height="16" x="2" y="4" rx="2" />
                                <path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7" />
                            </svg>
                        </i>
                    </div>
                    <div class="input-box animation" style="--i:20; --j:3;">
                        <input type="password" id="password_reg" name="password" required>
                        <label>Password</label>
                        <i class=''>
                            <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none"
                                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                class="lucide lucide-lock">
                                <rect width="18" height="11" x="3" y="11" rx="2" ry="2" />
                                <path d="M7 11V7a5 5 0 0 1 10 0v4" />
                            </svg>
                        </i>
                    </div>
                    <button type="submit" class="btn animation" style="--i:21; --j:4;">Sign Up</button>
                    <div class="logreg-link animation" style="--i:22; --j:5;">
                        <p>Already have an account? <a href="#" class="login-link">Login</a></p>
                    </div>
                </form>

            </div>
            <div class="info-text register">
                <h2 class="animation" style="--i:17; --j:0;">Welcome to Admin!</h2>
                <p class="animation" style="--i:18; --j:1;">Create account?</p>
            </div>
        </div>
    </div>









    <script>
        const wrapper = document.querySelector('.wrapper');
        const registerLink = document.querySelector('.register-link');
        const loginLink = document.querySelector('.login-link');

        registerLink.onclick = () => {
            wrapper.classList.add('active');
        }

        loginLink.onclick = () => {
            wrapper.classList.remove('active');
        }
    </script>
</body>

</html>
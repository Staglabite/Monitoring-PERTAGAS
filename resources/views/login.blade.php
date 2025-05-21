<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Figtree', sans-serif;
            background: #0056b3;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            overflow: hidden;
            perspective: 1000px;
        }

        .background-animations {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            pointer-events: none;
            z-index: 0;
        }

        .particle {
            position: absolute;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.1);
            animation: float 20s infinite;
            pointer-events: none;
        }

        @keyframes float {
            0% { transform: translateY(0) translateX(0) rotate(0deg); }
            33% { transform: translateY(-100px) translateX(100px) rotate(120deg); }
            66% { transform: translateY(100px) translateX(-100px) rotate(240deg); }
            100% { transform: translateY(0) translateX(0) rotate(360deg); }
        }

        .login-wrapper {
            position: relative;
            width: 90%;
            max-width: 380px;
        }

        .login-container {
            background: #fff;
            padding: 2rem;
            border-radius: 1.5rem;
            box-shadow: 
                0 8px 32px rgba(0, 0, 0, 0.1),
                0 0 100px rgba(0, 86, 179, 0.15);
            width: 100%;
            backdrop-filter: blur(10px);

            position: relative;
            transition: all 0.3s ease;
            border: 2px solid rgba(0, 86, 179, 0.2);
        }

        .login-title {
            font-size: 2rem;
            font-weight: bold;
            text-align: center;
            margin-bottom: 1.5rem;
            color: #0056b3;
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        form {
            display: grid;
            grid-template-columns: 1fr;
            gap: 1.5rem;
            max-width: 420px;
            margin: 0 auto;
        }

        .form-group {
            position: relative;
            z-index: 1;
        }

        .form-label {
            display: block;
            font-size: 0.875rem;
            font-weight: 500;
            color: #374151;
            margin-bottom: 0.5rem;
            transition: all 0.3s ease;
        }

        .form-input {
            width: 100%;
            padding: 0.75rem 1rem;
            border: 2px solid rgba(0, 86, 179, 0.2);
            border-radius: 0.75rem;
            transition: all 0.3s ease;
            font-size: 0.875rem;
            background: #ffffff;
        }

        .form-input:focus {
            outline: none;
            border-color: #0056b3;
            box-shadow: 0 0 15px rgba(0, 86, 179, 0.2);
            transform: translateY(-2px);
        }

        .button-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 1rem;
            margin-top: 1rem;
        }

        .login-button {
            background: #0056b3;
            color: white;
            font-size: 1rem;
            padding: 0.875rem;
            border-radius: 0.75rem;
            border: none;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(0, 86, 179, 0.2);
            width: 100%;
        }

        .login-button:hover {
            transform: translateY(-3px);
            box-shadow: 0 6px 20px rgba(0, 86, 179, 0.3);
            background: #0062cc;
        }

        .register-link {
            text-align: center;
            color: #0056b3;
            text-decoration: none;
            font-weight: 500;
            transition: all 0.3s ease;
            position: relative;
            display: flex;
            align-items: center;
            padding: 0.875rem 2.5rem;
        }

        .register-link::after {
            content: '';
            position: absolute;
            width: 0;
            height: 2px;
            bottom: -2px;
            left: 50%;
            background: #0056b3;
            transition: all 0.3s ease;
        }

        .register-link:hover::after {
            width: 100%;
            left: 0;
        }

        .error-message {
            color: #dc2626;
            font-size: 0.75rem;
            margin-top: 0.25rem;
            opacity: 0;
            animation: fadeIn 0.3s ease forwards;
        }

        @keyframes fadeIn {
            to { opacity: 1; }
        }

        @media (max-width: 640px) {
            .login-container {
                padding: 1.5rem;
            }
        }

        .captcha-error {
            color: #dc2626;
            font-size: 0.75rem;
            margin-top: 0.5rem;
            opacity: 0;
            animation: fadeIn 0.3s ease forwards;
            text-align: center;
            padding: 0.5rem;
            background-color: rgba(220, 38, 38, 0.1);
            border: 1px solid rgba(220, 38, 38, 0.3);
            border-radius: 0.5rem;
        }

    </style>

    {!!htmlScriptTagJsApi()!!}
</head>
<body>
    <div class="background-animations" id="backgroundAnimations"></div>

    <div class="login-wrapper">
        <div class="login-container">
            <h1 class="login-title">Login</h1>
            <form action="{{ route('login.api') }}" method="post">
                @csrf
                <div class="form-group">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" name="email" id="email" class="form-input" required>
                    @if ($errors->has('email'))
                        <span class="error-message">{{ $errors->first('email') }}</span>
                    @endif
                </div>
                
                <div class="form-group">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" name="password" id="password" class="form-input" required>
                    @if ($errors->has('password'))
                        <span class="error-message">{{ $errors->first('password') }}</span>
                    @endif
                </div>

                <div class="form-group">
                    <div class="g-recaptcha" data-sitekey="6LeqcR8rAAAAACg8g6N9dJQlw8bxh9pGVTty3tAO"></div>
                    @if ($errors->has('g-recaptcha-response'))
                        <div class="captcha-error">
                            {{ $errors->first('g-recaptcha-response') }}
                        </div>
                    @endif
                </div>

                <div class="button-container">
                    <button type="submit" class="login-button">Login</button>
                    <a href="{{ route('register') }}" class="register-link">Register</a>
                </div>
            </form>
        </div>
    </div>

    <script>
        // Create background particles
        const backgroundAnimations = document.getElementById('backgroundAnimations');
        const particleCount = 50;

        for (let i = 0; i < particleCount; i++) {
            const particle = document.createElement('div');
            particle.className = 'particle';
            
            const size = Math.random() * 15 + 5;
            particle.style.width = `${size}px`;
            particle.style.height = `${size}px`;
            
            particle.style.left = `${Math.random() * 100}%`;
            particle.style.top = `${Math.random() * 100}%`;
            
            particle.style.animationDuration = `${Math.random() * 15 + 15}s`;
            particle.style.animationDelay = `${Math.random() * -30}s`;
            
            backgroundAnimations.appendChild(particle);
        }

        // GSAP Animations
        gsap.from(".login-container", {
            duration: 1.5,
            opacity: 0,
            y: 50,
            rotationX: 10,
            rotationY: 10,
            ease: "power3.out"
        });



        // Form input animations
        const inputs = document.querySelectorAll('.form-input');
        inputs.forEach(input => {
            input.addEventListener('focus', () => {
                gsap.to(input.previousElementSibling, {
                    duration: 0.3,
                    y: -3,
                    color: '#0056b3',
                    ease: "power2.out"
                });
            });

            input.addEventListener('blur', () => {
                if (!input.value) {
                    gsap.to(input.previousElementSibling, {
                        duration: 0.3,
                        y: 0,
                        color: '#374151',
                        ease: "power2.out"
                    });
                }
            });
        });

        // Button hover animation
        const loginButton = document.querySelector('.login-button');
        loginButton.addEventListener('mouseenter', () => {
            gsap.to(loginButton, {
                duration: 0.3,
                scale: 1.05,
                ease: "power2.out"
            });
        });

        loginButton.addEventListener('mouseleave', () => {
            gsap.to(loginButton, {
                duration: 0.3,
                scale: 1,
                ease: "power2.out"
            });
        });
    </script>
</body>
</html>
@extends('template.main')
@section('content')
<style>
/* Background animation */
.background-animations {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    pointer-events: none;
    z-index: 0;
    background-color: #0056b3;
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

/* Enhanced nav styles */
.nav-enhanced {
    backdrop-filter: blur(10px);
    transition: all 0.3s ease;
}

.nav-link {
    transition: all 0.3s ease;
}

.nav-link:hover {
    transform: translateY(-2px);
}

/* Logo container animation */
.logo-container {
    transition: all 0.3s ease;
}

.logo-container:hover {
    transform: scale(1.05);
}

.btn-animate:hover {
    transform: scale(1.05); /* Sama seperti logo */
    transition: all 0.3s ease;
}

</style>

<div class="dashboard-wrapper">
    <div class="background-animations" id="backgroundAnimations"></div>
    
    <div class="dashboard-content background: #0056b3; min-h-screen relative">
        <nav class="w-full border-b border-gray-200 bg-gray-100 nav-enhanced">
            <div class="max-w-screen-xl mx-auto flex justify-between items-center p-4">
                <!-- Kiri: Logo + Menu -->
                <div class="flex flex-row justify-between items-center gap-[12px]">
                    <div class="logo-container flex items-center h-full">
                        <a href="/" class="pl-4 flex items-center h-full">
                            <img src="{{ asset('logo-pertagas.png') }}" alt="Logo Pertagas" class="h-7 object-contain">
                        </a>
                    </div>
                    <a href="/" class="nav-link block px-3 text-[20px] font-weight:200 text-[#1A47AA] rounded-sm font-bold relative top-[4px] ml-4">Home</a>
                    <a href="/stream" class="nav-link block px-3 text-[20px] font-weight:200 text-[#1A47AA] rounded-sm font-bold relative top-[4px] ml-4">Stream</a>
                </div>
                
                <!-- Kanan: Logout -->
                <div class="flex-shrink-0">
                    <a href="{{ route('logout') }}" class="btn-animate flex items-center justify-center bg-red-600 hover:bg-red-700 text-white rounded-lg p-2 transition-all">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path>
                            <polyline points="16 17 21 12 16 7"></polyline>
                            <line x1="21" y1="12" x2="9" y2="12"></line>
                        </svg>
                    </a>
                </div>
            </div>
        </nav>
        <div class="max-w-screen-xl flex flex-row mx-auto p-4 relative z-10">
            @yield('dashboard_content')
        </div>
        @include('template.footer') 
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>
<script>
// Create background particles
document.addEventListener('DOMContentLoaded', function() {
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

});

// Smooth scroll animation
document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function (e) {
        e.preventDefault();
        document.querySelector(this.getAttribute('href')).scrollIntoView({
            behavior: 'smooth'
        });
    });
});
</script>
@endsection
<?php

session_start();

if (!isset($_SESSION['username'])) {
    header("Location: index.php");
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Kall Portfolio</title>
    <link rel="icon" type="image/x-icon" href="path/to/icon.ico">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet" />
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet" />
    <style>
        body {
            margin: 0;
            font-family: 'Poppins', sans-serif;
            background-color: #0a0a23;
            color: #ffffff;
        }

        .navbar {
            width: 100%;
            display: flex;
            justify-content: space-between;
            padding: 20px 50px;
            position: fixed;
            top: 0;
            background-color: #0a0a23;
            z-index: 1000;
            transition: background-color 0.3s ease;
        }

        .navbar a {
            color: #ffffff;
            text-decoration: none;
            margin: 0 15px;
            font-weight: 300;
            position: relative;
        }

        .navbar a:hover,
        .navbar a.active {
            color: #7f7fff;
        }

        .navbar a.active::after {
            content: '';
            position: absolute;
            bottom: -5px;
            left: 50%;
            transform: translateX(-50%);
            width: 6px;
            height: 6px;
            background-color: #7f7fff;
            border-radius: 50%;
        }

        .navbar .logo {
            font-weight: 600;
        }

        .navbar .nav-links {
            display: flex;
            align-items: center;
        }

        .navbar .nav-links a {
            margin: 0 10px;
        }

        .navbar .menu-toggle {
            display: none;
            font-size: 1.5em;
            cursor: pointer;
        }

        #about h6 {
            margin-top: 10px;
            margin-bottom: 10px;
            font-size: 16px;
            line-height: 1.5;
            color: #fff;
        }

        .container {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100vh;
            text-align: center;
            opacity: 0;
            transform: translateY(50px);
            transition: opacity 0.6s ease-out, transform 0.6s ease-out;
        }

        .container.visible {
            opacity: 1;
            transform: translateY(0);
        }

        .container.hidden {
            opacity: 0;
            transform: translateY(50px);
        }

        .content {
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
            gap: 20px;
        }

        .content h1 {
            font-size: 2.5em;
            font-weight: 600;
            margin: 0;
        }

        .content h2 {
            font-size: 1.5em;
            font-weight: 300;
            margin: 10px 0;
        }

        .content p {
            font-size: 1em;
            font-weight: 300;
            margin: 10px 0;
        }

        .content p strong {
            font-weight: 600;
        }

        .profile-pic {
            border-radius: 50%;
            width: 150px;
            height: 150px;
            object-fit: cover;
            margin-top: 20px;
        }

        .scroll-down {
            display: flex;
            align-items: center;
            margin-top: 50px;
            cursor: pointer;
            color: #ffffff;
        }

        .scroll-down span {
            color: #ffffff;
        }

        .scroll-down:hover span {
            color: #ffffff;
        }

        .scroll-down i {
            margin-left: 10px;
            animation: bounce 2s infinite;
            color: #ffffff;
        }

        .scroll-down:hover i {
            color: #ffffff;
        }


        /* Chat box styling */

        .chat-box {
            height: 100px;
            border-radius: 5px;
            overflow-y: auto;
            padding: 10px;
            margin-bottom: 20px;
            /* Warna latar belakang yang lebih lembut */
        }


        /* Chat form styling */

        .chat-form {
            display: flex;
            flex-direction: column;
        }


        /* Input field styling */

        input[type="text"] {
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            margin-bottom: 10px;
        }


        /* Button styling */

        button {
            padding: 10px;
            background-color: #007bff;
            /* Warna biru */
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            margin-top: 10px;
            /* Menambahkan jarak antara tombol dan form */
        }

        button:hover {
            background-color: #0056b3;
            /* Warna biru lebih gelap saat hover */
        }

        .rating {
            margin-bottom: 20px;
            /* Jarak antara rating dan chat form */
            font-size: 24px;
            /* Ukuran font untuk rating */
            color: #FFD700;
            /* Warna emas untuk bintang */
        }

        .star {
            cursor: pointer;
            /* Menunjukkan bahwa bintang dapat diklik */
            transition: color 0.3s;
            /* Efek transisi saat hover */
        }

        .star:hover {
            color: #FFC107;
            /* Warna saat hover */
        }

        .logo {
            cursor: pointer;
        }

        h1 {
            position: relative;
        }

        h1::after {
            content: '';
            display: block;
            width: 100%;
            height: 2px;
            /* Tinggi garis */
            background: #ffffff;
            /* Warna garis */
            margin-top: 10px;
            /* Jarak antara judul dan garis */
        }


        /* Menghapus tanda panah pada input type number */

        input[type="number"] {
            -moz-appearance: textfield;
            /* Firefox */
        }

        input[type="number"]::-webkit-inner-spin-button,
        input[type="number"]::-webkit-outer-spin-button {
            -webkit-appearance: none;
            /* Chrome, Safari, dan Opera */
            margin: 0;
            /* Menghapus margin */
        }

        @media (max-width: 768px) {
            .chat-box {
                height: 250px;
                /* Reduce height for smaller screens */
            }

            .chat-form input,
            .chat-form textarea {
                font-size: 14px;
                /* Smaller font size for inputs */
            }

            .chat-form button {
                font-size: 14px;
                /* Smaller font size for button */
            }
        }

        @media (max-width: 480px) {
            .chat-box {
                height: 200px;
                /* Further reduce height for very small screens */
            }

            .chat-form input,
            .chat-form textarea {
                font-size: 12px;
                /* Even smaller font size */
            }

            .chat-form button {
                font-size: 12px;
                /* Even smaller font size */
            }
        }

        @keyframes bounce {

            0%,
            20%,
            50%,
            80%,
            100% {
                transform: translateY(0);
            }

            40% {
                transform: translateY(-10px);
            }

            60% {
                transform: translateY(-5px);
            }
        }

        .contact-form {
            background-color: #0a0a23;
            padding: 20px;
            border-radius: 10px;
            width: 100%;
            max-width: 500px;
            margin: 20px auto;
        }

        .contact-form input,
        .contact-form textarea {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: none;
            border-radius: 5px;
            background-color: #1a1a3d;
            color: #ffffff;
        }

        .contact-form button {
            background-color: #7f7fff;
            color: #ffffff;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease, transform 0.3s ease;
            width: 100%;
        }

        .contact-form button:hover {
            background-color: #6f6fff;
            transform: scale(1.05);
        }

        .contact-form button:active {
            background-color: #5f5fff;
            transform: scale(1);
        }

        .modal {
            display: none;
            position: fixed;
            z-index: 1001;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0, 0, 0, 0.5);
            animation: fadeIn 0.5s;
        }

        .modal-content {
            background-color: #1a1a3d;
            margin: 15% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
            max-width: 400px;
            border-radius: 10px;
            text-align: center;
            animation: slideIn 0.5s, slideOut 0.5s 2.5s;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
            }

            to {
                opacity: 1;
            }
        }

        @keyframes slideIn {
            from {
                transform: translateY(-50px);
            }

            to {
                transform: translateY(0);
            }
        }

        @keyframes slideOut {
            from {
                transform: translateY(0);
            }

            to {
                transform: translateY(-50px);
            }
        }

        @media (max-width: 768px) {
            .navbar {
                flex-direction: row;
                justify-content: space-between;
                padding: 10px 20px;
            }

            .navbar .nav-links {
                display: none;
                flex-direction: column;
                align-items: center;
                width: 100%;
                background-color: rgba(10, 10, 35, 0.9);
                backdrop-filter: blur(10px);
                position: absolute;
                top: 60px;
                left: 0;
                width: 100%;
                transition: all 0.3s ease;
            }

            .navbar .nav-links a {
                margin: 10px 0;
            }

            .navbar .menu-toggle {
                display: block;
            }

            .navbar .nav-links.active {
                display: flex;
                animation: slideDown 0.3s ease forwards;
            }

            @keyframes slideDown {
                from {
                    transform: translateY(-100%);
                }

                to {
                    transform: translateY(0);
                }
            }

            @keyframes fadeIn {
                from {
                    opacity: 0;
                }

                to {
                    opacity: 1;
                }
            }

            .fade-in {
                animation: fadeIn 1s ease-in;
            }

            .content h1 {
                font-size: 2em;
            }

            .content h2 {
                font-size: 1.2em;
            }

            .content p {
                font-size: 0.9em;
            }

            .profile-pic {
                width: 100px;
                height: 100px;
            }

            .contact-form {
                padding: 15px;
            }
        }
    </style>
</head>


<body>
    <!-- Navigation Bar -->
    <nav class="navbar">
        <div class="logo" onclick="scrollToHome()">Kall</div>
        <div class="menu-toggle" onclick="toggleMenu()">
            <i class="fas fa-bars"></i>
        </div>
        <div class="nav-links">
            <a class="active" href="#home">Home</a>
            <a href="#about">About</a>
            <a href="#contact">Contact</a>
            <a href="logout.php">Logout</a>
        </div>
    </nav>

    <!-- Home Section -->
    <div class="container" id="home">
        <div class="content">
            <a href="https://instagram.com/h.arrhmn">
                <img src="https://i.ibb.co.com/KLyGJYC/Haikal-Arrahman.jpg" alt="Haikal Arrahman" class="profile-pic" height="150" width="150" />
            </a>
            <h1>Hi, I'm Haikal Arrahman</h1>
        </div>
        <a class="scroll-down" href="#about">
            <span>Scroll down</span>
            <i class="fas fa-arrow-down"></i>
        </a>
    </div>

    <!-- About Section -->
    <div class="container hidden" id="about">
        <div class="content">
            <h1>About Me</h1>
            <p>Hai saya Haikal Arrahman asal sekolah saya dari SMK Negeri 5 Kabupaten Tangerang dari jurusan Rekayasa Perangkat Lunak. Tantangan bukanlah penghalang, tetapi batu loncatan menuju kesuksesan. Saya telah belajar untuk melihat setiap rintangan
                sebagai peluang untuk berkembang dan menemukan kekuatan dalam diri saya.</p>
        </div>
    </div>

    <!-- Contact Section -->
    <div class="container" id="contact">
        <div class="content">
            <h1>Contact Me</h1>
            <div class="contact-form">
                <input id="name" name="name" placeholder="Your Name" required type="text" />
                <input id="phone" name="phone" placeholder="Your Phone Number" required title="Please enter a valid phone number" type="number" />
                <input id="email" name="email" placeholder="Your Email" required type="email" />
                <textarea id="pesan" name="pesan" placeholder="Your Message" required rows="4"></textarea>
                <button onclick="sendEmail()">Send</button>
            </div>
        </div>
    </div>

    <!-- Error Modal -->
    <div class="modal" id="errorModal">
        <div class="modal-content">
            <p>Maaf, semua kolom harus diisi.</p>
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        // Scroll animation
        const observer = new IntersectionObserver(entries => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('visible');
                    entry.target.classList.remove('hidden');
                } else {
                    entry.target.classList.remove('visible');
                    entry.target.classList.add('hidden');
                }
            });
        });

        document.querySelectorAll('.container').forEach(container => {
            observer.observe(container);
        });

        // Smooth scroll
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function(e) {
                e.preventDefault();
                document.querySelector(this.getAttribute('href')).scrollIntoView({
                    behavior: 'smooth'
                });
                setActiveLink(this);
            });
        });

        function scrollToHome() {
            const homeSection = document.getElementById('home');
            homeSection.scrollIntoView({
                behavior: 'smooth'
            });
        }

        // Toggle menu
        function toggleMenu() {
            const navLinks = document.querySelector('.nav-links');
            navLinks.classList.toggle('active');
        }


        // Set active link
        function setActiveLink(link) {
            document.querySelectorAll('.nav-links a').forEach(anchor => {
                anchor.classList.remove('active');
            });
            link.classList.add('active');
        }

        // Send email using mailto
        function sendEmail() {
            const name = document.getElementById('name').value;
            const phone = document.getElementById('phone').value;
            const email = document.getElementById('email').value;
            const pesan = document.getElementById('pesan').value;

            if (!name || !phone || !email || !pesan) {
                const modal = document.getElementById('errorModal');
                modal.style.display = 'block';
                setTimeout(() => {
                    modal.style.display = 'none';
                }, 3000);
                return;
            }

            const subject = `Pengiriman Formulir Kontak dari ${name}`;
            const body = `Name: ${name}\nPhone: ${phone}\nEmail: ${email}\n\nPesan:\n${pesan}`;
            window.location.href =
                `mailto:haikalarrahman08@gmail.com?subject=${encodeURIComponent(subject)}&body=${encodeURIComponent(body)}`;
        }
    </script>
</body>

</html>
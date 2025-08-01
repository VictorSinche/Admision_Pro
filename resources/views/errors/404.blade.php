@php
    $manifest = json_decode(file_get_contents(public_path('build/manifest.json')), true);
@endphp

<link rel="stylesheet" href="{{ asset('build/' . $manifest['resources/css/app.css']['file']) }}">
<script type="module" src="{{ asset('build/' . $manifest['resources/js/app.js']['file']) }}"></script>

<link rel="icon" href="{{ asset('uma/img/logo-uma.ico') }}" type="image/x-icon">
<title>UMA | 404</title>


{{-- <script src="/js/sweetalert2.js"></script> --}}
<!-- CDN Tom Select -->
{{-- <link href="/tom-select/tom-select.css" rel="stylesheet">
<script src="/tom-select/tom-select.complete.min.js"></script>


<div class="flex flex-col items-center justify-center min-h-[50vh] text-center text-gray-600">
    <h1 class="text-6xl font-bold text-[#e72352]">404</h1>
    <p class="text-xl mt-4">Página no encontrada</p>
    <p class="text-gray-500 mt-2">La página que buscas no existe o fue movida.</p>
    <a href="{{ route('login.postulante') }}" class="mt-6 inline-block bg-[#e72352] text-white px-4 py-2 rounded hover:bg-[#c91e45] transition">
        Ir al inicio
    </a>
</div> --}}


<!--
VIEW IN FULL SCREEN MODE
FULL SCREEN MODE: http://salehriaz.com/404Page/404.html

DRIBBBLE: https://dribbble.com/shots/4330167-404-Page-Lost-In-Space
-->
<style>
        /*
    VIEW IN FULL SCREEN MODE
    FULL SCREEN MODE: http://salehriaz.com/404Page/404.html

    DRIBBBLE: https://dribbble.com/shots/4330167-404-Page-Lost-In-Space
    */

    @import url('https://fonts.googleapis.com/css?family=Dosis:300,400,500');

    @-moz-keyframes rocket-movement { 100% {-moz-transform: translate(1200px,-600px);} }
    @-webkit-keyframes rocket-movement {100% {-webkit-transform: translate(1200px,-600px); } }
    @keyframes rocket-movement { 100% {transform: translate(1200px,-600px);} }
    @-moz-keyframes spin-earth { 100% { -moz-transform: rotate(-360deg); transition: transform 20s;  } }
    @-webkit-keyframes spin-earth { 100% { -webkit-transform: rotate(-360deg); transition: transform 20s;  } }
    @keyframes spin-earth{ 100% { -webkit-transform: rotate(-360deg); transform:rotate(-360deg); transition: transform 20s; } }

    @-moz-keyframes move-astronaut {
        100% { -moz-transform: translate(-160px, -160px);}
    }
    @-webkit-keyframes move-astronaut {
        100% { -webkit-transform: translate(-160px, -160px);}
    }
    @keyframes move-astronaut{
        100% { -webkit-transform: translate(-160px, -160px); transform:translate(-160px, -160px); }
    }
    @-moz-keyframes rotate-astronaut {
        100% { -moz-transform: rotate(-720deg);}
    }
    @-webkit-keyframes rotate-astronaut {
        100% { -webkit-transform: rotate(-720deg);}
    }
    @keyframes rotate-astronaut{
        100% { -webkit-transform: rotate(-720deg); transform:rotate(-720deg); }
    }

    @-moz-keyframes glow-star {
        40% { -moz-opacity: 0.3;}
        90%,100% { -moz-opacity: 1; -moz-transform: scale(1.2);}
    }
    @-webkit-keyframes glow-star {
        40% { -webkit-opacity: 0.3;}
        90%,100% { -webkit-opacity: 1; -webkit-transform: scale(1.2);}
    }
    @keyframes glow-star{
        40% { -webkit-opacity: 0.3; opacity: 0.3;  }
        90%,100% { -webkit-opacity: 1; opacity: 1; -webkit-transform: scale(1.2); transform: scale(1.2); border-radius: 999999px;}
    }

    .spin-earth-on-hover{
        
        transition: ease 200s !important;
        transform: rotate(-3600deg) !important;
    }

    html, body{
        margin: 0;
        width: 100%;
        height: 100%;
        font-family: 'Dosis', sans-serif;
        font-weight: 300;
        -webkit-user-select: none; /* Safari 3.1+ */
        -moz-user-select: none; /* Firefox 2+ */
        -ms-user-select: none; /* IE 10+ */
        user-select: none; /* Standard syntax */
    }

    .bg-purple{
        background: url(http://salehriaz.com/404Page/img/bg_purple.png);
        background-repeat: repeat-x;
        background-size: cover;
        background-position: left top;
        height: 100%;
        overflow: hidden;
        
    }

    .custom-navbar{
        padding-top: 15px;
    }

    .brand-logo{
        margin-left: 25px;
        margin-top: 5px;
        display: inline-block;
    }

    .navbar-links{
        display: inline-block;
        float: right;
        margin-right: 15px;
        text-transform: uppercase;
        
        
    }

    ul {
        list-style-type: none;
        margin: 0;
        padding: 0;
    /*    overflow: hidden;*/
        display: flex; 
        align-items: center; 
    }

    li {
        float: left;
        padding: 0px 15px;
    }

    li a {
        display: block;
        color: white;
        text-align: center;
        text-decoration: none;
        letter-spacing : 2px;
        font-size: 12px;
        
        -webkit-transition: all 0.3s ease-in;
        -moz-transition: all 0.3s ease-in;
        -ms-transition: all 0.3s ease-in;
        -o-transition: all 0.3s ease-in;
        transition: all 0.3s ease-in;
    }

    li a:hover {
        color: #ffcb39;
    }

    .btn-request{
        padding: 10px 25px;
        border: 1px solid #FFCB39;
        border-radius: 100px;
        font-weight: 400;
    }

    .btn-request:hover{
        background-color: #FFCB39;
        color: #fff;
        transform: scale(1.05);
        box-shadow: 0px 20px 20px rgba(0,0,0,0.1);
    }

    .btn-go-home {
        z-index: 200;
        width: 100px;
        padding: 10px 15px;
        border: 1px solid #FFCB39;
        border-radius: 100px;
        font-weight: 400;
        color: white;
        text-align: center;
        text-decoration: none;
        letter-spacing: 2px;
        font-size: 11px;
        background-color: transparent;
        transition: all 0.3s ease-in;
        margin-top: 18px;
        
        -webkit-transition: all 0.3s ease-in;
        -moz-transition: all 0.3s ease-in;
        -ms-transition: all 0.3s ease-in;
        -o-transition: all 0.3s ease-in;
        transition: all 0.3s ease-in;
    }

    .btn-go-home:hover{
        background-color: #FFCB39;
        color: #fff;
        transform: scale(1.05);
        box-shadow: 0px 20px 20px rgba(0,0,0,0.1);
    }

    .central-body {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        height: 100vh; /* Altura completa del viewport */
        text-align: center;
        padding: 0;
    }

    .objects img{
        z-index: 90;
        pointer-events: none;
    }

    .object_rocket{
        z-index: 95;
        position: absolute;
        transform: translateX(-50px);
        top: 75%;
        pointer-events: none;
        animation: rocket-movement 200s linear infinite both running;
    }

    .object_earth{
        position: absolute;
        top: 20%;
        left: 15%;
        z-index: 90;
    /*    animation: spin-earth 100s infinite linear both;*/
    }

    .object_moon{
        position: absolute;
        top: 12%;
        left: 25%;
    /*
        transform: rotate(0deg);
        transition: transform ease-in 99999999999s;
    */
    }

    .earth-moon{
        
    }

    .object_astronaut{
        animation: rotate-astronaut 200s infinite linear both alternate;
    }

    .box_astronaut{
        z-index: 110 !important;
        position: absolute;
        top: 60%;
        right: 20%;
        will-change: transform;
        animation: move-astronaut 50s infinite linear both alternate;
    }

    .image-404{
        position: relative;
        z-index: 100;
        pointer-events: none;
    }

    .stars{
        background: url(http://salehriaz.com/404Page/img/overlay_stars.svg);
        background-repeat: repeat;
        background-size: contain;
        background-position: left top;
    }

    .glowing_stars .star{
        position: absolute;
        border-radius: 100%;
        background-color: #fff;
        width: 3px;
        height: 3px;
        opacity: 0.3;
        will-change: opacity;
    }

    .glowing_stars .star:nth-child(1){
        top: 80%;
        left: 25%;
        animation: glow-star 2s infinite ease-in-out alternate 1s;
    }
    .glowing_stars .star:nth-child(2){
        top: 20%;
        left: 40%;
        animation: glow-star 2s infinite ease-in-out alternate 3s;
    }
    .glowing_stars .star:nth-child(3){
        top: 25%;
        left: 25%;
        animation: glow-star 2s infinite ease-in-out alternate 5s;
    }
    .glowing_stars .star:nth-child(4){
        top: 75%;
        left: 80%;
        animation: glow-star 2s infinite ease-in-out alternate 7s;
    }
    .glowing_stars .star:nth-child(5){
        top: 90%;
        left: 50%;
        animation: glow-star 2s infinite ease-in-out alternate 9s;
    }

    @media only screen and (max-width: 600px){
        .navbar-links{
            display: none;
        }
        
        .custom-navbar{
            text-align: center;
        }
        
        .brand-logo img{
            width: 120px;
        }
        
        .box_astronaut{
            top: 70%;
        }
        
        .central-body{
            padding-top: 25%;
        }
    }
</style>

<body class="bg-purple">
    <div class="stars">
        <div class="central-body">
            <img class="image-404" src="http://salehriaz.com/404Page/img/404.svg" width="300px">
            <a href="{{ url()->previous() }}" class="btn-go-home">Volver atrás</a>
        </div>
        <div class="objects">
            <img class="object_rocket" src="http://salehriaz.com/404Page/img/rocket.svg" width="40px">
            <div class="earth-moon">
                <img class="object_earth" src="http://salehriaz.com/404Page/img/earth.svg" width="100px">
                <img class="object_moon" src="http://salehriaz.com/404Page/img/moon.svg" width="80px">
            </div>
            <div class="box_astronaut">
                <img class="object_astronaut" src="http://salehriaz.com/404Page/img/astronaut.svg" width="140px">
            </div>
        </div>
    </div>
</body>
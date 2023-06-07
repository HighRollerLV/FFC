<?php
session_start();
include "config/db.php";
include "models/dbOperations.php";
include "controllers/sessions.php";
loggedIn();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SignUp</title>
    <link rel="stylesheet" href="includes/css/style.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="icon" type="image/png" href="includes/images/ffcNoBG.png"/>
</head>
<body class="font-mono">
<div class="Holder flex flex-col min-h-screen w-full justify-center items-center sm:bg-[url('includes/images/ffc_background.png')] object-fill ">
    <div class="box flex flex-row h-full sm:min-h-[50vh] rounded drop-shadow-2xl flex-wrap">
        <div class="boxLeft flex bg-[#959595] flex-col justify-center items-center gap-4 flex-1 p-20 min-w-[20rem] rounded-l-lg">
            <form class="forms flex flex-col" id="form">
                <div id="divReg" class="hidden flex-col justify-center items-center gap-8">
                    <h1 class="text-4xl font-bold text-[#F9FAFA]">Register</h1>
                    <div>
                        <p class="text-1xl font-semibold text-[#F9FAFA]">Nickname</p>
                        <input class="rounded-full w-[99%] h-[2.5rem] outline-none p-2.5" id="nickname" type="text"
                               name="nickname" placeholder="Nickname">
                    </div>
                    <div>
                        <p class="text-1xl font-semibold text-[#F9FAFA]">Email</p>
                        <input class="rounded-full w-[99%] h-[2.5rem] outline-none p-2.5" id="email" type="email"
                               name="email" placeholder="Email">
                    </div>
                    <div>
                        <p class="text-1xl font-semibold text-[#F9FAFA]">Password</p>
                        <input class="rounded-full w-[99%] h-[2.5rem] outline-none p-2.5" id="password" type="password"
                               name="password" placeholder="Password">
                    </div>
                    <div>
                        <p class="text-1xl font-semibold text-[#F9FAFA]">Repeat Password</p>
                        <input class="rounded-full w-[99%] h-[2.5rem] outline-none p-2.5" id="repeatpassword"
                               type="password" name="repeatpassword" placeholder="Repeat Password">
                    </div>
                    <button class="rounded-full bg-[#4E4E4E] text-[#e4c065] font-bold w-[99%] h-[2.5rem] text-xl hover:bg-[#e4c065] hover:text-[#4E4E4E] hover:scale-110 transition duration-150 ease-out hover:ease-in hover:transition duration-300 ease-out"
                            onclick="getInput('registration.php',event, 'form')">Register
                    </button>
                </div>
            </form>
            <form id="log">
                <div id="divLog" class="flex flex-col justify-center items-center gap-8 w-full">
                    <h1 class="text-4xl font-bold text-[#F9FAFA]">Login</h1>
                    <div>
                        <p class="text-1xl font-semibold text-[#F9FAFA]">Email</p>
                        <input class="rounded-full w-[99%] h-[2.5rem] outline-none p-2.5" id="email" type="email"
                               name="email2" placeholder="Email">
                    </div>
                    <div>
                        <p class="text-1xl font-semibold text-[#F9FAFA]">Password</p>
                        <input class="rounded-full w-[99%] h-[2.5rem] outline-none p-2.5" id="password" type="password"
                               name="password2" placeholder="Password">
                    </div>
                    <button class="rounded-full bg-[#4E4E4E] text-[#e4c065] font-bold w-[99%] h-[2.5rem] text-xl hover:bg-[#e4c065] hover:scale-110 hover:text-[#4E4E4E] hover:transition duration-300 ease-out"
                            onclick="getInput('loginVerify.php', event, 'log')">Login
                    </button>
                </div>
            </form>
            <div class="flex flex-col items-center justify-center text-center w-52 lg:w-64">
                <p id="msg"></p>
            </div>
        </div>
        <div class="boxRight flex flex-col justify-center items-center min-h-[50vh] flex-1 bg-[#A8B7BC] p-6 min-w-[20rem] rounded-r-lg">
            <div class="logRegButton flex flex-col justify-center items-center gap-4">
                <h2 class="text-2xl font-bold text-[#F9FAFA]">Welcome to FFC</h2>
                <h3 class="text-1xl font-bold text-[#F9FAFA]" id="text">Don't have an account?</h3>
                <button class="rounded-full bg-[#4E4E4E] text-[#e4c065] font-bold w-[99%] h-[2.5rem] text-xl hover:bg-[#e4c065] hover:text-[#4E4E4E] hover:transition duration-300 ease-out hover:scale-110"
                        id="btn" onclick="displayShow()">Register
                </button>
            </div>
        </div>
    </div>
</div>
<script src="includes/js/script.js"></script>
</body>
</html>
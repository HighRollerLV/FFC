function getInput(inputCtrl, event, inputForm) {
    event.preventDefault();
    let msg = document.getElementById('msg');
    let form = document.getElementById(inputForm);
    let xmlhttp = new XMLHttpRequest();
    let formData = new FormData(form);
    xmlhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            if (this.responseText === "true") {
                const successMessage = "You have successfully logged in!";
                window.location = `index.php?message=${encodeURIComponent(successMessage)}`;
            } else {
                msg.innerHTML = this.responseText;
            }
        }
    };
    xmlhttp.open("POST", "controllers/" + inputCtrl, true);
    xmlhttp.send(formData);
}

document.addEventListener('DOMContentLoaded', function() {
    const urlParams = new URLSearchParams(window.location.search);
    const message = urlParams.get('message');
    if (message) {
        showSuccessMessage(message);
    }
});

function showSuccessMessage(message) {
    const successBox = document.createElement('div');
    successBox.classList.add('fixed', 'bottom-4', 'right-4', 'z-50');
    successBox.innerHTML = `
        <div class="bg-[#4e4e4e] text-[#e4c065] px-6 py-4 rounded-lg shadow-lg">
            <p class="text-xl font-bold">${message}</p>
        </div>
    `;
    document.body.appendChild(successBox);

    setTimeout(function() {
        successBox.remove();
    }, 5000);
}

// function getValue(inputCtrl, event, profileForm, id){
//     event.preventDefault();
//     let msg = document.getElementById('msg'+id);
//     let form = document.getElementById(profileForm);
//     let formData = new FormData(form);
//     let xmlhttp = new XMLHttpRequest();
//
//     xmlhttp.onreadystatechange = function() {
//         if (this.readyState == 4 && this.status == 200){
//             msg.innerHTML = this.responseText;
//         }
//     };
//     xmlhttp.open("POST", "controllers/"+inputCtrl, true);
//     xmlhttp.send(formData);
// }

function getValue(inputCtrl, event, profileForm, id){
    event.preventDefault();
    let msg = document.getElementById('msg'+id);
    let form = document.getElementById(profileForm);
    let formData = new FormData(form);

    fetch('controllers/'+inputCtrl, {
        method: 'POST',
        body: formData
    })
        .then(response => response.text())
        .then(data => {
            msg.innerHTML = data;
        })

        .catch(error => {
            console.error('Error:', error);
        });
    console.log(msg)
}

function deleteUser(userID) {
    let msg = document.getElementById('deleteUser');
    let xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            if (this.responseText == 0) {
                window.location = "register.php";
            } else {
                msg.innerHTML = this.responseText;
            }
        }
    };
    //Ajax prieksh currency un datubazēm.
    xmlhttp.open("GET", "controllers/deleteUser.php?" + userID, true);
    xmlhttp.send();

}

function displayShow() {
    event.preventDefault();
    let x = document.getElementById("divReg");
    if (x.style.display === "none") {
        btn.textContent = 'Login';
        text.textContent = "Don't have an account?";
        x.style.display = "flex";
    } else {
        btn.textContent = 'Register';
        text.textContent = "Have an account?";
        x.style.display = "none";
    }

    let y = document.getElementById("divLog");
    if (y.style.display == "flex") {
        btn.textContent = 'Login';
        text.textContent = "Have an account?";
        y.style.display = "none";
    } else {
        btn.textContent = 'Register';
        text.textContent = "Don't have an account?";
        y.style.display = "flex";
    }
}

function activateTabs(panelIndex) {
    const tabBtn = document.querySelectorAll(".tab");
    const tab = document.querySelectorAll(".tabShow");

    tab.forEach(function (node) {
        node.style.display = "none";
    });
    tab[panelIndex].style.display = "flex";
}

activateTabs(0);

function hamburger() {
    let menu = document.getElementById("mobile-menu-2");
    let menuVisible = menu.style.display === "flex";

    if (menuVisible) {
        menu.style.display = "none";
        document.removeEventListener("click", hamburger);
    } else {
        menu.style.display = "flex";
        document.addEventListener("click", hamburger);
    }
}






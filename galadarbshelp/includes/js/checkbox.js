function toggleCheckboxes(checkBoxHome, checkBoxAway, id) {
    const homeBox = document.getElementById('checkBoxHome-' + id);
    const awayBox = document.getElementById('checkBoxAway-' + id);
    // console.log(homeBox);
    // console.log(awayBox);

    homeBox.addEventListener('change', function () {
        if (homeBox.checked) {
            awayBox.checked = false;
            homeBox.setAttribute('data-checked', 'true');
            awayBox.setAttribute('data-checked', 'false');
        }else{
            homeBox.setAttribute('data-checked', 'false');
            awayBox.setAttribute('data-checked', 'false');
        }
    });

    awayBox.addEventListener('change', function () {
        if (awayBox.checked) {
            homeBox.checked = false;
            awayBox.setAttribute('data-checked', 'true');
            homeBox.setAttribute('data-checked', 'false');
        }else{
            homeBox.setAttribute('data-checked', 'false');
            awayBox.setAttribute('data-checked', 'false');
        }
    });
}

function activateButton(id, bet) {
    const buttons = document.querySelectorAll('.currency-btn-' + id);
    let currency = document.getElementById("currency");
    let newCoin = currency.dataset.currency - bet;
    let homeFighter = document.getElementById("checkBoxHome-"+id);
    let awayFighter = document.getElementById("checkBoxAway-"+id);
    let koefHome = document.getElementById("koefHome-"+id);
    let koefAway = document.getElementById("koefAway-"+id);
    let mainEv = document.getElementById("mainEv-"+id).getAttribute('data-mainEv');
    let fighter, koef;
    //Alert Message if checkbox not checked and button pressed.
    //Also checks if it has been checked afterwards if true inserts value into DB
    if (homeFighter.getAttribute('data-checked') == 'true') {
        fighter = homeFighter.value;
        koef = koefHome.getAttribute('data-koef');
    } else if (awayFighter.getAttribute('data-checked') == 'true') {
        fighter = awayFighter.value;
        koef = koefAway.getAttribute('data-koef');
    } else {
        const alertDiv = document.createElement('div');
        alertDiv.classList.add('bg-red-100', 'border', 'border-red-400', 'text-red-700', 'px-4', 'py-3', 'rounded', 'relative', 'mb-4');
        alertDiv.innerHTML = `
            <strong class="font-bold">Attention!</strong>
            <span class="block sm:inline">Please choose a fighter.</span>
        `;
        let alertContainer = document.getElementById('alert-container');
        if (!alertContainer) {
            alertContainer = document.createElement('div');
            alertContainer.id = 'alert-container';
            alertContainer.classList.add('fixed', 'top-4', 'right-4', 'z-50');
            document.body.appendChild(alertContainer);
        }
        alertContainer.appendChild(alertDiv);
        setTimeout(() => {
            alertDiv.remove();
        }, 5000);

        return;
    }
    let event = homeFighter.getAttribute('data-event');
    currency.innerHTML = newCoin;
    currency.dataset.currency = newCoin;
    // console.log("Home fighter "+homeFighter.value);
    // console.log("Away fighter "+awayFighter.value);
    // console.log("Koefficient "+koefHome.getAttribute('data-koef'));
    // console.log("Koefficient "+koefAway.getAttribute('data-koef'));
    //Jauna funkcija AJAX
    updCoin(bet, fighter, event, koef, mainEv);
    // console.log(buttons);
    //Styling for button if checked and unchecked
    buttons.forEach(button => {
        button.disabled = true;
        if (button.classList.contains('active')) {
            button.classList.add('bg-[#e4c065]');
            button.classList.add('text-[#4E4E4E]');
        }else {
            // Add red cross to disabled button
            button.classList.add('relative', 'inline-flex', 'items-center', 'justify-center', 'px-4', 'py-2');
            button.innerHTML = '';
            let icon = document.createElement('i');
            icon.classList.add('uil', 'uil-ban', 'text-red-500');
            button.appendChild(icon);
        }
        document.getElementById('bet-' + id + '-' + bet).classList.add('active');
    });
}
//Forwards data to UpdateCurrency to insert into database
function updCoin(newCoin, fighter, event, koef, mainEv) {
    let xhttp = new XMLHttpRequest()
    xhttp.open('POST', 'controllers/updateCurrency.php', true)
    xhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            let response = this.responseText;
            // console.log("answer from ajax: " + response);
        }
    };
    let data = 'coin='+newCoin+'&fighter='+fighter+'&event='+event+'&koef='+koef+'&mainEv='+mainEv;
    xhttp.send(data);
    console.log('data='+data);
}

function disableButton(id){
    let homeFighter = document.getElementById("checkBoxHome-"+id);
    let awayFighter = document.getElementById("checkBoxAway-"+id);
    const buttons = document.querySelectorAll('.currency-btn-' + id);



    buttons.forEach(button => {
        button.disabled = true;
        if (button.classList.contains('active')) {
            button.classList.add('bg-[#e4c065]');
            button.classList.add('text-[#4E4E4E]');
        }else {
            // Add red cross to disabled button
            button.classList.add('relative', 'inline-flex', 'items-center', 'justify-center', 'px-4', 'py-2');
            button.innerHTML = '';
            let icon = document.createElement('i');
            icon.classList.add('uil', 'uil-ban', 'text-red-500');
            button.appendChild(icon);
        }
        document.getElementById('bet-' + id + '-' + bet).classList.add('active');
    });
}


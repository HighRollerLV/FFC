function updateCurrency(amount) {
    let xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function() {
        if (xhr.readyState === 4) {
            if (xhr.status === 200) {
                document.getElementById("currency").textContent = xhr.responseText;
            } else {
                alert("Error updating currency!");
            }
        }
    };
    xhr.open("POST", "controllers/updateCurrency.php");
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.send("amount=" + amount);
}


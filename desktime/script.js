const addBtn = document.getElementById("add");

const input = document.getElementById("inp-group");

function addInput() {
    const checkboxes = document.createElement("input");
    checkboxes.type="checkbox";
    checkboxes.className = "select-option";

    const name = document.createElement("input");
    name.type="text";
    name.placeholder = "Team member's full name";
    name.classList.add("inputBox");

    const email = document.createElement("input");
    email.type="email";
    email.placeholder="Email";
    email.classList.add("inputBox");
    
    const inputBox = document.createElement("div");
    inputBox.className = "wrap center row";

    const selectManagement = document.createElement("select");
    selectManagement.classList.add("selectBox",);
    const optionsList = ["Management", "Programmming", "Designer"];
    optionsList.forEach(optionValue => {
        const opt = document.createElement('option');
        opt.value = optionValue;
        opt.textContent = optionValue;
        selectManagement.appendChild(opt);
    })

    const selectRole = document.createElement("select");
    selectRole.classList.add("selectBox", "graytext");
    const optionsRole = ["Role1", "Role2", "Role3"];
    optionsRole.forEach(optionValue => {
        const opt = document.createElement('option');
        opt.value = optionValue;
        opt.textContent = optionValue;
        selectRole.appendChild(opt);
    })
    
    
    inputBox.appendChild(checkboxes);
    inputBox.appendChild(name);
    inputBox.appendChild(email);
    inputBox.appendChild(selectManagement);
    inputBox.appendChild(selectRole);

    input.appendChild(inputBox);
    
    selectAllChkboxes();
    
}


addBtn.addEventListener("click", addInput);




const chkbxAll = document.getElementById("chkbxAll");

function selectAllChkboxes() {
    const chkbxOptions = document.querySelectorAll(".select-option");
    chkbxOptions.forEach(checkBox => {
        checkBox.checked = chkbxAll.checked;
    });
}

chkbxAll.addEventListener("change", () => {
    Array.from(chkbxOptions).map((chkbx) => {
        chkbx.checked = chkbxAll.checked;
    });
});
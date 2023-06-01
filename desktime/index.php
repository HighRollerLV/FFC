<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Desktime</title>
    <link rel="stylesheet" href="style.css">
    <script src="https://code.iconify.design/iconify-icon/1.0.1/iconify-icon.min.js"></script>
</head>
<body>
    <div class="container col center">
        <div class="title_spot center row">
            <img src="logo.svg">
            <h1 class="logo_title">&nbsp;DeskTime</h1>
        </div>
            <div class="linesText row center">
                        <h4>Step 3/5</h4>
            </div>
                <div class="greenLines center row">
                        <div class="greenLine">
                        </div>
                        <div class="greenLine">
                        </div>
                        <div class="greenLine">
                        </div>
                        <div class="greyLine">
                        </div>
                        <div class="greyLine">
                </div>
            </div>
            <div class="box_holder center col">
                <div class="box center col">
                    <div class="descriptions center col">
                        <h2 class="description1">Invite your team members to start tracking their time with DeskTime</h2>
                        <h3 class="description2">Add team members and assing them to a team. Skip this step if you want to do this later.</h3>
                    </div>
                            <div class="inputs center">
                                <label class="selectAll-option row" for="chkbxAll">
                                    <input onchange="selectAllChkboxes()" type="checkbox" id="chkbxAll">
                                    <p class="selectAllText">&nbsp;SELECT ALL</p>
                                </label>
                                <div class="wrap center row">
                                    <label for="chkbx1">
                                        <input class="select-option" type="checkbox" class="select-option">
                                    </label>
                                        <input type="text" placeholder="Team member's full name">
                                        <input type="text" placeholder="Email" class="inputBox">
                                        <select placeholder="Managment" class="selectBox">
                                            <option value="managment">Managment</option>
                                            <option value="managment">Programming</option>
                                            <option value="managment">Designer</option>
                                        </select>
                                        <select placeholder="Select role" class="selectBox graytext">
                                            <option value="" disabled selected>Select role</option>
                                            <option value="role1">Role1</option>
                                            <option value="role2">Role2</option>
                                            <option value="role2">Role3</option>
                                        </select>
                                </div>
                            </div>
                            <div class="addNew col center">
                                <div class="inputs">
                                        <div id="inp-group" class="inp-group center col"> 
                                            
                                        </div>
                                </div class="inputs">
                                        <div class="lowerLine center row">
                                            <a href="#" id="add" class="add">&plus;Add A NEW TEAM</a>
                                            <p class="importButtonsText">Import from:
                                                    <div class="importButtons center row">
                                                        <a class="slackButton row center" href="#"><iconify-icon icon="logos:slack-icon"></iconify-icon>&nbsp;SLACK</a>
                                                        <a class="gmailButton row center" href="#"><iconify-icon icon="cib:gmail" style="color:#E84F4B; background-color:#F5F5F5"></iconify-icon>&nbsp;GMAIL</a>
                                                        <a class="csvButton row center" href="#"><iconify-icon icon="fa6-solid:file-csv" style="color: #4eaa18;"></iconify-icon>&nbsp;CSV</a>
                                                    </div>
                                                </div>
                                            </p>
                                        </div>
                                <div class="buttons row center">
                                    <a class="skip_button row center" href="#">SKIP</a>
                                    <a class="email_button row center" href="#">SEND EMAIL</a>
                                </div>
                            </div>
                </div>
            </div>
    </div>
    <script src="script.js"></script>
</body>
</html>
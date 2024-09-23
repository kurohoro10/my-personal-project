<?php
    
?>

<div id="popup-overlay">
        <div id="crud-popup">
            <div class="close-button">
                <span><i class="fa-solid fa-xmark"></i></span>
            </div>

            <div class="one-rem-apart">
                <h6>Add user</h6>
            </div>

            <form id="user-form" method="POST" action="../../classes/App/CrudController.class.php">
                <div>
                    <div class="one-rem-apart">
                        <div class="set-both-ends">
                            <label for="crud-id">Crud Id:</label>
                            <input type="text" id="crud-id" name="crud-id" disabled>
                        </div>
                    </div>
                    <div class="one-rem-apart">
                        <div class="set-both-ends">
                            <label for="fullname">Fullname:</label>
                            <input type="text" id="fullname" name="fullname" placeholder="Fullname">
                        </div>
                        <div class="set-display-at-end">
                            <p class="errMsg hide"></p>
                        </div>
                    </div>
                    <div class="one-rem-apart">
                        <div class="set-both-ends">
                            <label for="username">Username:</label>
                            <input type="text" id="username" name="username" placeholder="Username">
                        </div>
                        <div class="set-display-at-end">
                            <p class="errMsg hide"></p>
                        </div>
                    </div>
                    <div class="one-rem-apart">
                        <div class="set-both-ends">
                            <label for="email">Email:</label>
                            <input type="email" id="email" name="email" placeholder="Email">
                        </div>
                        <div class="set-display-at-end">
                            <p class="errMsg hide"></p>
                        </div>
                    </div>
                    <div class="one-rem-apart">
                        <div class="set-both-ends">
                            <label for="password">Password:</label>
                            <div class="password">
                                <input type="password" id="password" name="password" placeholder="Password">
                                <i class="fa-regular fa-eye-slash"></i>
                            </div>
                        </div>
                        <div class="set-display-at-end">
                            <p class="errMsg hide"></p>
                        </div>
                        <div class="set-display-at-end">
                            <ul class="password-guide hide">
                                <li>* Should be 8 characters or more.</li>
                                <li>* Should contains at least 1 special character.</li>
                                <li>* Should contains at least 1 capital letter.</li>
                                <li>* Should contains at least 1 small letter.</li>
                            </ul>
                        </div>
                    </div>
                    <div class="one-rem-apart">
                        <div class="set-both-ends repassword">
                            <label for="repassword">Re-type Password:</label>
                            <div class="password">
                                <input type="password" id="repassword" name="repassword" placeholder="Re-type Password">
                                <i class="fa-regular fa-eye-slash"></i>
                            </div>
                        </div>
                        <div class="set-display-at-end">
                            <p class="errMsg hide"></p>
                        </div>
                    </div>
                    <div>
                        <button class="primary-btn" id="submit" type="submit">
                            Add User
                            <span><i class="fa-solid fa-user"></i></span>
                        </button>
                    </div>
                    <div class="set-display-at-end">
                        <p class="errMsg hide"></p>
                    </div>
                </div>
            </form>
        </div>
    </div>
<div id="popup-overlay">
        <div id="crud-popup">
            <div class="close-button">
                <span><i class="fa-solid fa-xmark"></i></span>
            </div>

            <div class="one-rem-apart">
                <h6>Add user</h6>
            </div>

            <form method="POST" action="/" class="user_form" name="user_form">
                <div>
                    <div class="one-rem-apart">
                        <div class="set-both-ends">
                            <label for="crud-id">Crud Id:</label>
                            <input type="text" name="crud-id" class="user_form_crud_id" readonly>
                        </div>
                    </div>
                    <div class="one-rem-apart">
                        <div class="set-both-ends">
                            <label for="fullname">Fullname:</label>
                            <input type="text" name="fullname" placeholder="Fullname" class="user_form_fullname">
                        </div>
                        <div class="set-display-at-end">
                            <p class="errMsg hide"></p>
                        </div>
                    </div>
                    <div class="one-rem-apart">
                        <div class="set-both-ends">
                            <label for="username">Username:</label>
                            <input type="text" name="username" placeholder="Username" class="user_form_username">
                        </div>
                        <div class="set-display-at-end">
                            <p class="errMsg hide"></p>
                        </div>
                    </div>
                    <div class="one-rem-apart">
                        <div class="set-both-ends">
                            <label for="email">Email:</label>
                            <input type="email" name="email" placeholder="Email" class="user_form_email">
                        </div>
                        <div class="set-display-at-end">
                            <p class="errMsg hide"></p>
                        </div>
                    </div>
                    <div class="one-rem-apart">
                        <div class="set-both-ends">
                            <label for="password">Password:</label>
                            <div class="password">
                                <input type="password" name="password" placeholder="Password" class="user_form_password">
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
                                <input type="password" name="repassword" placeholder="Re-type Password">
                                <i class="fa-regular fa-eye-slash"></i>
                            </div>
                        </div>
                        <div class="set-display-at-end">
                            <p class="errMsg hide"></p>
                        </div>
                    </div>
                    <div>
                        <button class="primary-btn" name="submit" type="submit">
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
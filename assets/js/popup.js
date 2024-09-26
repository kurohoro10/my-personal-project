document.addEventListener("DOMContentLoaded", () => {
    // For handling opening and closing the popup
        const addUser = document.querySelector('div.table-nav button');
        const editUsers = document.querySelectorAll('div.crud-table-form button.crud-table-edit');
        const popup = document.querySelector('#popup-overlay');
        const closeBtns = document.querySelectorAll('.close-button span');
        const deletePopup = document.querySelector('div#delete-overlay');
        const deleteBtns = document.querySelectorAll('div.crud-table-form button.crud-table-delete');
        const addUserTitle = document.querySelector('.one-rem-apart h6');
        const addUserBtn = document.querySelector('.user_form button');
        const cancelBtn = deletePopup.querySelector('.cancel-btn');

        const closePopup = (popup) => {
            popup.style.display = 'none';
            document.removeEventListener('keydown', handleClosingPopup);
        };

        // Keyboard function for closing popup
        const handleClosingPopup = (e) => {
            if (e.key === 'Escape') {
                closePopup(popup);
                closePopup(deletePopup);
            }
        };

        const openPopup = (popup) => {
           popup.style.display = 'block';
           document.addEventListener('keydown', handleClosingPopup);
        }

        // Close popup when clicking outside the popup or on the close button
        popup?.addEventListener('click', (e) => {
            if (e.target === popup) closePopup(popup);
        });

        deletePopup?.addEventListener('click', (e) => {
            if (e.target === deletePopup) closePopup(deletePopup);
        });

        closeBtns?.forEach(closeBtn => {
            closeBtn?.addEventListener('click', () => {
                closePopup(deletePopup);
                closePopup(popup);
            });
        });
        
    // End handling opening and closing the popup

    // Get data of single row
        const get_form = document.querySelector('.user_form');

        const get_form_field = (id, fullname, username, email) => {
            if (get_form){
                get_form[0].value = id;
                get_form[1].value = fullname;
                get_form[2].value = username;
                get_form[3].value = email;
            }
        };

        addUser?.addEventListener('click', () =>{
            openPopup(popup)
            addUserTitle.textContent = 'Add user';
            addUserBtn.innerHTML = 'Add user <span><i class="fa-solid fa-user"></i></span>';
            get_form_field( '', '', '', '');
        });

        editUsers?.forEach(editUser => {
            editUser.addEventListener('click', () =>{
                openPopup(popup)
                addUserTitle.textContent = 'Update user';
                addUserBtn.innerHTML = 'Update user <span><i class="fa-solid fa-user"></i></span>';
                const data = editUser.parentElement.parentElement.parentElement;
                const data_id = data.children[0].textContent;
                const data_fullname = data.children[1].textContent;
                const data_username = data.children[2].textContent;
                const data_email = data.children[3].textContent;

                if (!data || !data_id) {
                    get_form_field( '', '', '', '');
                }

                get_form_field(data_id, data_fullname, data_username, data_email);
                
            });
        });
    // End of getting data of single row

    // Deleting Data
        // Close Delete popup when cancel button is clicked
        cancelBtn?.addEventListener('click', () => closePopup(deletePopup));

        deleteBtns?.forEach(deleteBtn => {
            deleteBtn.addEventListener('click', () => {
                openPopup(deletePopup);
                const data = deleteBtn.parentElement.parentElement.parentElement;
                const data_id = data.children[0].textContent;
                const del_user = deletePopup.querySelector('.delete_id');
                del_user.value = data_id;
                console.log(del_user);
            });
        });
    // End of deleting data
});
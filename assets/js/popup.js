document.addEventListener("DOMContentLoaded", () => {
    // For handling opening and closing the popup
        const addUser = document.querySelector('div.table-nav button');
        const editUsers = document.querySelectorAll('div.crud-table-form button.crud-table-edit');
        const popup = document.querySelector('#popup-overlay');
        const closeBtns = document.querySelectorAll('.close-button span');
        const deletePopup = document.querySelector('div#delete-overlay');
        const deleteBtn = document.querySelector('div.crud-table-form button.crud-table-delete');

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

        // Open popup when the buttons are clicked
        addUser?.addEventListener('click', () => openPopup(popup));
        deleteBtn?.addEventListener('click', () => openPopup(deletePopup));

        // Close popup when clicking outside the popup or on the close button
        popup.addEventListener('click', (e) => {
            if (e.target === popup) closePopup(popup);
        });

        deletePopup.addEventListener('click', (e) => {
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
    editUsers?.forEach(editUser => {
        editUser.addEventListener('click', () =>{
            openPopup(popup)
        });
    });
});
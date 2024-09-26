<div id="delete-overlay">
        <div id="delete-popup">
            <div class="close-button">
                <span><i class="fa-solid fa-xmark"></i></span>
            </div>
            <div>
                <h6 class="warning"><strong>Delete data?</strong></h6>
            </div>
            <div>
                <div>
                    <p>Are you sure you want to delete this data?</p>
                </div>
                <div class="set-in-middle">
                    <form action="/" method="POST" class="delete_user">
                        <input type="hidden" name="delete_id" class="delete_id">
                        <button class="warning-btn">
                            Delete
                            <span><i class="fa-solid fa-trash"></i></span>
                        </button>
                    </form>
                    <button class="primary-btn cancel-btn">
                        Cancel
                    </button>
                </div>
            </div>
        </div>
    </div>
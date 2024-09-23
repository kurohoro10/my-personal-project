<?php
    // require_once __DIR__ . '/vendor/autoload.php';
    require_once 'includes/bootstrap.inc.php';
    require_once './includes/layouts/header.inc.php';

    use App\Database;
    use App\CrudController;
?>
    <main>
        <!-- Responsive Grid Design -->
        <!-- <section id="table" class="container">
            <div class="one"></div>
            <div class="two"></div>
            <div class="three"></div>
            <div class="four"></div>
            <div class="five"></div>
        </section> -->

        <section id="crud-table" class="crud-table container">
            <div class="container table-nav">
                <button class="primary-btn">
                    Add user 
                    <span><i class="fa-solid fa-user"></i></span>
                </button>
            </div>
            <table>
                <thead>
                    <tr>
                        <th><h6>ID</h6></th>
                        <th><h6>Name</h6></th>
                        <th><h6>Username</h6></th>
                        <th><h6>Email</h6></th>
                        <th><h6>Password</h6></th>
                        <th><h6>Action</h6></th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>Test</td>
                        <td>uname</td>
                        <td>test@mail.com</td>
                        <td>test</td>
                        <td>
                            <div class="crud-table-form">
                                <button class="crud-table-edit">
                                    <span><i class="fa-solid fa-pen-to-square"></i></span>
                                </button>

                                <button class="crud-table-delete">
                                    <span><i class="fa-solid fa-trash"></i></span>
                                </button>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>1</td>
                        <td>Test</td>
                        <td>uname</td>
                        <td>test@mail.com</td>
                        <td>test</td>
                        <td>
                            <form class="crud-table-form">
                                <button class="crud-table-edit">
                                    <span><i class="fa-solid fa-pen-to-square"></i></span>
                                </button>

                                <button class="crud-table-delete">
                                    <span><i class="fa-solid fa-trash"></i></span>
                                </button>
                            </form>
                        </td>
                    </tr>
                </tbody>
            </table>
        </section>
    </main>

    <?php
        // To include the popup in the page
        require_once './includes/popups/popup.inc.php';

        // To include delete warning in the page
        require_once './includes/popups/deleteWarning.inc.php';

        // footer
        require_once './includes/layouts/footer.inc.php';
    ?>

    
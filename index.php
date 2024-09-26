<?php
    require_once __DIR__ . '/vendor/autoload.php';
    require_once __DIR__ . '/includes/bootstrap.inc.php';
    require_once __DIR__ . '/includes/layouts/header.inc.php';

    use App\CrudController;
    $crudController = new CrudController();
    $data = $crudController->showData();
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

                    <?php 
                        if (empty($data)) :   
                    ?>

                    <tr>
                        <td colspan ="6">No data found!</td>
                    </tr>

                    <?php
                        else:
                            foreach($data as $row) :
                    ?>

                    <tr>
                        <td class="table_id"><?= htmlspecialchars($row['id']) ?></td>
                        <td class="table_fullname"><?= htmlspecialchars($row['fullname']) ?></td>
                        <td class="table_username"><?= htmlspecialchars($row['username']) ?></td>
                        <td class="table_email"><?= htmlspecialchars($row['email']) ?></td>
                        <td class="table_password"><?= htmlspecialchars($row['password']) ?></td>
                        <td>
                            <div class="crud-table-form">
                                <!-- <form method="POST" action=""> -->
                                    <!-- <input type="hidden" name="edit_button" value="<?= htmlspecialchars($row['id']) ?>"> -->
                                    <button class="crud-table-edit" type="submit" name="edit_button" value="<?= htmlspecialchars($row['id']) ?>">
                                        <span><i class="fa-solid fa-pen-to-square"></i></span>
                                    </button>
                                <!-- </form> -->

                                <button class="crud-table-delete">
                                    <span><i class="fa-solid fa-trash"></i></span>
                                </button>
                            </div>
                        </td>
                    </tr>

                    <?php
                            endforeach;
                        endif;
                    ?>

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

    
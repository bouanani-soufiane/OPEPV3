<?php

function allPlantes()
{
    $allUsers = new User();
    $result = $allUsers->showAllUsers();

    foreach ($result as $user) {
        ?>
        <tr>
            <td><?= $user["firstName"] ?></td>
            <td><?= $user["lastName"] ?></td>
            <td><?= $user["email"] ?></td>

            <?php if ($user["userType"] == 1) { ?>
                <td><span class="status admin">Admin</span></td>

            <?php } else { ?>
                <td><span class="status client">Client</span></td>
            <?php } ?>
        </tr>

    <?php }
}
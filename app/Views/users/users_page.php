<style>
    .header h3 {
        color: #646363;
        cursor: pointer;
    }

    .header h4 {
        color: #646363;
    }

    .table-container {
        padding: 4rem 2rem;
        background-color: rgb(226, 226, 226);
    }

    .row {
        background-color: #ffffff
    }

    .dropdown:hover>.dropdown-menu {
        display: block;
    }

    .dropdown>.dropdown-toggle:active {
        /*Without this, clicking will make it sticky*/
        pointer-events: none;
    }
</style>

<div class="container-fluid table-container">
    <div class="row rowTable">
        <div class="col-md-12 py-3">
            <div class="header w-100 d-flex justify-content-between">
                <h4 class="mb-4">User Details</h4>
                <a href="/displayCreateUsers" class="">
                    <h3 class="mr-3">+</h3>
                </a>
            </div>
            <div class="table">
                <table class="table align-middle mb-0 bg-white">
                    <thead class="bg-light">
                        <tr>
                            <th>First name</th>
                            <th>Last name</th>
                            <th>Username</th>
                            <th>Access level</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php

                        if ($all_users) {
                            foreach ($all_users as $user) {
                        ?>
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="ms-3">
                                                <a href="Process/<?php echo $user->id ?>" class="fw-bold mb-1 text-dark"><?php echo $user->Firstname ?></a>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <p class="fw-normal mb-1"><?php echo $user->Lastname ?></p>
                                    </td>
                                    <td><?php echo $user->Username ?></td>
                                    <td><?php echo  $user->accessname  ?></td>

                                    <td>
                                        <span class="badge badge-success rounded-pill d-inline">Active</span>
                                    </td>
                                    <td>
                                        <div class="dropdown h-100 ml-3 mt-2">
                                            <button data-mdb-button-init
                                                data-mdb-ripple-init data-mdb-dropdown-init
                                                class=" bg-transparent p-0 border-0 dropdown-toggle"
                                                type="button"
                                                id="dropdownMenuButton"
                                                data-mdb-toggle="dropdown"
                                                style="color: #6c6c6c;"
                                                aria-expanded="false">
                                                <i class="fas fa-cog text-dark"></i>
                                            </button>
                                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                <li><a class="dropdown-item" href="/displayUpdateUsers/<?php echo $user->id ?>">Update</a></li>

                                                <li><a class="dropdown-item" style="cursor: pointer;" onclick="if (confirm('Are you sure you want to delete this user?')) { location.replace('/DeleteUser/<?php echo $user->id ?>'); }">Delete</a></li>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                            <?php
                            }
                        } else { ?>
                            <td>No user avaialble</td>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
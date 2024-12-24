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

    .pagination li {
        border: 2px solid #f0eeee;
        padding: 8px;
    }

    .pagination li:hover {
        background-color: rgb(218, 216, 216);
        cursor: pointer;
    }
</style>

<div class="container-fluid table-container">
    <div class="row rowTable">
        <div class="col-md-12 py-3">
            <div class="header w-100 d-flex justify-content-between">
                <h4 class="mb-4">User Details</h4>
                <div class="right-div d-flex ">
                    <!-- Button trigger modal -->
                    <button type="button" style="height:max-content; margin-right: 50px;" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                        Filter
                    </button>
                    <a href="/displayCreateUsers" class="">
                        <h3 class="mr-3">+</h3>
                    </a>
                </div>
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
                                                <a href="Process/<?php echo $user['id'] ?>" class="fw-bold mb-1 text-dark"><?php echo $user['Firstname'] ?></a>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <p class="fw-normal mb-1"><?php echo $user['Lastname'] ?></p>
                                    </td>
                                    <td><?php echo $user['Username'] ?></td>
                                    <td><?php echo  $accesslevel[$user['Accesslevel'] - 1]['roles']  ?></td>

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
                                                <li><a class="dropdown-item" href="/displayUpdateUsers/<?php echo $user['id'] ?>">Update</a></li>

                                                <li><a class="dropdown-item" style="cursor: pointer;" onclick="if (confirm('Are you sure you want to delete this user?')) { location.replace('/DeleteUser/<?php echo $user['id'] ?>'); }">Delete</a></li>
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
                <div class="pager d-flex mt-5 justify-content-center">
                    <?php echo $pager['pager']->links() ?>
                </div>


                <!-- Modal -->
                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h3 class="modal-title fs-5" id="exampleModalLabel">Filter</h3>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">X</button>
                            </div>
                            <form action="/Users">
                            <div class="modal-body">
                                <div class="select mr-5 mt-2">
                                        <select class="js-example-basic-single" style="width: 90%;" name="state">
                                            <option value="">Select role</option>
                                            <?php
                                            foreach ($accesslevel as $role) { ?>
                                                <option value="<?php echo $role['id'] ?>"><?php echo $role['roles'] ?></option>
                                            <?php } ?>
                                        </select>
                                        <!-- <input type="submit" name="" class="btn btn-primary" id=""> -->
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Filter</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    // In your Javascript (external .js resource or <script> tag)
    $(document).ready(function() {
        $('.js-example-basic-single').select2();
    });
</script>
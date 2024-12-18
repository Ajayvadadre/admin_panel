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
</style>

<div class="container-fluid table-container ">
    <div class="row rowTable w-75 pt-2">
        <div class="col-md-12 py-3">
            <?php if ($userData) { ?>
                <form action="/updateUser/<?php echo $userData['id'] ?>" method="post">
                    <div class="header d-flex justify-content-between">
                        <h4 class="mb-4">Update users </h4>
                        <a href="/createCampaign" class="">
                        </a>
                    </div>
                    <div class="details">
                        <div class="name-details d-flex flex-column">
                            <label for="Firstname">First name:</label>
                            <input name="Firstname" value="<?php echo $userData['Firstname'] ?>" type="text">
                        </div>
                        <div class="name-details d-flex flex-column mt-4">
                            <label for="Lastname">Last name:</label>
                            <input name="Lastname" value="<?php echo $userData['Lastname'] ?>" type="text">
                        </div>
                        <div class="name-details d-flex flex-column mt-4">
                            <label for="Username">Username:</label>
                            <input name="Username" value="<?php echo $userData['Username'] ?>" type="text">
                        </div>
                        <div class="name-details d-flex flex-column mt-4">
                            <label for="Password">Password:</label>
                            <input name="Password" value="<?php echo $userData['Password'] ?>" type="password">
                        </div>
                        <div class="name-details d-flex flex-column mt-4">
                            <label for="Accesslevel">Access level:</label>
                            <select class="form-select" name="Accesslevel" aria-label="Default select example">
                                <option class=" font-weight-bold" selected> <?php echo $userData['Accesslevel'] ?></option>
                                <option value="1">Admin</option>
                                <option value="2">Supervisor</option>
                                <option value="3">Team leader</option>
                                <option value="4">Agent</option>
                            </select>
                        </div>
                    </div>
                <?php } ?>
                <div class="saveDetails w-100 mt-5">
                    <button type="submit" class="btn btn-primary">Update</button>
                    <a href="/Users" class="btn btn-light ml-2">cancel</a>
                </div>
                </form>
        </div>
    </div>
</div>
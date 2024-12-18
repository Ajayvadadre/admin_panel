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

                <form  action="/updateCampaign/<?php echo $userData['id'] ?>" method="post">
                    <div class="header d-flex justify-content-between">
                        <h4 class="mb-4">Update Campaign </h4>
                        <a href="/createCampaign" class="">
                        </a>
                    </div>
                    <div class="details">
                        <div class="name-details d-flex flex-column">
                            <label for="name">Name:</label>
                            <input value=" <?php echo $userData['name'] ?>" name="name" type="text">
                        </div>
                        <div class="name-details d-flex flex-column mt-4">
                            <label for="description">Description:</label>
                            <input value=" <?php echo $userData['description'] ?>" name="description" type="text">
                        </div>
                        <div class="name-details d-flex flex-column mt-4">
                            <label for="client">Client:</label>
                            <input value=" <?php echo $userData['client'] ?>" name="client" type="text">
                        </div>
                        <div class="name-details d-flex flex-column mt-4">
                            <label for="supervisor">Supervisor:</label>
                            <input value=" <?php echo $userData['supervisor'] ?>" name="supervisor" type="text">
                        </div>
                    </div>
                    <div class="saveDetails w-100 mt-5">
                        <button type="submit" class="btn btn-primary">Save</button>
                        <a href="/Home" class="btn btn-light ml-2">cancel</a>
                    </div>
                </form>
            <?php } ?>
        </div>
    </div>
</div>
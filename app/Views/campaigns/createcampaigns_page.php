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
            <form action="/createCampaign" method="post">
                <div class="header d-flex justify-content-between">
                    <h4 class="mb-4">Create Campaign </h4>
                    <a href="/createCampaign" class="">
                    </a>
                </div>
                <div class="details">
                    <div class="name-details d-flex flex-column">
                        <label for="name">Name:</label>
                        <input name="name" type="text">
                        <?php if (session()->getFlashdata('sameCampaignError')) { ?>
                            <div>
                                <h6 class="text-danger mt-1"><?php echo session()->getFlashdata('sameCampaignError'); ?></h6>
                            </div>
                        <?php } ?>
                    </div>
                    <div class="name-details d-flex flex-column mt-4">
                        <label for="description">Description:</label>
                        <input name="description" type="text">
                    </div>
                    <div class="name-details d-flex flex-column mt-4">
                        <label for="client">Client:</label>
                        <input name="client" type="text">
                    </div>
                    <div class="name-details d-flex flex-column mt-4">
                        <label for="supervisor">Supervisor:</label>
                        <input name="supervisor" type="text">
                    </div>
                </div>
                <div class="saveDetails w-100 mt-5">
                    <button type="submit" class="btn btn-primary">Save</button>
                    <a href="/Campaigns" class="btn btn-light ml-2">cancel</a>
                </div>
            </form>
        </div>
    </div>
</div>
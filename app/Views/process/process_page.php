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

<div class="container-fluid table-container">
    <div class="row rowTable">
        <div class="col-md-12 py-3">
            <div class="header w-100 d-flex justify-content-between">
                <h4 class="mb-4">Process Details</h4>
                <?php
                if ($all_process) {
                    foreach ($all_process as $process) {                ?>
                        <a href="/displayCreateProcess/<?php echo $process['id'] ?>" class="">
                            <h3 class="mr-3">+</h3>
                        </a>
                <?php }
                }
                ?>
            </div>
            <div class="table">
                <table class="table align-middle mb-0 bg-white">
                    <thead class="bg-light">
                        <tr>
                            <th>Name</th>
                            <th>Description</th>
                            <th>Client</th>
                            <th>Supervisor</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if ($all_process) {
                            foreach ($all_process as $process) {
                        ?>
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="ms-3">
                                                <a href="Process/<?php $process['id'] ?>" class="fw-bold mb-1 text-dark"><?php echo $campaigns['name'] ?></a>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <p class="fw-normal mb-1"><?php echo $process['description'] ?></p>
                                    </td>
                                    <td><?php echo $process['client'] ?></td>
                                    <td><?php echo $process['supervisor'] ?></td>
                                    <td>
                                        <span class="badge badge-success rounded-pill d-inline">Active</span>
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-link btn-sm btn-rounded">
                                            <i class="fas fa-cog text-dark"></i>
                                        </button>
                                        
                                    </td>
                                </tr>
                            <?php }
                        } else { ?>
                            <td>No process found</td>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<style>
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
            <p></p>

            <h4 class="mb-4">Hourly report</h4>
            <div class="table">
                <table class="table align-middle mb-0 bg-white">
                    <thead class="bg-light">
                        <tr>
                          
                            <th>Hour</th>
                            <th>Call count</th>
                            <th>Total duration</th>
                            <th>Total hold</th>
                            <th>Total ringing</th>
                            <th>Total transfer</th>
                            <th>Total conference</th>
                        </tr>

                    </thead>
                    <tbody>
                        <?php if ($data) {
                            foreach ($data as $value) {
                                ?>
                                <tr>
                                    
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="ms-3">
                                                <p class="fw-bold mb-1"><?= $value['hour'].":00 - ".$value['hour']+1 .":00"  ?>     </p>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <p class="fw-normal mb-1"><?= $value['call_count'] ?></p>
                                    </td>
                                    <td>
                                        <p class="fw-normal mb-1"><?= gmdate('H:i:s',$value['total_duration'])  ?></p>
                                    </td>
                                    <td>
                                        <p class="fw-normal mb-1"><?= $value['total_hold'] ?></p>
                                    </td>
                                    <td>
                                        <p class="fw-normal mb-1"><?= $value['total_ringing'] ?></p>
                                    </td>
                                    <td>
                                        <p class="fw-normal mb-1"><?= $value['total_transfer'] ?></p>
                                    </td>
                                    <td>
                                        <p class="fw-normal mb-1"><?= $value['total_conference'] ?></p>
                                    </td>
                              
                                </tr>
                                <?php
                            }
                        } else { ?>
                            <td>No data avaialble</td>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
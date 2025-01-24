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
        <div class="col-md-12 py-3 " style="overflow: auto;" >
            <p></p>

            <div class="header d-flex justify-content-between" >
                <h4 class="mb-4">Logger report</h4>
                <div class="downloadData">
                        <form action="<?php echo base_url()?>/ExportOverallData/" method="get">
                            <button type="submit" style="text-transform: capitalize; border:1px solid lightgrey" class="btn btn-primary">Export csv</button>
                        </form>
                </div>
            </div>
            <div class="table">
            <table class="table">
                    <thead class="table-dark">
                      <tr>
                        <th class="texzt-capitalize">datetime</th>
                        <th class="text-capitalize">type</th>
                        <th class="text-capitalize">disposetype</th>
                        <th class="text-capitalize">disposename</th>
                        <th class="text-capitalize">duration</th>
                        <th class="text-capitalize">agentname</th>
                        <th class="text-capitalize">campaignName</th>
                        <th class="text-capitalize">processName </th>
                        <th class="text-capitalize">leadset</th>
                        <th class="text-capitalize">referenceUuid</th>
                        <th class="text-capitalize">customerUuid</th>
                        <th class="text-capitalize">hold</th>
                        <th class="text-capitalize">mute</th>
                        <th class="text-capitalize">ringing</th>
                        <th class="text-capitalize">transfer</th>
                        <th class="text-capitalize">conference</th>
                        <th class="text-capitalize">oncall</th>
                        <th class="text-capitalize">disposetime</th>
                      </tr>
                    </thead>
                    
                    <tbody class="table-border-bottom-0">
                    <?php foreach($data as $row){ ?>
                        <tr>
                          <td><?= $id === "elastic" ? $row['datetime'] : $row['datetime'] ?></td>
                          <td><?= $id === "mysql" ? $row['type'] :  $row['calltype']?></td>
                          <td><?= $id === "elastic" ? $row['disposetype'] : $row['disposetype'] ?></td>
                          <td><?= $id === "elastic" ? $row['disposename'] : $row['disposename'] ?></td>
                          <td><?= $id === "elastic" ? $row['agentname'] : $row['agentname'] ?></td>
                          <td><?= $id === "elastic" ? $row['campaignName'] : $row['campaignName'] ?></td>
                          <td><?= $id === "elastic" ? $row['processName'] : $row['processName'] ?></td>
                          <td><?= $id === "elastic" ? $row['leadset'] : $row['leadset'] ?></td>
                          <td><?= $id === "elastic" ? $row['refrence_uuid'] : ($id === "mongo"? $row['refrence_uuid']:$row['referenceUuid']) ?></td>
                          <td><?= $id === "elastic" ? $row['coustomer_uuid'] : ($id === "mongo"? $row['coustomer_uuid']:$row['customerUuid']) ?></td>
                          <td><?= $id === "elastic" ? gmdate("H:i:s",(int)$row['hold']):gmdate("H:i:s", (int)$row['hold']) ?>Hr</td>
                          <td><?= $id === "elastic" ? gmdate("H:i:s",(int)$row['mute']):gmdate("H:i:s", (int)$row['mute']) ?>Hr</td>
                          <td><?= $id === "elastic" ? gmdate("H:i:s",(int)$row['ringing']):gmdate("H:i:s", (int)$row['ringing']) ?>Hr</td>
                          <td><?= $id === "elastic" ? gmdate("H:i:s",(int)$row['transfer']):gmdate("H:i:s", (int)$row['transfer']) ?>Hr</td>
                          <td><?= $id === "elastic" ? gmdate("H:i:s",(int)$row['conference']):gmdate("H:i:s", (int)$row['conference']) ?>Hr</td>
                          <td><?= $id === "elastic" ? gmdate("H:i:s",(int)$row['call']): ($id==="mongo"?gmdate("H:i:s", (int)$row['call']):gmdate("H:i:s", (int)$row['oncall']))?>Hr</td>
                          <td><?= $id === "elastic" ? (int)$row['disposetime'] : $row['disposetime'] ?></td>
                      </tr> 
                      <?php } ?>
                    </tbody>
                  </table>
                <?= $pager?>
            </div>
        </div>
    </div>
</div>

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

            <div class="header d-flex justify-content-between" >
                <h4 class="mb-4">Logger report</h4>
                <div class="downloadData">
                        <form action="/ExportData" method="get">
                            <button type="submit" style="text-transform: capitalize; border:1px solid lightgrey" class="btn btn-primary">Export csv</button>
                        </form>
                </div>
            </div>
            <div class="table">
            <table class="table">
                    <thead class="table-dark">
                      <tr>
                        <th>hours</th>
                        <th>call count</th>
                        <th>Total duration</th>
                        <th>Total hold</th>
                        <th>Total Mute</th>
                        <th>total Ringing</th>
                        <th>Total transfer</th>
                        <th>Total onCall</th>
                        <th>Total consferenace</th>
                      </tr>
                    </thead>
                    
                    <tbody class="table-border-bottom-0">
                      <?php foreach($data as $row) { ?>
                      <?php $total_duration = $id === "elastic" ? $row['total_hold']['value'] + $row['total_mute']['value'] +$row['total_ringing']['value']+$row['total_transfer']['value']+$row['call_count']['value']+$row['total_conference']['value'] : $row['total_hold'] + $row['total_mute'] +$row['total_ringing']+$row['total_transfer']+$row['call_count']+$row['total_conference']; ?>
                      <tr>
                        
                        <td><?= $id === "elastic" ?  gmdate("H",$row['key']/1000).":00 - ".gmdate("H",$row['key']/1000)+1 .":00" : $row['hour'].":00 -  ".$row['hour']+1 .":00"  ?></td>
                        <td><?= $id === "elastic" ? $row['doc_count'] : $row['call_count'] ?></td>
                        <td><?= floor($total_duration/3600)?>: <?= floor(($total_duration%3600)/60)?> hr</td>
                        <td><?= $id === "elastic" ? gmdate("H:i:s",$row['total_hold']['value']):gmdate("H:i:s", $row['total_hold']) ?>Hr</td>
                        <td><?= $id === "elastic" ? gmdate("H:i:s",$row['total_mute']['value']):gmdate("H:i:s",$row['total_mute'])?> Hr</td>
                        <td><?= $id === "elastic" ? gmdate("H:i:s",$row['total_ringing']['value']):gmdate("H:i:s",$row['total_ringing']) ?> Hr</td>
                        <td><?= $id === "elastic" ? gmdate("H:i:s",$row['total_transfer']['value']):gmdate("H:i:s",$row['total_transfer']) ?>: Hr</td>
                        <td><?= $id === "elastic" ? gmdate("H:i:s",$row['call_count']['value']):gmdate("H:i:s",$row['call_count']) ?> Hr</td>
                        <td><?= $id === "elastic" ? gmdate("H:i:s",$row['total_conference']['value']):gmdate("H:i:s",$row['total_conference']) ?> Hr</td>
                      </tr>
                      <?php } ?>
                    </tbody>
                  </table>
                <?= $pager?>
            </div>
        </div>
    </div>
</div>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" />

    <style>
        body {
            background-color: #f4f7f6;
            margin-top: 20px;
        }

        .card {
            background: #fff;
            transition: .5s;
            border: 0;
            margin-bottom: 30px;
            border-radius: .55rem;
            position: relative;
            width: 100%;
            box-shadow: 0 1px 2px 0 rgb(0 0 0 / 10%);
        }

        .chat-app .people-list {
            width: 280px;
            position: absolute;
            left: 0;
            top: 0;
            padding: 20px;
            z-index: 7
        }

        .chat-app .chat {
            margin-left: 280px;
            border-left: 1px solid #eaeaea
        }

        .people-list {
            -moz-transition: .5s;
            -o-transition: .5s;
            -webkit-transition: .5s;
            transition: .5s
        }

        .people-list .chat-list li {
            padding: 10px 15px;
            list-style: none;
            border-radius: 3px
        }

        .people-list .chat-list li:hover {
            background: #efefef;
            cursor: pointer
        }

        .people-list .chat-list li.active {
            background: #efefef
        }

        .people-list .chat-list li .name {
            font-size: 15px
        }

        .people-list .chat-list img {
            width: 45px;
            border-radius: 50%
        }

        .people-list img {
            float: left;
            border-radius: 50%
        }

        .people-list .about {
            float: left;
            padding-left: 8px
        }

        .people-list .status {
            color: #999;
            font-size: 13px
        }

        .chat .chat-header {
            padding: 15px 20px;
            border-bottom: 2px solid #f4f7f6
        }

        .chat .chat-header img {
            float: left;
            border-radius: 40px;
            width: 40px
        }

        .chat .chat-header .chat-about {
            float: left;
            padding-left: 10px
        }

        .chat .chat-history {
            padding: 20px;
            border-bottom: 2px solid #fff
        }

        .chat .chat-history ul {
            padding: 0
        }

        .chat .chat-history ul li {
            list-style: none;
            margin-bottom: 30px
        }

        .chat .chat-history ul li:last-child {
            margin-bottom: 0px
        }

        .chat .chat-history .message-data {
            margin-bottom: 15px
        }

        .chat .chat-history .message-data img {
            border-radius: 40px;
            width: 40px
        }

        .chat .chat-history .message-data-time {
            color: #434651;
            padding-left: 6px
        }

        .chat .chat-history .message {
            color: #444;
            padding: 18px 20px;
            line-height: 26px;
            font-size: 16px;
            border-radius: 7px;
            display: inline-block;
            position: relative
        }

        .chat .chat-history .message:after {
            bottom: 100%;
            left: 7%;
            border: solid transparent;
            content: " ";
            height: 0;
            width: 0;
            position: absolute;
            pointer-events: none;
            border-bottom-color: #fff;
            border-width: 10px;
            margin-left: -10px
        }

        .chat .chat-history .my-message {
            background: #efefef
        }

        .chat .chat-history .my-message:after {
            bottom: 100%;
            left: 30px;
            border: solid transparent;
            content: " ";
            height: 0;
            width: 0;
            position: absolute;
            pointer-events: none;
            border-bottom-color: #efefef;
            border-width: 10px;
            margin-left: -10px
        }

        .chat .chat-history .other-message {
            background: #e8f1f3;
            text-align: right
        }

        .chat .chat-history .other-message:after {
            border-bottom-color: #e8f1f3;
            left: 93%
        }

        .chat .chat-message {
            padding: 20px
        }

        .online,
        .offline,
        .me {
            margin-right: 2px;
            font-size: 8px;
            vertical-align: middle
        }

        .online {
            color: #86c541
        }

        .offline {
            color: #e47297
        }

        .me {
            color: #1d8ecd
        }

        .float-right {
            float: right
        }

        .clearfix:after {
            visibility: hidden;
            display: block;
            font-size: 0;
            content: " ";
            clear: both;
            height: 0
        }

        @media only screen and (max-width: 767px) {
            .chat-app .people-list {
                height: 465px;
                width: 100%;
                overflow-x: auto;
                background: #fff;
                left: -400px;
                display: none
            }

            .chat-app .people-list.open {
                left: 0
            }

            .chat-app .chat {
                margin: 0
            }

            .chat-app .chat .chat-header {
                border-radius: 0.55rem 0.55rem 0 0
            }

            .chat-app .chat-history {
                height: 300px;
                overflow-x: auto
            }
        }

        @media only screen and (min-width: 768px) and (max-width: 992px) {
            .chat-app .chat-list {
                height: 650px;
                overflow-x: auto
            }

            .chat-app .chat-history {
                height: 600px;
                overflow-x: auto
            }
        }

        @media only screen and (min-device-width: 768px) and (max-device-width: 1024px) and (orientation: landscape) and (-webkit-min-device-pixel-ratio: 1) {
            .chat-app .chat-list {
                height: 480px;
                overflow-x: auto
            }

            .chat-app .chat-history {
                height: calc(100vh - 350px);
                overflow-x: auto
            }
        }
    </style>
</head>

<body>

    <div class="container">
        <div class="row clearfix">
            <div class="col-lg-12">
                <div class="card chat-app">
                    <div id="plist" class="people-list">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fa fa-search"></i></span>
                            </div>
                            <input type="text" class="form-control" placeholder="Search...">
                        </div>
                        <ul class="list-unstyled chat-list mt-2 mb-0">
                            <li class="clearfix">
                                <img src="https://bootdey.com/img/Content/avatar/avatar1.png" alt="avatar">
                                <div class="about">
                                    <div class="name">Vincent Porter</div>
                                    <div class="status"> <i class="fa fa-circle offline"></i> left 7 mins ago </div>
                                </div>
                            </li>
                            <li class="clearfix active">
                                <img src="https://bootdey.com/img/Content/avatar/avatar2.png" alt="avatar">
                                <div class="about">
                                    <div class="name">Aiden Chavez</div>
                                    <div class="status"> <i class="fa fa-circle online"></i> online </div>
                                </div>
                            </li>
                            <li class="clearfix">
                                <img src="https://bootdey.com/img/Content/avatar/avatar3.png" alt="avatar">
                                <div class="about">
                                    <div class="name">Mike Thomas</div>
                                    <div class="status"> <i class="fa fa-circle online"></i> online </div>
                                </div>
                            </li>
                            <li class="clearfix">
                                <img src="https://bootdey.com/img/Content/avatar/avatar7.png" alt="avatar">
                                <div class="about">
                                    <div class="name">Christian Kelly</div>
                                    <div class="status"> <i class="fa fa-circle offline"></i> left 10 hours ago </div>
                                </div>
                            </li>
                            <li class="clearfix">
                                <img src="https://bootdey.com/img/Content/avatar/avatar8.png" alt="avatar">
                                <div class="about">
                                    <div class="name">Monica Ward</div>
                                    <div class="status"> <i class="fa fa-circle online"></i> online </div>
                                </div>
                            </li>
                            <li class="clearfix">
                                <img src="https://bootdey.com/img/Content/avatar/avatar3.png" alt="avatar">
                                <div class="about">
                                    <div class="name">Dean Henry</div>
                                    <div class="status"> <i class="fa fa-circle offline"></i> offline since Oct 28 </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <div class="chat">
                        <div class="chat-header clearfix">
                            <div class="row">
                                <div class="col-lg-6">
                                    <a href="javascript:void(0);" data-toggle="modal" data-target="#view_info">
                                        <img src="https://bootdey.com/img/Content/avatar/avatar2.png" alt="avatar">
                                    </a>
                                    <div class="chat-about">
                                        <h6 class="m-b-0">Aiden Chavez</h6>
                                        <small>Last seen: 2 hours ago</small>
                                    </div>
                                </div>
                                <div class="col-lg-6 hidden-sm text-right">
                                    <a href="javascript:void(0);" class="btn btn-outline-secondary"><i class="fa fa-camera"></i></a>
                                    <a href="javascript:void(0);" class="btn btn-outline-primary"><i class="fa fa-image"></i></a>
                                    <a href="javascript:void(0);" class="btn btn-outline-info"><i class="fa fa-cogs"></i></a>
                                    <a href="javascript:void(0);" class="btn btn-outline-warning"><i class="fa fa-question"></i></a>
                                </div>
                            </div>
                        </div>
                        <div class="chat-history">
                            <ul class="m-b-0">
                                <li class="clearfix">
                                    <div class="message-data text-right">
                                        <span class="message-data-time">10:10 AM, Today</span>
                                        <img src="https://bootdey.com/img/Content/avatar/avatar7.png" alt="avatar">
                                    </div>
                                    <div class="message other-message float-right"> Hi Aiden, how are you? How is the project coming along? </div>
                                </li>
                                <li class="clearfix">
                                    <div class="message-data">
                                        <span class="message-data-time">10:12 AM, Today</span>
                                    </div>
                                    <div class="message my-message">Are we meeting today?</div>
                                </li>
                                <li class="clearfix">
                                    <div class="message-data">
                                        <span class="message-data-time">10:15 AM, Today</span>
                                    </div>
                                    <div class="message my-message">Project has been already finished and I have results to show you.</div>
                                </li>
                            </ul>
                        </div>
                        <div class="chat-message clearfix">
                            <div class="input-group mb-0">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fa fa-send"></i></span>
                                </div>
                                <input type="text" class="form-control" placeholder="Enter text here...">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="../../../public/bootstrap/bootstrap"></script>
</body>

</html>

<!-- amarsharma :  1122 -->
<!-- ajayvadadre : 112233 -->
<!-- yash12 : 1122 -->
<!-- mitileshShinde : 1122 -->  
















public function logger_report($id){ 
        $data['loginDetails'] = session()->get(); 
        $page = $this->request->getVar('page') ? (int)$this->request->getVar('page') : 1; 
        $perPage = 10; 
        $data['id']= $id;
        // Number of records per page 
        $ch = curl_init(); 
        $url =  $id==="mysql" ? 'http://localhost:3000/mysql/summary' : ($id==="mongo" ?'http://localhost:3000/mongo/summary' : "localhost:3000/elastic/summary"); 
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); 
        curl_setopt($ch, CURLOPT_URL, $url); 
        $response = json_decode(curl_exec($ch), true); 
        $total = count($response); 
        $data['pageData'] = $id ==="elastic" ? array_slice($response, ($page - 1) * $perPage, $perPage)['aggregations']['group_by_hour']['buckets'] : array_slice($response, ($page - 1) * $perPage, $perPage); 
        $data['pager'] = $this->pager->makeLinks($page, $perPage, $total); 
        echo view('components/Dashborad', $data); 
        echo view('components/logger_report', $data); 
    }








 
<div class="content-wrapper">
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="card">
          <div class="d-flex">
                <h5 class="card-header" >Summary Reports</h5>
                <div class="card-body mt-3">
                  <a href="#" class="btn btn-info">download</a>
                </div>
          </div>
                <div class="table-responsive text-nowrap">
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
                      <?php foreach($pageData as $row) { ?>
                      <?php $total_duration = $id === "elastic" ? $row['total_hold']['value'] + $row['total_mute']['value'] +$row['total_ringing']['value']+$row['total_transfer']['value']+$row['total_onCall']['value']+$row['total_conference']['value'] : $row['total_hold'] + $row['total_mute'] +$row['total_ringing']+$row['total_transfer']+$row['total_onCall']+$row['total_conference']; ?>
                      <tr>
                        
                        <td><?= $id === "elastic" ?  gmdate("H",$row['key']/1000).":00 - ".gmdate("H",$row['key']/1000)+1 .":00" : $row['hour'].":00 -  ".$row['hour']+1 .":00"  ?></td>
                        <td><?= $id === "elastic" ? $row['doc_count'] : $row['call_count'] ?></td>
                        <td><?= floor($total_duration/3600)?>: <?= floor(($total_duration%3600)/60)?> hr</td>
                        <td><?= $id === "elastic" ? gmdate("H:i:s",$row['total_hold']['value']):gmdate("H:i:s", $row['total_hold']) ?>Hr</td>
                        <td><?= $id === "elastic" ? gmdate("H:i:s",$row['total_mute']['value']):gmdate("H:i:s",$row['total_mute'])?> Hr</td>
                        <td><?= $id === "elastic" ? gmdate("H:i:s",$row['total_ringing']['value']):gmdate("H:i:s",$row['total_ringing']) ?> Hr</td>
                        <td><?= $id === "elastic" ? gmdate("H:i:s",$row['total_transfer']['value']):gmdate("H:i:s",$row['total_transfer']) ?>: Hr</td>
                        <td><?= $id === "elastic" ? gmdate("H:i:s",$row['total_onCall']['value']):gmdate("H:i:s",$row['total_onCall']) ?> Hr</td>
                        <td><?= $id === "elastic" ? gmdate("H:i:s",$row['total_conference']['value']):gmdate("H:i:s",$row['total_conference']) ?> Hr</td>
                      </tr>
                      <?php } ?>
                    </tbody>
                  </table>
                  <div>
                    <?php echo $pager ?>
                  </div>
                </div>
              </div>
    </div>
</div>















<!-- my home view page -->
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
                <table class="table align-middle mb-0 bg-white">
                    <thead class="bg-light">
                        <tr>
                            <th>Campaign name</th>
                            <th>Process name</th>
                            <th>Hour</th>
                            <th>Call count</th>
                            <th>Total duration</th>
                            <th>Total hold</th>
                            <th>Total ringing</th>
                            <th>Total transfer</th>
                            <th>Total conference</th>
                            <th>Unique calls</th>
                        </tr>

                    </thead>
                    <tbody>
                        <?php if ($data) {
                            // var_dump($data);
                            foreach ($data[0] as $value) {
                                ?>
                                <tr>
                                    <td>
                                        <p class="fw-normal mb-1"><?= $value['campaignName'] ?></p>
                                    </td>
                                    <td>
                                        <p class="fw-normal mb-1"><?= $value['processName'] ?></p>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="ms-3">
                                                <p class="fw-bold mb-1"><?= $value['hour'] ?>Hr </p>
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
                                    <td>
                                        <p class="fw-normal mb-1"><?= $value['unique_calls'] ?></p>
                                    </td>
                                </tr>
                                <?php
                            }
                        } else { ?>
                            <td>No data avaialble</td>
                        <?php } ?>
                    </tbody>
                </table>
                <?= $pager?>
            </div>
        </div>
    </div>
</div>
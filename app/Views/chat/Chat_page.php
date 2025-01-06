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
            /* position: relative */
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
                        <?php $condition = true;
                        if ($condition) { ?>
                            <ul class="list-unstyled chat-list mt-2 mb-0">
                                <?php
                                foreach ($all_user as $user) { ?>
                                    <li class="clearfix" id="agentsList" data-username="<?php echo $user['Username'] ?>">
                                        <img src="https://bootdey.com/img/Content/avatar/avatar1.png" alt="avatar">
                                        <div class="about">
                                            <div id="someid" class="name text-capitalize"><?php echo $user['Username'] ?></div>
                                            <div class="status"> <i class="fa fa-circle offline"></i> left 7 mins ago </div>
                                        </div>
                                    </li>
                                <?php }
                                ?>

                            </ul>
                        <?php } else { ?>
                            <ul class="clearfix mt-5">
                                <div class="about">
                                    <div class="name">No user</div>
                                </div>
                            </ul>
                        <?php } ?>
                    </div>
                    <div class="chat">
                        <div class="chat-header clearfix">
                            <div class="row">
                                <div class="col-lg-6">
                                    <a href="javascript:void(0);" data-toggle="modal" data-target="#view_info">
                                        <img src="https://bootdey.com/img/Content/avatar/avatar2.png" alt="avatar">
                                    </a>
                                    <div class="chat-about">
                                        <h6 id="reciverHeading" class="m-b-0 text-capitalize">Aiden Chavez</h6>
                                        <small>Last seen: 2 hours ago</small>
                                    </div>
                                </div>
                                <div class="col-lg-6 hidden-sm text-right">
                                    <!-- <a href="javascript:void(0);" class="btn btn-outline-secondary"><i class="fa fa-camera"></i></a>
                                    <a href="javascript:void(0);" class="btn btn-outline-primary"><i class="fa fa-image"></i></a>
                                    <a href="javascript:void(0);" class="btn btn-outline-info"><i class="fa fa-cogs"></i></a>
                                    <a href="javascript:void(0);" class="btn btn-outline-warning"><i class="fa fa-question"></i></a> -->
                                    <p><?= session('username') ?></p>

                                </div>
                            </div>
                        </div>
                        <div class="chat-history">
                            <ul class="m-b-0">
                                <li class="clearfix d-flex flex-column" id="messageField">
                                    <div class="message-data text-right">
                                        <span class="message-data-time">10:10 AM, Today</span>
                                        <img src="https://bootdey.com/img/Content/avatar/avatar7.png" alt="avatar">
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <div class="chat-message clearfix">
                            <div class="input-group mb-0">
                                <div class="input-group-prepend ">
                                    <span class="input-group-text" style="cursor:pointer" id="sendBtn"><i class="fa fa-send"></i></span>
                                </div>
                                <input type="text" id="textField" class="form-control" placeholder="Enter text here...">
                            </div>
                        </div>
                    </div>
                </div>
            </div>


        </div>
    </div>
    <script src="<?php echo base_url('jquery/jquery.js') ?>"></script>
    <script src="<?php echo base_url('socketio/socketio.js') ?>"></script>
    <script>
        const someId = document.getElementById('someid').textContent
        // const socket = io(URL, {
        //     autoConnect: false
        // });
        const socket = io.connect('http://localhost:3000');
        const sendBtn = document.getElementById('sendBtn');
        const textField = document.getElementById('textField');
        const messageField = document.getElementById('messageField');
        const displayMessage = document.getElementById('show-message');
        const agentsList = document.querySelectorAll("#agentsList");
        const sender = "<?= session('username') ?>"
        const reciverHeading = document.getElementById('reciverHeading');
        let reciver = null


        //emit join 


        // Registering user id:
        socket.emit("register", sender);

        // To get all the socket events inside console
        socket.onAny((event, ...args) => {
            console.log(event, args);
        });

        // Private message 
        const sendPrivateMessage = () => {
            console.log(sender, reciever, message);
        }


        // Display agents list on screen 
        agentsList.forEach((x) => {
            x.addEventListener('click', (event) => {
                reciver = x.getAttribute('data-username');
                console.log(reciver);
                reciverHeading.innerText = reciver
                socket.emit('join', {sender,reciver});
                return reciver;
            });
        });

        //Socket emit 
        sendBtn.addEventListener('click', () => {
            message = textField.value
            socket.emit('sendMessage', message);
            textField.value = '';
        })
        textField.addEventListener('keydown', () => {
            if (event.key == 'Enter') {
                message = textField.value
                console.log(message)
                // socket.`emit('sendMessage', message, sender, reciver);
                socket.emit('privateMessage', {
                    message,
                    reciver,
                    sender
                })
                textField.value = '';
            }
        })
        //Socket listener 
        socket.on('recievedMessage', function(msg) {
            var item = document.createElement('div');
            item.innerHTML = `<div class="message other-message float-right mt-2" id="show-message">${msg}</div>`;
            messageField.appendChild(item);
            window.scrollTo(0, document.body.scrollHeight);
        });

        //private message reciever 
        socket.on("private message", ({
            message,
            from
        }) => {
            console.log("Client side private msg: " + message + " " + from)
            var item = document.createElement('div');
            item.innerHTML = `   <li class="clearfix">
                <div class="message-data mt-2">
                    <span class="message-data-time">${from}</span>
                </div>
                <div class="message my-message">${message}</div>
            </li>`;
            messageField.appendChild(item);
            window.scrollTo(0, document.body.scrollHeight);
        });

        // Room message listener
        socket.on('roomMessage',()=>{
            
        })


    </script>
</body>

</html>
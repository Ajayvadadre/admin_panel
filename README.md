# CodeIgniter 4 Application Starter

## What is CodeIgniter?

CodeIgniter is a PHP full-stack web framework that is light, fast, flexible and secure.
More information can be found at the [official site](https://codeigniter.com).

This repository holds a composer-installable app starter.
It has been built from the
[development repository](https://github.com/codeigniter4/CodeIgniter4).

More information about the plans for version 4 can be found in [CodeIgniter 4](https://forum.codeigniter.com/forumdisplay.php?fid=28) on the forums.

You can read the [user guide](https://codeigniter.com/user_guide/)
corresponding to the latest version of the framework.

## Installation & updates

`composer create-project codeigniter4/appstarter` then `composer update` whenever
there is a new release of the framework.

When updating, check the release notes to see if there are any changes you might need to apply
to your `app` folder. The affected files can be copied or merged from
`vendor/codeigniter4/framework/app`.

## Setup

Copy `env` to `.env` and tailor for your app, specifically the baseURL
and any database settings.

## Important Change with index.php

`index.php` is no longer in the root of the project! It has been moved inside the *public* folder,
for better security and separation of components.

This means that you should configure your web server to "point" to your project's *public* folder, and
not to the project root. A better practice would be to configure a virtual host to point there. A poor practice would be to point your web server to the project root and expect to enter *public/...*, as the rest of your logic and the
framework are exposed.

**Please** read the user guide for a better explanation of how CI4 works!

## Repository Management

We use GitHub issues, in our main repository, to track **BUGS** and to track approved **DEVELOPMENT** work packages.
We use our [forum](http://forum.codeigniter.com) to provide SUPPORT and to discuss
FEATURE REQUESTS.

This repository is a "distribution" one, built by our release preparation script.
Problems with it can be raised on our forum, or as issues in the main repository.

## Server Requirements

PHP version 8.1 or higher is required, with the following extensions installed:

- [intl](http://php.net/manual/en/intl.requirements.php)
- [mbstring](http://php.net/manual/en/mbstring.installation.php)

> [!WARNING]
> - The end of life date for PHP 7.4 was November 28, 2022.
> - The end of life date for PHP 8.0 was November 26, 2023.
> - If you are still using PHP 7.4 or 8.0, you should upgrade immediately.
> - The end of life date for PHP 8.1 will be December 31, 2025.

Additionally, make sure that the following extensions are enabled in your PHP:

- json (enabled by default - don't turn it off)
- [mysqlnd](http://php.net/manual/en/mysqlnd.install.php) if you plan to use MySQL
- [libcurl](http://php.net/manual/en/curl.requirements.php) if you plan to use the HTTP\CURLRequest library



//bootstrap templartes for jay
- https://startbootstrap.com/templates/ecommerce
- https://themewagon.com/themes/kaira/

         <li><a class="dropdown-item" href="/DeleteUser/<?php echo $user->id ?>">Delete</a></li>


----------------------------------------
//19-12-2024

Topics: 
1: Calling API
2: Pre-call handeler 
3: State change on Event  
4: Transfer button on call



#Calling Api-
- Calling Api is a service which has API's related to the call events which are called based on events.
- When a agent initates a call, the call event is send to the chat server with the agents data to pre-call handler service which gathers agents data and sends to calling API's where the command to originate call is initiated 
    - There are two types of originate command- 
        - 1:Normal API: For web/OnDemand = SessionSlashRTC() 
        - 2:Bridge API: For Bridge/Inbound= customerOriginateAndPark()
- Call event service is responsible for merging agents and customer call on the basis of channel.
- Calling API's also changes the state of the agent.
- Note: This are required for making media query commands or else it wont perform it.
        - agent reference UID
        - customer UID
        - remote call UID 

        
#Media queries- Media query has commands or context that are in XML.
                - Eg: Agent->When clicks Hold->Multiple steps/services performed-> 2 context created->
                      XML Agent context-> sends to valet(park state)
                      XML Customer context-> sends to valet(park state)

#State change on Event- 
- When on call and agent clicks on Hold,mute,unmute,stop,transfer etc this are onCall events handled by PreCallHandler service  which then calls the corresponding api's in calling api's with the complete data of the Agent. Different commands are present for each event/state.
- For Hold: 
     when agent clicks hold->PreCallHandler service is called with the data-> In calling Api service-> Hold command gets performed uuid_dual_transfer command is send to media query with data->media query->adds agent & coustomer in valet(park)->sets state to hold

- For Mute: 
     when agent clicks Mute->checks mode of call(Bridge/Ondemand,web)
     if Ondemand/Bridge: Commands ->PreCallHandler->calling API->Mute API command(command_Mute)->media query->performs command-> reduces volume for it

- Unhold:
    when agent clicks Unhold->preCallHandler->Calling API's->calls command(uuid_bridge)->merges 2 calls

#Transfer button on call:
- Transfer start button is used when agent wants to transfer call to another agent.
- Calls are transfered based on 3 conditions:
        - 1: Team- If Team is selected agent is shown other agents from same process.
        - 2: other Team- If other Team is selected agent is shown agents from another campaigns process.This option is only available if configed in campaign button settings. 
        - 3: external transfer- If external transfer agent can add external number in input the call has to transfer to. 
        
- ->Agent->Transfer button->chat server->preCallHandler gets all agents data-> calls Calling API->State of the agent is set to transfer start->
- Agents are shown based on the conditions set for that process->
- 

- Call disconnect button: 
                  - Call disconnect button while clicked->checks mode of call
                  - If Bridge->sends data-> chat server-> calls remoteagenttransfercancle API directly using socket -> remoteagenttransfercancle performs its command-> Sets agent to park/ready state.
                  - If web/Ondemand->"same as bridge"->chat server->calls hangupAPI->hangupAPI performs its command-> sets agent state to dispose 

        - 3 scenearios when btn will be called: 1- Manual call disconnect
                                                2- Bridge call disconnect
                                                3- Conference call disconnect 
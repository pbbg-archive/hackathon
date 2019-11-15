<?php

$judges = [
    'asdfdelta' => 'https://cdn.discordapp.com/avatars/202823592918908928/e27286e80ed59fa2e55f6717e834e968.png?size=128',
    'FoohonPie' => 'https://cdn.discordapp.com/avatars/188520252387229696/9dfc30c153b525d76d38a04e6d54fb1e.png?size=128',
    'Hudy' => 'https://cdn.discordapp.com/avatars/148515701550743552/a_1a6d43a229b5fe03dbe76e020e12c1e2.gif?size=128"',
];

$webhookurl = '';

$errors = [];
$success = false;

if (isset($_POST['register']) && $webhookurl !== '') {

    $gitLink = $_POST['git_link'];
    $name = $_POST['team_name'];

    if (isset($gitLink) && isset($name)) {

        if(!filter_var($gitLink, FILTER_VALIDATE_URL))
            $errors[] = 'You must submit a valid Git URL';

        if(strlen($name) < 3 || strlen($name) > 50)
            $errors[] = 'Your team name must contain between 3 and 50 characters';

        if(count($errors) === 0) {
            $msg = "{$name} has registered for the hackathon, {$gitLink}";
            $json_data = [
                'username' => 'Hackathon Bot',
                'content' => "$msg"
            ];
            $make_json = json_encode($json_data);
            $ch = curl_init($webhookurl);
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $make_json);
            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
            curl_setopt($ch, CURLOPT_HEADER, 0);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            $response = curl_exec($ch);

            $success = true;

        }

    } else {
        $errors[] = 'Some fields are missing';
    }

}

?>
<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
          integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/582fef26d7.js" crossorigin="anonymous"></script>

    <title>Hackathon - PBBG</title>

    <style type="text/css">

        header {
            height: 625px;
            width: 100%;
            position: relative;
            max-height: 100vh;
        }

        #bg {
            background: url("./images/header.png") #000;
            position: absolute;
            height: 100%;
            width: 100%;
        }

        header .titles {
            z-index: 1;
        }

        #bg:before {
            height: 100%;
            width: 100%;
            position: absolute;
            left: 0;
            top: 0;
            background-color: rgba(0, 0, 0, 0.9);
            content: ' ';
        }

        .description-list .icon > svg {
            height: 58px;
            width: 58px;
        }

        .avatar {
            height: 56px;
            width: 56px;
        }

        .rule-list > li {
            margin: 5px 0;
        }

    </style>
</head>
<body>
<header class="d-flex justify-content-center justify-items-center align-items-center mb-4">
    <div id="bg"></div>
    <div class="titles text-white text-center">
        <div class="container">
            <div class="row">
                <div class="col">

                    <h1 class="">PBBG Hackathon #1</h1>
                    <h4 class="text-white-50 mb-5">November 23rd and 24th 2019</h4>

                    <form action="" method="post" class="form-inline mb-3">

                        <input type="text" placeholder="Team Name" name="team_name" class="form-control mb-2 mb-md-0 mr-md-3" />
                        <input type="text" placeholder="Repository Link" name="git_link" class="form-control mb-2 mb-md-0 mr-md-3" />
                        <input type="submit" name="register" value="Sign up" class="btn btn-primary">


                    </form>
                    <?php

                    if($success)
                        echo "<div class='alert alert-success'>You have successfully entered the hackathon</div>";

                    if(count($errors) > 0) {
                        $temp = '';

                        $temp .= "<div class='alert alert-danger'>";

                        foreach ($errors as $error)
                            $temp .= "<p class='mb-0'>{$error}</p>";

                        $temp .= "</div>";

                        echo $temp;
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</header>
<section id="intro">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-10 col-md-7">
                <p class="text-center lead">Welcome to PBBG's first ever hackathon, brought to you by the PBBG staff
                    team. It's
                    our first attempt at a group competition with some small prizes at the end</p>
                <hr>
            </div>
        </div>
    </div>
</section>
<section id="pretty-icons" class="py-5 my-4">
    <div class="container">
        <div class="row justify-content-center description-list">
            <div class="col-sm-12 col-md-5">
                <div class="d-flex p-4">
                    <div class="icon d-inline-block">
                        <i data-fa-symbol="users" class="far fa-users"></i>
                        <svg>
                            <use xlink:href="#users"></use>
                        </svg>
                    </div>
                    <div class="icon-description d-inline-block ml-3">
                        <h4 class=" d-inline-block">Teams</h4>
                        <p class="">Work in teams of up to 3 people, so join your friends for 48 hours and build
                            something!</p>
                    </div>
                </div>

            </div>
            <div class="col-sm-12 col-md-5">
                <div class="d-flex p-4">
                    <div class="icon d-inline-block">
                        <i data-fa-symbol="clock" class="far fa-clock"></i>
                        <svg>
                            <use xlink:href="#clock"></use>
                        </svg>
                    </div>
                    <div class="icon-description d-inline-block ml-3">
                        <h4 class=" d-inline-block">48 Hours</h4>
                        <p class="">The hackathon lasts 48 hours over Saturday 23rd and Sunday 24th</p>
                    </div>
                </div>
            </div>
            <div class="col-sm-12 col-md-5">
                <div class="d-flex p-4">
                    <div class="icon d-inline-block">
                        <i data-fa-symbol="puzzle-piece" class="far fa-puzzle-piece"></i>
                        <svg>
                            <use xlink:href="#puzzle-piece"></use>
                        </svg>
                    </div>
                    <div class="icon-description d-inline-block ml-3">
                        <h4 class=" d-inline-block">PBBG</h4>
                        <p class="">The game must be a persistent browser based game to qualify for entry</p>
                    </div>
                </div>
            </div>
            <div class="col-sm-12 col-md-5">
                <div class="d-flex p-4">
                    <div class="icon d-inline-block">
                        <i data-fa-symbol="unicorn" class="far fa-unicorn"></i>
                        <svg>
                            <use xlink:href="#unicorn"></use>
                        </svg>
                    </div>
                    <div class="icon-description d-inline-block ml-3">
                        <h4 class=" d-inline-block">Freedom!</h4>
                        <p class="">Any genre, any game type, mafia, fantasy, tick based, time based, up to you!</p>
                    </div>
                </div>
            </div>
            <div class="col-sm-12 col-md-5">
                <div class="d-flex p-4">
                    <div class="icon d-inline-block">
                        <i data-fa-symbol="money-bill" class="far fa-money-bill-alt"></i>
                        <svg>
                            <use xlink:href="#money-bill"></use>
                        </svg>
                    </div>
                    <div class="icon-description d-inline-block ml-3">
                        <h4 class=" d-inline-block">Cash Prizes</h4>
                        <p class="">1st and 2nd place will get cash prizes, third will gain Discord Nitro!</p>
                    </div>
                </div>
            </div>
            <div class="col-sm-12 col-md-5">
                <div class="d-flex p-4">
                    <div class="icon d-inline-block">
                        <i data-fa-symbol="box" class="far fa-box-full"></i>
                        <svg>
                            <use xlink:href="#box"></use>
                        </svg>
                    </div>
                    <div class="icon-description d-inline-block ml-3">
                        <h4 class=" d-inline-block">Packages</h4>
                        <p class="">Use any packages and any framework, the only requirement is that the end product
                            must be
                            open source!</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section id="rules" class="bg-dark text-white py-5 my-4">

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-10">
                <h2>Rules</h2>

                <ol class="rule-list">
                    <li>Teams must not contain more than 3 people</li>
                    <li>You may use any open source libraries or frameworks such as Socket.IO, Express, Laravel,
                        Spring
                    </li>
                    <li>Your first commit must be on or after 2019-11-23 00:01 GMT (Saturday the 23rd)</li>
                    <li>Your last commit must be on or before 2019-11-24 23:59 GMT (Sunday the 24th)</li>
                    <li>No code must be pre written, though planning on Trello or something similar is allowed,
                        likewise setting up your development environment
                    </li>
                    <li>It must be a PBBG, however basic or complex.</li>
                    <li>You may use assets previously created or open source assets. Your choice.</li>
                </ol>
            </div>
        </div>
    </div>
</section>

<section id="team" class="py-5 my-4">
    <div class="container">
        <div class="row justify-content-center mb-5">
            <div class="col-10">
                <h2>Judges</h2>
            </div>
        </div>
        <div class="row">
            <?php foreach ($judges as $judgeName => $image) { ?>
                <div class="col-sm-12 col-md-4 text-center">
                    <figure class="figure text-center">
                        <img src="<?= $image ?>" alt="<?= $judgeName ?> Avatar" class="avatar mb-4">
                        <figcaption class="figure-caption">
                            Judge <?= $judgeName ?>
                        </figcaption>
                    </figure>
                </div>
            <?php } ?>
        </div>
    </div>
</section>

<footer>
    <div class="container">
        <div class="row">
            <div class="col text-center text-muted">
                &copy; 2019 PBBG
            </div>
        </div>
    </div>
</footer>
</body>
</html>

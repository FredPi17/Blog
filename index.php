<?php
/**
 * Created by PhpStorm.
 * User: pinau
 * Date: 18/02/2018
 * Time: 11:08
 */
?>

<!doctype html>
<html lang="fr">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <link rel="icon" type="image/jpg" href="img/dashboard.png"/>
    <title>BLOG</title>
    <!--<link rel="stylesheet" href="http://dhbhdrzi4tiry.cloudfront.net/cdn/sites/foundation.min.css">-->
    <link rel="stylesheet" href="include/css/foundation.css">
    <link rel="stylesheet" href="include/css/app.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="include/fonts/foundation-icons/foundation-icons.css">
</head>
<body>
<?php
include_once("include/utilisateur.php");
include_once("include/import.php");
?>

<style>
    div.textImage:hover {
        border: black solid 2px;
    }
    .fi-social-facebook, .fi-social-twitter, .fi-social-instagram, .fi-social-linkedin{
        font-size: 3rem;
    }
</style>
<div class="off-canvas-wrapper">
    <div class="off-canvas-wrapper-inner" data-off-canvas-wrapper>
        <div class="off-canvas position-top" id="menu" data-off-canvas data-position="top">
            <div class="row column">
                <div class="small-up-2 medium-up-3 large-up-4">
                    <div class="column">
                        <p>colonne 1</p>
                    </div>
                    <div class="column">
                        <p>Colonne 2</p>
                    </div>
                    <div class="column">
                        <p>Colonne 3
                        </p>
                    </div>
                    <div class="column">
                        <p>Colonne 4</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="off-canvas-content" data-off-canvas-content>
            <div class="title-bar">
                <div class="small-up-1 medium-up-2">
                    <div class="column text-left">
                        <h2>Blog de Frédéric Pinaud</h2>
                    </div>
                    <div class="column text-right">
                        <button class="menu-icon" type="button" data-open="menu"></button>
                        <br>
                        <p>MENU</p>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="columns medium-8 text-center" style="margin-top: 10px; padding-right: 10px;">
                    <div class="textImage" style=" background-color: white; height: 350px;">
                        <a href="article.php?id=<?php echo $id; ?>">
                            <img src="<?php echo $image; ?>" style="width: 100%; height: 280px; color: black;"><br>
                            <p class="text-left" style="font-style: inherit;"><?php echo $titre; ?></p>
                        </a>
                    </div>
                </div>

                <div class="columns medium-4 text-center" style="margin-top: 10px">
                    <div class="textImage" style="background: white; height: 170px;">
                        <a href="article.php?id=<?php echo $id; ?>">
                            <img src="<?php echo $image; ?>" style="width: 100%; height: 100px;"><br>
                            <p class="text-left"><?php echo $titre; ?></p>
                        </a>
                    </div>
                    <div class="textImage" style="background: white; height: 170px; margin-top: 10px;">
                        <a href="article.php?id=<?php echo $id; ?>">
                            <img src="<?php echo $image; ?>" style="width: 100%; height: 100px;"><br>
                            <p class="text-left"><?php echo $titre; ?></p>
                        </a>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="columns medium-12" style="margin-top: 20px;">
                    <div class="textImage" style="background-color: white; height: 200px;">
                        <a href="article.php?id=<?php echo $id; ?>">
                            <div class="columns medium-7">
                                <img src="<?php echo $image; ?>" style="width: 100%; height: 190px;">
                            </div>
                            <div class="columns medium-5">
                                <h2 class="text-left"><?php echo $titre; ?></h2><br>
                                <p class="text-left"><?php echo $intro; ?></p>
                                <p>Auteur : <?php echo $auteur; ?></p>
                            </div>
                        </a>
                    </div>

                </div>
            </div>
            <hr>
            <div class="row">
                <div class="columns medium-8" style="margin-top: 20px; padding-right: 10px; border-right: 1px solid darkgrey;">
                    <div class="textImage" style="background-color:white; height: 450px;">
                        <a href="article.php?id=<?php echo $id;?>">
                            <img src="<?php echo $image;?>" style="height: 200px; width:100%"><br>
                            <h2><?php echo $titre;?></h2><br>
                            <p><?php echo $intro;?></p><br>
                            <p>Auteur: <?php echo $auteur;?></p>
                        </a>
                    </div>
                    <div class="textImage" style="background-color:white; height: 450px; margin-top: 20px;">
                        <a href="article.php?id=<?php echo $id;?>">
                            <img src="<?php echo $image;?>" style="height: 200px; width:100%"><br>
                            <h2><?php echo $titre;?></h2><br>
                            <p><?php echo $intro;?></p><br>
                            <p>Auteur: <?php echo $auteur;?></p>
                        </a>
                    </div>
                </div>
                <div class="columns medium-4" style="margin-top: 20px; padding-left: 10px;">
                    <h2 class="text-center">Me suivre</h2>
                    <div class="row small-up-4">
                        <div class="column text-center">
                            <a href="https://www.facebook.com/frederic.pinaud.7"><i class="fi-social-facebook"></i></a>
                        </div>
                        <div class="column text-center">
                            <a href="https://twitter.com/FredericPinaud"><i class="fi-social-twitter"></i></a>
                        </div>
                        <div class="column text-center">
                            <a href="https://www.instagram.com/fred0du04/"><i class="fi-social-instagram"></i></a>
                        </div>
                        <div class="column text-center">
                            <a href="https://www.linkedin.com/in/frederic-pinaud-092773b2/"><i class="fi-social-linkedin"></i></a>
                        </div>
                    </div>
                    <hr>
                    <div class=""
                </div>
            </div>
        </div>
    </div>
</div>
<script src="include/js/vendor/jquery.js"></script>
<script src="include/js/vendor/foundation.min.js"></script>
<script>$(document).foundation();</script>
</body>
</html>
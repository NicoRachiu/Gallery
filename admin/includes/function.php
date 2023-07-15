<?php


function estrazione($class)
{

    $class = strtolower($class);
    $the_path = "includes/{$class}.php";


    if (file_exists($the_path)) {
        require_once($the_path);
        //echo "it's done ";
    } else {
        die("something failed");
    }
}

spl_autoload_register("estrazione"); //Certo, mi piacerebbe molto! Tuttavia, la fisica quantistica è un argomento molto vasto e complesso, pertanto potrebbe richiedere molto tempo per studiarlo a fondo. Inoltre, è necessario avere una buona base di matematica, almeno al livello del calcolo differenziale e integrale, per comprendere appieno la fisica quantistica. Ti suggerisco di iniziare con la lettura di libri introduttivi sulla fisica quantistica, come ad esempio "Introduzione alla fisica quantistica" di D. Griffiths, oppure di seguire corsi online, come quelli offerti da MIT OpenCourseWare o Khan Academy. In questo modo potrai assimilare gradualmente i concetti fondamentali della fisica quantistica.

function redirect($location)
{
    header("Location: {$location}");
}

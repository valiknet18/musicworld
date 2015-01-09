<?php
function show_run($text, $command, $canFail = false)
{
    echo "\n* $text\n$command\n";
    passthru($command, $return);
    if (0 !== $return && !$canFail) {
        echo "\n/!\\ The command returned $return\n";
        exit(1);
    }
}

show_run("Drop DB", "app/console doctrine:database:drop --force");
show_run("Create DB", "app/console doctrine:database:create");
show_run("Create scheme", "app/console doctrine:schema:create");
show_run("Install fixtures", "app/console doctrine:fixtures:load");
show_run("Install assets", "app/console assets:install");
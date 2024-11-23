<?php
function isPortOpen($host, $port, $timeout = 1): bool {
    $connection = @fsockopen($host, $port, $errno, $errstr, $timeout);
    if (is_resource($connection)) {
        fclose($connection);
        return true;
    }
    return false;
}

function checkPorts($host, $startPort, $endPort, $maxProcesses = 500): void {
    $activeProcesses = 0;

    for ($port = $startPort; $port <= $endPort; $port++) {
        if ($port % 1000 === 0) echo "Выполняется проверка $port порта...\n";
        $pid = pcntl_fork();
        if ($pid == -1) {
            die("Невозможно создать дочерний процесс!");
        } else if ($pid) {
            $activeProcesses++;
            if ($activeProcesses >= $maxProcesses) {
                pcntl_wait($status);
                $activeProcesses--;
            }
        } else {
            if (isPortOpen($host, $port)) echo "Порт $port открыт!\n";
            exit(0);
        }
    }

    while ($activeProcesses > 0) {
        pcntl_wait($status);
        $activeProcesses--;
    }
}

checkPorts($argv[1], 1, 65535);

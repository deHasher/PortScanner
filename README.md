Вводим в терминале и кайфуем:

Linux: ```wget -qO- https://raw.githubusercontent.com/deHasher/PortScanner/refs/heads/master/PortScanner.php | php -- -arg1 АЙПИ_АДРЕС```

Windows: ```Invoke-WebRequest -Uri "https://raw.githubusercontent.com/deHasher/PortScanner/refs/heads/master/PortScanner.php" -OutFile "PortScanner.php"; php PortScanner.php -arg1 АЙПИ_АДРЕС; Remove-Item "PortScanner.php"```

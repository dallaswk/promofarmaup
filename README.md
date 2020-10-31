# promofarmaup
A simple php script to take data from Farmatic DB and upload to Promofarma services.

Set the connection data to DB at the start of extractor.php file.

You can make a little script for run this script, something like this:

SET PATH=\php\php-5.6.18\
@echo off
php.exe -f extractor.php
ping localhost -n 10 >nul 
copy Datos\datos.csv X:\Dropbox\Promofarma\Datos\promofarma.csv /y
exit

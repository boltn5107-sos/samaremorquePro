@echo off
cd /d C:\Users\moradmin\Desktop\samaremorquePro-main\samaremorquePro-main\public
php -S 127.0.0.1:8000 server.php > nul 2>&1 & timeout /t 2 /nobreak > nul
echo Testing CSS headers:
curl -s -I http://127.0.0.1:8000/build/assets/app-CQcrnDP3.css
echo.
echo Testing page:
curl -s -I http://127.0.0.1:8000/
echo.
echo Killing...
taskkill /F /IM php.exe 2>nul
echo Done
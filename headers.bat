@echo off
Start-Process -FilePath php -ArgumentList "artisan,serve,--port=8000,--host=127.0.0.1" -WindowStyle Hidden
timeout /t 3 /nobreak > nul
curl -s -I http://127.0.0.1:8000/build/assets/app-CQcrnDP3.css
echo ---
curl -s -I http://127.0.0.1:8000/
echo ---
taskkill /F /IM php.exe 2>nul
echo Done
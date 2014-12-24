@echo off
echo Installing HTTPD
\ABCD\Apache2.4\bin\httpd.exe -k install
if errorlevel==1 goto :alt1
echo HTPPD installed
echo Starting Apache2
\ABCD\Apache2.4\bin\httpd.exe -k start
if errorlevel==1 goto :alt2
echo Apache2.4 started
goto :fim

:alt1
echo Error installing Apache2.4 as service
echo Using first alternate mode 1
start cmd /K alternate24.bat
goto :fim

:alt2
echo Error starting Apache2.4 service
echo Using first alternate mode 2
start cmd /K alternate24.bat
goto :fim

:fim
echo Calling ABCD Site
start  http://localhost:9090
exit
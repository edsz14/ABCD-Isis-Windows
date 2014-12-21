@ECHO OFF

REM Startup script for jetty under Windows systems
REM
REM Configuration variables
REM
REM JAVA_HOME
REM   Home of Java installation.
REM
REM JAVA
REM   Command to invoke Java. If not set, $JAVA_HOME/bin/java will be used.
REM
REM JAVA_OPTIONS
REM   Extra options to pass to the JVM
REM
REM JETTY_HOME
REM   Where Jetty is installed.
REM   The java system property "jetty.home" will be
REM   set to this value for use by configure.xml files, f.e.:
REM
REM    <Arg><SystemProperty name="jetty.home" default="."/>/webapps/jetty.war</Arg>
REM
REM JETTY_CONSOLE
REM   Where Jetty console output should go.
REM

REM #############################################################
REM ####### EmpWeb environment variables and Java parameters.
REM ####### CHANGE THIS TO CONFIGURE FOR YOUR LOCAL SETUP!
REM #############################################################

REM The root directory of the Empweb installation
    set EMPWEB_HOME=\ABCD\empweb\

REM URL of ABCD software
    set ABCD_URL=http://localhost:9090


REM Specify the Jetty configuration files for all the parts of Empweb that this server must run.
REM If you want to run everything in one machine, then specify ewdbws, ewengine, ewgui configurations.
    set CONFIGS=%EMPWEB_HOME%\common\etc\ewdbws-jetty.xml %EMPWEB_HOME%\common\etc\ewengine-jetty.xml %EMPWEB_HOME%\common\etc\ewgui-jetty.xml


REM Variables used by Jetty
    set JETTY_HOME=\ABCD\empweb\jetty
    set JETTY_START=%EMPWEB_HOME%\common\etc\start.config
    set JETTY_CONSOLE=%JETTY_HOME%\logs\jetty-console.log

REM set JETTY_CONSOLE=CON

REM Java variables.
    set JAVA_HOME="\Program Files\Java\jdk1.7.0_09\bin"
    set JAVA=%JAVA_HOME%\javaw.exe


REM CISIS Wrapper
    set CISIS_LOCATION="\ABCD\www\cgi-bin"
    set CISIS_COMMAND="\mx"
    set OS=win32


REM Logging settings.
    set LOGGING_CONF=%EMPWEB_HOME%\common\etc\logging.properties

REM For large memory machines, dedicated to Empweb, -Xms = initial heap size, -Xmx = maximum heap size
REM    set JAVA_OPTIONS=-server -DSTART=%JETTY_START%  -Djetty.home=%JETTY_HOME% -Dempweb.home=%EMPWEB_HOME% -Djava.util.logging.config.file=%LOGGING_CONF% -Xms96M -Xmx512M  -Xincgc

REM Or use less memory in smaller machines running other programs
 set JAVA_OPTIONS=-server -DSTART=%JETTY_START% -Djetty.home=%JETTY_HOME% -Dcisis.os=%OS% -Dcisis.location=%CISIS_LOCATION% -Dcisis.command=%CISIS_COMMAND% -Dempweb.home=%EMPWEB_HOME% -Djava.util.logging.config.file=%LOGGING_CONF% -Dabcd.url=%ABCD_URL% -Xms128M -Xmx128M -Xincgc


REM ############################################################################
REM #### You shouldn't change anything below unless you know what you're doing!
REM ############################################################################

:usage
if not /%1==/ goto correct
   echo "Usage: %0 {start|startdebug|stop|check|supervise} [ CONFIGS ... ] "
   exit /B 1

:correct


REM ##################################################
REM # Get the action & configs
REM ##################################################

set ACTION=%1
shift


REM ###########################################################
REM # Get the list of config.xml files from the command line.
REM ###########################################################
:procargs
if "%1"=="" goto endif

    if exist %1 (
       set CONF=%1
       goto config
    )
    if exist %JETTY_HOME%\etc\%1 (
       set CONF=%JETTY_HOME%\etc\%1
       goto config
    )
    if exist %1.xml (
       set CONF=%1.xml
       goto config
    )
    if exist %JETTY_HOME%\etc\%1.xml (
       set CONF=%JETTY_HOME%\etc\%1.xml
       goto endiconfigf
    )
    echo ** ERROR: Cannot find configuration %1% specified in the command line.
    exit /B 1

:config
    set CONFIGS=%CONFIGS% %CONF%
    shift
    goto procargs
:endif




REM #####################################################
REM # Add jetty properties to Java VM options.
REM #####################################################
set JAVA_OPTIONS=%JAVA_OPTIONS% -Djava.library.path=%EMPWEB_HOME%\common\ext

if not %ACTION%==startdebug goto notdebug
  set JAVA_OPTIONS= -DDEBUG %JAVA_OPTIONS%

:notdebug

REM #####################################################
REM # This is how the Jetty server will be started
REM #####################################################
set RUN_CMD=%JAVA% %JAVA_OPTIONS%  -jar %JETTY_HOME%/start.jar %CONFIGS%

REM #####################################################
REM # This is to stop the Jetty server
REM #####################################################
set STOP_CMD=%JAVA% %JAVA_OPTIONS% -jar %JETTY_HOME%/stop.jar


REM #####################################################
REM # Comment these out after you're happy with what
REM # the script is doing.
REM #####################################################
echo JETTY_HOME     =  %JETTY_HOME%
echo JETTY_CONSOLE  =  %JETTY_CONSOLE%
echo CONFIGS        =  %CONFIGS%
echo JAVA_OPTIONS   =  %JAVA_OPTIONS%
echo JAVA           =  %JAVA%
echo CLASSPATH      =  %CLASSPATH%
echo RUN_CMD        =  %RUN_CMD%

REM #################################################
REM # Do the action
REM ##################################################

goto %ACTION%

:start
:startdebug
  echo Starting Jetty:


  for /f "tokens=1,2,3,4 delims=/ " %%i in ('date/t') do set d=%%k/%%j/%%i
  for /f "tokens=1,2,3,4 delims=:.," %%a in ("%TIME%") do set t=%%a:%%b:%%c:%%d
  set DATE_TIME=%d%,%t%
  echo STARTED Jetty %DATE_TIME% >> %JETTY_CONSOLE%

  %RUN_CMD% >>%JETTY_CONSOLE% 2>&1
  goto ENDACTION

:stop

  for /f "tokens=1,2,3,4 delims=/ " %%i in ('date/t') do set d=%%k/%%j/%%i
  for /f "tokens=1,2,3,4 delims=:.," %%a in ("%TIME%") do set t=%%a:%%b:%%c:%%d
  set DATE_TIME=%d%,%t%
    echo STOPPED %DATE_TIME% 

  %STOP_CMD% 
  goto ENDACTION

:supervise
REM ### NOT DONE ### 	REM #
REM ### NOT DONE ### 	REM # Under control of daemontools supervise monitor which
REM ### NOT DONE ### 	REM # handles restarts and shutdowns via the svc program.
REM ### NOT DONE ### 		REM #
REM ### NOT DONE ### 		%RUN_CMD%
  goto ENDACTION

:check
  echo Checking arguments to Jetty:
  echo JETTY_HOME     =  %JETTY_HOME%
  echo JETTY_CONSOLE  =  %JETTY_CONSOLE%
  echo JETTY_PORT     =  %JETTY_PORT%
  echo CONFIGS        =  %CONFIGS%
  echo JAVA_OPTIONS   =  %JAVA_OPTIONS%
  echo JAVA           =  %JAVA%
  echo CLASSPATH      =  %CLASSPATH%
  echo RUN_CMD        =  %RUN_CMD%
  echo
  goto ENDACTION

:ENDACTION

exit





REM copy files from modules folder to php ext folder.
REM copy php.ini to php install folder


xcopy "..\putmoduleshere\*.*" "%PROGRAMFILES(X86)%\PHP\v5.3\ext"

REM echo extension=php_azure.dll >> "%PROGRAMFILES(X86)%\PHP\v5.3\php.ini"

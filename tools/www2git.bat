@echo off
REM Ez a file csak a komponenseket kezeli a foltokat és a template -t nem!!!!!!!
@echo on
SET repo=e:\github-repok\li-de
SET www=e:\www\li-de

CALL :component_copy temakorok
CALL :component_copy tagok
CALL :component_copy szavazasok
CALL :component_copy alternativak
CALL :component_copy kepviselojeloltek
CALL :component_copy kepviselok
CALL :component_copy cimkek
CALL :component_copy beallitasok
CALL :component_copy lide
GOTO eof

REM component copy subroutine
:component_copy
del %repo%\componens_telepitok\com_%1\*.* /Q /S
xcopy  %www%\components\com_%1\assests                   %repo%\componens_telepitok\com_%1\site\assets            /Y /S /E
xcopy  %www%\components\com_%1\controllers               %repo%\componens_telepitok\com_%1\site\controllers       /Y /S /E
xcopy  %www%\components\com_%1\helpers                   %repo%\componens_telepitok\com_%1\site\helpers           /Y /S /E
xcopy  %www%\components\com_%1\models                    %repo%\componens_telepitok\com_%1\site\models            /Y /S /E
xcopy  %www%\components\com_%1\views                     %repo%\componens_telepitok\com_%1\site\views             /Y /S /E
copy   %www%\components\com_%1\*.php                     %repo%\componens_telepitok\com_%1\site\*.php             
copy   %www%\components\com_%1\*.xml                     %repo%\componens_telepitok\com_%1\site\*.xml             
copy   %www%\components\com_%1\*.html                    %repo%\componens_telepitok\com_%1\site\*.html             
copy   %www%\language\hu-HU\hu-HU.com_%1.*               %repo%\componens_telepitok\com_%1\site\language 
copy   %www%\language\en-GB\en-GB.com_%1.*               %repo%\componens_telepitok\com_%1\site\language 
copy   %www%\language\hu-HU\hu-HU.com_%1.*.*             %repo%\componens_telepitok\com_%1\site\language 
copy   %www%\language\en-GB\en-GB.com_%1.*.*             %repo%\componens_telepitok\com_%1\site\language 
xcopy  %www%\administrator\components\com_%1\assests     %repo%\componens_telepitok\com_%1\admin\assets           /Y /S /E
xcopy  %www%\administrator\components\com_%1\controllers %repo%\componens_telepitok\com_%1\admin\controllers      /Y /S /E
xcopy  %www%\administrator\components\com_%1\helpers     %repo%\componens_telepitok\com_%1\admin\helpers          /Y /S /E
xcopy  %www%\administrator\components\com_%1\models      %repo%\componens_telepitok\com_%1\admin\models           /Y /S /E
xcopy  %www%\administrator\components\com_%1\views       %repo%\componens_telepitok\com_%1\admin\views            /Y /S /E
xcopy  %www%\administrator\components\com_%1\views       %repo%\componens_telepitok\com_%1\admin\sql              /Y /S /E
xcopy  %www%\administrator\components\com_%1\views       %repo%\componens_telepitok\com_%1\admin\tables           /Y /S /E
xcopy  %www%\administrator\components\com_%1\sql         %repo%\componens_telepitok\com_%1\admin\sql              /Y /S /E
copy   %www%\administrator\components\com_%1\*.php       %repo%\componens_telepitok\com_%1\admin\*.php            
copy   %www%\administrator\components\com_%1\*.xml       %repo%\componens_telepitok\com_%1\admin\*.xml            
copy   %www%\administrator\components\com_%1\*.html      %repo%\componens_telepitok\com_%1\admin\*.html            
copy   %www%\administrator\language\hu-HU\hu-HU.com_%1.* %repo%\componens_telepitok\com_%1\admin\language
copy   %www%\administrator\language\en-GB\en-GB\com_%1.* %repo%\componens_telepitok\com_%1\admin\language
EXIT /b

:eof
pause


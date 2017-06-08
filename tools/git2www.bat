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
GOTO eof

REM component copy subroutine
:component_copy
xcopy %repo%\componens_telepitok\com_%1\site\assets            %www%\components\com_%1\assests  /Y /S /E
xcopy %repo%\componens_telepitok\com_%1\site\controllers       %www%\components\com_%1\controllers /Y /S /E
xcopy %repo%\componens_telepitok\com_%1\site\helpers           %www%\components\com_%1\helpers  /Y /S /E
xcopy %repo%\componens_telepitok\com_%1\site\models            %www%\components\com_%1\models  /Y /S /E
xcopy %repo%\componens_telepitok\com_%1\site\views             %www%\components\com_%1\views  /Y /S /E
copy %repo%\componens_telepitok\com_%1\site\*.php              %www%\components\com_%1
copy %repo%\componens_telepitok\com_%1\site\*.xml              %www%\components\com_%1
copy %repo%\componens_telepitok\com_%1\site\language\hu-HU*.*  %www%\language\hu-HU  
copy %repo%\componens_telepitok\com_%1\site\language\en-GB*.*  %www%\language\en-GB  
xcopy %repo%\componens_telepitok\com_%1\admin\assets           %www%\administrator\components\com_%1\assests  /Y /S /E
xcopy %repo%\componens_telepitok\com_%1\admin\controllers      %www%\administrator\components\com_%1\controllers /Y /S /E
xcopy %repo%\componens_telepitok\com_%1\admin\helpers          %www%\administrator\components\com_%1\helpers  /Y /S /E
xcopy %repo%\componens_telepitok\com_%1\admin\models           %www%\administrator\components\com_%1\models  /Y /S /E
xcopy %repo%\componens_telepitok\com_%1\admin\views            %www%\administrator\components\com_%1\views  /Y /S /E
xcopy %repo%\componens_telepitok\com_%1\admin\sql              %www%\administrator\components\com_%1\views  /Y /S /E
xcopy %repo%\componens_telepitok\com_%1\admin\tables           %www%\administrator\components\com_%1\views  /Y /S /E
copy %repo%\componens_telepitok\com_%1\admin\*.php             %www%\administrator\components\com_%1
copy %repo%\componens_telepitok\com_%1\admin\*.xml             %www%\administrator\components\com_%1
copy %repo%\componens_telepitok\com_%1\admin\language\hu-HU*.* %www%\administrator\language\hu-HU  
copy %repo%\componens_telepitok\com_%1\admin\language\en-GB*.* %www%\administrator\language\en-GB  
EXIT /b

:eof
pause


# Likvid demokrácia szofver

## Tulajdonságok:

- fa strukturájú témakör rendszer
- preferenciális szavazás (Borda, Condorcet, Shulze)
- file upload könyvtár minden kategoriához és szavazáshoz
- esemény naptár (jelentkezési lehetőséggel) minden kategoriához és szavazáshoz
- kommentelési lehetőség
- front end admin

Nyelv: Joomla 3 alapú php 

Licensz: GNU/GPL

## Telepités:

1. Joomla rendszer telepités
2. iccalendar, jcomments, jdownloads, kunena, uddeim kiegészitők telepitése
3. A komponens_telepitok -ben lévő komponensek telepitése (a joomla telepités könytárból funkciójával)
4. pluginek telepitése
5. a foltok "könyvtár helyes" feltöltése
6. adalogin komponens telepitése és konfigurálása (lásd github/edemo)
7. joomla admin felületen fejléc, menü és modul konfigurálás, template telepités stb.

## információk programozóknak
view->dispay() müködése:

Ha létezik 'lngCode'.'tmplName'.php akkor ezt használja, egyébként a 'tmplName.php' -t.

Keresés elöször a 'template_path'/html/com_lide/'viewname' könyvtárban, másodszor a 'component_path'/views/'viewname'/tmpl könyvtárban

### php unittests:

cd repo_path

phpunit ./tests/site






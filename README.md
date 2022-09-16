# laravel_project_220916

Egy blog, amit feladatként kaptam.

A teljes projekt a 'blog' mappában található.

## PRE-FLIGHT CHECKS

Kezdés előtt használatos:

```
php artisan migrate
php artisan optimize:clear
```

Teszt adatokkal való feltöltéshez:

```
php artisan tinker
>>> App\Models\Post::factory()->times(XXX)->create();
```

ahol 'XXX' a hozzáadni kívánt bejegyzések száma.

## FUNKCIÓK - TODO

- [x] Új bejegyzés hozzáadása
- [x] Bejegyzések listázása
- [x] Bejegyzések megtekintése
- [x] Bejegyzések törlése
- [x] Bejegyzések szerkesztése
- [x] Bejegyzések szűrése tagek / címkek szerint (bármely kijelölt taget tartalmazó poszt megjelenítése)
- [ ] Frontend update
- [ ] Test Case-k
- [ ] CleanCode és DRY update
- [ ] ...

Felhasznált frameworkök, könyvtárak, alias köszönet:
- [Laravel](https://laravel.com/)
- [TailwindCSS](https://tailwindcss.com/)
- [Select2](https://select2.org/)

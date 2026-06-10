# Workout Tracker

Workout Tracker ir tīmekļa lietojumprogramma treniņu, ķermeņa mērījumu un uztura mērķu uzskaitei. Projekts tika izstrādāts kā personīgs mācību projekts, izmantojot Vue 3 un Laravel.

## Funkcionalitāte

### Lietotāju autentifikācija

* Reģistrācija
* Pieteikšanās
* Izrakstīšanās
* Konta dzēšana
* Aizsargātas lapas, izmantojot Laravel Sanctum

### Treniņi

* Treniņu izveide
* Vingrinājumu pievienošana treniņiem
* Pieeju pievienošana un rediģēšana
* Vingrinājumu un pieeju dzēšana
* Treniņu vēstures apskate

### Ķermeņa mērījumi

* Mērījumu saglabāšana
* Svara uzskaite
* Kakla apkārtmērs
* Krūšu apkārtmērs
* Bicepsu apkārtmērs
* Apakšdelmu apkārtmērs
* Vidukļa apkārtmērs
* Gurnu apkārtmērs
* Ikru apkārtmērs
* Mērījumu rediģēšana un dzēšana
* Vēstures filtrēšana

### Progresa uzraudzība

* Svara izmaiņu grafiks
* Jaunāko mērījumu pārskats

### Uzturs

* Dienas kaloriju mērķis
* Olbaltumvielu, tauku un ogļhidrātu aprēķins
* Aprēķini balstīti uz Mifflin-St Jeor formulu

### Lietotāja profils

* Vecums
* Augums
* Svars
* Dzimums
* Fiziskās aktivitātes līmenis
* Izvēlētais mērķis

### Lietotāja saskarne

* Adaptīvs dizains dažādām ierīcēm
* Gaišais un tumšais režīms
* Latviešu un angļu valoda
* Formu validācija
* Paziņojumi lietotājam par veiktajām darbībām

## Izmantotās tehnoloģijas

### Frontend

* Vue 3
* Vite
* Vue Router
* Vuetify
* Axios
* Chart.js
* Vue I18n

### Backend

* Laravel 12
* PHP 8.4
* REST API
* Laravel Sanctum

### Datu bāze

* MySQL

### Izvietošana

* Railway

## Projekta struktūra

### Frontend

```text
src/
├── components/
├── views/
├── stores/
├── router/
├── utils/
├── locales/
```

### Backend

```text
app/
├── Http/
├── Models/
database/
├── migrations/
├── seeders/
```

## Projekta mērķis

Projekta mērķis ir nodrošināt ērtu iespēju uzskaitīt treniņus, ķermeņa mērījumus un uztura mērķus, kā arī praktiski apgūt pilna cikla tīmekļa lietojumprogrammu izstrādi, izmantojot mūsdienīgas tehnoloģijas.

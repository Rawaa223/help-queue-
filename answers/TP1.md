Exercice 1 :
.env is ignored because it typically contains local settings and secrets. /vendor is ignored because Composer can recreate those dependencies from composer.lock with composer install. They’re normally kept off GitHub for those reasons.
Exercice 2 :
- It’s line 5: Route::get('/', ...). It maps / to the welcome view.
- DB_CONNECTION=sqlite
- 3 migrations
- name , email , password
Exercice 3 :
404 Not Found cuz route doesnt exist
Exercice 4 :
/hello/a/b doesn’t match because {name} accepts only one URL segment.

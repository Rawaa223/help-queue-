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
Exercice 5 :
/hello/<marquee>Bob displays the tag as text because Blade's {{ }} escapes values instead of rendering them as HTML.
Exercice 7 :
7 columns 
created_at and updated_at are created together by $table->timestamps(). The id column is created by $table->id().

# Ancora - just a PHP way to construct web applications.

This is a tool built by [Maurício Fauth](https://github.com/mauriciofauth) and [Thiago Nardi](https://github.com/thnardi) to develop web apps.

## Dependences

 - php 7+;
 - Composer;
 - Jquery;
 - Bootstrap 3;
 - [Tim Creative Material Kit](https://github.com/timcreative).


## Key Concepts and references.

This section helps anyone ho wants to learn webdev with php.

The core of application are built with [Slim 3 Framework](https://www.slimframework.com). To understand the code you must focus on slim's *routes* and *dependecies* management and learn about his *middleware* concept.

The MVC concept are strongly implemented on this solution.

In View we use [Twig](https://twig.symfony.com/) engine.

Functions used in layout.twig like "get_name()" or "get_email()" are defined in src/twig/AuthExtension.php file;

The model layer work with 2 classes: a plain class refering exactly the table in db and a same name ended by **Model** pair class with extends *src/Model.php* class. This class have all sql functions. The way to add a new class is: 1) create the *NamedDBObject.php" in *src/model* (you can take any other class already implemented as template), than 2) create a NamedDBObjectModel.php and 3) insert a function on *src/model/EntityFactory.php* class (we work with factory design patern).

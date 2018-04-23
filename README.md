# Ancora - just a PHP way to construct web apps.

This is a tool built by [Maurício Fauth](https://github.com/mauriciofauth) and [Thiago Nardi](https://github.com/thnardi) to develop web apps. We have working on this since 2017 in [Farol 360](https://farol360.com.br) jobs.

The core of application are built with [Slim 3 Framework](https://www.slimframework.com). To understand the code you must focus on slim's *routes* and *dependecies* management and learn about his [middleware](https://www.slimframework.com/docs/v3/concepts/middleware.html) concept.

We create a [guide](https://github.com/thnardi/ancora/blob/master/GUIDE.md) to help anyone who may be interested.

## Dependences

 - php 7+;
 - Composer;
 - Jquery;
 - Bootstrap 3;
 - [Tim Creative Material Kit](https://github.com/timcreative).


## Usage

1) Clone or download de repo files;
2) run **composer install** command on project folder to install dependencies in *vendor/*;
3) run **vendor/bin/phinx migrate** command on project folder to run *db/migrations* initial database;

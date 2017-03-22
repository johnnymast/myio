[![Build Status](https://travis-ci.org/johnnymast/myio.svg?branch=master)](https://travis-ci.org/johnnymast/myio)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/johnnymast/myio/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/johnnymast/myio/?branch=master)
[![StyleCI](https://styleci.io/repos/84979323/shield?branch=master)](https://styleci.io/repos/84979323)

[![Twitter URL](https://img.shields.io/twitter/url/http/shields.io.svg?style=social&label=Contact%20Laravel%20UK)](https://twitter.com/intent/tweet?text=@uklaravel)



## About MyIO

This project started as a project to practice for working on a project in a group. In fact whats more easy then a url shorting service on laravel right? After some time and more and more members joined the project became a bigger thing it even has an own logo for crying out loud lol.


# Step 1: install composer

First thing you is installing composer on to your system. You can get composer [here](https://getcomposer.org/download/). Don't worry it might seem intimidating but its really not.

# Step 2: Installing using composer

As i am writing this document you can tryout the development version of MyIO by creating a project with MyIO.
 
```bash
$ composer create-project johnnymast/myio dev-master
```

# Step 3: Stetting up the environment

MyIO gives you the option to copying the .env.example into .env and configure your project that way. You could alternatively use the MyIO installer.
 

```bash
$ php artisan myio:install
Welcome to MyIO. We will get you started quickly by asking you a few questions.

 What environment will you run MyIO in [local]:
 >

 Enable debugging?  [true]:
 >

 Logging level [debug]:
 >

 Application url [http://localhost]:
 >

 Database connection [mysql]:
 > mysql

 Database host [127.0.0.1]:
 >
 
 Database port [3306]:
 >

 Database name [myio]:
 > myio

 Database user [root]:
 > root
 
 Database password [root]:
 > root
 
Have fun ...

$


```

# Step 4: Run your migrations

Use artisan to run your migrations. This will create your database for the website.


```bash
-bash-4.2$ php artisan migrate
Migration table created successfully.
Migrated: 2014_10_12_000000_create_users_table
Migrated: 2014_10_12_100000_create_password_resets_table
Migrated: 2017_03_14_172117_create_links_table
Migrated: 2017_03_14_184704_create_hits_table
-bash-4.2$

```


## Requirements

The following versions of PHP are supported by this version.

+ PHP 5.6
+ PHP 7.0
+ PHP 7.1
+ HHVM



## Contributing

TODO

## Special thanks

We like to thank everyone who contributed to this product. Most of these people are straight from our [Slack](xx) but you can earn your place on this list as well.

By no special order here are our contributors.

| Name        | Role           |
|:-------------|:-------------|
| [Steve Popoola](https://github.com/stevepop)      | Design and development |  
| [Johnny Mast](https://github.com/johnnymast)     | Core development | 
| [Rick Bolton](https://github.com/rickbolton) | Design and Development  |  
| [Siddharth](https://github.com/siddharthghedia) | Design and Development |  

## Contact us

This package is created and maintained by [LaravelUK](https://laraveluk.slack.com/). If you have any questions please feel free to contact us on our [Slack](https://laraveluk.slack.com/) space. 

We all know making new friends can be hard and especially if your a little bit shy (we have been there) it can be hard to approach people. We have a nice solution for that because you can find us on [Twitter](https://twitter.com/UKLaravel) as well to hang out and read what we have to say there (You don't have to rush anything).
 
## License

Copyright (c) 2017 LaravelUK

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is
furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.
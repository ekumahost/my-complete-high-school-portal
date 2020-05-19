# Introduction
This project was developed by Okokoh (http://ekumaly.com) and Kelvin (https://kelvin.ugbana.com)

WE DEVELOPED HISP (SECONDARY, nursery, creche, school portal while in school learning programming). It is a great tool. UBEB compliant, in fact it has all features, and I mean it. Starting from admission, scratch cards for admission, online payments, results, attendance, exam, cbt, graduation.. 
I mean this portal is just an online school. It can work for school that have multiple locations, eg. if your school is in many states the students can all be handled here from admission to graduation parents, teachers, health attendant, principals, students, admins can login. 
I dont know how to say it again. it has all features a school can think of/ even cctv (Premium), parents can even track their kids even in the portal (Premium).

# About
HISP Cloud School is school management system with all features a school can think of. 
Put your school in the cloud. School portal is Equipped with more than 50 Features that covers all sections of a High School. UBEB compliance.

# Version 2.1.8
#Framework php7 was it built on, no framework. this is raw php work with mysql database

# Installation
We have tested on PHP 7.3.7 Apache web server. Follow these 9 Instructions

    1. create your mysql database and import /TOOLS/hisp.sql(with dummy data), fresh_install.sql for fresh school production
    2. edit /php.files/classes/pdoDB.php for your database configurations
    3. edit /control/includes/configuration.php for your database configurations again and others in the config files 
    4. edit /php.files/classes/private-config.php for some portal url config.. you may see some http://127.0.0.1/hisp.kastechnet.com/ change them to your own website url. ::)
    5. edit /myjs/feccukcontroller.js for server_root_dir and one img src there.. you may see some http://27.0.0.1/hisp.kastechnet.com/ change them to your own website url. ::)
    6. Edit your webserver and set home.php as directory Index (google it if you dont know) -- you see we did not have that index.php thing, its home.php here, we already did this .htaccess but just incase
    7. edit /home.php for the Tawk.to Script
    8. run the sql in /TOOLS/sql_fix.txt in your database: that is run the code inside. It as a fix.
    9. SET YOUR SMTP DETAILS FOR MAIL SENDING and Hacking Report Email: /php.files/classes/mailing_list.php

I think you can see some of the features here: https://hisp.kastechnet.com/features BOOM you are done, open the site and visit http://yourwebportalurl.com/control to login to admin as username = admin, password=cejine and start playing around.

# Warning
we may have written powered by us. do not remove it.. never on earth should you change it to powered by you because you did not write this code. unless you buy us coffee first then you can use it as you like..

# Have a problem?
please feel free to contact us for help and questions.. but please just be a php developer and do not bother us, look around and fix your issue, this portal was build to be very simple to use the datbase already have some dummy data: you will need to shine your eyes and know the ones to remove before running a live production portal trying to login to admin and you cannot find the password, you can easily change the password in the database oo table = web_users, the password is just MD5 -- git push origin master

# Are we awesome please donate?
BITCOINS :)
1DHHPQeggnDcr9NNm6uhhyEcA16GQPa8iJ

OR USDT (ERC20)
0x68c62c0c6e5d1e21c448133bccfc7fcb5d244f86
# Introduction
This project was developed by Okokoh (http://ekumaly.com) and Kelvin (https://kelvin.ugbana.com)

WE DEVELOPED HISP (SECONDARY, nursery, creche, school portal while in school learning programming). It is a great tool. UBEB compliant, in fact it has all features, and I mean it. Starting from admission, scratch cards for admission, online payments, results, attendance, exam, cbt, graduation.. 
I mean this portal is just an online school. It can work for school that have multiple locations, eg. if your school is in many states the students can all be handled here from admission to graduation parents, teachers, health attendant, principals, students, admins can login. 
I dont know how to say it again. it has all features a school can think of/ even cctv (Premium), parents can even track their kids even in the portal (Premium).

# About
HISP Cloud School is school management system with all features a school can think of. 
Put your school in the cloud. School portal is Equipped with more than 50 Features that cover all sections of a High School. UBEB compliance.

# Version 2.1.8
#Framework. This portal was built with php8. No framework. This is raw php work with MySQL database

# Installation
We have tested on PHP 7.3.7 Apache web server. Follow these 10 Instructions one after the other.

    1. create your mysql database and import /TOOLS/dummy.sql (with dummy data), fresh_install.sql for fresh school production
    2. edit /php.files/classes/pdoDB.php for your database configurations
    3. edit /php.files/classes/private-config.php and put your portal url
    4. edit /control/includes/configuration.php for your database configurations again and others in the config files 
    5. edit /myjs/feccukcontroller.js for server_root_dir and put your portal url)
    6. Edit your webserver and set home.php as directory Index (google it if you dont know) -- we already did this .htaccess but just incase the file is missing
    7. edit /home.php for the Tawk.to Script
    8. run the sql in /TOOLS/sql_fix.txt in your database: that is run the code inside. It as a fix.
    9. SET YOUR SMTP details for mail sending and Hacking Report Email: /php.files/classes/mailing_list.php
    10. Open the following script and comment out the code "$send_mail = true". It was used to byepass mail sending
            staff/register/staff_register_script.php {Line 117}
            student/register/student_register_script.php {Line 162}
            parents/register/parent_register_script.php {Line 80}

I think you can see some of the features here: https://hisp.kastechnet.com/features BOOM you are done, Open the site and visit http://yourwebportalurl.com/control to login to admin as username = admin, password=cejine and start playing around.

# DEMO DATA
If you have imported the demo sql data, here are some logins for you. The demo data may not be stable and may have som data Inconsistency. Please ignore. New install is bug free.
Staff ===>                      staff: open
Student ===>                    student: open
Parent ====>                    parent: open
Admin ({PORTAL_URL}/control)      admin: open

# NEW INSTALL
If you have a newly installed portal, then you can do this
Admin ({PORTAL_URL}/control)      admin: cejine

This will direct you to the Install list. You should carry out these task before starting use.

# Warning
We may have written powered by us. do not remove it.. never on earth should you change it to powered by you because you did not write this code. unless you buy us coffee first then you can use it as you like..

# Have a problem?
please feel free to contact us for help and questions.. but please just be a php developer and do not bother us, look around and fix your issue, this portal was build to be very simple to use the datbase already have some dummy data: you will need to shine your eyes and know the ones to remove before running a live production portal trying to login to admin and you cannot find the password, you can easily change the password in the database table (web_users). The password is just simple MD5 -- git push origin master.

# Version v3.4 Released - 12th Sptember 2023
For Installation and use of this version, please contact Kastech Network Limited or Visit https://hisp.kastechnet.com/v3 for more information.

To update the current version v1.8 (if you are using this free version), update the following files from this repo to your current installation. :
    1. /php.files/classes/kas-framework.php
    2. /php.files/classes/encoder.php
    3. /control/cpanel/switch_session.php
    4. control/cpanel/installer.php
    5. /control/cpanel/fancyadmin/* (All the files in fancyadmin)
    
This will fix the switch-forward issues. 

Feel free to request for the demo of the new version v3.4 at any time.



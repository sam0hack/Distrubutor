# Distributor

Laravel Plugin for 6 level referral system. 

**Configure with Composer**

`"repositories": [
     {
         "type": "path",
         "url": "Distributor"
     }
 ]`

**OR**

**Configure with Composer as dev-package**

_Recommended if you want to make changes in the plugin_   

`    "repositories": {
         "dev-package": {
             "type": "path",
             "url": "Distributor",
             "options": {
                 "symlink": true
             }
         }
     }`
     
 Make sure you have Distributor plugin in same folder
 
 Run  `composer require "sam0hack/Distributor`
 
 **Installation**
 Run `php artisan distributor:install-settings` _This will create basic settings_
 
 Run `php artisan distributor:generation-zero` _This will create 6 Generation zero users, those users will be the highest level users in the referral system._
 
**Usage** 

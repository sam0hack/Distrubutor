# Distributor

###### Laravel Plugin for 6 level referral system. 

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
 
 Run `php artisan migrate`
 
 
 
 Run `php artisan distributor:install-settings`
 _This will create basic settings_
 	

 
 Run `php artisan distributor:generation-zero` 
 
 _This will create 6 Generation zero users, those users will be the highest level users in the referral system._
 
**Usage** 

**To get Random Generation Zero Referral Code**

`Distributor::getRandomGenZeroCode();`

**To add new in the Distributor system**

`Distributor::add_distributor(new_user_id,'referral_code');`
This will create 6 level layer and a wallet for this new_user_id

**Make Transaction**

`DistributorTransaction::distributeAmount(user_id,amount);`

 This will distribute the amount into 6 upper levels of this user_id
 
** Get User code
** 
 `Distributor::getCode(user_id);`
 

###Wallet
 
 **GET Methods**
 
 **Get Total Withdrawal of the user**

 `DistributorWallet::GetTotalWithdrawal('user_id');`

 **Get Total Earnings of the user**
 
`DistributorWallet::GetTotalEarning('user_id');`

 **Get Total Balance of the user**

`DistributorWallet::GetBalance('user_id');`
 
 
 **Set Methods**
     
 **Set Withdrawal Amount**
`DistributorWallet::SetTotalwithdrawal(user_id,Withdrawal_amount);`

 
 **Set Balance**
 
 `DistributorWallet::SetBalance(user_id,$amount);`
 
 **Set Earnings**
 
 `DistributorWallet::SetTotalEarnings(user_id,$amount);`
 
 
 
### Database

**Migration Files**

* 2019_11_01_000000_distributor //for handling referral
* 2019_11_01_000000_distributor_code //Referral codes
* 2019_11_01_000000_distributor_earning_from_user //Track earning from users
* 2019_11_01_000000_distributor_generation_zero_user //Generation zero user. Highest initial level users (at-least 6 users are required) 
* 2019_11_01_000000_distributor_level //Handle user levels
* 2019_11_01_000000_distributor_setting //Settings like percentage and referral limit 
* 2019_11_01_000000_distributor_transaction //Track of every transaction
* 2019_11_01_000000_distributor_wallet //User wallet for keep track of earning and withdrawals


**Test**

Run test `./vendor/bin/phpunit`

![plot](./public/assets/images/logo.png)

## Instruction

Change Email sending from `MailTrap` to `MailGun`

In `ApiController` change the recipeient of the email notification

---

## Updating File

Follow instruction below for installation of app

```Server Requirements
Install `Apache` on the server to make page builder work.
```

```Package
execute >  `composer update`
```

```DATABASE
execute >  `php artisan migrate:fresh`
```

```Seeder
execute >  `php artisan db:seed`
```

---

## Instruction

Follow instruction below for installation of app

## For Server

Configure file to adjust the maximum allowed packet accepted in server

```SERVER
my.ini
```

and set

```SERVER
max_allowed_packet
```

to

```SERVER
max_allowed_packet = 200M
```

## For Login Authentication

Use Administrator credential to access backend page

```CREDENTIALS
email: tronicspay@gmail.com
password: tronicspay
```

```
Added develop branch
```

---

## For Paypal Integration

Create Paypal account

Get API Credentials from Paypal

Go to TronicsPay Root

Go to `app\Models` and open `TableList.php`

Search for `$paypal_account` and insert your paypal credentials

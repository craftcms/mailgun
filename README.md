<p align="center"><img src="./src/icon.svg" width="100" height="100" alt="Mailgun for Craft CMS icon"></p>

<h1 align="center">Mailgun for Craft CMS</h1>

This plugin provides a [Mailgun](http://www.mailgun.com/) integration for [Craft CMS](https://craftcms.com/).

## Requirements

This plugin requires Craft CMS 4.0.0+ or 5.0.0+, or 6.0.0-beta.1+ with the `craftcms/yii2-adapter` package.

You can install this plugin from the Plugin Store or with Composer.

#### From the Plugin Store

Go to the Plugin Store in your project’s Control Panel and search for “Mailgun”. Then click on the “Install” button in its modal window.

#### With Composer

Open your terminal and run the following commands:

```bash
# go to the project directory
cd /path/to/my-project.test

# tell Composer to load the plugin
composer require craftcms/mailgun

# tell Craft to install the plugin
./craft install/plugin mailgun
```

## Setup

Once Mailgun is installed, go to Settings → Email, and change the “Transport Type” setting to “Mailgun”. Enter your domain name and Mailgun API Key (which you can get from your [domain overview](https://app.mailgun.com/mg/sending/domains) page) and click Save.

> **Tip:** The Domain, API Key, and Endpoint settings can be set to environment variables. See [Environmental Configuration](https://docs.craftcms.com/v3/config/environments.html) in the Craft docs to learn more about that.

## Craft 6

Craft 6 sends email through [Laravel mailers](https://laravel.com/docs/mail). Laravel has its own Mailgun driver, so you don’t need this plugin once you’ve configured it.

With the `craftcms/yii2-adapter` package installed, Craft can keep sending email through the Mailgun settings in your project config, as the `craft-transport` mailer. To use it, set `MAIL_MAILER=craft-transport` in your environment, or choose `craft-transport` as the mailer in Settings → Email. (Craft only falls back to it on its own when neither is set and the default mailer in `config/mail.php` is still `log`.) The Yii2 Loose Ends utility lists the Mailgun settings until you configure a Laravel mailer.

To configure Laravel’s Mailgun driver:

1. Require Symfony’s Mailgun transport and HTTP client. Removing this plugin removes them too, otherwise.

   ```bash
   composer require symfony/mailgun-mailer symfony/http-client
   ```

2. Add a `mailgun` mailer to the `mailers` array in `config/mail.php`:

   ```php
   'mailgun' => [
       'transport' => 'mailgun',
   ],
   ```

3. Add your Mailgun credentials to `config/services.php`:

   ```php
   'mailgun' => [
       'domain' => env('MAILGUN_DOMAIN'),
       'secret' => env('MAILGUN_SECRET'),
       'endpoint' => env('MAILGUN_ENDPOINT', 'api.mailgun.net'),
       'scheme' => 'https',
   ],
   ```

4. Set the environment variables in `.env`. `MAILGUN_SECRET` is the API key. `MAILGUN_ENDPOINT` is a hostname without `https://`, such as `api.eu.mailgun.net` for Mailgun’s EU region.

   ```bash
   MAIL_MAILER=mailgun
   MAILGUN_DOMAIN=mg.example.com
   MAILGUN_SECRET=your-api-key
   MAILGUN_ENDPOINT=api.mailgun.net
   ```

5. Send a test email from Settings → Email, or with `php artisan craft:mailer:test`.

Then uninstall the plugin and remove it from your project:

```bash
php artisan craft:plugin:uninstall mailgun
composer remove craftcms/mailgun
```

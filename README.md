# Mailgun for Craft CMS

This plugin provides a [Mailgun](http://www.mailgun.com/) integration for [Craft CMS](https://craftcms.com/).

## Requirements

This plugin requires Craft CMS 3.1.0 or later.

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

Once Mailgun is installed, go to Settings → Email, and change the “Transport Type” setting to “Mailgun”. Enter your domain name and Mailgun API Key (which you can get from your [domain overview](https://mailgun.com/app/domains) page) and click Save.

### Per-Environment Configuration

Once you’ve selected Mailgun as mail transport type in the Control Panel, you can override its settings with different values for each environment.
Mailgun’s Domain, API Key, and Endpoint settings can be set to environment variables.

First, add the following environment variables to your `.env` and `.env.example` files:

```bash
# Mailgun's Domain
MAILGUN_DOMAIN=""
# The Mailgun API key
MAILGUN_API_KEY=""
# The Mailgun endpoint
MAILGUN_ENDPOINT=""
``` 

Fill in the values in your `.env` file (leaving the values in `.env.example` blank).

Then when you use Mailgun as mail transport type, you can reference these environment variables in the email settings by typing `$` followed by the environment variable names.

Only the environment variable names will be saved to your database and `project.yaml` file, not their values.

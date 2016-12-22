Mailgun for Craft CMS
=====================

This plugin provides a [Mailgun](http://www.mailgun.com/) integration for [Craft CMS](https://craftcms.com/).


## Requirements

This plugin requires Craft CMS 3.0.0-beta.1 or later.


## Installation

To install the plugin, follow these instructions.

1. Open your terminal and go to your Craft project:

        cd /path/to/project

2. Then tell Composer to load the plugin:

        php composer.phar require craftcms/mailgun

3. In the Control Panel, go to Settings → Plugins and click the “Install” button for Mailgun.

## Setup

Once Mailgun is installed, go to Settings → Email, and change the “Transport Type” setting to “Mailgun”. Enter your domain name and Mailgun API Key (which you can get from your [domain overview](https://mailgun.com/app/domains) page) and click Save.

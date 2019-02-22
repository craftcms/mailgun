# Release Notes for Mailgun for Craft CMS

## 1.4.2 - 2019-02-22

### Fixed
- Fixed a bug where `craft\mailgun\MailgunAdapter` wasn’t triggering the `defineBehaviors` event.

## 1.4.1 - 2019-02-13

### Fixed
- Fixed a validation error that would occur when the Endpoint setting was set to an environment variable. ([#7](https://github.com/craftcms/mailgun/issues/7))

## 1.4.0 - 2019-02-04

### Added
- Mailgun now requires Craft 3.1.5 or later.
- The Domain, API Key, and Endpoint settings can now be set to environment variables. ([#5](https://github.com/craftcms/mailgun/issues/5))

## 1.3.0 - 2018-11-08

### Added
- Added an “Endpoint” setting, making it possible to use regional Mailgun API endpoint URLs. ([#4](https://github.com/craftcms/mailgun/pull/4))

## 1.2.0 - 2017-12-18

### Changed
- Swift Mailer 6 compatibility

## 1.1.0 - 2017-09-28

### Changed
- Craft 3 Beta 35 compatibility

## 1.0.0.1 - 2017-01-31

### Fixed
- Fixed Composer installation support  

## 1.0.0 - 2017-01-31

Initial release.

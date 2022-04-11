<?php
/**
 * @copyright Copyright (c) Pixel & Tonic, Inc.
 */

namespace craft\mailgun;

use Craft;
use craft\behaviors\EnvAttributeParserBehavior;
use craft\helpers\App;
use craft\mail\transportadapters\BaseTransportAdapter;
use Symfony\Component\Mailer\Bridge\Mailgun\Transport\MailgunApiTransport;

/**
 * MailgunAdapter implements a Mailgun transport adapter into Craft’s mailer.
 *
 * @property mixed $settingsHtml
 * @author Pixel & Tonic, Inc. <support@pixelandtonic.com>
 * @since 3.0
 */
class MailgunAdapter extends BaseTransportAdapter
{
    /**
     * @inheritdoc
     */
    public static function displayName(): string
    {
        return 'Mailgun';
    }

    /**
     * @var string The domain
     */
    public string $domain = '';

    /**
     * @var string The API key that should be used
     */
    public string $apiKey = '';

    /**
     * @var string The API endpoint that should be used
     */
    public string $endpoint = '';

    /**
     * @inheritdoc
     */
    public function behaviors(): array
    {
        $behaviors = parent::behaviors();
        $behaviors['parser'] = [
            'class' => EnvAttributeParserBehavior::class,
            'attributes' => [
                'apiKey',
                'endpoint',
                'domain',
            ],
        ];
        return $behaviors;
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'apiKey' => Craft::t('mailgun', 'API Key'),
            'domain' => Craft::t('mailgun', 'Domain'),
            'endpoint' => Craft::t('mailgun', 'Endpoint'),
        ];
    }

    /**
     * @inheritdoc
     */
    public function defineRules(): array
    {
        return [
            [['apiKey', 'domain'], 'required'],
            [['endpoint'], 'url', 'defaultScheme' => 'https'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function getSettingsHtml(): ?string
    {
        return Craft::$app->getView()->renderTemplate('mailgun/settings', [
            'adapter' => $this,
        ]);
    }

    /**
     * @inheritdoc
     */
    public function defineTransport(): array|\Symfony\Component\Mailer\Transport\AbstractTransport
    {
        $region = preg_match('/api\.eu\.mailgun/i', App::parseEnv($this->endpoint)) ? 'eu' : 'us';
        $transport = new MailgunApiTransport(App::parseEnv($this->apiKey), App::parseEnv($this->domain), $region);

        return $transport;
    }
}

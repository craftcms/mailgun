<?php
/**
 * @copyright Copyright (c) Pixel & Tonic, Inc.
 */

namespace craft\mailgun;

use Craft;
use craft\behaviors\EnvAttributeParserBehavior;
use craft\mail\transportadapters\BaseTransportAdapter;
use cspoo\Swiftmailer\MailgunBundle\Service\MailgunTransport;
use Mailgun\HttpClient\HttpClientConfigurator;
use Mailgun\Mailgun;
use Swift_Events_SimpleEventDispatcher;

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
    public $domain;

    /**
     * @var string The API key that should be used
     */
    public $apiKey;

    /**
     * @var string The API endpoint that should be used
     */
    public $endpoint;

    /**
     * @inheritdoc
     */
    public function behaviors()
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
    public function rules()
    {
        return [
            [['apiKey', 'domain'], 'required'],
            [['endpoint'], 'url', 'defaultScheme' => 'https'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function getSettingsHtml()
    {
        return Craft::$app->getView()->renderTemplate('mailgun/settings', [
            'adapter' => $this
        ]);
    }

    /**
     * @inheritdoc
     */
    public function defineTransport()
    {
        $configurator = (new HttpClientConfigurator())
            ->setHttpClient(Craft::createGuzzleClient() )
            ->setApiKey(Craft::parseEnv($this->apiKey));

        if ($this->endpoint) {
            $configurator->setEndpoint(Craft::parseEnv($this->endpoint));
        }

        return new MailgunTransport(
            new Swift_Events_SimpleEventDispatcher(),
            new Mailgun($configurator),
            Craft::parseEnv($this->domain)
        );
    }
}

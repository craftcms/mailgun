<?php
/**
 * @copyright Copyright (c) Pixel & Tonic, Inc.
 */

namespace craft\mailgun;

use craft\events\RegisterComponentTypesEvent;
use craft\helpers\MailerHelper;
use yii\base\Event;

/**
 * Plugin represents the Mailgun plugin.
 *
 * @author Pixel & Tonic, Inc. <support@pixelandtonic.com>
 * @since 3.0
 */
class Plugin extends \craft\base\Plugin
{
    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();

        $eventName = defined(sprintf('%s::EVENT_REGISTER_MAILER_TRANSPORT_TYPES', MailerHelper::class))
            ? MailerHelper::EVENT_REGISTER_MAILER_TRANSPORT_TYPES // Craft 4
            /** @phpstan-ignore-next-line */
            : MailerHelper::EVENT_REGISTER_MAILER_TRANSPORTS; // Craft 5+

        Event::on(
            MailerHelper::class,
            $eventName,
            function(RegisterComponentTypesEvent $event) {
                $event->types[] = MailgunAdapter::class;
            }
        );
    }
}

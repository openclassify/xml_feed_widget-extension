<?php namespace Anomaly\XmlFeedWidgetExtension\Command;

use Anomaly\ConfigurationModule\Configuration\Contract\ConfigurationRepositoryInterface;
use Anomaly\DashboardModule\Widget\Contract\WidgetInterface;
use Anomaly\EditorFieldType\EditorFieldTypePresenter;
use Anomaly\Streams\Platform\Support\Decorator;
use Illuminate\Contracts\Bus\SelfHandling;
use Illuminate\Contracts\Cache\Repository;

/**
 * Class SetContent
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 * @package       Anomaly\XmlFeedWidgetExtension\Command
 */
class SetContent implements SelfHandling
{

    /**
     * The widget instance.
     *
     * @var WidgetInterface
     */
    protected $widget;

    /**
     * Create a new SetContent instance.
     *
     * @param WidgetInterface $widget
     */
    public function __construct(WidgetInterface $widget)
    {
        $this->widget = $widget;
    }

    /**
     * Handle the widget data.
     */
    public function handle(ConfigurationRepositoryInterface $configuration)
    {
        $template = $configuration->get(
            'anomaly.extension.xml_feed_widget::template',
            $this->widget->getId()
        );

        /* @var EditorFieldTypePresenter $presenter */
        $presenter = $template->getFieldTypePresenter('value');

        $this->widget->setContent($presenter->parsed(['widget' => $this->widget]));
    }
}

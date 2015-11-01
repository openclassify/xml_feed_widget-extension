<?php namespace Anomaly\XmlFeedWidgetExtension;

use Anomaly\DashboardModule\Widget\Contract\WidgetInterface;
use Anomaly\DashboardModule\Widget\Extension\WidgetExtension;
use Anomaly\XmlFeedWidgetExtension\Command\LoadItems;

/**
 * Class XmlFeedWidgetExtension
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 * @package       Anomaly\XmlFeedWidgetExtension
 */
class XmlFeedWidgetExtension extends WidgetExtension
{

    /**
     * This extension provides the "Recent News"
     * widget for the main dashboard.
     *
     * @var string
     */
    protected $provides = 'anomaly.module.dashboard::widget.recent_news';

    /**
     * Load the widget data.
     *
     * @param WidgetInterface $widget
     */
    protected function load(WidgetInterface $widget)
    {
        $this->dispatch(new LoadItems($widget));
    }
}

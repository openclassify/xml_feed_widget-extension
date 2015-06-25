<?php namespace Anomaly\RecentNewsWidgetExtension;

use Anomaly\DashboardModule\Widget\WidgetExtension;

/**
 * Class RecentNewsWidgetExtension
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 * @package       Anomaly\RecentNewsWidgetExtension
 */
class RecentNewsWidgetExtension extends WidgetExtension
{

    /**
     * This extension provides the "Recent News"
     * widget for the main dashboard.
     *
     * @var string
     */
    protected $provides = 'anomaly.module.dashboard::widget.recent_news';
}

<?php namespace Anomaly\RecentNewsWidgetExtension;

use Anomaly\DashboardModule\Dashboard\Component\Widget\Widget;

class RecentNewsWidgetHandler
{
    public function handle(Widget $widget)
    {
        $widget->addData('test', 'Value');
    }
}

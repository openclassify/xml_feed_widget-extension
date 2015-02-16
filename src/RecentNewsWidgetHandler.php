<?php namespace Anomaly\RecentNewsWidgetExtension;

use Anomaly\DashboardModule\Dashboard\Component\Widget\Widget;

/**
 * Class RecentNewsWidgetHandler
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 * @package       Anomaly\RecentNewsWidgetExtension
 */
class RecentNewsWidgetHandler
{

    /**
     * The SimplePie client.
     *
     * @var \SimplePie
     */
    protected $rss;

    /**
     * Create a new RecentNewsWidgetHandler instance.
     *
     * @param \SimplePie $rss
     */
    public function __construct(\SimplePie $rss)
    {
        $this->rss = $rss;
    }

    /**
     * Handle the widget data.
     *
     * @param Widget $widget
     */
    public function handle(Widget $widget)
    {
        $items = app('cache')->remember(
            __METHOD__,
            30,
            function () {

                // Let Laravel cache everything.
                $this->rss->enable_cache(false);

                // Hard-code this for now.
                $this->rss->set_feed_url('https://www.pyrocms.com/blog/rss/all.rss');

                // Make the request.
                $this->rss->init();

                return $this->rss->get_items(0, 5);
            }
        );

        // Load the items to the widget's view data.
        $widget->addData('items', $items);
    }
}

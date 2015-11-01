<?php namespace Anomaly\XmlFeedWidgetExtension\Command;

use Anomaly\DashboardModule\Widget\Contract\WidgetInterface;
use Illuminate\Contracts\Bus\SelfHandling;
use Illuminate\Contracts\Cache\Repository;

/**
 * Class LoadItems
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 * @package       Anomaly\XmlFeedWidgetExtension\Command
 */
class LoadItems implements SelfHandling
{

    /**
     * The widget instance.
     *
     * @var WidgetInterface
     */
    protected $widget;

    /**
     * Create a new LoadItems instance.
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
    public function handle(\SimplePie $rss, Repository $cache)
    {
        $items = $cache->remember(
            __METHOD__,
            30,
            function () use ($rss) {

                // Let Laravel cache everything.
                $rss->enable_cache(false);

                // Hard-code this for now.
                $rss->set_feed_url('http://www.pyrocms.com/posts/rss.xml');

                // Make the request.
                $rss->init();

                return $rss->get_items(0, 5);
            }
        );

        // Load the items to the widget's view data.
        $this->widget->addData('items', $items);
    }
}

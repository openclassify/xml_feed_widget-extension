<?php namespace Anomaly\RecentNewsWidgetExtension;

use Illuminate\Cache\Repository;

/**
 * Class RecentNewsWidgetLoader
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 * @package       Anomaly\RecentNewsWidgetExtension
 */
class RecentNewsWidgetLoader
{

    /**
     * The SimplePie client.
     *
     * @var \SimplePie
     */
    protected $rss;

    /**
     * Create a new RecentNewsWidgetLoader instance.
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
     * @param RecentNewsWidgetExtension $extension
     */
    public function handle(RecentNewsWidgetExtension $extension, Repository $cache)
    {
        $items = $cache->remember(
            __METHOD__,
            30,
            function () {

                // Let Laravel cache everything.
                $this->rss->enable_cache(false);

                // Hard-code this for now.
                $this->rss->set_feed_url('http://www.pyrocms.com/posts/rss.xml');

                // Make the request.
                $this->rss->init();

                return $this->rss->get_items(0, 5);
            }
        );

        // Load the items to the widget's view data.
        $extension->addWidgetData('items', $items);
    }
}

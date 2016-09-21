<?php namespace Anomaly\XmlFeedWidgetExtension\Command;

use Anomaly\ConfigurationModule\Configuration\Contract\ConfigurationRepositoryInterface;
use Anomaly\DashboardModule\Widget\Contract\WidgetInterface;
use Illuminate\Contracts\Cache\Repository;

/**
 * Class LoadItems
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 */
class LoadItems
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
    public function handle(\SimplePie $rss, Repository $cache, ConfigurationRepositoryInterface $configuration)
    {
        $cache_key = __METHOD__.'_'.$this->widget->getId();

        $items = $cache->remember(
            $cache_key,
            30,
            function () use ($rss, $configuration) {

                // Let Laravel cache everything.
                $rss->enable_cache(false);

                // Hard-code this for now.
                $rss->set_feed_url(
                    $configuration->value(
                        'anomaly.extension.xml_feed_widget::url',
                        $this->widget->getId(),
                        'http://www.pyrocms.com/posts/rss.xml'
                    )
                );

                // Make the request.
                $rss->init();

                return $rss->get_items(0, 5);
            }
        );

        // Load the items to the widget's view data.
        $this->widget->addData('items', $items);
    }
}

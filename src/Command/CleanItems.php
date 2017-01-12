<?php namespace Anomaly\XmlFeedWidgetExtension\Command;

class CleanItems
{

    /**
     * The RSS items.
     *
     * @var array
     */
    protected $items;

    /**
     * Create a new CleanItems instance.
     *
     * @param array $items
     */
    public function __construct(array $items)
    {
        $this->items = $items;
    }

    public function handle()
    {
        array_walk($this->items, function(&$item) {
            dd($item);
        });
    }
}

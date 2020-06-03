<?php
class Paginator
{
    public $limit;
    public $offset;
    public $previous;
    public $next;

    /**
     * construct the Paginator class
     *
     * @param [int] $page
     * @param [int] $record_per_page
     */
    public function __construct($page, $record_per_page, $total)
    {
        $this->limit = $record_per_page;
        $page = filter_var($page, FILTER_VALIDATE_INT, [
            'options'=>[
                'default' => 1,
                'min_range' => 1
            ]
        ]);
        if ($page > 1) {
            $this->previous = $page -1;
        }
        if (ceil($total / $record_per_page) > $page) {
            $this->next = $page + 1;
        }
        
        $this->offset = ($page - 1) * $record_per_page;
    }
}
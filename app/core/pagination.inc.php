<?php
/*
    Simple pagination wrapper, given a total, per page and a range it will
    display a pagination html using bootstrap's format 
    http://twitter.github.com/bootstrap/components.html#pagination
*/
class Pagination 
{
    var $items_per_page;
    var $items_total;
    var $mid_range;
    var $page_name = 'page';

    function Pagination($total, $per_page = 10, $range = 7, $max_per_page = 12) {
        $this->items_total = $total;

        $this->items_per_page = isset($_GET['per_page']) ? (int)$_GET['per_page'] : $per_page;
        if($this->items_per_page <= 0)
            $this->items_per_page = $per_page;
        elseif($this->items_per_page > $max_per_page)
            $this->items_per_page = $max_per_page;

        $this->mid_range = $range;
    }

    function paginate() {
        $total_pages = ceil($this->items_total / $this->items_per_page);
        $current_page = (int)$_GET[$this->page_name]; // must be numeric > 0
        $output = '<div class="pagination"><ul>';

        if($current_page < 1) 
            $current_page = 1;
        elseif($current_page > $total_pages) 
            $current_page = $total_pages;

        $prev_page = $current_page - 1;
        $next_page = $current_page + 1;

        if($total_pages > 10) {
            $output .= ($current_page != 1 && $this->items_total >= 10) 
                        ? "<li><a class=\"paginate\" href=\"$_SERVER[PHP_SELF]?page=$prev_page&amp;per_page=$this->items_per_page\">« Previous</a></li> "
                        : '<li class="disabled"><a>« Previous</a></li> ';

            $this->start_range = $current_page - floor($this->mid_range / 2);
            $this->end_range = $current_page + floor($this->mid_range / 2);

            if($this->start_range <= 0) {
                $this->end_range += abs($this->start_range) + 1;
                $this->start_range = 1;
            }

            if($this->end_range > $total_pages) {
                $this->start_range -= $this->end_range - $total_pages;
                $this->end_range = $total_pages;
            }

            $this->range = range($this->start_range, $this->end_range);
            for($i = 1; $i <= $total_pages; $i++) {
                if($this->range[0] > 2 && $i == $this->range[0]) 
                    $output .= '<li class="disabled"><a> ... </a></li>';

                if($i == 1 || $i == $total_pages || in_array($i, $this->range)) {
                    $output .= ($i == $current_page) 
                                ? "<li class=\"active\"><a title=\"Go to page $i of $total_pages\">$i</a></li> "
                                : "<li><a title=\"Go to page $i of $total_pages\" href=\"$_SERVER[PHP_SELF]?page=$i&amp;per_page=$this->items_per_page\">$i</a></li> ";
                }

                if($this->range[$this->mid_range-1] < $total_pages-1 && $i == $this->range[$this->mid_range-1]) 
                    $output .= '<li class="disabled"><a> ... </a></li>';
            }

            $output .= (($current_page != $total_pages && $this->items_total >= 10) && ($_GET[$this->page_name] != 'All')) 
                        ? "<li><a href=\"$_SERVER[PHP_SELF]?page=$next_page&amp;per_page=$this->items_per_page\">Next »</a></li>"
                        : '<li class="disabled"><a>Next »</a></li>';
        }
        else
        {
            for($i=1;$i<=$total_pages;$i++) {
                $output .= ($i == $current_page) 
                            ? "<li class=\"active\"><a>$i</a></li> "
                            : "<li><a href=\"$_SERVER[PHP_SELF]?page=$i&amp;per_page=$this->items_per_page\">$i</a></li> ";
            }
        }

        return $output . '</ul></div>';
    }
}

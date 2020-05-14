<?php

namespace App\Domain\Business;

use Illuminate\Http\Request;

class RequestHelper
{
    private $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function pageIterator()
    {
        $page = $this->request->page;
        if (empty($page) or $page == 0) {
            $pageIterator = 0;
        } else {
            $pageIterator = ($page - 1) * 15;
        }

        return $pageIterator;
    }
}

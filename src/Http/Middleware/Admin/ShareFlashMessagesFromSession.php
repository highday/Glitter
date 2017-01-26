<?php

namespace Highday\Glitter\Http\Middleware\Admin;

use Closure;
use Illuminate\Contracts\View\Factory as ViewFactory;
use Illuminate\Support\MessageBag;

class ShareFlashMessagesFromSession
{
    /**
     * The view factory implementation.
     *
     * @var \Illuminate\Contracts\View\Factory
     */
    protected $view;

    /**
     * Create a new instance.
     *
     * @param \Illuminate\Contracts\View\Factory $view
     *
     * @return void
     */
    public function __construct(ViewFactory $view)
    {
        $this->view = $view;
    }

    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure                 $next
     *
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $flash_message = new MessageBag($request->session()->get('flash_message', []));
        $flash_message->setFormat('<div class="alert alert-info alert-dismissible fade show" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>:message</div>');

        $this->view->share(compact('flash_message'));

        return $next($request);
    }
}

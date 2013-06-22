<?php
/**
 * Hello.php
 * @author Tom
 * @since 22/06/13
 */
namespace tomindustries\bootstrapblade;
use Illuminate\View\Compilers\BladeCompiler;
use Illuminate\Filesystem\Filesystem;

/**
 * Class BootstrapBladeCompiler
 * @package tomindustries\bootstraphelper
 */
class BootstrapBladeCompiler extends BladeCompiler {

    /**
     * Construct this BootstrapBladeCompiler
     * @param Filesystem $files Fileystem Library for loading views.
     * @param string $cachePath A path to the cache.
     */
    public function __construct(Filesystem $files, $cachePath)
    {
        parent::__construct($files, $cachePath);
        $bootstrapCompilers = array('modal');
        $this->compilers = array_merge($bootstrapCompilers, $this->compilers);
    }

    /**
     * Replace @modal('id', 'view') with Blade and HTML to create a modal dialogue
     * including the given view then outputting its header, body and footer.
     * @param string $view The view compiled so far.
     * @return mixed The compiled view.
     */
    protected function compileModal($view)
    {
        return preg_replace('/@modal (\S+) (\S+)/', '
        @include("$2")
        <div id="$1" class="modal hide fade">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                @yield("header")
            </div>
            <div class="modal-body">
                @yield("body")
            </div>
            <div class="modal-footer">
                <a href="#" class="btn">Close</a>
                @yield("footer")
            </div>
        </div>', $view);
    }
}
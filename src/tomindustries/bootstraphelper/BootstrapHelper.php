<?php
/**
 * Hello.php
 * @author Tom
 * @since 17/06/13
 */
namespace tomindustries\bootstraphelper;

/**
 * Class BootstrapHelper
 * @package tomindustries\bootstraphelper
 */
class BootstrapHelper {

    /**
     * Output a modal dialogue
     * @param string $view A view with .header, .content and .footer sections.
     */
    public function modal($view)  {
        echo '
        <div class="modal hide fade">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            '.Blade::compileString('@include '.$view.'-header').'
          </div>
          <div class="modal-body">
            '.Blade::compileString('@include '.$view.'-body').'
          </div>
          <div class="modal-footer">
            <a href="#" class="btn">Close</a>
            '.Blade::compileString('@include '.$view.'-footer').'
          </div>
        </div>';
    }
}
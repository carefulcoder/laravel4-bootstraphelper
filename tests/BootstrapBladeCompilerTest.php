<?php
/**
 * BootstrapBladeCompilerTest.php
 * @author Tom
 * @since 24/06/13
 */
require("../vendor/autoload.php");

use carefulcoder\bootstrapblade\BootstrapBladeCompiler;
use Illuminate\Filesystem\Filesystem;

/**
 * Yeah, I thought I should do some testing.
 * Class BootstrapBladeCompilerTest
 */
class BootstrapBladeCompilerTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var BootstrapBladeCompiler An instance of the compiler.
     * It is stateless so can be safely reused between tests.
     */
    private static $instance = null;

    /**
     * Create an instance of our compiler.
     */
    public static function setUpBeforeClass()
    {
        self::$instance = new BootstrapBladeCompiler(new Filesystem(), '.');
    }

    /**
     * Test the compilation of a header command.
     * Since this is our first test we also do some basic syntax checks.
     * Should they be split out? Yeah, maybe. Makes sense, etc.
     */
    public function testHeadAndSyntax()
    {
        //we're going to use this expected PHP in a couple of test cases, you see.
        $expectedPhp = "<?php echo HTML::style('bootstrap/css/bootstrap.min.css'); ?>";

        //try all kinds of wild and wacky command variations. We want to pass them all.
        $this->assertEquals($expectedPhp, self::$instance->compileString('@head("")'));
        $this->assertEquals($expectedPhp, self::$instance->compileString("@heAd('')"));
        $this->assertEquals($expectedPhp, self::$instance->compileString('@hEad(")')); //even this one!
        $this->assertEquals($expectedPhp, self::$instance->compileString('@Head()'));
        $this->assertEquals('@head', self::$instance->compileString('@head')); //Much like Lisa we need braces

        //check optional inclusion of responsive styles.
        $expectedResponsive = "<?php echo HTML::style('bootstrap/css/bootstrap.min.css'); ?><?php echo HTML::style('bootstrap/css/bootstrap-responsive.css'); ?>";
        $this->assertEquals($expectedResponsive, self::$instance->compileString('@head("responsive")'));
        $this->assertEquals($expectedResponsive, self::$instance->compileString('@head("REspOnsive")'));
    }

    /**
     * Make sure our foot method outputs the right JS.
     */
    public function testFoot()
    {
        //take THAT, 120 character line limit!
        $withJquery = "<?php echo HTML::script('//ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js'); ?><?php echo HTML::script('bootstrap/js/bootstrap.min.js'); ?>";
        $this->assertEquals($withJquery, self::$instance->compileString('@foot("look Mum I\'m in a unit test"")')); //you can't pass just any old arg and expect no jquery
        $this->assertEquals($withJquery, self::$instance->compileString('@foot()'));

        $withoutJQuery = "<?php echo HTML::script('bootstrap/js/bootstrap.min.js'); ?>";
        $this->assertEquals($withoutJQuery, self::$instance->compileString('@foot("no-jquery")'));
        $this->assertEquals($withoutJQuery, self::$instance->compileString('@foot("No-jQuErY")'));
    }



}

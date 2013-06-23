Twitter Bootstrap view shortcuts for Laravel 4
==============================================

This is an extra compiler for Laravel 4 views to enable some shortcuts for common Bootstrap elements.
It works in broadly the same way as Laravel's Blade templating engine but instead of compiling down to PHP
it "compiles" down to an unholy mixture of HTML and Blade which is then compiled by the Blade compiler.

Files using this compiler should have the extension .boot.php.

I'm nowhere near done adding even the basic bootstrap elements and what I *have* done does need some improving,
particularly the nav element which only supports very basic hardcoded links at the moment. Since this is for
a project I'm working on I'll update the library as and when I need to but I'd absolutely love some help :)

Because <del>I'm terrible at regular expressions</del> the syntax I've used is quite different to Blade I've decided
to use the percent sign (%) to denote Bootstrap shortcuts rather than Blade's @. You can change it back in
BootstrapBladeCompiler.php by setting `$this->bootstrapSymbol`.

If you want to try the package out then go to https://carefulcoder.co.uk/composer and follow the instructions to add the repo.
You can then add something along the lines of  `"carefulcoder/bootstrapblade": "*"` to your composer.json file.
I haven't put this on Packagist yet because it isn't really ready.

Examples
--------

The basic syntax of these commands currently is %commandname arg1, arg2, arg3. Strings don't need to be quoted.
This is definitely a design choice and absolutely in no way because I spent ages failing at writing better regexes.

Optional parameters are shown with their possible values within brackets in these examples.

To include Bootstrap's CSS:

    %head [responsive]

Output:

    <link media="all" type="text/css" rel="stylesheet" href="http://localhost/public/bootstrap/css/bootstrap.min.css">
    <link media="all" type="text/css" rel="stylesheet" href="http://localhost/public/bootstrap/css/bootstrap-responsive.css">

To include Bootstrap's JS:

    %foot [no-jquery]

Output (assuming no-jquery wasn't set and you're on localhost):

    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script>
    <script src="http://localhost/public/bootstrap/js/bootstrap.min.js"></script>

To create a modal dialogue:

    %modal id, path/to/view

Output (I've shown the output before it is compiled by Blade rather than final HTML for this one to demonstrate what it does):
Note that the view given should have {name}-header, {name}-content and {name}-footer @sections within it.

    @include("/path/to/view")
    <div id="id" class="modal hide fade">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            @yield("view-header")
        </div>
        <div class="modal-body">
            @yield("view-content")
        </div>
        <div class="modal-footer">
            <a href="#" class="btn">Close</a>
            @yield("view-footer")
        </div>
    </div>

To create a basic full width Call to Action:

    %cta call text, button caption, button href

Output:

    <div class="row">
        <div class="span12">
            <div class="well">
                <div class="row-fluid">
                    <div class="span9">
                        <h4>call text</h4>
                    </div>
                    <div class="span3">
                        <a href="button href" role="button" class="btn btn-success btn-large btn-block" data-toggle="modal">
                            button caption&nbsp; <i class="icon-white icon-arrow-right"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

To create a fixed navbar of links (don't forget to add 60px padding to the top of your page to compensate):

    %nav App Name, Link Name -> location

Output (if you're on localhost):

    <div class="navbar navbar-inverse navbar-fixed-top">
        <div class="navbar-inner">
            <div class="container">

                <!-- .btn-navbar is used as the toggle for collapsed navbar content -->
                <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                </a>

                <!-- Be sure to leave the brand out there if you want it shown -->
                <a class="brand" href="#">My Bootstrap App</a>

                <!-- Everything you want hidden at 940px or less, place within here -->
                <div class="nav-collapse collapse">
                    <ul class="nav">
                        <li><a href="http://localhost/public/index.php/location">Home</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

To create a hero element with a title & caption:

    %hero title, caption

Output:

    <div class="hero-unit">
        <h1>title</h1>
        <p>caption</p>
    </div>

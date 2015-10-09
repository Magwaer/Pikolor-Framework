<?php

/* home.twig */
class __TwigTemplate_18c178266e6cb8e19f95e8c47714c15168b52f471e2a0d62e03a3564cc9c38f4 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 1
        echo "
<!DOCTYPE html>
<html lang=\"en\">
<head>
\t<meta charset=\"UTF-8\">
\t<title>BSS  - Campaigns</title>
\t<meta http-equiv=\"X-UA-Compatible\" content=\"IE=edge\">
\t<meta content=\"width=device-width, initial-scale=1.0\" name=\"viewport\"/>
\t<meta http-equiv=\"Content-type\" content=\"text/html; charset=utf-8\">
\t<meta content=\"\" name=\"description\"/>
\t<meta content=\"\" name=\"author\"/>

\t<link href=\"https://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all\" rel=\"stylesheet\" type=\"text/css\"/>
\t<link href=\"/assets/global/plugins/font-awesome/css/font-awesome.min.css\" rel=\"stylesheet\" type=\"text/css\"/>
\t<link href=\"/assets/global/plugins/simple-line-icons/simple-line-icons.min.css\" rel=\"stylesheet\" type=\"text/css\"/>
\t<link href=\"/assets/global/plugins/bootstrap/css/bootstrap.min.css\" rel=\"stylesheet\" type=\"text/css\"/>
\t<link href=\"/assets/global/plugins/uniform/css/uniform.default.css\" rel=\"stylesheet\" type=\"text/css\"/>
\t<link href=\"/assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css\" rel=\"stylesheet\" type=\"text/css\"/>

\t<link rel=\"stylesheet\" type=\"text/css\" href=\"assets/global/plugins/bootstrap-datepicker/css/datepicker3.css\"/>
\t<link rel=\"stylesheet\" type=\"text/css\" href=\"assets/global/plugins/bootstrap-toastr/toastr.min.css\"/>

\t<link href=\"/assets/global/css/components.css\" id=\"style_components\" rel=\"stylesheet\" type=\"text/css\"/>
\t<link href=\"/assets/global/css/plugins.css\" rel=\"stylesheet\" type=\"text/css\"/>
\t<link href=\"/assets/admin/layout/css/layout.css\" rel=\"stylesheet\" type=\"text/css\"/>
\t<link rel=\"stylesheet\" type=\"text/css\" href=\"/assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.css\"/>
\t<link id=\"style_color\" href=\"/assets/admin/layout/css/themes/darkblue.css\" rel=\"stylesheet\" type=\"text/css\"/>
\t<link rel=\"stylesheet\" type=\"text/css\" href=\"/assets/global/plugins/bootstrap-toastr/toastr.min.css\"/>
\t<link id=\"style_color\" href=\"/assets/bss/css/custom.css\" rel=\"stylesheet\" type=\"text/css\"/>
\t\t
\t<link rel=\"stylesheet\" type=\"text/css\" href=\"/assets/global/plugins/bootstrap-select/bootstrap-select.min.css\"/>
\t<link href=\"assets/global/plugins/jquery-multi-select/css/multi-select.css\" rel=\"stylesheet\" type=\"text/css\"/>
\t\t<link rel=\"shortcut icon\" href=\"favicon.ico\"/>
</head>
<body class=\"page-header-fixed page-quick-sidebar-over-content page-style-square\">

\t<!-- BEGIN HEADER -->
\t<div class=\"page-header navbar navbar-fixed-top\">
\t\t<!-- BEGIN HEADER INNER -->
\t\t<div class=\"page-header-inner\">
\t\t\t<!-- BEGIN LOGO -->
\t\t\t<div class=\"page-logo\">
\t\t\t\t<a href=\"/dashboard\">
\t\t\t\t<img src=\"/assets/admin/layout/img/logo.png\" alt=\"logo\" class=\"logo-default\"/>
\t\t\t\t</a>
\t\t\t\t<div class=\"menu-toggler sidebar-toggler hide\">
\t\t\t\t\t<!-- DOC: Remove the above \"hide\" to enable the sidebar toggler button on header -->
\t\t\t\t</div>
\t\t\t</div>
\t\t\t<!-- END LOGO -->
\t\t\t<!-- BEGIN RESPONSIVE MENU TOGGLER -->
\t\t\t<a href=\"javascript:;\" class=\"menu-toggler responsive-toggler\" data-toggle=\"collapse\" data-target=\".navbar-collapse\">
\t\t\t</a>
\t\t\t<!-- END RESPONSIVE MENU TOGGLER -->
\t\t\t<!-- BEGIN TOP NAVIGATION MENU -->
\t\t\t<div class=\"top-menu\">
\t\t\t\t<ul class=\"nav navbar-nav pull-right\">
\t\t\t\t\t
\t\t\t\t\t<!-- BEGIN USER LOGIN DROPDOWN -->
\t\t\t\t\t<!-- DOC: Apply \"dropdown-dark\" class after below \"dropdown-extended\" to change the dropdown styte -->
\t\t\t\t\t<li class=\"dropdown dropdown-user\">
\t\t\t\t\t\t<a href=\"#\" class=\"dropdown-toggle\" data-toggle=\"dropdown\" data-hover=\"dropdown\" data-close-others=\"true\">
\t\t\t\t\t\t<img alt=\"\" class=\"img-circle\" src=\"/assets/admin/layout/img/avatar3_small.jpg\"/>
\t\t\t\t\t\t<span class=\"username username-hide-on-mobile\">
\t\t\t\t\t\tAdmin </span>
\t\t\t\t\t\t</a>
\t\t\t\t\t</li>
\t\t\t\t\t<!-- END USER LOGIN DROPDOWN -->
\t\t\t\t\t<!-- BEGIN QUICK SIDEBAR TOGGLER -->
\t\t\t\t\t<!-- DOC: Apply \"dropdown-dark\" class after below \"dropdown-extended\" to change the dropdown styte -->
\t\t\t\t\t<li class=\"dropdown dropdown-quick-sidebar-toggler\">
\t\t\t\t\t\t<a href=\"/logout\" class=\"dropdown-toggle\">
\t\t\t\t\t\t<i class=\"icon-logout\"></i>
\t\t\t\t\t\t</a>
\t\t\t\t\t</li>
\t\t\t\t\t<!-- END QUICK SIDEBAR TOGGLER -->
\t\t\t\t</ul>
\t\t\t</div>
\t\t\t<!-- END TOP NAVIGATION MENU -->
\t\t</div>
\t\t<!-- END HEADER INNER -->
\t</div>
\t<!-- END HEADER -->
\t<div class=\"clearfix\">
\t</div>
\t<!-- BEGIN CONTAINER -->
\t<div class=\"page-container\">
\t\t<!-- BEGIN SIDEBAR -->
\t<div class=\"page-sidebar-wrapper\">
\t\t<div class=\"page-sidebar navbar-collapse collapse\">
\t\t\t<!-- BEGIN SIDEBAR MENU -->
\t\t\t<!-- DOC: Apply \"page-sidebar-menu-light\" class right after \"page-sidebar-menu\" to enable light sidebar menu style(without borders) -->
\t\t\t<!-- DOC: Apply \"page-sidebar-menu-hover-submenu\" class right after \"page-sidebar-menu\" to enable hoverable(hover vs accordion) sub menu mode -->
\t\t\t<!-- DOC: Apply \"page-sidebar-menu-closed\" class right after \"page-sidebar-menu\" to collapse(\"page-sidebar-closed\" class must be applied to the body element) the sidebar sub menu mode -->
\t\t\t<!-- DOC: Set data-auto-scroll=\"false\" to disable the sidebar from auto scrolling/focusing -->
\t\t\t<!-- DOC: Set data-keep-expand=\"true\" to keep the submenues expanded -->
\t\t\t<!-- DOC: Set data-auto-speed=\"200\" to adjust the sub menu slide up/down speed -->
\t\t\t<ul class=\"page-sidebar-menu\" data-keep-expanded=\"false\" data-auto-scroll=\"true\" data-slide-speed=\"200\">
\t\t\t\t<!-- DOC: To remove the sidebar toggler from the sidebar you just need to completely remove the below \"sidebar-toggler-wrapper\" LI element -->
\t\t\t\t<li class=\"sidebar-toggler-wrapper\">
\t\t\t\t\t<!-- BEGIN SIDEBAR TOGGLER BUTTON -->
\t\t\t\t\t<div class=\"sidebar-toggler\">
\t\t\t\t\t</div>
\t\t\t\t\t<!-- END SIDEBAR TOGGLER BUTTON -->
\t\t\t\t</li>
\t\t\t\t
\t\t\t\t<li class=\"start \">
\t\t\t\t\t<a href=\"/dashboard\" >
\t\t\t\t\t<i class=\"icon-home\"></i>
\t\t\t\t\t<span class=\"title\">
\t\t\t\t\tDashboard </span>
\t\t\t\t\t</a>
\t\t\t\t</li>
\t\t\t\t
\t\t\t\t<li class=\" active open\">
\t\t\t\t\t<a href=\"javascript:;\">
\t\t\t\t\t\t<i class=\"fa fa-phone \"></i>
\t\t\t\t\t\t<span class=\"title\">Telephony</span>
\t\t\t\t\t\t<span class=\"selected\"></span>
\t\t\t\t\t\t<span class=\"arrow open\"></span>
\t\t\t\t\t</a>
\t\t\t\t\t<ul class=\"sub-menu\">
\t\t\t\t\t\t<li class=\"active\">
\t\t\t\t\t\t\t<a href=\"/campaigns\">
\t\t\t\t\t\t\t<i class=\"fa fa-paper-plane \"></i>
\t\t\t\t\t\t\tCampaigns</a>
\t\t\t\t\t\t</li>
\t\t\t\t\t\t<li class=\"\">
\t\t\t\t\t\t\t<a href=\"/ingroups\">
\t\t\t\t\t\t\t<i class=\"fa  fa-arrow-circle-down \"></i>
\t\t\t\t\t\t\tInbound</a>
\t\t\t\t\t\t</li>
\t\t\t\t\t\t<li class=\"\">
\t\t\t\t\t\t\t<a href=\"/go_list\">
\t\t\t\t\t\t\t<i class=\"fa fa-list \"></i>
\t\t\t\t\t\t\tLists</a>
\t\t\t\t\t\t</li>
\t\t\t\t\t\t<li class=\"\">
\t\t\t\t\t\t\t<a href=\"/moh\">
\t\t\t\t\t\t\t<i class=\"fa  fa-music \"></i>
\t\t\t\t\t\t\tMusic On Hold</a>
\t\t\t\t\t\t</li>
\t\t\t\t\t\t<li class=\"\">
\t\t\t\t\t\t\t<a href=\"/scripts\">
\t\t\t\t\t\t\t<i class=\"fa fa-cubes \"></i>
\t\t\t\t\t\t\tScripts</a>
\t\t\t\t\t\t</li>
\t\t\t\t\t\t<li class=\"\">
\t\t\t\t\t\t\t<a href=\"/users\">
\t\t\t\t\t\t\t<i class=\"fa fa-user \"></i>
\t\t\t\t\t\t\tUsers</a>
\t\t\t\t\t\t</li>
\t\t\t\t\t\t<li class=\"\">
\t\t\t\t\t\t\t<a href=\"/voicemails\">
\t\t\t\t\t\t\t<i class=\"icon-envelope-open \"></i>
\t\t\t\t\t\t\tVoice Files</a>
\t\t\t\t\t\t</li>
\t\t\t\t\t</ul>
\t\t\t\t</li>
\t\t\t\t

\t\t\t</ul>
\t\t\t<!-- END SIDEBAR MENU -->
\t\t</div>
\t</div>
\t<!-- END SIDEBAR -->
\t<div class=\"page-content-wrapper\">
\t\t<div class=\"page-content\">
\t\t\t<h3 class=\"page-title\">
\t\t\t\tCampaigns
\t\t\t\t
\t\t\t</h3>

\t\t\t
\t\t\taa
\t\t\t\t
\t\t</div>
\t</div>
\t</div>

\t<!-- BEGIN FOOTER -->
\t<div class=\"page-footer\">
\t\t<div class=\"page-footer-inner\">
\t\t\t 2015 &copy; Buzco Stas
\t\t</div>
\t\t<div class=\"scroll-to-top\">
\t\t\t<i class=\"icon-arrow-up\"></i>
\t\t</div>
\t</div>
\t
\t
\t<!--DOC: Aplly \"modal-cached\" class after \"modal\" class to enable ajax content caching-->
\t<div class=\"modal fade\" id=\"ajax_modal\" role=\"basic\" aria-hidden=\"true\">
\t\t<div class=\"modal-dialog\">
\t\t\t<div class=\"modal-content\">
\t\t\t\t<div class=\"modal-body\">
\t\t\t\t\t<img src=\"/assets/global/img/loading-spinner-grey.gif\" alt=\"\" class=\"loading\">
\t\t\t\t\t<span>
\t\t\t\t\t\t&nbsp;&nbsp;Loading... </span>
\t\t\t\t</div>
\t\t\t</div>
\t\t</div>
\t</div>

\t<!--[if lt IE 9]>
\t<script src=\"assets/global/plugins/respond.min.js\"></script>
\t<script src=\"assets/global/plugins/excanvas.min.js\"></script>
\t<![endif]-->
\t<script src=\"/assets/global/plugins/jquery.min.js\" type=\"text/javascript\"></script>
\t<script src=\"/assets/global/plugins/jquery-migrate.min.js\" type=\"text/javascript\"></script>
\t<!-- IMPORTANT! Load jquery-ui.min.js before bootstrap.min.js to fix bootstrap tooltip conflict with jquery ui tooltip -->
\t<script src=\"/assets/global/plugins/jquery-ui/jquery-ui.min.js\" type=\"text/javascript\"></script>
\t<script src=\"/assets/global/plugins/bootstrap/js/bootstrap.min.js\" type=\"text/javascript\"></script>
\t<script src=\"/assets/global/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js\" type=\"text/javascript\"></script>
\t<script src=\"/assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js\" type=\"text/javascript\"></script>
\t<script src=\"/assets/global/plugins/jquery.blockui.min.js\" type=\"text/javascript\"></script>
\t<script src=\"/assets/global/plugins/jquery.cokie.min.js\" type=\"text/javascript\"></script>
\t<script src=\"/assets/global/plugins/uniform/jquery.uniform.min.js\" type=\"text/javascript\"></script>
\t<script src=\"/assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js\" type=\"text/javascript\"></script>

\t<script src=\"/assets/global/scripts/metronic.js\" type=\"text/javascript\"></script>
\t<script src=\"/assets/admin/layout/scripts/layout.js\" type=\"text/javascript\"></script>
\t
\t
\t<script type=\"text/javascript\" src=\"/js/bss/campaigns.js\"></script>
\t

<script>
\tjQuery(document).ready(function() {
\t\t   \t// initiate layout and plugins
\t\t  \tMetronic.init(); // init metronic core components
\t\t\tLayout.init(); // init current layout

\t\t\t
\t\t});
</script>

</body>
</html>";
    }

    public function getTemplateName()
    {
        return "home.twig";
    }

    public function getDebugInfo()
    {
        return array (  19 => 1,);
    }
}

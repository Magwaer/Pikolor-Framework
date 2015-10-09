<?php

/* pages/login.twig */
class __TwigTemplate_ea35b64933ac08da643a82960921b1cc18691ea58adbc82ac3888a9fa0c2b862 extends Twig_Template
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
        echo "<!DOCTYPE html>
<!-- 
Template Name: Metronic - Responsive Admin Dashboard Template build with Twitter Bootstrap 3.3.5
Version: 3.3.0
Author: KeenThemes
Website: http://www.keenthemes.com/
Contact: support@keenthemes.com
Follow: www.twitter.com/keenthemes
Like: www.facebook.com/keenthemes
Purchase: http://themeforest.net/item/metronic-responsive-admin-dashboard-template/4021469?ref=keenthemes
License: You must have a valid license purchased only from themeforest(the above link) in order to legally use the theme for your project.
-->
<!--[if IE 8]> <html lang=\"en\" class=\"ie8 no-js\"> <![endif]-->
<!--[if IE 9]> <html lang=\"en\" class=\"ie9 no-js\"> <![endif]-->
<!--[if !IE]><!-->
<html lang=\"en\">
<!--<![endif]-->
<!-- BEGIN HEAD -->
<head>
<meta charset=\"utf-8\"/>
<title>";
        // line 21
        echo twig_escape_filter($this->env, (isset($context["page_title"]) ? $context["page_title"] : null), "html", null, true);
        echo "</title>
<meta http-equiv=\"X-UA-Compatible\" content=\"IE=edge\">
<meta content=\"width=device-width, initial-scale=1.0\" name=\"viewport\"/>
<meta http-equiv=\"Content-type\" content=\"text/html; charset=utf-8\">
<meta content=\"\" name=\"description\"/>
<meta content=\"\" name=\"author\"/>
<!-- BEGIN GLOBAL MANDATORY STYLES -->
<link href=\"http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all\" rel=\"stylesheet\" type=\"text/css\"/>
<link href=\"/assets/global/plugins/font-awesome/css/font-awesome.min.css\" rel=\"stylesheet\" type=\"text/css\"/>
<link href=\"/assets/global/plugins/simple-line-icons/simple-line-icons.min.css\" rel=\"stylesheet\" type=\"text/css\"/>
<link href=\"/assets/global/plugins/bootstrap/css/bootstrap.min.css\" rel=\"stylesheet\" type=\"text/css\"/>
<link href=\"/assets/global/plugins/uniform/css/uniform.default.css\" rel=\"stylesheet\" type=\"text/css\"/>
<!-- END GLOBAL MANDATORY STYLES -->
<!-- BEGIN PAGE LEVEL STYLES -->
<link href=\"/assets/admin/pages/css/login.css\" rel=\"stylesheet\" type=\"text/css\"/>
<!-- END PAGE LEVEL SCRIPTS -->
<!-- BEGIN THEME STYLES -->
<link href=\"/assets/global/css/components.css\" id=\"style_components\" rel=\"stylesheet\" type=\"text/css\"/>
<link href=\"/assets/global/css/plugins.css\" rel=\"stylesheet\" type=\"text/css\"/>
<link href=\"/assets/admin/layout/css/layout.css\" rel=\"stylesheet\" type=\"text/css\"/>
<link href=\"/assets/admin/layout/css/themes/darkblue.css\" rel=\"stylesheet\" type=\"text/css\" id=\"style_color\"/>
<link href=\"/assets/admin/layout/css/custom.css\" rel=\"stylesheet\" type=\"text/css\"/>
<link rel=\"stylesheet\" type=\"text/css\" href=\"/assets/global/plugins/bootstrap-toastr/toastr.min.css\"/>
<!-- END THEME STYLES -->

</head>
<!-- END HEAD -->
<!-- BEGIN BODY -->
<body class=\"login\">
<!-- BEGIN SIDEBAR TOGGLER BUTTON -->

<!-- END SIDEBAR TOGGLER BUTTON -->
<!-- BEGIN LOGO -->
<div class=\"logo\">
\t<a href=\"/\">
\t<img src=\"/app/Web/img/logo.png\" alt=\"\"/>
\t</a>
</div>
<!-- END LOGO -->
<!-- BEGIN LOGIN -->
<div class=\"content\">
\t<!-- BEGIN LOGIN FORM -->
\t<form class=\"login-form\" action=\"index.html\" method=\"post\" id=\"login_form\">
\t\t<h3 class=\"form-title\">Sign In</h3>
\t\t<div class=\"alert alert-danger display-hide\">
\t\t\t<button class=\"close\" data-close=\"alert\"></button>
\t\t\t<span>
\t\t\tEnter any username and password. </span>
\t\t</div>
\t\t<div class=\"form-group\">
\t\t\t<!--ie8, ie9 does not support html5 placeholder, so we just show field title for that-->
\t\t\t<label class=\"control-label visible-ie8 visible-ie9\">Username</label>
\t\t\t<input class=\"form-control form-control-solid placeholder-no-fix\" type=\"text\" autocomplete=\"off\" placeholder=\"Phone number\" name=\"phone_number\" id=\"phone_number\"/>
\t\t</div>
\t\t<div class=\"form-group\">
\t\t\t<label class=\"control-label visible-ie8 visible-ie9\">Password</label>
\t\t\t<input class=\"form-control form-control-solid placeholder-no-fix\" type=\"password\" autocomplete=\"off\" placeholder=\"Password\" name=\"password\" id=\"password\"/>
\t\t</div>
\t\t<div class=\"form-actions\">
\t\t\t<button type=\"submit\" class=\"btn btn-success uppercase\">Login or Register</button>
\t\t</div>
\t\t<a href=\"#\" >Nu pot intra cu contul meu</a>
\t\t<input type=\"hidden\" name=\"ac\" value=\"login\" />
\t</form>
\t<!-- END LOGIN FORM -->
\t
\t<!--DOC: Aplly \"modal-cached\" class after \"modal\" class to enable ajax content caching-->
\t<div class=\"modal fade\" id=\"register_modal\" role=\"basic\" aria-hidden=\"true\">
\t\t<div class=\"modal-dialog\">
\t\t\t<div class=\"modal-content\">
\t\t\t\t<div class=\"modal-header\">
\t\t\t\t\t<button type=\"button\" class=\"close\" data-dismiss=\"modal\" aria-hidden=\"true\"></button>
\t\t\t\t\t<h4 class=\"modal-title\">Inregistreaza-te acuma</h4>
\t\t\t\t</div>
\t\t\t\t<div class=\"modal-body\">
\t\t\t\t\t<form id=\"register_form\" class=\"ajax_form form-horizontal\" method=\"post\">
\t\t\t\t\t\t<div style=\"padding:0 15px\" class=\"form-body\">
\t\t\t\t\t\t\t<div class=\"form-group\">
\t\t\t\t\t\t\t\t<label class=\"col-md-4 control-label\">Numele dvs</label>
\t\t\t\t\t\t\t\t<div class=\"col-md-7\">
\t\t\t\t\t\t\t\t\t<input type=\"text\" name=\"user_name\" value=\"\" class=\"form-control\" id=\"user_name\">
\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t
\t\t\t\t\t\t</div>
\t\t\t\t\t\t<input type=\"hidden\" name=\"phone_number\" id=\"reg_phone_number\" />
\t\t\t\t\t\t<input type=\"hidden\" name=\"password\" id=\"reg_password\" />
\t\t\t\t\t\t<input type=\"hidden\" name=\"ac\" value=\"register\" />
\t\t\t\t\t</form>
\t\t\t\t</div>
\t\t\t\t<div class=\"modal-footer\">
\t\t\t\t\t<button type=\"button\" class=\"btn blue\" id=\"register_but\">Inregistreaza-te</button>
\t\t\t\t</div>
\t\t\t</div>
\t\t</div>
\t</div>
\t
</div>
<div class=\"copyright\">
\t 2015 &copy; 2Rent
</div>
<!-- END LOGIN -->
<!-- BEGIN JAVASCRIPTS(Load javascripts at bottom, this will reduce page load time) -->
<!-- BEGIN CORE PLUGINS -->
<!--[if lt IE 9]>
<script src=\"/assets/global/plugins/respond.min.js\"></script>
<script src=\"/assets/global/plugins/excanvas.min.js\"></script> 
<![endif]-->
<script src=\"/assets/global/plugins/jquery.min.js\" type=\"text/javascript\"></script>
<script src=\"/assets/global/plugins/jquery-migrate.min.js\" type=\"text/javascript\"></script>
<script src=\"/assets/global/plugins/bootstrap/js/bootstrap.min.js\" type=\"text/javascript\"></script>
<script src=\"/assets/global/plugins/jquery.blockui.min.js\" type=\"text/javascript\"></script>
<script src=\"/assets/global/plugins/jquery.cokie.min.js\" type=\"text/javascript\"></script>
<script src=\"/assets/global/plugins/uniform/jquery.uniform.min.js\" type=\"text/javascript\"></script>
<!-- END CORE PLUGINS -->
<!-- BEGIN PAGE LEVEL PLUGINS -->
<script src=\"/assets/global/plugins/jquery-validation/js/jquery.validate.min.js\" type=\"text/javascript\"></script>
<!-- END PAGE LEVEL PLUGINS -->
<!-- BEGIN PAGE LEVEL SCRIPTS -->
<script src=\"/assets/global/scripts/metronic.js\" type=\"text/javascript\"></script>
<script src=\"/assets/admin/layout/scripts/layout.js\" type=\"text/javascript\"></script>
<script type=\"text/javascript\" src=\"/assets/global/plugins/bootstrap-toastr/toastr.min.js\"></script>
<!-- END PAGE LEVEL SCRIPTS -->
<script src=\"/app/Web/js/login.js\" type=\"text/javascript\"></script>
<script>
jQuery(document).ready(function() {     
\tMetronic.init(); // init metronic core components
\tLayout.init(); // init current layout
\t
});
</script>
<!-- END JAVASCRIPTS -->

</body>

<!-- END BODY -->
</html>";
    }

    public function getTemplateName()
    {
        return "pages/login.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  41 => 21,  19 => 1,);
    }
}

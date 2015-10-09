<?php

/* full-page-layout.html */
class __TwigTemplate_3668c140cb01bb4078c094b5e91689660b9327ba185250b0b275a1d41dac24e2 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
            'stylesheets' => array($this, 'block_stylesheets'),
            'javascript_head' => array($this, 'block_javascript_head'),
            'content' => array($this, 'block_content'),
            'javascript_bottom' => array($this, 'block_javascript_bottom'),
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 1
        echo "<!DOCTYPE html>
<html lang=\"en\">
<head>
\t<meta charset=\"UTF-8\">
\t<title>BSS ";
        // line 5
        if ((isset($context["page_title"]) ? $context["page_title"] : null)) {
            echo " - ";
            echo twig_escape_filter($this->env, (isset($context["page_title"]) ? $context["page_title"] : null), "html", null, true);
        }
        echo "</title>
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
\t";
        // line 29
        $this->displayBlock('stylesheets', $context, $blocks);
        // line 30
        echo "\t";
        $this->displayBlock('javascript_head', $context, $blocks);
        // line 31
        echo "\t<link rel=\"shortcut icon\" href=\"favicon.ico\"/>
</head>
<body class=\"page-header-fixed page-quick-sidebar-over-content page-style-square\">

\t";
        // line 35
        $this->env->loadTemplate("layout-parts/header.html")->display($context);
        // line 36
        echo "
\t<div class=\"page-container\">
\t\t";
        // line 38
        $this->env->loadTemplate("layout-parts/sidebar.html")->display($context);
        // line 39
        echo "
\t\t";
        // line 40
        $this->displayBlock('content', $context, $blocks);
        // line 41
        echo "\t</div>

\t";
        // line 43
        $this->env->loadTemplate("layout-parts/footer.html")->display($context);
        // line 44
        echo "
\t<!--DOC: Aplly \"modal-cached\" class after \"modal\" class to enable ajax content caching-->
\t<div class=\"modal fade  bs-modal-lg\" id=\"ajax_modal_long\" role=\"basic\" aria-hidden=\"true\">
\t\t<div class=\"modal-dialog modal-lg\">
\t\t\t<div class=\"modal-content\">
\t\t\t\t<div class=\"modal-body\">
\t\t\t\t\t<img src=\"/assets/global/img/loading-spinner-grey.gif\" alt=\"\" class=\"loading\">
\t\t\t\t\t<span>
\t\t\t\t\t&nbsp;&nbsp;Loading... </span>
\t\t\t\t</div>
\t\t\t</div>
\t\t</div>
\t</div>
\t
\t\t<!--DOC: Aplly \"modal-cached\" class after \"modal\" class to enable ajax content caching-->
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
\t<script type=\"text/javascript\" src=\"/assets/global/plugins/bootstrap-toastr/toastr.min.js\"></script>
\t<script src=\"/assets/global/plugins/bootbox/bootbox.min.js\" type=\"text/javascript\"></script>
\t<script type=\"text/javascript\" src=\"/app/Web/js/socket.io/dist/socket.io.js\"></script>
\t<script src=\"/app/Web/js/app.js\" type=\"text/javascript\"></script>
";
        // line 93
        $this->displayBlock('javascript_bottom', $context, $blocks);
        // line 95
        echo "
<script>
\tjQuery(document).ready(function() {
\t\t   \t// initiate layout and plugins
\t\t  \tMetronic.init(); // init metronic core components
\t\t\tLayout.init(); // init current layout

\t\t\tapp.my_id = ";
        // line 102
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["me"]) ? $context["me"] : null), "id", array()), "html", null, true);
        echo ";\t\t\t
\t\t\tapp.initApp();
\t\t});
</script>

</body>
</html>";
    }

    // line 29
    public function block_stylesheets($context, array $blocks = array())
    {
    }

    // line 30
    public function block_javascript_head($context, array $blocks = array())
    {
    }

    // line 40
    public function block_content($context, array $blocks = array())
    {
    }

    // line 93
    public function block_javascript_bottom($context, array $blocks = array())
    {
    }

    public function getTemplateName()
    {
        return "full-page-layout.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  177 => 93,  172 => 40,  167 => 30,  162 => 29,  151 => 102,  142 => 95,  140 => 93,  89 => 44,  87 => 43,  83 => 41,  81 => 40,  78 => 39,  76 => 38,  72 => 36,  70 => 35,  64 => 31,  61 => 30,  59 => 29,  29 => 5,  23 => 1,);
    }
}

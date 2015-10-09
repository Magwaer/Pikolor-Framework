<?php

/* pages/home.twig */
class __TwigTemplate_7555027326990a2e9d55d004e49c10d3a227eebba7c8c62f748be3a2b2cf608e extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        try {
            $this->parent = $this->env->loadTemplate("full-page-layout.html");
        } catch (Twig_Error_Loader $e) {
            $e->setTemplateFile($this->getTemplateName());
            $e->setTemplateLine(1);

            throw $e;
        }

        $this->blocks = array(
            'stylesheets' => array($this, 'block_stylesheets'),
            'content' => array($this, 'block_content'),
            'javascript_bottom' => array($this, 'block_javascript_bottom'),
        );
    }

    protected function doGetParent(array $context)
    {
        return "full-page-layout.html";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 3
    public function block_stylesheets($context, array $blocks = array())
    {
        // line 4
        echo "\t";
        $this->displayParentBlock("stylesheets", $context, $blocks);
        echo "
\t
";
    }

    // line 8
    public function block_content($context, array $blocks = array())
    {
        // line 9
        echo "\t<div class=\"page-content-wrapper\">
\t\t<div class=\"page-content\">
\t\t\t<h3 class=\"page-title\">
\t\t\t\t";
        // line 12
        echo twig_escape_filter($this->env, (isset($context["page_title"]) ? $context["page_title"] : null), "html", null, true);
        echo "
\t\t\t\t<div class=\"btn-group pull-right\">
\t\t\t\t\t<a class=\"btn default yellow-stripe\" href=\"javascript:;\" data-toggle=\"dropdown\">
\t\t\t\t\t\t<i class=\"fa fa-share\"></i>
\t\t\t\t\t\t<span class=\"hidden-480\">";
        // line 16
        echo "Tools";
        echo "</span>
\t\t\t\t\t\t<i class=\"fa fa-angle-down\"></i>
\t\t\t\t\t</a>
\t\t\t\t\t<ul class=\"dropdown-menu pull-right\">
\t\t\t\t\t\t<li>
\t\t\t\t\t\t\t<a href=\"/index.php/bss_agents/add_agent/\" data-target=\"#ajax_modal\" data-toggle=\"modal\">
\t\t\t\t\t\t\t\t<i class=\"fa fa-user-plus\"></i> ";
        // line 22
        echo "Add new agent";
        echo "
\t\t\t\t\t\t\t</a>
\t\t\t\t\t\t</li>
\t\t\t\t\t\t";
        // line 25
        if (((isset($context["vtiger_integration"]) ? $context["vtiger_integration"] : null) == 1)) {
            // line 26
            echo "\t\t\t\t\t\t\t<li>
\t\t\t\t\t\t\t\t<a onclick=\"predictive.sync_agents(\$(this)); return false\" href=\"#\">
\t\t\t\t\t\t\t\t\t<i class=\"fa fa-cloud-download\"></i>";
            // line 28
            echo "Sync with VTiger";
            echo "
\t\t\t\t\t\t\t\t</a>
\t\t\t\t\t\t\t</li>
\t\t\t\t\t\t";
        }
        // line 32
        echo "\t\t\t\t\t</ul>
\t\t\t\t</div>
\t\t\t</h3>

\t\t\t<table cellspacing=\"0\" cellpadding=\"1\" border=\"0\" style=\"width:100%;\" class=\"table table-striped table-bordered table-hover dataTable no-footer\" id=\"mainTable\">
\t\t\t\t<thead>
\t\t\t\t\t<tr style=\"font-weight:bold;\">
\t\t\t\t\t\t<th class=\"header\" style=\"text-align:left\" width=\"70\">#</th>
\t\t\t\t\t\t<th class=\"header\" style=\"text-align:left\">";
        // line 40
        echo "First name";
        echo "</th>
\t\t\t\t\t\t<th class=\"header\" style=\"text-align:left\">";
        // line 41
        echo "Last name";
        echo "</th>
\t\t\t\t\t\t<th class=\"header\" style=\"text-align:left\">";
        // line 42
        echo "Email";
        echo "</th>
\t\t\t\t\t\t<th class=\"header\" style=\"text-align:left\" width=\"100\">";
        // line 43
        echo "Option";
        echo "</th>
\t\t\t\t\t</tr>
\t\t\t\t</thead>
\t\t\t\t<tbody>
\t\t\t\t";
        // line 47
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["all_agents"]) ? $context["all_agents"] : null));
        foreach ($context['_seq'] as $context["_key"] => $context["agent"]) {
            // line 48
            echo "\t\t\t\t\t<tr>
\t\t\t\t\t\t<td>";
            // line 49
            echo twig_escape_filter($this->env, $this->getAttribute($context["agent"], "id", array()), "html", null, true);
            echo "</td>
\t\t\t\t\t\t<td>";
            // line 50
            echo twig_escape_filter($this->env, $this->getAttribute($context["agent"], "firstname", array()), "html", null, true);
            echo "</td>
\t\t\t\t\t\t<td>";
            // line 51
            echo twig_escape_filter($this->env, $this->getAttribute($context["agent"], "lastname", array()), "html", null, true);
            echo "</td>
\t\t\t\t\t\t<td>";
            // line 52
            echo twig_escape_filter($this->env, $this->getAttribute($context["agent"], "email", array()), "html", null, true);
            echo "</td>
\t\t\t\t\t\t<td>
\t\t\t\t\t\t\t<div class=\"btn-group pull-right\">
\t\t\t\t\t\t\t\t<button type=\"button\" class=\"btn btn-sm btn-info dropdown-toggle\" data-toggle=\"dropdown\" data-delay=\"1000\" data-close-others=\"true\">
\t\t\t\t\t\t\t\t\t";
            // line 56
            echo "Actions";
            echo " <i class=\"fa fa-angle-down\"></i>
\t\t\t\t\t\t\t\t</button>
\t\t\t\t\t\t\t\t<ul class=\"dropdown-menu pull-right\" role=\"menu\">
\t\t\t\t\t\t\t\t\t<li>
\t\t\t\t\t\t\t\t\t\t<a href=\"/index.php/bss_agents/edit_agent/";
            // line 60
            echo twig_escape_filter($this->env, $this->getAttribute($context["agent"], "id", array()), "html", null, true);
            echo "\" data-target=\"#ajax_modal\" data-toggle=\"modal\">";
            echo "Edit agent";
            echo "</a>
\t\t\t\t\t\t\t\t\t</li>
\t\t\t\t\t\t\t\t\t<li>
\t\t\t\t\t\t\t\t\t\t<a href=\"/agent_busytime/";
            // line 63
            echo twig_escape_filter($this->env, $this->getAttribute($context["agent"], "id", array()), "html", null, true);
            echo "\">";
            echo "Show agent calendar";
            echo "</a>
\t\t\t\t\t\t\t\t\t</li>
\t\t\t\t\t\t\t\t\t<li>
\t\t\t\t\t\t\t\t\t\t<a href=\"/agent_working_hours/";
            // line 66
            echo twig_escape_filter($this->env, $this->getAttribute($context["agent"], "id", array()), "html", null, true);
            echo "\" data-target=\"#ajax_modal\" data-toggle=\"modal\">";
            echo "Show agent working hours";
            echo "</a>
\t\t\t\t\t\t\t\t\t</li>
\t\t\t\t\t\t\t\t\t<li>
\t\t\t\t\t\t\t\t\t\t<a href=\"/index.php/bss_agents/delete_agent/";
            // line 69
            echo twig_escape_filter($this->env, $this->getAttribute($context["agent"], "id", array()), "html", null, true);
            echo "\" onclick=\"return confirm('Are you sure ?')\">";
            echo "Delete";
            echo "</a>
\t\t\t\t\t\t\t\t\t</li>
\t\t\t\t\t\t\t\t</ul>
\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t</td>
\t\t\t\t\t</tr>
\t\t\t\t";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['agent'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 76
        echo "\t\t\t\t</tbody>
\t\t\t</table>
\t\t</div>
\t</div>
";
    }

    // line 82
    public function block_javascript_bottom($context, array $blocks = array())
    {
        // line 83
        echo "\tapp.initApp();
";
    }

    public function getTemplateName()
    {
        return "pages/home.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  204 => 83,  201 => 82,  193 => 76,  178 => 69,  170 => 66,  162 => 63,  154 => 60,  147 => 56,  140 => 52,  136 => 51,  132 => 50,  128 => 49,  125 => 48,  121 => 47,  114 => 43,  110 => 42,  106 => 41,  102 => 40,  92 => 32,  85 => 28,  81 => 26,  79 => 25,  73 => 22,  64 => 16,  57 => 12,  52 => 9,  49 => 8,  41 => 4,  38 => 3,  11 => 1,);
    }
}

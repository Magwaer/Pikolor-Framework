<?php

/* layout-parts/sidebar.html */
class __TwigTemplate_8a6efb3913f2171a12b18eba56c44d3b1b9665501cbdad81a4187ba133d5c8cd extends Twig_Template
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
        echo "<!-- BEGIN SIDEBAR -->
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
\t\t\t\t<li class=\"start ";
        // line 20
        if (((isset($context["page"]) ? $context["page"] : null) == "dashboard")) {
            echo "active";
        }
        echo "\">
\t\t\t\t\t<a href=\"/dashboard\" >
\t\t\t\t\t<i class=\"icon-home\"></i>
\t\t\t\t\t<span class=\"title\">
\t\t\t\t\tDashboard </span>
\t\t\t\t\t</a>
\t\t\t\t</li>
\t\t\t\t
\t\t\t\t<li class=\" ";
        // line 28
        if (((isset($context["tab"]) ? $context["tab"] : null) == "telefony")) {
            echo "active open";
        }
        echo "\">
\t\t\t\t\t<a href=\"javascript:;\">
\t\t\t\t\t<i class=\"fa fa-phone \"></i>
\t\t\t\t\t<span class=\"title\">Telephony</span>
\t\t\t\t\t<span class=\"selected\"></span>
\t\t\t\t\t<span class=\"arrow open\"></span>
\t\t\t\t\t</a>
\t\t\t\t\t<ul class=\"sub-menu\">
\t\t\t\t\t\t<li class=\"";
        // line 36
        if (((isset($context["page"]) ? $context["page"] : null) == "campaigns")) {
            echo "active";
        }
        echo "\">
\t\t\t\t\t\t\t<a href=\"/campaigns\">
\t\t\t\t\t\t\t<i class=\"fa fa-paper-plane \"></i>
\t\t\t\t\t\t\tCampaigns</a>
\t\t\t\t\t\t</li>
\t\t\t\t\t\t<li class=\"";
        // line 41
        if (((isset($context["page"]) ? $context["page"] : null) == "inbound")) {
            echo "active";
        }
        echo "\">
\t\t\t\t\t\t\t<a href=\"/ingroups\">
\t\t\t\t\t\t\t<i class=\"fa  fa-arrow-circle-down \"></i>
\t\t\t\t\t\t\tInbound</a>
\t\t\t\t\t\t</li>
\t\t\t\t\t\t<li class=\"";
        // line 46
        if (((isset($context["page"]) ? $context["page"] : null) == "lists")) {
            echo "active";
        }
        echo "\">
\t\t\t\t\t\t\t<a href=\"/go_list\">
\t\t\t\t\t\t\t<i class=\"fa fa-list \"></i>
\t\t\t\t\t\t\tLists</a>
\t\t\t\t\t\t</li>
\t\t\t\t\t\t<li class=\"";
        // line 51
        if (((isset($context["page"]) ? $context["page"] : null) == "moh")) {
            echo "active";
        }
        echo "\">
\t\t\t\t\t\t\t<a href=\"/moh\">
\t\t\t\t\t\t\t<i class=\"fa  fa-music \"></i>
\t\t\t\t\t\t\tMusic On Hold</a>
\t\t\t\t\t\t</li>
\t\t\t\t\t\t<li class=\"";
        // line 56
        if (((isset($context["page"]) ? $context["page"] : null) == "scripts")) {
            echo "active";
        }
        echo "\">
\t\t\t\t\t\t\t<a href=\"/scripts\">
\t\t\t\t\t\t\t<i class=\"fa fa-cubes \"></i>
\t\t\t\t\t\t\tScripts</a>
\t\t\t\t\t\t</li>
\t\t\t\t\t\t<li class=\"";
        // line 61
        if (((isset($context["page"]) ? $context["page"] : null) == "users")) {
            echo "active";
        }
        echo "\">
\t\t\t\t\t\t\t<a href=\"/users\">
\t\t\t\t\t\t\t<i class=\"fa fa-user \"></i>
\t\t\t\t\t\t\tUsers</a>
\t\t\t\t\t\t</li>
\t\t\t\t\t\t<li class=\"";
        // line 66
        if (((isset($context["page"]) ? $context["page"] : null) == "voicemails")) {
            echo "active";
        }
        echo "\">
\t\t\t\t\t\t\t<a href=\"/voicemails\">
\t\t\t\t\t\t\t<i class=\"icon-envelope-open \"></i>
\t\t\t\t\t\t\tVoice Files</a>
\t\t\t\t\t\t</li>
\t\t\t\t\t</ul>
\t\t\t\t</li>
\t\t\t\t
\t\t\t\t<li class=\" ";
        // line 74
        if (((isset($context["tab"]) ? $context["tab"] : null) == "agents")) {
            echo "active open";
        }
        echo "\">
\t\t\t\t\t<a href=\"javascript:;\">
\t\t\t\t\t<i class=\"fa fa-users \"></i>
\t\t\t\t\t<span class=\"title\">Agents and Products</span>
\t\t\t\t\t<span class=\"arrow \"></span>
\t\t\t\t\t</a>
\t\t\t\t\t<ul class=\"sub-menu\">
\t\t\t\t\t\t<li class=\"";
        // line 81
        if (((isset($context["page"]) ? $context["page"] : null) == "agents")) {
            echo "active";
        }
        echo "\">
\t\t\t\t\t\t\t<a href=\"/agents\">
\t\t\t\t\t\t\t<i class=\"fa fa-user\"></i>
\t\t\t\t\t\t\tAgents</a>
\t\t\t\t\t\t</li>
\t\t\t\t\t\t<li class=\"";
        // line 86
        if (((isset($context["page"]) ? $context["page"] : null) == "agents_groups")) {
            echo "active";
        }
        echo "\">
\t\t\t\t\t\t\t<a href=\"/agents_groups\">
\t\t\t\t\t\t\t<i class=\"icon-basket\"></i>
\t\t\t\t\t\t\tAgents Groups</a>
\t\t\t\t\t\t</li>
\t\t\t\t\t\t<li class=\"";
        // line 91
        if (((isset($context["page"]) ? $context["page"] : null) == "products")) {
            echo "active";
        }
        echo "\">
\t\t\t\t\t\t\t<a href=\"/products\">
\t\t\t\t\t\t\t<i class=\"icon-tag\"></i>
\t\t\t\t\t\t\tProducts</a>
\t\t\t\t\t\t</li>
\t\t\t\t\t\t<li class=\"";
        // line 96
        if (((isset($context["page"]) ? $context["page"] : null) == "appointments")) {
            echo "active";
        }
        echo "\">
\t\t\t\t\t\t\t<a href=\"/appointments\">
\t\t\t\t\t\t\t<i class=\"icon-handbag\"></i>
\t\t\t\t\t\t\tAppointments</a>
\t\t\t\t\t\t</li>
\t\t\t\t\t</ul>
\t\t\t\t</li>
\t\t\t\t
\t\t\t\t<li class=\" ";
        // line 104
        if (((isset($context["tab"]) ? $context["tab"] : null) == "settings")) {
            echo "active open";
        }
        echo "\">
\t\t\t\t\t<a href=\"javascript:;\">
\t\t\t\t\t<i class=\"icon-basket\"></i>
\t\t\t\t\t<span class=\"title\">Admin Settings</span>
\t\t\t\t\t<span class=\"arrow \"></span>
\t\t\t\t\t</a>
\t\t\t\t\t<ul class=\"sub-menu\">
\t\t\t\t\t\t<li class=\"";
        // line 111
        if (((isset($context["page"]) ? $context["page"] : null) == "logs")) {
            echo "active";
        }
        echo "\">
\t\t\t\t\t\t\t<a href=\"/logs\">
\t\t\t\t\t\t\t<i class=\"icon-home\"></i>
\t\t\t\t\t\t\tAdmin Log</a>
\t\t\t\t\t\t</li>
\t\t\t\t\t\t<li class=\"";
        // line 116
        if (((isset($context["page"]) ? $context["page"] : null) == "calltimes")) {
            echo "active";
        }
        echo "\">
\t\t\t\t\t\t\t<a href=\"/calltimes\">
\t\t\t\t\t\t\t<i class=\"icon-basket\"></i>
\t\t\t\t\t\t\tCall Times</a>
\t\t\t\t\t\t</li>
\t\t\t\t\t\t<li class=\"";
        // line 121
        if (((isset($context["page"]) ? $context["page"] : null) == "carriers")) {
            echo "active";
        }
        echo "\">
\t\t\t\t\t\t\t<a href=\"/carriers\">
\t\t\t\t\t\t\t<i class=\"icon-tag\"></i>
\t\t\t\t\t\t\tCarriers</a>
\t\t\t\t\t\t</li>
\t\t\t\t\t\t<li class=\"";
        // line 126
        if (((isset($context["page"]) ? $context["page"] : null) == "phones")) {
            echo "active";
        }
        echo "\">
\t\t\t\t\t\t\t<a href=\"/phones\">
\t\t\t\t\t\t\t<i class=\"icon-handbag\"></i>
\t\t\t\t\t\t\tPhones</a>
\t\t\t\t\t\t</li>
\t\t\t\t\t\t<li class=\"";
        // line 131
        if (((isset($context["page"]) ? $context["page"] : null) == "servers")) {
            echo "active";
        }
        echo "\">
\t\t\t\t\t\t\t<a href=\"/servers\">
\t\t\t\t\t\t\t<i class=\"icon-handbag\"></i>
\t\t\t\t\t\t\tServers</a>
\t\t\t\t\t\t</li>
\t\t\t\t\t\t<li class=\"";
        // line 136
        if (((isset($context["page"]) ? $context["page"] : null) == "settings")) {
            echo "active";
        }
        echo "\">
\t\t\t\t\t\t\t<a href=\"/settings\">
\t\t\t\t\t\t\t<i class=\"icon-handbag\"></i>
\t\t\t\t\t\t\tSystem Settings</a>
\t\t\t\t\t\t</li>
\t\t\t\t\t\t<li class=\"";
        // line 141
        if (((isset($context["page"]) ? $context["page"] : null) == "usergroups")) {
            echo "active";
        }
        echo "\">
\t\t\t\t\t\t\t<a href=\"/usergroups\">
\t\t\t\t\t\t\t<i class=\"icon-handbag\"></i>
\t\t\t\t\t\t\tUser groups</a>
\t\t\t\t\t\t</li>
\t\t\t\t\t\t<li class=\"";
        // line 146
        if (((isset($context["page"]) ? $context["page"] : null) == "voicemails")) {
            echo "active";
        }
        echo "\">
\t\t\t\t\t\t\t<a href=\"/voicemails\">
\t\t\t\t\t\t\t<i class=\"icon-handbag\"></i>
\t\t\t\t\t\t\tVoicemails</a>
\t\t\t\t\t\t</li>
\t\t\t\t\t</ul>
\t\t\t\t</li>
\t\t\t\t
\t\t\t\t<!-- BEGIN ANGULARJS LINK -->
\t\t\t\t<li class=\" ";
        // line 155
        if (((isset($context["tab"]) ? $context["tab"] : null) == "reports")) {
            echo "active";
        }
        echo "\">
\t\t\t\t\t<a href=\"/reports\" >
\t\t\t\t\t<i class=\"icon-paper-plane\"></i>
\t\t\t\t\t<span class=\"title\">
\t\t\t\t\tReports &amp; Analytics </span>
\t\t\t\t\t</a>
\t\t\t\t</li>

\t\t\t</ul>
\t\t\t<!-- END SIDEBAR MENU -->
\t\t</div>
\t</div>
\t<!-- END SIDEBAR -->";
    }

    public function getTemplateName()
    {
        return "layout-parts/sidebar.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  290 => 155,  276 => 146,  266 => 141,  256 => 136,  246 => 131,  236 => 126,  226 => 121,  216 => 116,  206 => 111,  194 => 104,  181 => 96,  171 => 91,  161 => 86,  151 => 81,  139 => 74,  126 => 66,  116 => 61,  106 => 56,  96 => 51,  86 => 46,  76 => 41,  66 => 36,  53 => 28,  40 => 20,  19 => 1,);
    }
}

<?php

/* layout-parts/header.html */
class __TwigTemplate_344fc5477057f1661a4cb55c4f854362c6d5d1d285755ddb8574ca77f44965d9 extends Twig_Template
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
        echo "<!-- BEGIN HEADER -->
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
\t\t\t\t\t\t";
        // line 29
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["me"]) ? $context["me"] : null), "name", array()), "html", null, true);
        echo " </span>
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
\t<!-- BEGIN CONTAINER -->";
    }

    public function getTemplateName()
    {
        return "layout-parts/header.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  49 => 29,  19 => 1,);
    }
}

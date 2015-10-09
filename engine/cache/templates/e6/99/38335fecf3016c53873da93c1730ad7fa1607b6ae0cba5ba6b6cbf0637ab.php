<?php

/* layout-parts/footer.html */
class __TwigTemplate_e69938335fecf3016c53873da93c1730ad7fa1607b6ae0cba5ba6b6cbf0637ab extends Twig_Template
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
        echo "\t<!-- BEGIN FOOTER -->
\t<div class=\"page-footer\">
\t\t<div class=\"page-footer-inner\">
\t\t\t 2015 &copy; 2Rent
\t\t</div>
\t\t<div class=\"scroll-to-top\">
\t\t\t<i class=\"icon-arrow-up\"></i>
\t\t</div>
\t</div>
\t<!-- END FOOTER -->";
    }

    public function getTemplateName()
    {
        return "layout-parts/footer.html";
    }

    public function getDebugInfo()
    {
        return array (  19 => 1,);
    }
}

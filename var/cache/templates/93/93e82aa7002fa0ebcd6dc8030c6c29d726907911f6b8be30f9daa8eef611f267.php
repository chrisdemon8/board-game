<?php

use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Extension\SandboxExtension;
use Twig\Markup;
use Twig\Sandbox\SecurityError;
use Twig\Sandbox\SecurityNotAllowedTagError;
use Twig\Sandbox\SecurityNotAllowedFilterError;
use Twig\Sandbox\SecurityNotAllowedFunctionError;
use Twig\Source;
use Twig\Template;

/* /question/questions.html.twig */
class __TwigTemplate_e00a4e2938ea97e322b0c006160f3fe432424dd9f4cc993b900f3e89d877e8ac extends Template
{
    private $source;
    private $macros = [];

    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->blocks = [
            'title' => [$this, 'block_title'],
            'css' => [$this, 'block_css'],
            'body' => [$this, 'block_body'],
            'bottom_js' => [$this, 'block_bottom_js'],
        ];
    }

    protected function doGetParent(array $context)
    {
        // line 1
        return "layout.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        $macros = $this->macros;
        $this->parent = $this->loadTemplate("layout.html.twig", "/question/questions.html.twig", 1);
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 3
    public function block_title($context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 4
        echo "\t";
        $this->displayParentBlock("title", $context, $blocks);
        echo "
\t- Accueil
";
    }

    // line 8
    public function block_css($context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 9
        echo "\t<link rel=\"stylesheet\" href=\"assets/css/questions.css\"/>
";
    }

    // line 13
    public function block_body($context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 14
        echo "\t<h1>Liste des questions</h1>


\t<div style=\"overflow-x:auto;\">
\t\t<table id=\"questionsTable\"></table>
\t</div>
\t<button id='addQuestion'></button>

\t<!-- The Modal -->
\t<div
\t\tid=\"myModal\" class=\"modal\">

\t\t<!-- Modal content -->
\t\t<div id=\"modalContent\" class=\"modal-content\">
\t\t</div>

\t</div>

";
    }

    // line 34
    public function block_bottom_js($context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 35
        echo "\t<script type=\"text/javascript\" src=\"assets/js/questions.js\"></script>
";
    }

    public function getTemplateName()
    {
        return "/question/questions.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  100 => 35,  96 => 34,  74 => 14,  70 => 13,  65 => 9,  61 => 8,  53 => 4,  49 => 3,  38 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "/question/questions.html.twig", "C:\\wamp64\\www\\MyProject\\board-game\\templates\\question\\questions.html.twig");
    }
}

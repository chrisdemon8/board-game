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

/* user/inscription.html.twig */
class __TwigTemplate_27c121f531c32aa71f51db44413bf2f65a3c1f63cc90a7c8429127ba7c8fda30 extends Template
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
        $this->parent = $this->loadTemplate("layout.html.twig", "user/inscription.html.twig", 1);
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 3
    public function block_title($context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 4
        echo "\tInscription
";
    }

    // line 7
    public function block_css($context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 8
        echo "\t<link rel=\"stylesheet\" href=\"assets/css/inscription.css\"/>
";
    }

    // line 12
    public function block_body($context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 13
        echo "
\t<div class=\"basicForm\">
\t\t<form action=\"addUser\" method=\"get\">


\t\t\t<div>
\t\t\t\t<label for=\"username\">pseudo :
\t\t\t\t</label>
\t\t\t\t<input type=\"text\" name=\"username\" id=\"username\" required>
\t\t\t</div>

\t\t\t<div>
\t\t\t\t<label for=\"lastname\">Nom de famille :
\t\t\t\t</label>
\t\t\t\t<input type=\"text\" name=\"lastname\" id=\"lastname\" required>
\t\t\t</div>

\t\t\t<div>
\t\t\t\t<label for=\"firstname\">Prénom :
\t\t\t\t</label>
\t\t\t\t<input type=\"text\" name=\"firstname\" id=\"firstname\" required>
\t\t\t</div>

\t\t\t<div>
\t\t\t\t<label for=\"email\">Email :
\t\t\t\t</label>
\t\t\t\t<input type=\"email\" name=\"email\" id=\"email\" required>
\t\t\t</div>

\t\t\t<div>
\t\t\t\t<label for=\"password\">Mot de passe :
\t\t\t\t</label>
\t\t\t\t<input type=\"password\" name=\"password\" id=\"password\" required>
\t\t\t</div>

\t\t\t<div>
\t\t\t\t<label for=\"passwordBis\">Vérification mot de passe :
\t\t\t\t</label>
\t\t\t\t<input type=\"password\" name=\"passwordBis\" id=\"password\" required>
\t\t\t</div>

\t\t\t<div class=\"button\">
\t\t\t\t<input type=\"submit\" value=\"S'inscrire\">
\t\t\t</div>

\t\t</form>
\t</div>


";
    }

    // line 64
    public function block_bottom_js($context, array $blocks = [])
    {
        $macros = $this->macros;
    }

    public function getTemplateName()
    {
        return "user/inscription.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  124 => 64,  71 => 13,  67 => 12,  62 => 8,  58 => 7,  53 => 4,  49 => 3,  38 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "user/inscription.html.twig", "C:\\wamp64\\www\\MyProject\\board-game\\templates\\user\\inscription.html.twig");
    }
}

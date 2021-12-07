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

/* user/connexion.html.twig */
class __TwigTemplate_9577f840c2d5c86b6ded6c4fae18f7db4c77666819cb5e94afba0969b7789ea5 extends Template
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
        $this->parent = $this->loadTemplate("layout.html.twig", "user/connexion.html.twig", 1);
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 3
    public function block_title($context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 4
        echo "\tConnexion
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
\t\t<form action=\"checkUser\" method=\"post\">

\t\t\t<div>
\t\t\t\t<label for=\"email\">Email / Username :
\t\t\t\t</label>
\t\t\t\t<input type=\"text\" name=\"email\" id=\"email\" required>
\t\t\t</div>

\t\t\t<div>
\t\t\t\t<label for=\"password\">Mot de passe :
\t\t\t\t</label>
\t\t\t\t<input type=\"password\" name=\"password\" id=\"password\" required>
\t\t\t</div>

\t\t\t<div>
\t\t\t\t<input type=\"submit\" value=\"S'identifier\">
\t\t\t</div>

\t\t</form>

\t\t<p>";
        // line 35
        echo twig_escape_filter($this->env, ($context["error"] ?? null), "html", null, true);
        echo "</p>
\t</div>

";
    }

    // line 40
    public function block_bottom_js($context, array $blocks = [])
    {
        $macros = $this->macros;
    }

    public function getTemplateName()
    {
        return "user/connexion.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  103 => 40,  95 => 35,  71 => 13,  67 => 12,  62 => 8,  58 => 7,  53 => 4,  49 => 3,  38 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "user/connexion.html.twig", "C:\\wamp64\\www\\MyProject\\board-game\\templates\\user\\connexion.html.twig");
    }
}

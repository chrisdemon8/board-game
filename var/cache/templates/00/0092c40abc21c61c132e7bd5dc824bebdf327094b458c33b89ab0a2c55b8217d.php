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

/* /user/admin.html.twig */
class __TwigTemplate_b4df195342c227701954503229f17dc3bfd7e7c29fdce3e59ff9ba4f176c246b extends Template
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
        $this->parent = $this->loadTemplate("layout.html.twig", "/user/admin.html.twig", 1);
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 3
    public function block_title($context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 4
        echo "\tProfil
";
    }

    // line 7
    public function block_css($context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 8
        echo "\t<link rel=\"stylesheet\" href=\"/assets/css/basicpage.css\"/>
";
    }

    // line 12
    public function block_body($context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 13
        echo "

\t";
        // line 15
        if (twig_get_attribute($this->env, $this->source, ($context["session"] ?? null), "user", [], "any", true, true, false, 15)) {
            // line 16
            echo "
\t\t";
            // line 17
            if ((twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["session"] ?? null), "user", [], "any", false, false, false, 17), "role", [], "any", false, false, false, 17) == 1)) {
                // line 18
                echo "\t\t\t<div class=\"container\">
\t\t\t\t<button class=\"countQuestion\" onclick=\"location.href='/allQuestions'\">Nombre de questions :
\t\t\t\t\t";
                // line 20
                echo twig_escape_filter($this->env, ($context["questions"] ?? null), "html", null, true);
                echo "</button>
\t\t\t\t<button class=\"countUser\" onclick=\"location.href='/allUsers'\">Nombre d'utilisateurs :
\t\t\t\t\t";
                // line 22
                echo twig_escape_filter($this->env, ($context["users"] ?? null), "html", null, true);
                echo "</button>
\t\t\t\t<button  >Jouer</button>

\t\t\t</div>
\t\t";
            }
            // line 27
            echo "\t";
        }
        // line 28
        echo "
";
    }

    public function getTemplateName()
    {
        return "/user/admin.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  101 => 28,  98 => 27,  90 => 22,  85 => 20,  81 => 18,  79 => 17,  76 => 16,  74 => 15,  70 => 13,  66 => 12,  61 => 8,  57 => 7,  52 => 4,  48 => 3,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "/user/admin.html.twig", "C:\\wamp64\\www\\MyProject\\board-game\\templates\\user\\admin.html.twig");
    }
}

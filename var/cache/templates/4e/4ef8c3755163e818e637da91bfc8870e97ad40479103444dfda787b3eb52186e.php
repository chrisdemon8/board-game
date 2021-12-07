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

/* layout.html.twig */
class __TwigTemplate_2c7811e8638b024721db1092e9dd57cdbb8ee8aede2e652dc61e6112c3473d6a extends Template
{
    private $source;
    private $macros = [];

    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->parent = false;

        $this->blocks = [
            'css' => [$this, 'block_css'],
            'js' => [$this, 'block_js'],
            'body' => [$this, 'block_body'],
            'bottom_js' => [$this, 'block_bottom_js'],
        ];
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 1
        echo "<!DOCTYPE html>
<html lang=\"fr\">
\t<head>
\t\t<meta charset=\"UTF-8\">
\t\t<meta http-equiv=\"X-UA-Compatible\" content=\"IE=edge\">
\t\t<meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\">
\t\t<title>Document</title>
\t\t<link rel=\"stylesheet\" href=\"assets/css/app.css\"/> ";
        // line 8
        $this->displayBlock('css', $context, $blocks);
        $this->displayBlock('js', $context, $blocks);
        // line 9
        echo "\t\t</head>
\t\t<body>
\t\t\t<div class=\"nav\" id=\"nav\">
\t\t\t\t<a href=\"/\" class=\"active\">Accueil</a>
\t\t\t\t<a href=\"/allUsers\">Utilisateurs</a>
\t\t\t\t<a href=\"/allQuestions\">Questions</a>
\t\t\t\t";
        // line 15
        if (twig_get_attribute($this->env, $this->source, ($context["session"] ?? null), "user", [], "any", true, true, false, 15)) {
            // line 16
            echo "\t\t\t\t\t<a href=\"/profil\">Profil</a>
\t\t\t\t\t<a href=\"/deconnexion\">Déconnexion</a>
\t\t\t\t";
        }
        // line 19
        echo "\t\t\t\t";
        if ( !twig_get_attribute($this->env, $this->source, ($context["session"] ?? null), "user", [], "any", true, true, false, 19)) {
            // line 20
            echo "\t\t\t\t\t<a href=\"/connexion\">Connexion</a>
\t\t\t\t\t<a href=\"/inscription\">Inscription</a>
\t\t\t\t";
        }
        // line 23
        echo "\t\t\t\t<a href=\"javascript:void(0);\" class=\"icon\" onclick=\"functionMenu()\">
\t\t\t\t\t<img class=\"burgerMenu\" src=\"assets/css/menu.png\" alt=\"menu\">
\t\t\t\t</a>
\t\t\t</div>
 

\t\t\t";
        // line 29
        $this->displayBlock('body', $context, $blocks);
        // line 30
        echo "\t\t\t";
        $this->displayBlock('bottom_js', $context, $blocks);
        // line 31
        echo "\t\t\t<script type=\"text/javascript\" src=\"assets/js/app.js\"></script>
\t\t</body>
\t</html>
";
    }

    // line 8
    public function block_css($context, array $blocks = [])
    {
        $macros = $this->macros;
    }

    public function block_js($context, array $blocks = [])
    {
        $macros = $this->macros;
    }

    // line 29
    public function block_body($context, array $blocks = [])
    {
        $macros = $this->macros;
    }

    // line 30
    public function block_bottom_js($context, array $blocks = [])
    {
        $macros = $this->macros;
    }

    public function getTemplateName()
    {
        return "layout.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  113 => 30,  107 => 29,  96 => 8,  89 => 31,  86 => 30,  84 => 29,  76 => 23,  71 => 20,  68 => 19,  63 => 16,  61 => 15,  53 => 9,  50 => 8,  41 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "layout.html.twig", "C:\\wamp64\\www\\MyProject\\board-game\\templates\\layout.html.twig");
    }
}

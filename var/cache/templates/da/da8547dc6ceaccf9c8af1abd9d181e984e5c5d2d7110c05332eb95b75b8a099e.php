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

/* user/profil.html.twig */
class __TwigTemplate_a8baec8137a3269613c1f26eb0f5be21e1d829560855c15e0f4710782cab8a43 extends Template
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
        $this->parent = $this->loadTemplate("layout.html.twig", "user/profil.html.twig", 1);
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
        echo "\t<link rel=\"stylesheet\" href=\"assets/css/inscription.css\"/>
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

\t\t<div class=\"basicForm\">
\t\t\t<form action=\"updateUser\" method=\"post\">


\t\t\t\t 

\t\t\t\t<div>
\t\t\t\t\t<label for=\"lastname\">Nom de famille :
\t\t\t\t\t</label>
\t\t\t\t\t<input type=\"text\" name=\"lastname\" id=\"lastname\" value=";
            // line 27
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["session"] ?? null), "user", [], "any", false, false, false, 27), "lastname", [], "any", false, false, false, 27), "html", null, true);
            echo " required>
\t\t\t\t</div>

\t\t\t\t<div>
\t\t\t\t\t<label for=\"firstname\">Prénom :
\t\t\t\t\t</label>
\t\t\t\t\t<input type=\"text\" name=\"firstname\" id=\"firstname\" value=";
            // line 33
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["session"] ?? null), "user", [], "any", false, false, false, 33), "firstname", [], "any", false, false, false, 33), "html", null, true);
            echo " required>
\t\t\t\t</div>

\t\t\t\t<div>
\t\t\t\t\t<label for=\"email\">Email :
\t\t\t\t\t</label>
\t\t\t\t\t<input type=\"email\" name=\"email\" id=\"email\" value=";
            // line 39
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["session"] ?? null), "user", [], "any", false, false, false, 39), "email", [], "any", false, false, false, 39), "html", null, true);
            echo " required>
\t\t\t\t</div>


\t\t\t\t<div>
\t\t\t\t\t<input type=\"checkbox\" id=\"changePassword\" name=\"changePassword\" onclick=\"checkChangePassword()\">
\t\t\t\t\t<label for=\"changePassword\">Changer votre mot de passe</label>
\t\t\t\t</div>

\t\t\t\t<div class=\"changePasswordArea\" id=\"changePasswordArea\">
\t\t\t\t\t<div>
\t\t\t\t\t\t<label for=\"password\">Nouveau mot de passe :
\t\t\t\t\t\t</label>
\t\t\t\t\t\t<input type=\"password\" name=\"password\" id=\"password\">
\t\t\t\t\t</div>

\t\t\t\t\t<div>
\t\t\t\t\t\t<label for=\"passwordNewBis\">Vérification nouveau mot de passe :
\t\t\t\t\t\t</label>
\t\t\t\t\t\t<input type=\"password\" name=\"passwordNewBis\" id=\"passwordNewBis\">
\t\t\t\t\t</div>
\t\t\t\t</div>

\t\t\t\t<div>
\t\t\t\t\t<label for=\"passwordCheck\">Tapez votre mot de passe pour actualiser vos données :
\t\t\t\t\t</label>
\t\t\t\t\t<input type=\"password\" name=\"passwordCheck\" id=\"passwordCheck\" required>
\t\t\t\t</div>


\t\t\t\t<div class=\"button\">
\t\t\t\t\t<input type=\"submit\" value=\"Mettre à jour\">
\t\t\t\t</div>

\t\t\t</form>
\t\t</div>
\t";
        }
        // line 76
        echo "
";
    }

    // line 80
    public function block_bottom_js($context, array $blocks = [])
    {
        $macros = $this->macros;
        echo "<script type=\"text/javascript\" src=\"assets/js/formulaire.js\"></script>";
    }

    public function getTemplateName()
    {
        return "user/profil.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  153 => 80,  148 => 76,  108 => 39,  99 => 33,  90 => 27,  77 => 16,  75 => 15,  71 => 13,  67 => 12,  62 => 8,  58 => 7,  53 => 4,  49 => 3,  38 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "user/profil.html.twig", "C:\\wamp64\\www\\MyProject\\board-game\\templates\\user\\profil.html.twig");
    }
}

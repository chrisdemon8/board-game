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

/* /user/users.html.twig */
class __TwigTemplate_0f0d7850c1a91e8cfdb70f2497331bb31ad7f9bda2d8c935e31f0bbd357f369e extends Template
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
        $this->parent = $this->loadTemplate("layout.html.twig", "/user/users.html.twig", 1);
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
        echo "\t<link rel=\"stylesheet\" href=\"assets/css/users.css\"/>
";
    }

    // line 13
    public function block_body($context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 14
        echo " 

\t<h1>Liste des utilisateur</h1>


\t<div style=\"overflow-x:auto;\">
\t\t<table>
\t\t\t<tr>
\t\t\t\t<th>Username</th>
\t\t\t\t<th>Email</th>
\t\t\t\t<th>Role</th>
\t\t\t\t<th>Firstname</th>
\t\t\t\t<th>Lastname</th>
\t\t\t\t<th>Creation date</th>
\t\t\t\t";
        // line 28
        if ((twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["session"] ?? null), "user", [], "any", false, false, false, 28), "role", [], "any", false, false, false, 28) == 1)) {
            // line 29
            echo "\t\t\t\t\t<th>Modifier</th>
\t\t\t\t\t<th>Supprimer</th>
\t\t\t\t";
        }
        // line 32
        echo "\t\t\t</tr>


\t\t\t";
        // line 35
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["users"] ?? null));
        $context['_iterated'] = false;
        foreach ($context['_seq'] as $context["_key"] => $context["user"]) {
            // line 36
            echo "
\t\t\t\t<tr id='";
            // line 37
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["user"], "getIdUser", [], "method", false, false, false, 37), "html", null, true);
            echo "'>
\t\t\t\t\t<td id=\"username\">";
            // line 38
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["user"], "getUsername", [], "method", false, false, false, 38), "html", null, true);
            echo "</td>
\t\t\t\t\t<td id=\"email\">";
            // line 39
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["user"], "getEmail", [], "method", false, false, false, 39), "html", null, true);
            echo "</td>
\t\t\t\t\t<td id=\"role\">";
            // line 40
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["user"], "getRole", [], "method", false, false, false, 40), "html", null, true);
            echo "</td>
\t\t\t\t\t<td id=\"firstName\">";
            // line 41
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["user"], "getFirstname", [], "method", false, false, false, 41), "html", null, true);
            echo "</td>
\t\t\t\t\t<td id=\"lastName\">";
            // line 42
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["user"], "getLastname", [], "method", false, false, false, 42), "html", null, true);
            echo "</td>
\t\t\t\t\t<td id=\"createdAt\">";
            // line 43
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, $context["user"], "getCreatedAt", [], "method", false, false, false, 43), "format", [0 => "Y-m-d H:i:s"], "method", false, false, false, 43), "html", null, true);
            echo "</td>
\t\t\t\t\t";
            // line 44
            if ((twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["session"] ?? null), "user", [], "any", false, false, false, 44), "role", [], "any", false, false, false, 44) == 1)) {
                // line 45
                echo "\t\t\t\t\t\t<td>
\t\t\t\t\t\t\t<button class=\"modify\" id='";
                // line 46
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["user"], "getIdUser", [], "method", false, false, false, 46), "html", null, true);
                echo "'>Modifier</button>
\t\t\t\t\t\t</td>
\t\t\t\t\t\t<td>
\t\t\t\t\t\t\t<button class=\"delete\" id='";
                // line 49
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["user"], "getIdUser", [], "method", false, false, false, 49), "html", null, true);
                echo "'>Supprimer</button>
\t\t\t\t\t\t</td>
\t\t\t\t\t";
            }
            // line 52
            echo "\t\t\t\t</tr>

\t\t\t";
            $context['_iterated'] = true;
        }
        if (!$context['_iterated']) {
            // line 55
            echo "\t\t\t\t<tr>
\t\t\t\t\t<td>Aucun utilisateur</td>
\t\t\t\t\t<td></td>
\t\t\t\t\t<td></td>
\t\t\t\t\t<td></td>
\t\t\t\t\t<td></td>
\t\t\t\t\t<td></td>
\t\t\t\t</tr>
\t\t\t";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['user'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 64
        echo "\t\t</table>
\t</div>
\t
";
    }

    // line 70
    public function block_bottom_js($context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 71
        echo "\t<script type=\"text/javascript\" src=\"assets/js/users.js\"></script>
";
    }

    public function getTemplateName()
    {
        return "/user/users.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  187 => 71,  183 => 70,  176 => 64,  162 => 55,  155 => 52,  149 => 49,  143 => 46,  140 => 45,  138 => 44,  134 => 43,  130 => 42,  126 => 41,  122 => 40,  118 => 39,  114 => 38,  110 => 37,  107 => 36,  102 => 35,  97 => 32,  92 => 29,  90 => 28,  74 => 14,  70 => 13,  65 => 9,  61 => 8,  53 => 4,  49 => 3,  38 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "/user/users.html.twig", "C:\\wamp64\\www\\MyProject\\board-game\\templates\\user\\users.html.twig");
    }
}

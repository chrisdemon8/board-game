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

/* /user/user.html.twig */
class __TwigTemplate_665c82d85dd825b32c4415b034a9dfaf71f33cbc12771fc7760911d21e787739 extends Template
{
    private $source;
    private $macros = [];

    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->blocks = [
            'title' => [$this, 'block_title'],
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
        $this->parent = $this->loadTemplate("layout.html.twig", "/user/user.html.twig", 1);
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 3
    public function block_title($context, array $blocks = [])
    {
        $macros = $this->macros;
        echo " ";
        $this->displayParentBlock("title", $context, $blocks);
        echo " - Accueil ";
    }

    // line 5
    public function block_body($context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 6
        echo "<h1>";
        echo twig_escape_filter($this->env, ($context["username"] ?? null), "html", null, true);
        echo "</h1>

<ul>
        <li>email : ";
        // line 9
        echo twig_escape_filter($this->env, ($context["email"] ?? null), "html", null, true);
        echo "</li>
        <li>role : ";
        // line 10
        echo twig_escape_filter($this->env, ($context["role"] ?? null), "html", null, true);
        echo "</li>
        <li>firstname : ";
        // line 11
        echo twig_escape_filter($this->env, ($context["firstname"] ?? null), "html", null, true);
        echo "</li>
        <li>lastname : ";
        // line 12
        echo twig_escape_filter($this->env, ($context["lastname"] ?? null), "html", null, true);
        echo "</li>
        <li>createdAt : ";
        // line 13
        echo twig_escape_filter($this->env, ($context["createdAt"] ?? null), "html", null, true);
        echo "</li>
</ul>

";
    }

    // line 18
    public function block_bottom_js($context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 19
        echo "       
";
    }

    public function getTemplateName()
    {
        return "/user/user.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  96 => 19,  92 => 18,  84 => 13,  80 => 12,  76 => 11,  72 => 10,  68 => 9,  61 => 6,  57 => 5,  48 => 3,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "/user/user.html.twig", "C:\\wamp64\\www\\MyProject\\board-game\\templates\\user\\user.html.twig");
    }
}

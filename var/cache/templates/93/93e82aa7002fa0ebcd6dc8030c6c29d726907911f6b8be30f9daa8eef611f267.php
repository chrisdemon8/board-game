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
        echo " ";
        $this->displayParentBlock("title", $context, $blocks);
        echo " - Accueil ";
    }

    // line 5
    public function block_body($context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 6
        echo "<h1>Liste des questions</h1>

        ";
        // line 8
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["questions"] ?? null));
        $context['_iterated'] = false;
        foreach ($context['_seq'] as $context["_key"] => $context["question"]) {
            // line 9
            echo "    <ul>

          <li>Label : ";
            // line 11
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["question"], "getLabelQuestion", [], "method", false, false, false, 11), "html", null, true);
            echo "</li>
          <li>Level : ";
            // line 12
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["question"], "getLevel", [], "method", false, false, false, 12), "html", null, true);
            echo "</li>
          <li>Réponse possible :</li>
                     ";
            // line 14
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(twig_get_attribute($this->env, $this->source, $context["question"], "getAnswers", [], "method", false, false, false, 14));
            $context['_iterated'] = false;
            foreach ($context['_seq'] as $context["_key"] => $context["answer"]) {
                // line 15
                echo "                     <ul>
                        <li>";
                // line 16
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["answer"], "getLabelAnswer", [], "method", false, false, false, 16), "html", null, true);
                echo "</li>
                     </ul>
                     ";
                $context['_iterated'] = true;
            }
            if (!$context['_iterated']) {
                // line 19
                echo "                     <ul>
                        <li>Aucune réponse</li>
                     </ul>

                    ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['answer'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 24
            echo "    </ul>
        ";
            $context['_iterated'] = true;
        }
        if (!$context['_iterated']) {
            // line 26
            echo "                <li>Aucun users</li>
        ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['question'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 28
        echo "
";
    }

    // line 31
    public function block_bottom_js($context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 32
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
        return array (  131 => 32,  127 => 31,  122 => 28,  115 => 26,  109 => 24,  99 => 19,  91 => 16,  88 => 15,  83 => 14,  78 => 12,  74 => 11,  70 => 9,  65 => 8,  61 => 6,  57 => 5,  48 => 3,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "/question/questions.html.twig", "C:\\wamp64\\www\\MyProject\\board-game\\templates\\question\\questions.html.twig");
    }
}

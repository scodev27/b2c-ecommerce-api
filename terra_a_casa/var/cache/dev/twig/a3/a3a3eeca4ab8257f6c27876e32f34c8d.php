<?php

use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Extension\CoreExtension;
use Twig\Extension\SandboxExtension;
use Twig\Markup;
use Twig\Sandbox\SecurityError;
use Twig\Sandbox\SecurityNotAllowedTagError;
use Twig\Sandbox\SecurityNotAllowedFilterError;
use Twig\Sandbox\SecurityNotAllowedFunctionError;
use Twig\Source;
use Twig\Template;
use Twig\TemplateWrapper;

/* checkout/index.html.twig */
class __TwigTemplate_c79b5c0726635c3fe3290e5598e90c83 extends Template
{
    private Source $source;
    /**
     * @var array<string, Template>
     */
    private array $macros = [];

    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->blocks = [
            'title' => [$this, 'block_title'],
            'body' => [$this, 'block_body'],
        ];
    }

    protected function doGetParent(array $context): bool|string|Template|TemplateWrapper
    {
        // line 1
        return "base.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "checkout/index.html.twig"));

        $this->parent = $this->load("base.html.twig", 1);
        yield from $this->parent->unwrap()->yield($context, array_merge($this->blocks, $blocks));
        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

    }

    // line 3
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_title(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "title"));

        yield "Checkout - Terra a Casa";
        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        yield from [];
    }

    // line 5
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_body(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "body"));

        // line 6
        yield "    <nav class=\"navbar navbar-dark bg-success mb-4 shadow-sm\">
        <div class=\"container\">
            <a class=\"navbar-brand\" href=\"";
        // line 8
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_home");
        yield "\">🌱 Terra a Casa</a>
        </div>
    </nav>

    <div class=\"container mt-5\">
        <div class=\"row justify-content-center\">
            <div class=\"col-md-6\">
                <div class=\"card shadow-sm\">
                    <div class=\"card-body p-4\">
                        <h2 class=\"mb-4\">Dades de contacte</h2>
                        <p class=\"text-muted\">Introdueix el teu correu electrònic per finalitzar la comanda. No cal registrar-se!</p>

                        <form method=\"POST\" action=\"";
        // line 20
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_checkout");
        yield "\">
                            <div class=\"mb-4\">
                                <label for=\"client_email\" class=\"form-label fw-bold\">Correu electrònic</label>
                                <input type=\"email\" name=\"client_email\" id=\"client_email\" class=\"form-control form-control-lg\" required placeholder=\"tu@email.cat\">
                            </div>

                            <div class=\"d-grid gap-2\">
                                <button type=\"submit\" class=\"btn btn-success btn-lg fw-bold\">Confirmar i Finalitzar Comanda 🚀</button>
                                <a href=\"";
        // line 28
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_cart");
        yield "\" class=\"btn btn-link text-muted\">← Tornar a la cistella</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
";
        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        yield from [];
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName(): string
    {
        return "checkout/index.html.twig";
    }

    /**
     * @codeCoverageIgnore
     */
    public function isTraitable(): bool
    {
        return false;
    }

    /**
     * @codeCoverageIgnore
     */
    public function getDebugInfo(): array
    {
        return array (  115 => 28,  104 => 20,  89 => 8,  85 => 6,  75 => 5,  58 => 3,  41 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("{% extends 'base.html.twig' %}

{% block title %}Checkout - Terra a Casa{% endblock %}

{% block body %}
    <nav class=\"navbar navbar-dark bg-success mb-4 shadow-sm\">
        <div class=\"container\">
            <a class=\"navbar-brand\" href=\"{{ path('app_home') }}\">🌱 Terra a Casa</a>
        </div>
    </nav>

    <div class=\"container mt-5\">
        <div class=\"row justify-content-center\">
            <div class=\"col-md-6\">
                <div class=\"card shadow-sm\">
                    <div class=\"card-body p-4\">
                        <h2 class=\"mb-4\">Dades de contacte</h2>
                        <p class=\"text-muted\">Introdueix el teu correu electrònic per finalitzar la comanda. No cal registrar-se!</p>

                        <form method=\"POST\" action=\"{{ path('app_checkout') }}\">
                            <div class=\"mb-4\">
                                <label for=\"client_email\" class=\"form-label fw-bold\">Correu electrònic</label>
                                <input type=\"email\" name=\"client_email\" id=\"client_email\" class=\"form-control form-control-lg\" required placeholder=\"tu@email.cat\">
                            </div>

                            <div class=\"d-grid gap-2\">
                                <button type=\"submit\" class=\"btn btn-success btn-lg fw-bold\">Confirmar i Finalitzar Comanda 🚀</button>
                                <a href=\"{{ path('app_cart') }}\" class=\"btn btn-link text-muted\">← Tornar a la cistella</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
{% endblock %}
", "checkout/index.html.twig", "C:\\Users\\User\\Desktop\\Prac2_SCE\\terra_a_casa\\templates\\checkout\\index.html.twig");
    }
}

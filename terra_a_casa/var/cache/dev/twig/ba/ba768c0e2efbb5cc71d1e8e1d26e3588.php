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

/* admin/index.html.twig */
class __TwigTemplate_29b34bc0d5faececa7d3daaf129de101 extends Template
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
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "admin/index.html.twig"));

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

        yield "Backoffice - Terra a Casa";
        
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
        yield "    <div class=\"container mt-5\">
        <div class=\"d-flex justify-content-between align-items-center mb-4\">
            <h1>📦 Panell de Comandes</h1>
            <div class=\"d-flex gap-2\">
                <a href=\"http://localhost:5500\" target=\"_blank\" class=\"btn btn-outline-success\">Veure Botiga</a>
                <a href=\"";
        // line 11
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_logout");
        yield "\" class=\"btn btn-outline-danger\">Tancar Sessió</a>
            </div>
        </div>

        ";
        // line 15
        $context['_parent'] = $context;
        $context['_seq'] = CoreExtension::ensureTraversable(CoreExtension::getAttribute($this->env, $this->source, (isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new RuntimeError('Variable "app" does not exist.', 15, $this->source); })()), "flashes", ["success"], "method", false, false, false, 15));
        foreach ($context['_seq'] as $context["_key"] => $context["message"]) {
            // line 16
            yield "            <div class=\"alert alert-success alert-dismissible fade show fw-bold shadow-sm\">
                ";
            // line 17
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($context["message"], "html", null, true);
            yield "
                <button type=\"button\" class=\"btn-close\" data-bs-dismiss=\"alert\"></button>
            </div>
        ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_key'], $context['message'], $context['_parent']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 21
        yield "
        <div class=\"card shadow-sm\">
            <div class=\"card-body\">
                <table class=\"table table-hover align-middle\">
                    <thead class=\"table-dark\">
                    <tr>
                        <th>ID Comanda</th>
                        <th>Email Client</th>
                        <th>Data</th>
                        <th>Total</th>
                        <th>Estat</th>
                        <th>Acció</th>
                    </tr>
                    </thead>
                    <tbody>
                    ";
        // line 36
        $context['_parent'] = $context;
        $context['_seq'] = CoreExtension::ensureTraversable((isset($context["orders"]) || array_key_exists("orders", $context) ? $context["orders"] : (function () { throw new RuntimeError('Variable "orders" does not exist.', 36, $this->source); })()));
        $context['_iterated'] = false;
        foreach ($context['_seq'] as $context["_key"] => $context["order"]) {
            // line 37
            yield "                        <tr>
                            <td><small class=\"text-muted\">";
            // line 38
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["order"], "id", [], "any", false, false, false, 38), "html", null, true);
            yield "</small></td>
                            <td><strong>";
            // line 39
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["order"], "clientEmail", [], "any", false, false, false, 39), "html", null, true);
            yield "</strong></td>
                            <td>";
            // line 40
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Twig\Extension\CoreExtension']->formatDate(CoreExtension::getAttribute($this->env, $this->source, $context["order"], "createdAt", [], "any", false, false, false, 40), "d/m/Y H:i"), "html", null, true);
            yield "</td>
                            <td>";
            // line 41
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Twig\Extension\CoreExtension']->formatNumber((CoreExtension::getAttribute($this->env, $this->source, $context["order"], "totalPrice", [], "any", false, false, false, 41) / 100), 2, ",", "."), "html", null, true);
            yield " €</td>
                            <td>
                                ";
            // line 43
            if ((CoreExtension::getAttribute($this->env, $this->source, $context["order"], "status", [], "any", false, false, false, 43) == "pending")) {
                // line 44
                yield "                                    <span class=\"badge bg-warning text-dark\">Pendent</span>
                                ";
            } elseif ((CoreExtension::getAttribute($this->env, $this->source,             // line 45
$context["order"], "status", [], "any", false, false, false, 45) == "processing")) {
                // line 46
                yield "                                    <span class=\"badge bg-info text-dark\">En preparació</span>
                                ";
            } elseif ((CoreExtension::getAttribute($this->env, $this->source,             // line 47
$context["order"], "status", [], "any", false, false, false, 47) == "delivering")) {
                // line 48
                yield "                                    <span class=\"badge bg-primary\">En repartiment</span>
                                ";
            } else {
                // line 50
                yield "                                    <span class=\"badge bg-success\">Lliurat</span>
                                ";
            }
            // line 52
            yield "                            </td>
                            <td>
                                <div class=\"dropdown\">
                                    <button class=\"btn btn-sm btn-secondary dropdown-toggle\" type=\"button\" data-bs-toggle=\"dropdown\">
                                        Canviar Estat
                                    </button>
                                    <ul class=\"dropdown-menu\">
                                        <li><a class=\"dropdown-item\" href=\"";
            // line 59
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("admin_order_status", ["id" => CoreExtension::getAttribute($this->env, $this->source, $context["order"], "id", [], "any", false, false, false, 59), "status" => "pending"]), "html", null, true);
            yield "\">Pendent</a></li>
                                        <li><a class=\"dropdown-item\" href=\"";
            // line 60
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("admin_order_status", ["id" => CoreExtension::getAttribute($this->env, $this->source, $context["order"], "id", [], "any", false, false, false, 60), "status" => "processing"]), "html", null, true);
            yield "\">En preparació</a></li>
                                        <li><a class=\"dropdown-item\" href=\"";
            // line 61
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("admin_order_status", ["id" => CoreExtension::getAttribute($this->env, $this->source, $context["order"], "id", [], "any", false, false, false, 61), "status" => "delivering"]), "html", null, true);
            yield "\">En repartiment</a></li>
                                        <li><hr class=\"dropdown-divider\"></li>
                                        <li><a class=\"dropdown-item text-success fw-bold\" href=\"";
            // line 63
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("admin_order_status", ["id" => CoreExtension::getAttribute($this->env, $this->source, $context["order"], "id", [], "any", false, false, false, 63), "status" => "completed"]), "html", null, true);
            yield "\">Lliurat</a></li>
                                    </ul>
                                </div>
                            </td>
                        </tr>
                    ";
            $context['_iterated'] = true;
        }
        // line 68
        if (!$context['_iterated']) {
            // line 69
            yield "                        <tr>
                            <td colspan=\"6\" class=\"text-center py-4 text-muted\">Encara no hi ha cap comanda registrada.</td>
                        </tr>
                    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_key'], $context['order'], $context['_parent'], $context['_iterated']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 73
        yield "                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script src=\"https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js\"></script>
";
        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        yield from [];
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName(): string
    {
        return "admin/index.html.twig";
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
        return array (  221 => 73,  212 => 69,  210 => 68,  200 => 63,  195 => 61,  191 => 60,  187 => 59,  178 => 52,  174 => 50,  170 => 48,  168 => 47,  165 => 46,  163 => 45,  160 => 44,  158 => 43,  153 => 41,  149 => 40,  145 => 39,  141 => 38,  138 => 37,  133 => 36,  116 => 21,  106 => 17,  103 => 16,  99 => 15,  92 => 11,  85 => 6,  75 => 5,  58 => 3,  41 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("{% extends 'base.html.twig' %}

{% block title %}Backoffice - Terra a Casa{% endblock %}

{% block body %}
    <div class=\"container mt-5\">
        <div class=\"d-flex justify-content-between align-items-center mb-4\">
            <h1>📦 Panell de Comandes</h1>
            <div class=\"d-flex gap-2\">
                <a href=\"http://localhost:5500\" target=\"_blank\" class=\"btn btn-outline-success\">Veure Botiga</a>
                <a href=\"{{ path('app_logout') }}\" class=\"btn btn-outline-danger\">Tancar Sessió</a>
            </div>
        </div>

        {% for message in app.flashes('success') %}
            <div class=\"alert alert-success alert-dismissible fade show fw-bold shadow-sm\">
                {{ message }}
                <button type=\"button\" class=\"btn-close\" data-bs-dismiss=\"alert\"></button>
            </div>
        {% endfor %}

        <div class=\"card shadow-sm\">
            <div class=\"card-body\">
                <table class=\"table table-hover align-middle\">
                    <thead class=\"table-dark\">
                    <tr>
                        <th>ID Comanda</th>
                        <th>Email Client</th>
                        <th>Data</th>
                        <th>Total</th>
                        <th>Estat</th>
                        <th>Acció</th>
                    </tr>
                    </thead>
                    <tbody>
                    {% for order in orders %}
                        <tr>
                            <td><small class=\"text-muted\">{{ order.id }}</small></td>
                            <td><strong>{{ order.clientEmail }}</strong></td>
                            <td>{{ order.createdAt|date('d/m/Y H:i') }}</td>
                            <td>{{ (order.totalPrice / 100)|number_format(2, ',', '.') }} €</td>
                            <td>
                                {% if order.status == 'pending' %}
                                    <span class=\"badge bg-warning text-dark\">Pendent</span>
                                {% elseif order.status == 'processing' %}
                                    <span class=\"badge bg-info text-dark\">En preparació</span>
                                {% elseif order.status == 'delivering' %}
                                    <span class=\"badge bg-primary\">En repartiment</span>
                                {% else %}
                                    <span class=\"badge bg-success\">Lliurat</span>
                                {% endif %}
                            </td>
                            <td>
                                <div class=\"dropdown\">
                                    <button class=\"btn btn-sm btn-secondary dropdown-toggle\" type=\"button\" data-bs-toggle=\"dropdown\">
                                        Canviar Estat
                                    </button>
                                    <ul class=\"dropdown-menu\">
                                        <li><a class=\"dropdown-item\" href=\"{{ path('admin_order_status', {'id': order.id, 'status': 'pending'}) }}\">Pendent</a></li>
                                        <li><a class=\"dropdown-item\" href=\"{{ path('admin_order_status', {'id': order.id, 'status': 'processing'}) }}\">En preparació</a></li>
                                        <li><a class=\"dropdown-item\" href=\"{{ path('admin_order_status', {'id': order.id, 'status': 'delivering'}) }}\">En repartiment</a></li>
                                        <li><hr class=\"dropdown-divider\"></li>
                                        <li><a class=\"dropdown-item text-success fw-bold\" href=\"{{ path('admin_order_status', {'id': order.id, 'status': 'completed'}) }}\">Lliurat</a></li>
                                    </ul>
                                </div>
                            </td>
                        </tr>
                    {% else %}
                        <tr>
                            <td colspan=\"6\" class=\"text-center py-4 text-muted\">Encara no hi ha cap comanda registrada.</td>
                        </tr>
                    {% endfor %}
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script src=\"https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js\"></script>
{% endblock %}
", "admin/index.html.twig", "C:\\Users\\User\\Desktop\\Prac2_SCE\\terra_a_casa\\templates\\admin\\index.html.twig");
    }
}

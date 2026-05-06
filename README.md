# Terra a Casa
Aquest projecte és el desenvolupament de l'assignatura Sistemes de Comerç Electrònic. És una aplicació web B2C construïda amb **Symfony** que posa en contacte pagesos amb clients finals per a la venda de capses de verdura fresca.

## 🚀 Desplegament i Ports

Per executar aquest projecte correctament, calen dos servidors funcionant de forma simultània:

1. **Backend (Symfony + Base de dades):**
   - Executar: `symfony server:start`
   - Port: `http://localhost:8000`
   - L'API respondrà sota `/api` i el Backoffice d'administració està a `/admin`.

2. **Frontend (Botiga per als clients):**
   - Executar mitjançant Live Server (VS Code) o similar.
   - Port: `http://localhost:5500`
   - Aquesta és la interfície principal on els usuaris fan les compres.

## 📦 Manual de Desplegament

A continuació es detallen les comandes pas a pas per posar en marxa el projecte en un entorn local:

**1. Descarregar dependències:**
```bash
composer install
```

**2. Configurar l'entorn i Base de Dades:**
Crea un fitxer `.env.local` a l'arrel del projecte. Configura la connexió a la base de dades (ajusta la versió de MariaDB/MySQL segons el teu entorn per evitar problemes amb el Messenger) i afegeix la clau de Stripe:
```env
DATABASE_URL="mysql://root:@127.0.0.1:3306/terra_a_casa?serverVersion=mariadb-10.4.0&charset=utf8mb4"
STRIPE_SECRET_KEY="sk_test_POSAR_CLAU_STRIPE"
```

**3. Crear la Base de Dades i l'Estructura:**
```bash
php bin/console doctrine:database:create
php bin/console doctrine:schema:update --force
php bin/console messenger:setup-transports
```

**4. Carregar dades de prova (Fixtures):**
S'ha creat un arxiu Fixtures que carrega un usuari Administrador i els 3 productes base.
```bash
php bin/console doctrine:fixtures:load --append
```
*Credencials de l'Admin creat:* `admin@terraacasa.cat` / `123456`

**5. Executar l'aplicació:**
Per simular un entorn de producció i provar processos asíncrons, es necessiten dues terminals:

*Terminal 1 (Servidor Web - Port 8000 per defecte):*
```bash
symfony server:start
```

*Terminal 2 (Worker de processos asíncrons per a l'enviament de correus):*
```bash
php bin/console messenger:consume async -vv --no-debug
```

*Terminal 3 (Servidor Frontend - Botiga per als clients):*
```bash
php -S localhost:5500
```

---

## 📡 Documentació de l'API

El projecte exposa diversos endpoints per interactuar amb la plataforma des d'aplicacions externes (com una App mòbil o un servei de tercers):

*   **Llistar productes:** `GET /api/products`
    *   **Retorn:** Format JSON amb els detalls bàsics de les capses (ID, nom i preu).
*   **Detall d'un producte:** `GET /api/products/{id}`
    *   **Retorn:** Format JSON amb tota la informació ampliada (ID, nom, descripció, preu, imatge i estoc).
*   **Crear una comanda:** `POST /api/order`
    *   **Petició (Body):** Requereix un JSON amb l'`email` del client i el `product_id`.
    *   **Retorn:** Genera la comanda, desencadena l'enviament asíncron del correu electrònic i retorna un JSON amb el `transaction_id` i la `payment_url` (enllaç de pagament segur de Stripe).

### 📖 Swagger UI
Per fer fàcil l'exploració i prova dels endpoints, s'ha implementat **NelmioApiDocBundle**, que autogenera la documentació interactiva sota l'estàndard OpenAPI.

Per visualitzar la documentació del servei (un cop el servidor estigui engegat), visita la següent adreça al navegador:

👉 `http://localhost:8000/api/doc`

### 🔐 Autenticació
Actualment, l'endpoint `/api/products` és de caràcter públic per permetre la visualització del catàleg sense registre previ, alineant-se amb l'experiència d'usuari de la web principal on qualsevol visitant pot veure l'aparador sense estar autenticat. L'autenticació queda reservada exclusivament per al Backoffice (ruta `/admin` i `/login`).

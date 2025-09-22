Commit #5
Admin Layout con Flowbite

Este commit agrega un layout de administración en Laravel con TailwindCSS y Flowbite, incluyendo navegación lateral (sidebar), barra superior (navbar) y soporte para dashboard.

-Cambios principales-

Nuevo layout de administración
Creado componente AdminLayout (php artisan make:component AdminLayout).
Se añadió soporte para {{$slot}} y dashboard en resources/views/admin/dashboard.blade.php.
Organización de vistas
Carpeta resources/views/layouts/includes/admin/:
navigation.blade.php → navbar.
sidebar.blade.php → menú lateral.
Limpieza y refactor en admin.blade.php.
Integración de Flowbite
Instalación: npm install flowbite --save.
Configuración en resources/css/app.css:

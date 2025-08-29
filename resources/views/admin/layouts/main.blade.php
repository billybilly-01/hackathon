<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hackday's IA</title>
    <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">
    <!-- Style here -->
    <link rel="stylesheet" href="{{ asset('dist/css/style.css') }}">
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">
    <link rel="stylesheet"
        href="{{ asset('plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">
    <!-- iCheck -->
    <link rel="stylesheet" href="{{ asset('plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>

<body>
    <div class="admin-container">
        <!-- Sidebar -->
        @include('admin.layouts.aside')

        <!-- Main Content -->
        <main class="main-content" id="mainContent">
            <header class="header">
                <div class="header-left">
                    <button class="menu-toggle" id="menuToggle">
                        <svg width="24" height="24" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                    </button>

                    <div class="search-bar">
                        <svg class="search-icon" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                                clip-rule="evenodd" />
                        </svg>
                        <input type="text" class="search-input" placeholder="Rechercher...">
                    </div>
                </div>

                <div class="header-right">
                    <button class="notification-bell">
                        <svg width="20" height="20" fill="currentColor" viewBox="0 0 20 20">
                            <path
                                d="M10 2a6 6 0 00-6 6v3.586l-.707.707A1 1 0 004 14h12a1 1 0 00.707-1.707L16 11.586V8a6 6 0 00-6-6zM10 18a3 3 0 01-3-3h6a3 3 0 01-3 3z" />
                        </svg>
                        <span class="notification-badge"></span>
                    </button>

                    <div class="user-profile">
                        <div class="user-avatar" id="user-avatar">JD</div>
                        <span id="user"></span>
                    </div>
                </div>
            </header>
            @yield('content')
        </main>
    </div>

    <script>
        class AdminDashboard {
            constructor() {
                this.sidebar = document.getElementById('sidebar');
                this.mainContent = document.getElementById('mainContent');
                this.menuToggle = document.getElementById('menuToggle');
                this.navItems = document.querySelectorAll('.nav-item');

                this.init();
            }

            init() {
                this.bindEvents();
                this.handleResponsive();
            }

            bindEvents() {
                // Menu toggle
                this.menuToggle.addEventListener('click', () => {
                    this.toggleSidebar();
                });

                // Navigation items
                this.navItems.forEach(item => {
                    item.addEventListener('click', (e) => {
                        // e.preventDefault();
                        this.handleNavigation(item);
                    });
                });

                // Search functionality
                const searchInput = document.querySelector('.search-input');
                searchInput.addEventListener('input', (e) => {
                    this.handleSearch(e.target.value);
                });

                // Window resize
                window.addEventListener('resize', () => {
                    this.handleResponsive();
                });

                // Close sidebar when clicking outside on mobile
                document.addEventListener('click', (e) => {
                    if (window.innerWidth <= 768) {
                        if (!this.sidebar.contains(e.target) && !this.menuToggle.contains(e.target)) {
                            this.closeSidebar();
                        }
                    }
                });
            }

            toggleSidebar() {
                if (window.innerWidth <= 768) {
                    this.sidebar.classList.toggle('open');
                } else {
                    this.sidebar.classList.toggle('closed');
                    this.mainContent.classList.toggle('expanded');
                }
            }

            closeSidebar() {
                if (window.innerWidth <= 768) {
                    this.sidebar.classList.remove('open');
                }
            }

            handleNavigation(clickedItem) {
                // Remove active class from all items
                this.navItems.forEach(item => {
                    item.classList.remove('active');
                });

                // Add active class to clicked item
                clickedItem.classList.add('active');

                // Get page data
                // const page = clickedItem.getAttribute('data-page');

                // Load page content
                // this.loadPageContent(page);

                // Close sidebar on mobile after navigation
                // if (window.innerWidth <= 768) {
                //     this.closeSidebar();
                // }
            }

            loadPageContent(page) {
                const pageContent = document.getElementById('pageContent');

                // Add fade out animation
                pageContent.style.opacity = '0';

                setTimeout(() => {
                    let content = '';

                    switch (page) {
                        case 'dashboard':
                            content = this.getDashboardContent();
                            break;
                        case 'analytics':
                            content = this.getAnalyticsContent();
                            break;
                        case 'users':
                            content = this.getUsersContent();
                            break;
                        case 'products':
                            content = this.getProductsContent();
                            break;
                        case 'orders':
                            content = this.getOrdersContent();
                            break;
                        case 'settings':
                            content = this.getSettingsContent();
                            break;
                        default:
                            content = this.getDashboardContent();
                    }

                    pageContent.innerHTML = content;
                    pageContent.style.opacity = '1';
                    pageContent.classList.add('fade-in-up');
                }, 150);
            }

            getDashboardContent() {
                return document.getElementById('dashboard-content').outerHTML;
            }

            getAnalyticsContent() {
                return `
                    <div class="page-content fade-in-up">
                        <div class="page-header">
                            <h1 class="page-title">Analytiques</h1>
                            <p class="page-subtitle">Analysez les performances de votre plateforme</p>
                        </div>
                        <div class="data-table-container">
                            <div class="table-header">
                                <h2 class="table-title">Rapports d'analyse</h2>
                                <div class="table-actions">
                                    <button class="btn btn-primary">Générer rapport</button>
                                </div>
                            </div>
                            <div style="padding: 2rem; text-align: center; color: var(--text-secondary);">
                                <p>Les données analytiques seront affichées ici.</p>
                            </div>
                        </div>
                    </div>
                `;
            }

            getUsersContent() {
                return `
                    <div class="page-content fade-in-up">
                        <div class="page-header">
                            <h1 class="page-title">Gestion des utilisateurs</h1>
                            <p class="page-subtitle">Gérez les comptes utilisateurs</p>
                        </div>
                        <div class="data-table-container">
                            <div class="table-header">
                                <h2 class="table-title">Liste des utilisateurs</h2>
                                <div class="table-actions">
                                    <button class="btn btn-secondary">Exporter</button>
                                    <button class="btn btn-primary">Ajouter utilisateur</button>
                                </div>
                            </div>
                            <table class="data-table">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Nom</th>
                                        <th>Email</th>
                                        <th>Rôle</th>
                                        <th>Statut</th>
                                        <th>Dernière connexion</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>#001</td>
                                        <td>Marie Dupont</td>
                                        <td>marie.dupont@email.com</td>
                                        <td>Admin</td>
                                        <td><span class="status-badge status-active">Actif</span></td>
                                        <td>Il y a 2h</td>
                                    </tr>
                                    <tr>
                                        <td>#002</td>
                                        <td>Pierre Martin</td>
                                        <td>pierre.martin@email.com</td>
                                        <td>Utilisateur</td>
                                        <td><span class="status-badge status-active">Actif</span></td>
                                        <td>Il y a 1 jour</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                `;
            }

            getProductsContent() {
                return `
                    <div class="page-content fade-in-up">
                        <div class="page-header">
                            <h1 class="page-title">Gestion des produits</h1>
                            <p class="page-subtitle">Gérez votre catalogue de produits</p>
                        </div>
                        <div class="data-table-container">
                            <div class="table-header">
                                <h2 class="table-title">Catalogue produits</h2>
                                <div class="table-actions">
                                    <button class="btn btn-secondary">Import CSV</button>
                                    <button class="btn btn-primary">Ajouter produit</button>
                                </div>
                            </div>
                            <div style="padding: 2rem; text-align: center; color: var(--text-secondary);">
                                <p>La liste des produits sera affichée ici.</p>
                            </div>
                        </div>
                    </div>
                `;
            }

            getOrdersContent() {
                return `
                    <div class="page-content fade-in-up">
                        <div class="page-header">
                            <h1 class="page-title">Gestion des commandes</h1>
                            <p class="page-subtitle">Suivez et gérez toutes les commandes</p>
                        </div>
                        <div class="data-table-container">
                            <div class="table-header">
                                <h2 class="table-title">Toutes les commandes</h2>
                                <div class="table-actions">
                                    <button class="btn btn-secondary">Filtres</button>
                                    <button class="btn btn-primary">Exporter</button>
                                </div>
                            </div>
                            <div style="padding: 2rem; text-align: center; color: var(--text-secondary);">
                                <p>La liste complète des commandes sera affichée ici.</p>
                            </div>
                        </div>
                    </div>
                `;
            }

            getSettingsContent() {
                return `
                    <div class="page-content fade-in-up">
                        <div class="page-header">
                            <h1 class="page-title">Paramètres</h1>
                            <p class="page-subtitle">Configurez votre application</p>
                        </div>
                        <div class="data-table-container">
                            <div class="table-header">
                                <h2 class="table-title">Configuration générale</h2>
                            </div>
                            <div style="padding: 2rem;">
                                <p>Les options de configuration seront disponibles ici.</p>
                                <br>
                                <div style="display: flex; gap: 1rem;">
                                    <button class="btn btn-primary">Sauvegarder</button>
                                    <button class="btn btn-secondary">Annuler</button>
                                </div>
                            </div>
                        </div>
                    </div>
                `;
            }

            handleSearch(query) {
                console.log('Recherche:', query);
                // Implémentation de la recherche
            }

            handleResponsive() {
                if (window.innerWidth <= 768) {
                    this.sidebar.classList.remove('closed');
                    this.sidebar.classList.remove('open');
                    this.mainContent.classList.remove('expanded');
                } else {
                    this.sidebar.classList.remove('open');
                }
            }
        }

        // Initialize dashboard when DOM is loaded
        document.addEventListener('DOMContentLoaded', function() {
            new AdminDashboard();
        });

        // Add some interactive features
        document.addEventListener('DOMContentLoaded', function() {
            // Animate stats cards on load
            const statCards = document.querySelectorAll('.stat-card');
            statCards.forEach((card, index) => {
                card.style.animationDelay = `${index * 0.1}s`;
                card.classList.add('fade-in-up');
            });

            // Add hover effects to table rows
            const tableRows = document.querySelectorAll('.data-table tbody tr');
            tableRows.forEach(row => {
                row.addEventListener('mouseenter', function() {
                    this.style.transform = 'translateX(5px)';
                    this.style.transition = 'transform 0.2s ease';
                });

                row.addEventListener('mouseleave', function() {
                    this.style.transform = 'translateX(0)';
                });
            });
        });

        function getCookie(name) {
            const match = document.cookie.split('; ').find(row => row.startsWith(name + '='));
            return match ? decodeURIComponent(match.split('=')[1]) : null;
        }

        function getUser() {
            const token = getCookie('laravel_session');

            console.log("Token:", token);

            fetch('/admin/connect-user', {
                    method: 'GET',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'Authorization': `Bearer ${token}`
                    }
                }).then(response => response.json())
                .then(data => {
                    document.getElementById('user').textContent = data.user.name;
                    document.getElementById("user-avatar").textContent = data.user.name[0]
                    console.log("DATA USER: ", data)
                })
                .catch(error => {
                    console.error('Error fetching user data:', error);
                });
        }

        getUser()
    </script>
    <script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="{{ asset('plugins/jquery-ui/jquery-ui.min.js') }}"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
        $.widget.bridge('uibutton', $.ui.button)
    </script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- ChartJS -->
</body>

</html>

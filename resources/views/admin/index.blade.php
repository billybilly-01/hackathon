@extends('admin.layouts.main')
@section('content')
    <!-- Header -->
    

    <!-- Content Area -->
    <div class="content-area">
        <div id="pageContent">
            <!-- Dashboard Content -->
            <div class="page-content fade-in-up" id="dashboard-content">
                <div class="page-header">
                    <h1 class="page-title">Tableau de bord</h1>
                    <p class="page-subtitle">Bienvenue dans votre espace d'administration</p>
                </div>

                <div class="stats-grid">
                    <div class="stat-card">
                        <div class="stat-header">
                            <div class="stat-title">Total des ventes</div>
                            <div class="stat-icon primary">
                                <svg width="20" height="20" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M2 10a8 8 0 018-8v8h8a8 8 0 11-16 0z" />
                                    <path d="M12 2.252A8.014 8.014 0 0117.748 8H12V2.252z" />
                                </svg>
                            </div>
                        </div>
                        <div class="stat-value">€45,231</div>
                        <div class="stat-change positive">
                            <svg width="16" height="16" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M3.293 9.707a1 1 0 010-1.414l6-6a1 1 0 011.414 0l6 6a1 1 0 01-1.414 1.414L11 5.414V17a1 1 0 11-2 0V5.414L4.707 9.707a1 1 0 01-1.414 0z"
                                    clip-rule="evenodd" />
                            </svg>
                            +12% ce mois-ci
                        </div>
                    </div>

                    <div class="stat-card">
                        <div class="stat-header">
                            <div class="stat-title">Nouveaux clients</div>
                            <div class="stat-icon success">
                                <svg width="20" height="20" fill="currentColor" viewBox="0 0 20 20">
                                    <path
                                        d="M9 6a3 3 0 11-6 0 3 3 0 016 0zM17 6a3 3 0 11-6 0 3 3 0 016 0zM12.93 17c.046-.327.07-.66.07-1a6.97 6.97 0 00-1.5-4.33A5 5 0 0119 16v1h-6.07zM6 11a5 5 0 015 5v1H1v-1a5 5 0 015-5z" />
                                </svg>
                            </div>
                        </div>
                        <div class="stat-value">1,234</div>
                        <div class="stat-change positive">
                            <svg width="16" height="16" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M3.293 9.707a1 1 0 010-1.414l6-6a1 1 0 011.414 0l6 6a1 1 0 01-1.414 1.414L11 5.414V17a1 1 0 11-2 0V5.414L4.707 9.707a1 1 0 01-1.414 0z"
                                    clip-rule="evenodd" />
                            </svg>
                            +8% ce mois-ci
                        </div>
                    </div>

                    <div class="stat-card">
                        <div class="stat-header">
                            <div class="stat-title">Commandes</div>
                            <div class="stat-icon warning">
                                <svg width="20" height="20" fill="currentColor" viewBox="0 0 20 20">
                                    <path
                                        d="M3 1a1 1 0 000 2h1.22l.305 1.222a.997.997 0 00.01.042l1.358 5.43-.893.892C3.74 11.846 4.632 14 6.414 14H15a1 1 0 000-2H6.414l1-1H14a1 1 0 00.894-.553l3-6A1 1 0 0017 3H6.28l-.31-1.243A1 1 0 005 1H3zM16 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0zM6.5 18a1.5 1.5 0 100-3 1.5 1.5 0 000 3z" />
                                </svg>
                            </div>
                        </div>
                        <div class="stat-value">567</div>
                        <div class="stat-change negative">
                            <svg width="16" height="16" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M16.707 10.293a1 1 0 010 1.414l-6 6a1 1 0 01-1.414 0l-6-6a1 1 0 111.414-1.414L9 14.586V3a1 1 0 012 0v11.586l4.293-4.293a1 1 0 011.414 0z"
                                    clip-rule="evenodd" />
                            </svg>
                            -3% ce mois-ci
                        </div>
                    </div>

                    <div class="stat-card">
                        <div class="stat-header">
                            <div class="stat-title">Taux de conversion</div>
                            <div class="stat-icon error">
                                <svg width="20" height="20" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M3 3a1 1 0 000 2v8a2 2 0 002 2h2.586l-1.293 1.293a1 1 0 101.414 1.414L10 15.414l2.293 2.293a1 1 0 001.414-1.414L12.414 15H15a2 2 0 002-2V5a1 1 0 100-2H3zm11.707 4.707a1 1 0 00-1.414-1.414L10 9.586 8.707 8.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                        clip-rule="evenodd" />
                                </svg>
                            </div>
                        </div>
                        <div class="stat-value">3.24%</div>
                        <div class="stat-change positive">
                            <svg width="16" height="16" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M3.293 9.707a1 1 0 010-1.414l6-6a1 1 0 011.414 0l6 6a1 1 0 01-1.414 1.414L11 5.414V17a1 1 0 11-2 0V5.414L4.707 9.707a1 1 0 01-1.414 0z"
                                    clip-rule="evenodd" />
                            </svg>
                            +0.1% ce mois-ci
                        </div>
                    </div>
                </div>

                <div class="data-table-container">
                    <div class="table-header">
                        <h2 class="table-title">Dernières commandes</h2>
                        <div class="table-actions">
                            <button class="btn btn-secondary">Exporter</button>
                            <button class="btn btn-primary">Nouvelle commande</button>
                        </div>
                    </div>
                    <table class="data-table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Client</th>
                                <th>Produit</th>
                                <th>Montant</th>
                                <th>Statut</th>
                                <th>Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>#12345</td>
                                <td>Marie Dupont</td>
                                <td>MacBook Pro 16"</td>
                                <td>€2,399</td>
                                <td><span class="status-badge status-active">Livré</span></td>
                                <td>15 Août 2025</td>
                            </tr>
                            <tr>
                                <td>#12344</td>
                                <td>Pierre Martin</td>
                                <td>iPhone 15 Pro</td>
                                <td>€1,199</td>
                                <td><span class="status-badge status-pending">En cours</span></td>
                                <td>14 Août 2025</td>
                            </tr>
                            <tr>
                                <td>#12343</td>
                                <td>Sophie Bernard</td>
                                <td>iPad Air</td>
                                <td>€649</td>
                                <td><span class="status-badge status-active">Livré</span></td>
                                <td>13 Août 2025</td>
                            </tr>
                            <tr>
                                <td>#12342</td>
                                <td>Lucas Moreau</td>
                                <td>AirPods Pro</td>
                                <td>€279</td>
                                <td><span class="status-badge status-inactive">Annulé</span></td>
                                <td>12 Août 2025</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

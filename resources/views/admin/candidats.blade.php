@extends('admin.layouts.main')
@section('content')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/xlsx@0.18.5/dist/xlsx.full.min.js"></script>

    <!-- Content Area -->
    <div class="content-area">
        <div id="pageContent">
            <!-- Dashboard Content -->
            <div class="page-content fade-in-up" id="dashboard-content">
                <div class="page-header">
                    <h1 class="page-title">Candidat</h1>
                    <p class="page-subtitle">Bienvenue dans votre espace d'administration</p>
                </div>

                <div class="data-table-container">
                    <div class="table-header">
                        <div>
                            <h2 class="table-title">Liste des candidats</h2>
                            <div>
                                <label for="rowsPerPage"
                                    style="font-size:0.9rem; color:var(--text-secondary);">Afficher</label>
                                <select id="rowsPerPage"
                                    style="padding:6px 8px; border-radius:6px; border:1px solid var(--border-color);">
                                    <option value="2">2</option>
                                    <option value="5" selected>5</option>
                                    <option value="10">10</option>
                                    <option value="20">20</option>
                                    <option value="50">50</option>
                                </select>
                            </div>
                        </div>
                        <div class="table-actions">
                            {{-- <button class="btn btn-secondary">Exporter</button> --}}
                            <button class="btn btn-secondary"
                                onclick="exportTableToExcel('data-table', 'candidats')">Exporter</button>
                            {{-- <button class="btn btn-primary">Nouvelle commande</button> --}}
                        </div>


                    </div>
                    <table class="data-table" id="data-table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nom</th>
                                <th>Prénom</th>
                                <th>Email</th>
                                <th>Entité</th>
                                <th>Nom de l'entité</th>
                                <th>Date de création</th>
                                <th>status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($candidats as $candidat)
                                <tr>
                                    <td>{{ $candidat->id }}</td>
                                    <td>{{ $candidat->nom }}</td>
                                    <td>{{ $candidat->prenom }}</td>
                                    <td>{{ $candidat->email }}</td>
                                    <td>{{ $candidat->entite }}</td>
                                    <td>{{ $candidat->nom_entite }}</td>
                                    <td>{{ date('d-m-Y', strtotime($candidat->created_at)) }}</td>
                                    <td>
                                        <span
                                            class="status-badge status-{{ $candidat->status == 'validated' ? 'active' : ($candidat->status == 'pending' ? 'pending' : 'inactive') }}">
                                            {{ $candidat->status }}
                                        </span>
                                    </td>
                                    {{-- <td><span class="status-badge status-{{$candidat->status =="validated" ? "active" : $candidat->status =="pending" ? "pending" : "inactive"}}">{{ $candidat->status }}</span></td> --}}
                                    <td>
                                        <!-- Valider le candidat -->
                                        <a href="#" class="action-validate" title="Valider"
                                            id="validateCandidate{{ $candidat->id }}">
                                            <i class="fas fa-check-circle"></i>
                                        </a>
                                        <!-- Rejeter le candidat -->
                                        <a href="#" class="action-reject" title="Rejeter"
                                            id="RejectCandidate{{ $candidat->id }}">
                                            <i class="fas fa-ban"></i>
                                        </a>
                                        <!-- Voir le candidat -->
                                        <a href="#" class="action-view" title="Voir" data-toggle="modal"
                                            data-target="#candidatModal{{ $candidat->id }}">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                    </td>
                                </tr>

                                <div class="modal fade" id="candidatModal{{ $candidat->id }}" tabindex="-1" role="dialog"
                                    aria-labelledby="candidatModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="candidatModalLabel">Détail du
                                                    candidat {{ $candidat->nom }}</h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Fermer">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="card" style="width: 100%;">
                                                    <ul class="list-group list-group-flush">
                                                        <li class="list-group-item">{{ $candidat->nom }}
                                                            {{ $candidat->prenom }}</li>
                                                        <li class="list-group-item">{{ $candidat->email }} /
                                                            {{ $candidat->telephone }}</li>
                                                        <li class="list-group-item">{{ $candidat->entite }} /
                                                            {{ $candidat->nom_entite }}</li>
                                                        <li class="list-group-item">{{ $candidat->pays }} /
                                                            {{ $candidat->ville }} / {{ $candidat->adresse }}
                                                        </li>
                                                    </ul>

                                                    @if ($candidat->video)
                                                        <video width="100%" height="auto" controls
                                                            style="margin-top: 20px; padding: 20px; border-radius: 35px;">
                                                            <source src="{{ asset($candidat->video) }}" type="video/mp4">
                                                            Votre navigateur ne supporte pas la lecture vidéo.
                                                        </video>
                                                    @else
                                                        <p>Aucune vidéo disponible.</p>
                                                    @endif
                                                </div>
                                                <div class="row mt-5 mb-3">
                                                    <div class="col-md-6 text-center">
                                                        <a href="{{ route('admin.candidat.validate', $candidat->id) }}"
                                                            class="btn btn-primary">Accepter</a>
                                                    </div>
                                                    <div class="col-md-6 text-center">
                                                        <a href="{{ route('admin.candidat.reject', $candidat->id) }}"
                                                            class="btn btn-danger">Rejeter</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
                                <script>
                                    $(document).ready(function() {
                                        $('#validateCandidate{{ $candidat->id }}').on('click', function() {
                                            // Démarrer la vidéo lorsque le modal est ouvert
                                            Swal.fire({
                                                title: "Confirmation!",
                                                text: "Êtes-vous sûr de vouloir valider {{ $candidat->nom }} {{ $candidat->prenom }} ?",
                                                type: "warning",
                                                allowEscapeKey: false,
                                                allowOutsideClick: false,
                                                showCancelButton: true,
                                                confirmButtonColor: "#DD6B55",
                                                confirmButtonText: "Oui",
                                                cancelButtonText: "Non",
                                                showLoaderOnConfirm: true,
                                                closeOnConfirm: false
                                            }).then((isConfirm) => {
                                                if (isConfirm.value === true) {
                                                    // document.getElementById("delForm").submit();
                                                    // return true;
                                                    $.ajax({
                                                        url: "{{ route('admin.candidat.validate', $candidat->id) }}",
                                                        type: "POST",
                                                        data: {
                                                            _token: '{{ csrf_token() }}'
                                                        },
                                                        success: function(response) {
                                                            // Traitez la réponse du serveur ici
                                                            console.log(response);
                                                            Swal.fire({
                                                                title: "Succès",
                                                                text: response.message,
                                                                type: "success"
                                                            }).then(() => {
                                                                // Rediriger ou mettre à jour la page après la suppression
                                                                // location.reload();
                                                            });
                                                        },
                                                        error: function(xhr, status, error) {
                                                            // Gérez les erreurs ici
                                                            console.error(error);
                                                        }
                                                    });
                                                } else {
                                                    // L'utilisateur a annulé l'action
                                                    Swal.fire({
                                                        title: "Annulé",
                                                        text: "L'action a été annulée.",
                                                        type: "info"
                                                    });
                                                }

                                            });
                                        });

                                        $('#RejectCandidate{{ $candidat->id }}').on('click', function(e) {
                                            e.preventDefault(); // Empêche le lien de rediriger immédiatement
                                            Swal.fire({
                                                title: "Confirmation!",
                                                text: "Êtes-vous sûr de vouloir rejeter {{ $candidat->nom }} {{ $candidat->prenom }} ?",
                                                type: "warning",
                                                allowEscapeKey: false,
                                                allowOutsideClick: false,
                                                showCancelButton: true,
                                                confirmButtonColor: "#DD6B55",
                                                confirmButtonText: "Oui",
                                                cancelButtonText: "Non",
                                                showLoaderOnConfirm: true,
                                                closeOnConfirm: false
                                            }).then((isConfirm) => {
                                                if (isConfirm.value === true) {
                                                    // Rediriger vers la route de rejet
                                                    // window.location.href = "{{ route('admin.candidat.reject', $candidat->id) }}";
                                                    $.ajax({
                                                        url: "{{ route('admin.candidat.reject', $candidat->id) }}",
                                                        type: "POST",
                                                        data: {
                                                            _token: '{{ csrf_token() }}'
                                                        },
                                                        success: function(response) {
                                                            // Traitez la réponse du serveur ici
                                                            console.log(response);
                                                            Swal.fire({
                                                                title: "Succès",
                                                                text: response.message,
                                                                type: "success"
                                                            }).then(() => {
                                                                // Rediriger ou mettre à jour la page après le rejet
                                                                // location.reload();
                                                            });
                                                        },
                                                        error: function(xhr, status, error) {
                                                            // Gérez les erreurs ici
                                                            console.error(error);
                                                        }
                                                    });

                                                } else {
                                                    // L'utilisateur a annulé l'action
                                                    Swal.fire({
                                                        title: "Annulé",
                                                        text: "L'action a été annulée.",
                                                        type: "info"
                                                    });
                                                }
                                            });
                                        });
                                    });
                                </script>
                            @endforeach

                        </tbody>
                    </table>
                </div>
                <!-- Pagination front-end améliorée -->
                <div class="table-footer"
                    style="display:flex; justify-content:space-between; align-items:center; margin-top:16px; gap:12px; flex-wrap:wrap;">
                    <div class="page-controls" style="display:flex; align-items:center; gap:12px;">

                        <div id="pagination-info" style="font-size:0.9rem; color:var(--text-secondary);">Affichage 0–0 sur
                            0</div>
                    </div>

                    <nav class="pagination-container" id="client-pagination" aria-label="Pagination" style="display: flex">
                        <!-- boutons générés par JS -->
                    </nav>

                    <div class="page-jump" style="display:flex; align-items:center; gap:8px;">
                    </div>
                </div>

                <script>
                    (function() {
                        const tableId = 'data-table';
                        const paginationId = 'client-pagination';
                        const rowsPerPageSelectId = 'rowsPerPage';
                        const infoId = 'pagination-info';
                        const gotoId = 'gotoPage';
                        const gotoBtnId = 'gotoBtn';

                        function initClientPagination() {
                            const table = document.getElementById(tableId);
                            const paginationContainer = document.getElementById(paginationId);
                            const select = document.getElementById(rowsPerPageSelectId);
                            const info = document.getElementById(infoId);
                            const gotoInput = document.getElementById(gotoId);
                            const gotoBtn = document.getElementById(gotoBtnId);
                            if (!table || !paginationContainer || !select || !info) return;

                            const tbody = table.tBodies[0];
                            const rows = Array.from(tbody.querySelectorAll('tr'));
                            if (rows.length === 0) {
                                paginationContainer.innerHTML = '';
                                info.textContent = 'Aucun élément';
                                return;
                            }

                            const state = {
                                currentPage: 1,
                                rowsPerPage: parseInt(select.value, 10) || 10,
                            };

                            function updateInfo() {
                                const total = rows.length;
                                const start = (state.currentPage - 1) * state.rowsPerPage;
                                const end = Math.min(start + state.rowsPerPage, total);
                                info.textContent = `Affichage ${total === 0 ? 0 : (start + 1)}–${end} sur ${total}`;
                                if (gotoInput) {
                                    gotoInput.value = state.currentPage;
                                    gotoInput.max = Math.max(1, Math.ceil(total / state.rowsPerPage));
                                }
                            }

                            function showPage(page) {
                                const totalPages = Math.max(1, Math.ceil(rows.length / state.rowsPerPage));
                                state.currentPage = Math.min(Math.max(1, page), totalPages);
                                const start = (state.currentPage - 1) * state.rowsPerPage;
                                const end = start + state.rowsPerPage;

                                rows.forEach((r, i) => {
                                    r.style.display = (i >= start && i < end) ? '' : 'none';
                                });

                                renderPagination();
                                updateInfo();
                            }

                            function renderPagination() {
                                const totalPages = Math.max(1, Math.ceil(rows.length / state.rowsPerPage));
                                if (state.currentPage > totalPages) state.currentPage = totalPages;

                                const maxButtons = 7;
                                let startPage = Math.max(1, state.currentPage - Math.floor(maxButtons / 2));
                                let endPage = startPage + maxButtons - 1;
                                if (endPage > totalPages) {
                                    endPage = totalPages;
                                    startPage = Math.max(1, endPage - maxButtons + 1);
                                }

                                paginationContainer.innerHTML = '';
                                paginationContainer.setAttribute('role', 'navigation');

                                // First
                                paginationContainer.appendChild(makeBtn('«', 1, state.currentPage === 1, 'First'));
                                // Prev
                                paginationContainer.appendChild(makeBtn('‹', Math.max(1, state.currentPage - 1), state
                                    .currentPage === 1, 'Prev'));

                                if (startPage > 1) {
                                    paginationContainer.appendChild(makePageBtn(1));
                                    if (startPage > 2) paginationContainer.appendChild(makeEllipsis());
                                }

                                for (let p = startPage; p <= endPage; p++) {
                                    paginationContainer.appendChild(makePageBtn(p, p === state.currentPage));
                                }

                                if (endPage < totalPages) {
                                    if (endPage < totalPages - 1) paginationContainer.appendChild(makeEllipsis());
                                    paginationContainer.appendChild(makePageBtn(totalPages));
                                }

                                // Next
                                paginationContainer.appendChild(makeBtn('›', Math.min(totalPages, state.currentPage + 1), state
                                    .currentPage === totalPages, 'Next'));
                                // Last
                                paginationContainer.appendChild(makeBtn('»', totalPages, state.currentPage === totalPages, 'Last'));

                                // keyboard support: focus first page-link
                                const firstBtn = paginationContainer.querySelector('.page-link:not(.disabled)');
                                if (firstBtn) firstBtn.setAttribute('tabindex', '0');
                            }

                            function makeBtn(label, page, disabled = false, ariaLabel = '') {
                                const btn = document.createElement('button');
                                btn.type = 'button';
                                btn.className = 'page-link' + (disabled ? ' disabled' : '');
                                btn.setAttribute('aria-label', ariaLabel || ('Page ' + page));
                                btn.textContent = label;
                                btn.disabled = disabled;
                                btn.addEventListener('click', () => {
                                    if (!disabled) showPage(page);
                                });
                                btn.addEventListener('keydown', handleKeydown);
                                return btn;
                            }

                            function makePageBtn(page, active = false) {
                                const btn = document.createElement('button');
                                btn.type = 'button';
                                btn.className = 'page-link' + (active ? ' active' : '');
                                btn.setAttribute('aria-label', 'Page ' + page);
                                if (active) btn.setAttribute('aria-current', 'page');
                                btn.textContent = page;
                                btn.addEventListener('click', () => showPage(page));
                                btn.addEventListener('keydown', handleKeydown);
                                return btn;
                            }

                            function makeEllipsis() {
                                const span = document.createElement('span');
                                span.className = 'page-ellipsis';
                                span.textContent = '…';
                                span.setAttribute('aria-hidden', 'true');
                                return span;
                            }

                            function handleKeydown(e) {
                                // allow Enter/Space on focused button
                                if (e.key === 'Enter' || e.key === ' ') {
                                    e.preventDefault();
                                    e.target.click();
                                }
                                // left/right/home/end are handled globally below
                            }

                            // global keyboard navigation for pagination
                            paginationContainer.addEventListener('keydown', function(e) {
                                const totalPages = Math.max(1, Math.ceil(rows.length / state.rowsPerPage));
                                if (e.key === 'ArrowLeft') {
                                    e.preventDefault();
                                    showPage(state.currentPage - 1);
                                } else if (e.key === 'ArrowRight') {
                                    e.preventDefault();
                                    showPage(state.currentPage + 1);
                                } else if (e.key === 'Home') {
                                    e.preventDefault();
                                    showPage(1);
                                } else if (e.key === 'End') {
                                    e.preventDefault();
                                    showPage(totalPages);
                                }
                            });

                            // events
                            select.addEventListener('change', () => {
                                state.rowsPerPage = parseInt(select.value, 10) || 10;
                                state.currentPage = 1;
                                showPage(1);
                            });

                            if (gotoBtn && gotoInput) {
                                gotoBtn.addEventListener('click', () => {
                                    const p = parseInt(gotoInput.value, 10);
                                    if (!isNaN(p)) showPage(p);
                                });
                                gotoInput.addEventListener('keydown', (e) => {
                                    if (e.key === 'Enter') gotoBtn.click();
                                });
                            }

                            // init
                            showPage(1);
                        }

                        if (document.readyState === 'loading') {
                            document.addEventListener('DOMContentLoaded', initClientPagination);
                        } else {
                            initClientPagination();
                        }
                    })();
                </script>
                <script>
                    (function() {
                        const tableId = 'data-table';
                        const paginationId = 'client-pagination';
                        const rowsPerPageSelectId = 'rowsPerPage';
                        const infoId = 'pagination-info';

                        function initClientPagination() {
                            const table = document.getElementById(tableId);
                            const paginationContainer = document.getElementById(paginationId);
                            const select = document.getElementById(rowsPerPageSelectId);
                            const info = document.getElementById(infoId);
                            if (!table || !paginationContainer || !select || !info) return;

                            const tbody = table.tBodies[0];
                            const rows = Array.from(tbody.querySelectorAll('tr'));
                            if (rows.length === 0) {
                                paginationContainer.innerHTML = '';
                                info.textContent = 'Aucun élément';
                                return;
                            }

                            const state = {
                                currentPage: 1,
                                rowsPerPage: parseInt(select.value, 10) || 10,
                            };

                            function updateInfo() {
                                const total = rows.length;
                                const start = (state.currentPage - 1) * state.rowsPerPage;
                                const end = Math.min(start + state.rowsPerPage, total);
                                info.textContent = `Affichage ${total === 0 ? 0 : (start + 1)}–${end} sur ${total}`;
                            }

                            function showPage(page) {
                                const totalPages = Math.max(1, Math.ceil(rows.length / state.rowsPerPage));
                                state.currentPage = Math.min(Math.max(1, page), totalPages);
                                const start = (state.currentPage - 1) * state.rowsPerPage;
                                const end = start + state.rowsPerPage;

                                rows.forEach((r, i) => {
                                    r.style.display = (i >= start && i < end) ? '' : 'none';
                                });

                                renderPagination();
                                updateInfo();
                            }

                            function renderPagination() {
                                const totalPages = Math.max(1, Math.ceil(rows.length / state.rowsPerPage));
                                if (state.currentPage > totalPages) state.currentPage = totalPages;

                                const maxButtons = 7;
                                let startPage = Math.max(1, state.currentPage - Math.floor(maxButtons / 2));
                                let endPage = startPage + maxButtons - 1;
                                if (endPage > totalPages) {
                                    endPage = totalPages;
                                    startPage = Math.max(1, endPage - maxButtons + 1);
                                }

                                paginationContainer.innerHTML = '';
                                paginationContainer.setAttribute('role', 'navigation');

                                // Helper: create wrapper .page-item with button inside
                                function appendPageItem(label, page, options = {}) {
                                    const {
                                        disabled = false, active = false, ariaLabel = ''
                                    } = options;
                                    const item = document.createElement('div');
                                    item.className = 'page-item' + (disabled ? ' disabled' : '') + (active ? ' active' : '');

                                    const btn = document.createElement('button');
                                    btn.type = 'button';
                                    btn.className = 'page-link' + (disabled ? ' disabled' : '') + (active ? ' active' : '');
                                    btn.setAttribute('aria-label', ariaLabel || (typeof label === 'string' ? label : 'Page ' +
                                        page));
                                    if (active) btn.setAttribute('aria-current', 'page');
                                    btn.textContent = label;
                                    btn.disabled = !!disabled;

                                    if (!disabled) {
                                        btn.addEventListener('click', () => showPage(page));
                                    }
                                    btn.addEventListener('keydown', handleKeydown);

                                    item.appendChild(btn);
                                    paginationContainer.appendChild(item);
                                }

                                function appendEllipsis() {
                                    const item = document.createElement('div');
                                    item.className = 'page-item';
                                    const span = document.createElement('div');
                                    span.className = 'page-ellipsis';
                                    span.setAttribute('aria-hidden', 'true');
                                    span.textContent = '…';
                                    item.appendChild(span);
                                    paginationContainer.appendChild(item);
                                }

                                // First / Prev
                                appendPageItem('«', 1, {
                                    disabled: state.currentPage === 1,
                                    ariaLabel: 'Première page'
                                });
                                appendPageItem('‹', Math.max(1, state.currentPage - 1), {
                                    disabled: state.currentPage === 1,
                                    ariaLabel: 'Page précédente'
                                });

                                // Leading
                                if (startPage > 1) {
                                    appendPageItem('1', 1);
                                    if (startPage > 2) appendEllipsis();
                                }

                                // Numbered pages
                                for (let p = startPage; p <= endPage; p++) {
                                    appendPageItem(String(p), p, {
                                        active: p === state.currentPage
                                    });
                                }

                                // Trailing
                                if (endPage < totalPages) {
                                    if (endPage < totalPages - 1) appendEllipsis();
                                    appendPageItem(String(totalPages), totalPages);
                                }

                                // Next / Last
                                appendPageItem('›', Math.min(totalPages, state.currentPage + 1), {
                                    disabled: state.currentPage === totalPages,
                                    ariaLabel: 'Page suivante'
                                });
                                appendPageItem('»', totalPages, {
                                    disabled: state.currentPage === totalPages,
                                    ariaLabel: 'Dernière page'
                                });

                                // focusable
                                const focusable = paginationContainer.querySelector('.page-item .page-link:not(.disabled)');
                                if (focusable) focusable.setAttribute('tabindex', '0');
                            }

                            function handleKeydown(e) {
                                if (e.key === 'Enter' || e.key === ' ') {
                                    e.preventDefault();
                                    e.target.click();
                                }
                            }

                            // keyboard navigation for container
                            paginationContainer.addEventListener('keydown', function(e) {
                                const totalPages = Math.max(1, Math.ceil(rows.length / state.rowsPerPage));
                                if (e.key === 'ArrowLeft') {
                                    e.preventDefault();
                                    showPage(state.currentPage - 1);
                                } else if (e.key === 'ArrowRight') {
                                    e.preventDefault();
                                    showPage(state.currentPage + 1);
                                } else if (e.key === 'Home') {
                                    e.preventDefault();
                                    showPage(1);
                                } else if (e.key === 'End') {
                                    e.preventDefault();
                                    showPage(totalPages);
                                }
                            });

                            // events
                            select.addEventListener('change', () => {
                                state.rowsPerPage = parseInt(select.value, 10) || 10;
                                state.currentPage = 1;
                                showPage(1);
                            });

                            // init
                            showPage(1);
                        }

                        if (document.readyState === 'loading') {
                            document.addEventListener('DOMContentLoaded', initClientPagination);
                        } else {
                            initClientPagination();
                        }
                    })();
                </script>

            </div>
        </div>
    </div>
    <script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
    <script>
        function openModal(id) {
            document.getElementById(id).style.display = 'block';
        }

        function closeModal(id) {
            document.getElementById(id).style.display = 'none';
        }
        // Fermer le modal si on clique en dehors
        window.onclick = function(event) {
            document.querySelectorAll('.custom-modal').forEach(function(modal) {
                if (event.target === modal) {
                    modal.style.display = "none";
                }
            });
        }
    </script>
    <script>
        function exportTableToExcel(tableID, filename = '') {
            var table = document.getElementById(tableID);
            var wb = XLSX.utils.table_to_book(table, {
                sheet: "Sheet 1"
            });
            return XLSX.writeFile(wb, filename ? filename + '.xlsx' : 'export.xlsx');
        }
    </script>
@endsection

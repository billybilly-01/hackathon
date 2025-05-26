@extends("admin.layouts.main")
@section("content")
<!-- DataTables -->
<link rel="stylesheet" href="https://cdn.datatables.net/2.3.1/css/dataTables.dataTables.css" />
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/3.2.3/css/buttons.dataTables.css">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Dashboard</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Dashboard</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Dashboard</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <h1>Bienvenue dans le tableau de bord administrateur</h1>
                            <p>Vous pouvez gérer les utilisateurs, les candidatures et d'autres fonctionnalités ici.</p>
                        </div>
                        <div class="card-body">
                            <table id="example" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Nom</th>
                                        <th>Prénom</th>
                                        <th>Email</th>
                                        <th>Entité</th>
                                        <th>Nom de l'entité</th>
                                        <th>Date de création</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($candidats as $candidat)
                                    <tr>
                                        <td>{{ $candidat->id }}</td>
                                        <td>{{ $candidat->nom }}</td>
                                        <td>{{ $candidat->prenom }}</td>
                                        <td>{{ $candidat->email }}</td>
                                        <td>{{ $candidat->entite }}</td>
                                        <td>{{ $candidat->nom_entite }}</td>
                                        <td>{{date('d-m-Y', strtotime($candidat->created_at))}}</td>
                                        <td>
                                            <!-- Exemple d'actions -->
                                            <a href="#" class="btn-sm text-primary btn btn-light m-1" id="validateCandidate{{ $candidat->id }}"><i class="fas fa-check-circle"></i></a>
                                            <a href="{{ route('admin.candidat.reject', $candidat->id) }}" class="btn-sm text-danger btn btn-light m-1" id="RejectCandidate{{ $candidat->id }}"><i class="fas fa-ban"></i></a>
                                            <a href="{{ route('admin.candidat.show', $candidat->id) }}" class="btn-sm text-success btn btn-light m-1" data-toggle="modal"
                                                data-target="#candidatModal{{ $candidat->id }}"><i class="fas fa-eye"></i></a>
                                        </td>
                                    </tr>

                                    <div class="modal fade" id="candidatModal{{ $candidat->id }}" tabindex="-1" role="dialog" aria-labelledby="candidatModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="candidatModalLabel">Détail du candidat {{ $candidat->nom }}</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Fermer">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="card" style="width: 100%;">
                                                        <ul class="list-group list-group-flush">
                                                            <li class="list-group-item">{{ $candidat->nom }} {{ $candidat->prenom }}</li>
                                                            <li class="list-group-item">{{ $candidat->email }} / {{ $candidat->telephone }}</li>
                                                            <li class="list-group-item">{{ $candidat->entite }} / {{ $candidat->nom_entite }}</li>
                                                            <li class="list-group-item">{{ $candidat->pays }} / {{ $candidat->ville }} / {{ $candidat->adresse }}</li>
                                                        </ul>

                                                        @if($candidat->video)
                                                        <video width="100%" height="auto" controls style="margin-top: 20px; padding: 20px; border-radius: 35px;">
                                                            <source src="{{ asset( $candidat->video) }}" type="video/mp4">
                                                            Votre navigateur ne supporte pas la lecture vidéo.
                                                        </video>


                                                        @else
                                                        <p>Aucune vidéo disponible.</p>
                                                        @endif
                                                    </div>
                                                    <div class="row mt-5 mb-3">
                                                        <div class="col-md-6 text-center">
                                                            <a href="{{ route('admin.candidat.validate', $candidat->id) }}" class="btn btn-primary">Accepter</a>
                                                        </div>
                                                        <div class="col-md-6 text-center">
                                                            <a href="{{ route('admin.candidat.reject', $candidat->id) }}" class="btn btn-danger">Rejeter</a>
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




                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>

<script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
<script src="https://cdn.datatables.net/2.3.1/js/dataTables.js"></script>
<script src="https://cdn.datatables.net/buttons/3.2.3/js/dataTables.buttons.js"></script>
<script src="https://cdn.datatables.net/buttons/3.2.3/js/buttons.dataTables.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdn.datatables.net/buttons/3.2.3/js/buttons.html5.min.js"></script>
<script>
    $(document).ready(function() {


        let table = new DataTable('#example', {
            layout: {
                topStart: {
                    buttons: ['excel'],
                }
            }
        });

        // $('#example').DataTable({
        //     // dom: 'Bfrtip',
        //     buttons: [
        //         'csv'
        //     ]
        // });


    });
</script>
<!-- /.content-wrapper -->
@endsection
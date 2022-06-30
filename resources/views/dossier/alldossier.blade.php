<x-app-layout/>

    <!-- Validation Errors -->
    <x-auth-validation-errors class="mb-4" :errors="$errors" />
    <div class="row">
            <div class="container col-md-7">
                <div class="card  mb-4">
                    <div class="card-header">
                        <h6 class="m-0 font-weight-bold text-primary">Liste des Dossiers de {{$patient->prenom}} {{$patient->nom}}</h6>
                    </div>
                    <div class="card-body">
                        <table id="datatablesSimple">
                            <thead>
                                <tr>
                                    <th>Numéro</th>
                                    <th>Date</th>
                                    <th>Etat</th>
                                    <th>Voir</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>Numéro</th>
                                    <th>Date</th>
                                    <th>Etat</th>
                                    <th>Voir</th>
                                </tr>
                            </tfoot>
                            <tbody>
                                @foreach($dossiers as $dossier)
                                    <tr>
                                        <td>{{$dossier->numero}}</td>
                                        <td>{{$dossier->date}}</td>
                                        @if($dossier->etat==1)
                                            <td>Actif</td>
                                        @else
                                            <td>Fermer</td>
                                        @endif
                                        <td><a class='btn btn-primary'  href= "{{route('getDossierbyId',['id'=>$dossier->id])}}">
                                        <i class="fas fa-eye fa-fw"></i>
                                            </a>
                                        </td>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            
       
</div>
    @include('layouts.footer')

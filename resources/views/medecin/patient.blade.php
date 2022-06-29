<x-app-layout/>

    <!-- Validation Errors -->
    <x-auth-validation-errors class="mb-4" :errors="$errors" />
    <div class="row">
            <div class="container ">
                <div class="card  mb-4">
                    <div class="card-header">
                        <h6 class="m-0 font-weight-bold text-primary">Liste des utilisateurs</h6>
                    </div>
                    <div class="card-body">
                        <table id="datatablesSimple">
                            <thead>
                                <tr>
                                    <th>Numéro</th>
                                    <th>Prénom</th>
                                    <th>Nom</th>
                                    <th>Dossier</th>
                                    <th>Rendez-vous</th>
                                    <th>Traitement</th>
                                    <th>Ordonance</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>Numéro</th>
                                    <th>Prénom</th>
                                    <th>Nom</th>
                                    <th>Dossier</th>
                                    <th>Rendez-vous</th>
                                    <th>Traitement</th>
                                    <th>Ordonance</th>
                                </tr>
                            </tfoot>
                            <tbody>
                                @foreach($patients as $patient)
                                    <tr>
                                        <td>{{$patient->numero}}</td>
                                        <td>{{$patient->prenom}}</td>
                                        <td>{{$patient->nom}}</td>
                                        <td><a class='btn btn-primary'  href= "{{route('listAntecedent',['id'=>$patient->id])}}">
                                        <i class="fas fa-folder-open fa-fw"></i>
                                            </a>
                                        </td>
                                        <td><a class='btn btn-primary'  href= "{{route('activeRV',['id'=>$patient->id])}}">
                                        <i class="fas fa-circle-plus fa-fw"></i>
                                            </a>
                                        </td>
                                        <td><a class='btn btn-primary'  href= "{{route('listAntecedent',['id'=>$patient->id])}}">
                                        <i class="fas fa-circle-plus fa-fw"></i>
                                            </a>
                                        </td>
                                        <td><a class='btn btn-primary'  href= "{{route('listAntecedent',['id'=>$patient->id])}}">
                                        <i class="fas fa-circle-plus fa-fw"></i>
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

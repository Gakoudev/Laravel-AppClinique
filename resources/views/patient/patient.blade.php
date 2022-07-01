<x-app-layout/>

    <!-- Validation Errors -->
    <x-auth-validation-errors class="mb-4" :errors="$errors" />
    <div class="row">
            <div class="container col-md-8">
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
                                    <th>Téléphone</th>
                                    <th>Date Naissance</th>
                                    <th>User</th>
                                    <th>Dossier</th>
                                    <th>Antécédent</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>Numéro</th>
                                    <th>Prénom</th>
                                    <th>Nom</th>
                                    <th>Téléphone</th>
                                    <th>Date Naissance</th>
                                    <th>User</th>
                                    <th>Dossier</th>
                                    <th>Antécédent</th>
                                </tr>
                            </tfoot>
                            <tbody>
                                @foreach($patients as $patient)
                                    <tr>
                                        <td>{{$patient->numero}}</td>
                                        <td>{{$patient->prenom}}</td>
                                        <td>{{$patient->nom}}</td>
                                        <td>{{$patient->telephone}}</td>
                                        <td>{{$patient->dateN}}</td>
                                        <td>{{$patient->user->prenom}} {{$patient->user->nom}}</td>
                                        <td><a class='btn btn-primary'  href= "{{route('getDossier',['id'=>$patient->id])}}">
                                        <i class="fas fa-folder-open fa-fw"></i>
                                            </a>
                                        </td>
                                        <td><a class='btn btn-primary'  href= "{{route('listAntecedent',['id'=>$patient->id])}}">
                                        <i class="fas fa-eye fa-fw"></i>
                                            </a>
                                        </td>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            
     <div class="container col-md-4"> 
        <div class="card"> 
            <div class="card-header">
                <h6 class="m-0 font-weight-bold text-primary">Formulaire d'ajout des utilisateurs</h6>
            </div>

            <form method="POST" action="{{ route('addpatient') }}">
                @csrf

                <!-- Prenom -->
                
                <div class="form-floating mb-3">   
                <input class="form-control" id="prenom" type="text" name="prenom" placeholder="prenom" required autofocus/>
                
                <label for="prenom">Prénom</label>                                   
                </div>

                <!-- Nom -->
                <div class="form-floating mb-3">   
                <input class="form-control" id="nom" type="text" name="nom" placeholder="nom" required autofocus/>
                
                <label for="nom">Nom</label> 
                
                <!-- Telephone -->
                <div class="form-floating mb-3">   
                <input class="form-control" id="telephone" type="text" name="telephone" placeholder="telephone" required autofocus/>
                
                <label for="telephone">Téléphone</label> 
                

                <!-- Date de Naissance -->
                <div class="form-floating mb-3">   
                <input class="form-control" id="dateN" type="date" name="dateN" placeholder="dateN" required />
                
                <label for="dateN">date</label>                                   
                </div>
                <div class="flex items-center justify-end mt-4">
                    <input type="submit" class="btn btn-primary" value="Ajouter"/>
                   
                </div>
            </form>
        </div>
    </div>
</div>
    @include('layouts.footer')

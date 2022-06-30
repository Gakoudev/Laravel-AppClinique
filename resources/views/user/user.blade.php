<x-app-layout/>

    <!-- Validation Errors -->
    <x-auth-validation-errors class="mb-4" :errors="$errors" />
    <div class="row">
            <div class="container col-md-7">
                <div class="card  mb-4">
                    <div class="card-header">
                        <h6 class="m-0 font-weight-bold text-primary">Liste des utilisateurs</h6>
                    </div>
                    <div class="card-body">
                        <table id="datatablesSimple">
                            <thead>
                                <tr>
                                    <th>Prénom</th>
                                    <th>Nom</th>
                                    <th>Téléphone</th>
                                    <th>Email</th>
                                    <th>Statut</th>
                                    <th>Etat</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>Prénom</th>
                                    <th>Nom</th>
                                    <th>Téléphone</th>
                                    <th>Email</th>
                                    <th>Statut</th>
                                    <th>Etat</th>
                                </tr>
                            </tfoot>
                            <tbody>
                                @foreach($users as $user)
                                    <tr>
                                        <td>{{$user->prenom}}</td>
                                        <td>{{$user->nom}}</td>
                                        <td>{{$user->telephone}}</td>
                                        <td>{{$user->email}}</td>
                                        @if($user->role==1)
                                        <td >ADMIN</td>
                                        @elseif($user->role==2)
                                            <td>SECRETAIRE</td>
                                        @else
                                            <td>MEDECIN</td>
                                        @endif
                                        @if($user->etat==1)
                                        <td ><a class='btn btn-primary'  href= "{{route('updateUser',['id'=>$user->id])}}"><i class='far fa-fw fa-check-circle'></a></td>
                                        @else
                                        <td><a class='btn btn-danger'  href= "{{route('updateUser',['id'=>$user->id])}}"><i class='fas fa-fw fa-times-circle'></a></td>
                                        @endif
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            
     <div class="container col-md-5"> 
        <div class="card"> 
            <div class="card-header">
                <h6 class="m-0 font-weight-bold text-primary">Formulaire d'ajout des utilisateurs</h6>
            </div>

            <form method="POST" action="{{ route('adduser') }}">
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
                

                <!-- Email Address -->
                <div class="form-floating mb-3">   
                <input class="form-control" id="email" type="email" name="email" placeholder="name@example.com" required />
                
                <label for="email">Email address</label>                                   
                </div>
                <!-- Role -->
                <div class="form-floating mb-3"> 
                    <select id="role" class="form-control"  name="role" >
                        <option>Faite un choix</option>
                        @foreach($roles as $role)
                            <option class="form-control" value="{{$role->id}}">{{$role->nom}}</option>
                        @endforeach
                    </select>
                    <label for="role">Rôle</label> 

                </div>

                <div class="flex items-center justify-end mt-4">
                    <input type="submit" class="btn btn-primary" value="Ajouter"/>
                   
                </div>
            </form>
        </div>
    </div>
</div>
    @include('layouts.footer')

<x-app-layout/>

    <!-- Validation Errors -->
    <x-auth-validation-errors class="mb-4" :errors="$errors" />
        <div class="row">
            <div class="container col-md-7">
                <div class="card  mb-4">
                    <div class="card-header">
                        <h6 class="m-0 font-weight-bold text-primary">Liste des antécédents de {{$patient->prenom}} {{$patient->nom}}</h6>
                    </div>
                    <div class="card-body">
                        <table id="datatablesSimple">
                            <thead>
                                <tr>
                                    <th>Libellé</th>
                                    <th>Détail</th>
                                    <th>Supprimer</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>Libellé</th>
                                    <th>Détail</th>
                                    <th>Supprimer</th>
                                </tr>
                            </tfoot>
                            <tbody>
                                @foreach($antecedents as $antecedent)
                                    <tr>
                                        <td>{{$antecedent->detail}}</td>
                                        <td>{{$antecedent->libelle}}</td>
                                        <td><a class='btn btn-danger'  href= "{{route('deleteAntecedent',['id'=>$antecedent->id])}}">
                                            <i class="fas fa-trash-can fa-fw"></i>
                                            </a>
                                        </td>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            
            <div class="container col-md-5"> 
               <div class="card"> 
                   <div class="card-header">
                       <h6 class="m-0 font-weight-bold text-primary">Formulaire d'ajout d'antecedent</h6>
                   </div>
       
                   <form method="POST" action="{{ route('addAntecedent',['id'=>$patient->id]) }}">
                       @csrf
                       <!-- Libelle -->
                       
                       <div class="form-floating mb-3">   
                       <input class="form-control" id="libelle" type="text" name="libelle" placeholder="libelle" required autofocus/>
                       
                       <label for="libelle">Libelle</label>   
       
                       <!-- Détail -->
                       
                       <div class="form-floating mb-3">   
                       <input class="form-control" id="detail" type="text" name="detail" placeholder="detail" required autofocus/>
                       
                       <label for="detail">Détail</label>                                   
                       </div>

                       <!-- Bouton  Ajouter-->

                       <div class="flex items-center justify-end mt-4">
                           <input type="submit" class="btn btn-primary" value="Ajouter"/>
                        
                       </div>
       
                      
                   </form>
               </div>
           </div>
       </div>
    @include('layouts.footer')

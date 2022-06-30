<x-app-layout/>

    <!-- Validation Errors -->
    <x-auth-validation-errors class="mb-4" :errors="$errors" />
    <div class="row">
            <div class="container col-md-7">
                <div class="card  mb-4">
                    <div class="card-header">
                        <h6 class="m-0 font-weight-bold text-primary">Liste des traitements de {{$patient->prenom}} {{$patient->nom}}</h6>
                    </div>
                    <div class="card-body">
                        <table id="datatablesSimple">
                            <thead>
                                <tr>
                                    <th>Date</th>
                                    <th>Libellé</th>
                                    <th>Detail</th>
                                    <th>Prix</th>
                                    <th>Medecin</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>Date</th>
                                    <th>Libellé</th>
                                    <th>Detail</th>
                                    <th>Prix</th>
                                    <th>Medecin</th>
                                </tr>
                            </tfoot>
                            <tbody>
                                @isset($traitements )
                                @foreach($traitements as $traitement)
                                    <tr>
                                        <td>{{$traitement->date}}</td>
                                        <td>{{$traitement->libelle}}</td>
                                        <td >{{$traitement->detail}}</td>
                                        <td>{{$traitement->prix}}</td>
                                        <td>{{$traitement->user}}</td>
                                @endforeach
                                @endisset
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            
        <div class="container col-md-5"> 
            <div class="card"> 
                <div class="card-header">
                    <h6 class="m-0 font-weight-bold text-primary">Formulaire ajout traitement</h6>
                </div>
                    <form method="POST" action="{{ route('addTraitement',['id'=>$patient->id] ) }}">
                        @csrf
                        <!-- libelle -->
                        
                        <div class="form-floating mb-3">   
                        <input class="form-control" id="libelle" type="text" name="libelle" placeholder="libelle" required autofocus/>
                        
                        <label for="libelle">libelle</label>   
                        </div>

                        <!-- Détail -->
                        
                        <div class="form-floating mb-3">   
                        <input class="form-control" id="detail" type="text" name="detail" placeholder="detail" required autofocus/>
                        
                        <label for="detail">Détail</label>
                        </div>

                        
                        <!-- Prix -->
                        
                        <div class="form-floating mb-3">   
                        <input class="form-control" id="prix" type="number" name="prix" placeholder="prix" required autofocus/>
                        
                        <label for="prix">Prix</label>   
                        </div>
                        <!-- Date RV -->
                        <div class="form-floating mb-3">   
                        <input class="form-control" id="date" type="date" name="date" placeholder="date" required />
                        
                        <label for="date">date</label>                                   
                        </div>
                        <div class="flex items-center justify-end mt-4">
                            <input type="submit" class="btn btn-primary" value="Ajouter"/>
                        
                        </div>
                    </form>
            </div>
        </div>
</div>
<div class="row">

<div class="container col-md-5"> 
<div class="flex items-center justify-end mt-4">
<a href= "{{route('listRV',['id'=>$patient->id])}}"><input type="submit" class="btn btn-primary" value="Nouveau RV"/></a>
</div>
</div>
</div>
    @include('layouts.footer')

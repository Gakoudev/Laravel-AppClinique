<x-app-layout/>

    <!-- Validation Errors -->
    <x-auth-validation-errors class="mb-4" :errors="$errors" />
    <div class="row">
            <div class="container col-md-7">
                <div class="card  mb-4">
                    <div class="card-header">
                        <h6 class="m-0 font-weight-bold text-primary">Liste des prescritions de {{$patient->prenom}} {{$patient->nom}}</h6>
                    </div>
                    <div class="card-body">
                        <table id="datatablesSimple">
                            <thead>
                                <tr>
                                    <th>Libellé</th>
                                    <th>Detail</th>
                                    <th>Quantité</th>
                                    @if($etat==1)   
                                    <th>Supprimer</th>
                                    @endif
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>Libellé</th>
                                    <th>Detail</th>
                                    <th>Quantité</th>
                                    @if($etat==1)   
                                    <th>Supprimer</th>
                                    @endif
                                </tr>
                            </tfoot>
                            <tbody>
                                @isset($prescriptions)
                                @foreach($prescriptions as $prescription)
                                    <tr>
                                        <td>{{$prescription->libelle}}</td>
                                        <td >{{$prescription->detail}}</td>
                                        <td>{{$prescription->quantite}}</td>
                                        @if($etat==1)  
                                        <td><a class='btn btn-danger'  href= "{{route('deletePrescription',['id'=>$prescription->id])}}">
                                            <i class="fas fa-trash-can fa-fw"></i>
                                            </a>
                                        </td> 
                                        @endif
                                @endforeach
                                @endisset
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        @if($etat==1)    
        <div class="container col-md-5"> 
            <div class="card"> 
                <div class="card-header">
                    <h6 class="m-0 font-weight-bold text-primary">Formulaire ajout prescription</h6>
                </div>
                    <form method="POST" action="{{ route('addPrescription',['id'=>$patient->id] ) }}">
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

                        
                        <!-- quantite -->
                        
                        <div class="form-floating mb-3">   
                        <input class="form-control" id="quantite" type="number" name="quantite" placeholder="quantite" required autofocus/>
                        
                        <label for="quantite">Quantité</label>   
                               
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
<a href= "{{route('activeRV',['id'=>$patient->id])}}"><input type="submit" class="btn btn-primary" value="Nouveau RV"/></a>
</div>
</div>
</div>
@else
    <div class="row">
            <div class="container col-md-2">
                <div class="flex items-center justify-end mt-3 col-md-5">
                        <a href= "{{route('ordonancePDF',['id'=>$prescription->ordonance])}}"><input type="submit" class="btn btn-primary" value="Générer Facture"/></a>
                </div>
            </div>
    </div>
</div>
@endif

    @include('layouts.footer')

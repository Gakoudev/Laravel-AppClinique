<x-app-layout/>

    <!-- Validation Errors -->
    <x-auth-validation-errors class="mb-4" :errors="$errors" />
    <div class="row">
            <div class="container col-md-6">
                <div class="card  mb-4">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-md-7 mt-4">
                        <h6 class="m-0 font-weight-bold text-primary">Information du Patient</h6>
                            </div>
                            @if($etat==1 || $etat==2)
                            <div class="flex items-center justify-end mt-3 col-md-5">
                                 <a href= "{{route('getAllDossier',['id'=>$patient->id])}}"><input type="submit" class="btn btn-primary" value="Tout les Dossiers"/></a>
                            </div>
                            @endif
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4">
                                <label >Numéro</label> 
                            </div>
                            <div class="col-md-3">
                                <label >{{$patient->numero}}</label> 
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4">
                                <label >Prénom</label> 
                            </div>
                            <div class="col-md-3">
                                <label >{{$patient->prenom}}</label> 
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-4">
                                <label >Nom</label> 
                            </div>
                            <div class="col-md-3">
                                <label >{{$patient->nom}}</label> 
                            </div>
                        </div>    

                        <div class="row">
                            <div class="col-md-4">
                                <label >Téléphone</label> 
                            </div col-md-2>
                            <div class="col-md-3">
                                <label >{{$patient->telephone}}</label> 
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4">
                                <label >Date de naissance</label> 
                            </div >
                            <div class="col-md-3">
                                <label >{{$patient->dateN}}</label> 
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            
            <div class="container col-md-5">
                <div class="card  mb-4">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-md-7 mt-4">
                                 <h6 class="m-0 font-weight-bold text-primary">Liste des Antécédents</h6>
                            </div>
                            @if($etat==1 || $etat==2)
                            <div class="flex items-center justify-end mt-3 col-md-5">
                                 <a href= "{{route('listAntecedent',['id'=>$patient->id])}}"><input type="submit" class="btn btn-primary" value="Nouveau Antécédent"/></a>
                            </div>
                            @endif
                        </div>
                    </div>
                    <div class="card-body">
                        <table id="datatablesSimple3">
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
    </div>


    <div class="row">
            <div class="container col-md-6">
                <div class="card  mb-4">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-md-7 mt-4">
                                 <h6 class="m-0 font-weight-bold text-primary">Liste des Traitements</h6>
                            </div>
                            @if($etat==1)
                            <div class="flex items-center justify-end mt-3 col-md-5">
                                 <a href= "{{route('listTraitement',['id'=>$patient->id])}}"><input type="submit" class="btn btn-primary" value="Nouveau Traitement"/></a>
                            </div>
                            @endif
                        </div>
                    </div>
                    <div class="card-body">
                        <table id="datatablesSimple2">
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
                                @foreach($traitements as $traitement)
                                    <tr>
                                        <td>{{$traitement->date}}</td>
                                        <td>{{$traitement->libelle}}</td>
                                        <td >{{$traitement->detail}}</td>
                                        <td>{{$traitement->prix}}</td>
                                        <td>{{$traitement->user->prenom}} {{$traitement->user->nom}}</td>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            
        
            <div class="container col-md-5">
                <div class="card  mb-4">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-md-7 mt-4">
                                 <h6 class="m-0 font-weight-bold text-primary">Liste des Ordonnances</h6>
                            </div>
                            @if($etat==1)
                            <div class="flex items-center justify-end mt-3 col-md-5">
                                 <a href= "{{route('listPrescription',['id'=>$patient->id])}}"><input type="submit" class="btn btn-primary" value="Nouvelle Ordonance"/></a>
                            </div>
                            @endif
                        </div>
                    </div>
                    <div class="card-body">
                        <table id="datatablesSimple">
                            <thead>
                                <tr>
                                    <th>Identifiant</th>
                                    <th>Date</th>
                                    <th>Medecin</th>
                                    <th>Voir</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>Identifiant</th>
                                    <th>Date</th>
                                    <th>Medecin</th>
                                    <th>Voir</th>
                                </tr>
                                </tr>
                            </tfoot>
                            <tbody>
                                @foreach($ordonances as $ordonance)
                                    <tr>
                                        <td>{{$ordonance->id}}</td>
                                        <td>{{$ordonance->created_at}}</td>
                                        <td>{{$ordonance->user->prenom}} {{$ordonance->user->nom}}</td>
                                        <td><a class='btn btn-primary'  href= "{{route('getByOrdonance',['id'=>$ordonance->id])}}">
                                        <i class="fas fa-eye fa-fw"></i>
                                            </a>
                                        </td>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        
            <div class="container col-md-2">    
            @if( $etat==2)
                <div class="flex items-center justify-end mt-3 col-md-5">
                        <a href= "{{route('facturePDF',['id'=>$ordonances[0]->facture])}}"><input type="submit" class="btn btn-primary" value="Générer Facture"/></a>
                </div>
            @endif
            </div>
    </div>
    @include('layouts.footer')

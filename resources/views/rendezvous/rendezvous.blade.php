<x-app-layout/>

    <!-- Validation Errors -->
    <x-auth-validation-errors class="mb-4" :errors="$errors" />
    <div class="row">
            <div class="container col-md-7">
                <div class="card  mb-4">
                    <div class="card-header">
                        <h6 class="m-0 font-weight-bold text-primary">Liste des rendez vous de {{$patient->prenom}} {{$patient->nom}}</h6>
                    </div>
                    <div class="card-body">
                        <table id="datatablesSimple">
                            <thead>
                                <tr>
                                    <th>Date RV</th>
                                    <th>Detail</th>
                                    <th>Etat</th>
                                    <th>Medecin</th>
                                    <th>Modifier</th>
                                    <th>Fin RV</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>Date RV</th>
                                    <th>Detail</th>
                                    <th>Etat</th>
                                    <th>Medecin</th>
                                    <th>Modifier</th>
                                    <th>Fin RV</th>
                                </tr>
                            </tfoot>
                            <tbody>
                                @foreach($rendezvous as $rv)
                                    @isset($rv->dateRV)
                                    <tr>
                                        <td>{{$rv->dateRV}}</td>
                                        <td>{{$rv->detail}}</td>
                                        <td >à venir</td>
                                        <td>{{$rv->user}}</td>
                                        <td><a class='btn btn-primary'  href= "{{route('decalerRV',['id'=>$rv->id])}}">
                                        <i class="fas fa-thumbs-up fa-fw"></i>
                                            </a>
                                        </td>
                                        <td><a class='btn btn-primary'  href= "{{route('finRV',['id'=>$rv->id])}}">
                                        <i class="fas fa-thumbs-up fa-fw"></i>
                                            </a>
                                        </td>
                                    @endisset
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            
        <div class="container col-md-5"> 
            <div class="card"> 
                <div class="card-header">
                    <h6 class="m-0 font-weight-bold text-primary">Formulaire d'ajout de rendez-vous</h6>
                </div>
                @isset($update)
                @if($update==0)
                    <form method="POST" action="{{ route('addRV',['id'=>$patient->id] ) }}">
                        @csrf
                        <!-- Détail -->
                        
                        <div class="form-floating mb-3">   
                        <input class="form-control" id="detail" type="text" name="detail" placeholder="detail" required autofocus/>
                        
                        <label for="detail">Détail</label>   

                        

                        <!-- Date RV -->
                        <div class="form-floating mb-3">   
                        <input class="form-control" id="dateRV" type="date" name="dateRV" placeholder="dateRV" required />
                        
                        <label for="dateRV">date</label>                                   
                        </div>
                        <div class="flex items-center justify-end mt-4">
                            <input type="submit" class="btn btn-primary" value="Ajouter"/>
                        
                        </div>
                    </form>
                @else
                    <form method="POST" action="{{ route('updateRV',['id'=>$rendezvous->id] ) }}">
                        @csrf
                        <!-- Détail -->
                        
                        <div class="form-floating mb-3">   
                        <input class="form-control" id="detail" type="text" name="detail" placeholder="detail"  required autofocus/>
                        
                        <label for="detail">{{$rendezvous->detail}}</label>   

                        

                        <!-- Date RV -->
                        <div class="form-floating mb-3">   
                        <input class="form-control" id="dateRV" type="date" name="dateRV" placeholder="dateRV" value="" required />
                        
                        <label for="dateRV">{{$rendezvous->dateRV}}</label>                                   
                        </div>
                        <div class="flex items-center justify-end mt-4">
                            <input type="submit" class="btn btn-primary" value="Décaler"/>
                        
                        </div>
                    </form>
                @endif
                @endisset
            </div>
        </div>
</div>
    @include('layouts.footer')

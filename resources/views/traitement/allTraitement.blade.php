<x-app-layout/>

    <!-- Validation Errors -->
    <x-auth-validation-errors class="mb-4" :errors="$errors" />
    <div class="row">
            <div class="container col-md-7">
                <div class="card  mb-4">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-md-7 mt-4">
                            <h6 class="m-0 font-weight-bold text-primary">Liste des tout les traitements de {{$patient->prenom}} {{$patient->nom}}</h6>
                            </div>
                            <div class="flex items-center justify-end mt-3 col-md-5">
                                <a href= "{{route('listTraitement',['id'=>$patient->id])}}"><input type="submit" class="btn btn-primary" value="traitements en cours"/></a>
                            </div>
                        </div>
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
                                        <td>{{$traitement->user->prenom}} {{$traitement->user->nom}}</td>
                                @endforeach
                                @endisset
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        
        </div>
<div class="row">

<div class="container col-md-2"> 
<div class="flex items-center justify-end mt-4 mb-4">
<a href= "{{route('activeRV',['id'=>$patient->id])}}"><input type="submit" class="btn btn-primary" value="Nouveau RV"/></a>
</div>
</div>
</div>
    @include('layouts.footer')

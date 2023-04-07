@extends('index')
@section('section')
<h3>{{ "Liste des recttes" }}</h3>
<table class="table table-striped">
  <tr><th>Titre</th><th>Ingrédients</th><th>Photo</th><th>Durée</th></tr>
  @foreach ($recettes as $recette)
  <tr><td>{{$recette->titre}}</td><td>{{$recette->ingredients}}</td><td><img src="{{$recette->photo}}"></td><td>{{$recette->duree}}</td></tr>
  @endforeach
  </table>
@stop
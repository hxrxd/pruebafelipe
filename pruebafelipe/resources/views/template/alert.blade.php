@if(count($errors) > 0)
<div class="alert alert-warning alert-dismissible" role="alert">
  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  <strong>Errores</strong> 
  <ul>
    @foreach($errors->all() as $er)
    <li>
        {!! $er !!}
    </li>
    @endforeach    
  </ul>
</div>
@endif
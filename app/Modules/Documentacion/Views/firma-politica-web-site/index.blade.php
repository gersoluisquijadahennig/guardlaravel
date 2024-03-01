@extends('layouts.portal')
@section('content')
  <ul class="nav nav-tabs" id="myTab" role="tablist">
      <li class="nav-item" role="presentation">
        <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button" role="tab" aria-controls="home" aria-selected="true">Home</button>
      </li>
      <li class="nav-item" role="presentation">
        <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="false">Profile</button>
      </li>
      <li class="nav-item" role="presentation">
        <button class="nav-link" id="contact-tab" data-bs-toggle="tab" data-bs-target="#contact" type="button" role="tab" aria-controls="contact" aria-selected="false">Contact</button>
      </li>
    </ul>
    <div class="tab-content" id="myTabContent">
      <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
        <div class="col-xs-12 col-md-12 quitar-padding-div" style="margin-bottom: 5px;">
          <div class="box-header with-border" style="background-color:#3c8dbc;color:#FFF;text-align:center;padding-top:7px;padding-bottom:7px;">
            <h3 class="box-title" style="font-size: 15px;  font-weight: bolder">
              <em class="fa fa-file-pdf-o"></em>&nbsp;Documentos por firmar.
            </h3>
          </div>
        </div>
        <div class="box-header with-border" style="margin-top:50px;margin-left:15px;margin-right:15px; padding-bottom:5px; padding-left:20px; border: 1px solid #3C8DBC; border-radius: 5px;">
          A continuación le presentamos todos los documentos contractuales que se han generado en su proceso de cambio de plan. Estos quedarán firmados una vez que usted haya presionado el botón "firmar documentos".
        </div>   
      </div>
      <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
        
      </div>
      <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
        
      </div>
    </div>
  @endsection

  @section('js')
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
  @endsection
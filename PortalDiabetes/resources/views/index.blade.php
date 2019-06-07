@extends('layouts.plantilla')

@section('content')
<section id="about" class="about-section text-center">
    <div class="container">
      <div class="row">
        <div class="col-lg-8 mx-auto">
          <h2 class="text-white mb-4">¿Cuáles son los diferentes tipos de diabetes?</h2>
          <p class="text-white-50">Existen dos tipos de diabetes: diabetes tipo 1 y diabetes tipo 2. </p>
          <div class="row" style="background: none;">
            <div class="card col-sm text-white" style="width: 18rem; background: none; border:none;" >
                <img class="card-img-top" width="350" height="178" src="https://www.informacionsobrediabetes.com/wp-content/uploads/2017/06/Informacion_Sobre_Diabetes_Insulina_para_la_Diabetes_Tipo_2_830x420px.jpg" alt="Diabetes tipo I">
                <div class="card-body">
                  <p class="card-text text-justify">En la diabetes Tipo 1 (también llamada juvenil o insulino- dependiente), del cuerpo deja de producir completamente insulina, una hormona que le permite al organismo utilizar la glucosa proveniente de comidas para producir energía.

                        Los pacientes con diabetes tipo 1 deben utilizar inyecciones de insulina diariamente para sobrevivir.Esta forma o tipo de diabetes generalmente se desarrolla en niños o adultos jóvenes, pero puede ocurrir a cualquier edad. </p>
                </div>
            </div>

            <div class="card col-sm text-white" style="width: 18rem; background: none; border:none;">
                    <img class="card-img-top" width="350" height="178" src="https://st1.uvnimg.com/dims4/default/94220d3/2147483647/crop/2232x1256%2B0%2B287/resize/400x225/quality/75/?url=https%3A%2F%2Fuvn-brightspot.s3.amazonaws.com%2F42%2Fac%2F855f10ca49e6ae680e4716920956%2F546547568.png" alt="Card image cap">
                    <div class="card-body">
                      <p class="card-text text-justify">La diabetes tipo 2 (también llamada de inicio tardío o no-insulino dependiente) resulta cuando el organismo no produce suficiente insulina y/o es incapaz de utilizar la insulina adecuadamente (resistencia a la insulina).

                            Esta forma de diabetes generalmente ocurre en pacientes mayores de 40 años, con sobrepeso y que tienen historia familiar de diabetes. Recientemente se ha visto un aumento en personas más jóvenes, particularmente adolescentes. </p>
                    </div>
            </div>
          </div>
        </div>
      </div>
      <img src="" class="img-fluid" alt="">
    </div>
  </section>
@endsection

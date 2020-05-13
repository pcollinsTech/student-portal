<div class="slide">
  <h4 class="step-title">Fill the all the checkbox bellow</h4>


  <form class="w-100">
    <div class="row">

      @include('application.steps.charater_declarations' ,['disabled' => false])
      @include('application.steps.health_declarations', ['disabled' => false])



    </div>

    {{-- Nav Controls --}}
    <div class="row">
      <section class="col-lg-12">
        <div class="card card-application right">
          <div class="section-controls">

            <div class="btn btn-sm btn-primary btn-prev" @click="slider.prev()">
              <i class="fa fa-angle-left mr-1"></i>
              PREV</div>
            <div class="btn btn-sm btn-primary btn-next ml-1" @click="slider.next()">
              NEXT
              <i class="fa fa-angle-right ml-1"></i>
            </div>
          </div>
        </div>
    </div>
  </form>

</div>
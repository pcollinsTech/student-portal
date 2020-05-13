<div class="slide">

  <h4 class="step-title">Placements</h4>

  {{-- Pharmacies --}}
  <div class="row">
    <section class="col-lg-12">

      <div class="card card-application right">

        <div class="title">
          Placements
        </div>

        <div class="description">
          Select if you will be undertaking your placement at 1 Pharmacy for 12 months or 2 separate Pharmacies for
          6 months each
        </div>

        <VToggleButtons class="text-center" v-model="pharmaciesCount" :fn="updatePharmacies"
          :items="{{ $utils->pharmaciesOptions() }}">
        </VToggleButtons>

        <form v-for="(pharmacie, index) in form.pharmacies" :key="index" class="mb-3">
          <VSelect :error="form.getErrorFromMessage('pharmacies',`index-${index}`, 'Must Select a Pharmacie')" label="Choose a Pharmacie" v-model="pharmacie.id" :items="{{ $utils->pharmacies()}}">
          </VSelect>
          <VDate label="Placement Start Date" v-model="pharmacie.placement_start"></VDate>
          <VDate label="Placement End Date" v-model="pharmacie.placement_end"></VDate>
        </form>


    </section>
  </div> {{-- Tutors --}} <div class="row">
    <section class="col-lg-12">
      <div class="card card-application right">

        <div class="title">
          Tutors
        </div>

        <div class="description">
          Select 1 Tutor for 12 months or 2 Tutors if undertaking two six month placements.
        </div>


        <VToggleButtons class="text-center" v-model="tutorsCount" :fn="updateTutors"
          :items="{{ $utils->tutorsOptions() }}">
        </VToggleButtons>

        <form v-for="(tutor, index) in form.tutors" :key="index" class="mb-3">
          <VSelect :error="form.getErrorFromMessage('tutors',`index-${index}`, 'Must Select a Tutor')" label="Choose a Tutor" v-model="tutor.id" :items="{{ $utils->tutors()}}">
          </VSelect>
          <VDate label="Tutor Start Date" v-model="tutor.tutor_start"></VDate>
          <VDate label="Tutor End Date" v-model="tutor.tutor_end"></VDate>
        </form>
    </section>
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

</div>
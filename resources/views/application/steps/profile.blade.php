<div class="slide">
  <h4 class="step-title">Fill the fields on each section</h4>

  <form class="w-100">
    <div class="row">
      <section class="col-lg-12">

        <div class="card card-application left">
          <div class="title">Personal Details</div>


          <div class="row">

            <div class="col-lg-2">
              <VSelect label="Title" :error="form.getError('title')" :items="{{ $utils->titles(true) }}"
                v-model="form.title">
              </VSelect>

            </div>
            <div class="col-lg-5">
              <VInput :error="form.getError('forenames')" placeholder="Forenames"
                label="Forename (as on birth certificate)" v-model="form.forenames"></VInput>
            </div>
            <div class="col-lg-5">
              <VInput :error="form.getError('surname')" placeholder="Surname" label="Surname" v-model="form.surname">
              </VInput>
            </div>

          </div>

          <div class="row">

            <div class="col-lg-6">
              <VInput :error="form.getError('known_as')" placeholder="Know As" label="Known As" v-model="form.known_as">
              </VInput>
            </div>


            <div class="col-lg-6">
              <VInput :error="form.getError('previous_name')" placeholder="Previous Name" label="Previous Name"
                v-model="form.previous_name">
              </VInput>
            </div>

          </div>



          <div class="row">
            <div class="col-lg-6">
              <VInput :error="form.getError('email')" placeholder="Email" label="Email" v-model="form.email"></VInput>
            </div>
            <div class="col-lg-6">
              <VDate :error="form.getError('date_of_birth')" label="Date of Birth" v-model="form.date_of_birth"></VDate>
            </div>

          </div>

          <div class="row">
            <div class="col-lg-6">
              <VInput data-type="password" :error="form.getError('password')" placeholder="Enter Password"
                label="Password" v-model="form.password"></VInput>
            </div>
            <div class="col-lg-6">
              <VInput data-type="password" label="Repeat Password" placeholder="Confirm Password"
                v-model="form.password_confirmation"></VInput>
            </div>

          </div>
        </div>




      </section>

      <section class="col-lg-12">
        <div class="card card-application right">
          <div class="title">Address</div>

          <div class="row">

            <div class="col-lg-6">

              <div class="row">
                <div class="col-lg-12">
                  <VInput :error="form.getError('home_address_1')" label="Home Address Line 1"
                    v-model="form.home_address_1"></VInput>
                </div>
                <div class="col-lg-12">
                  <VInput label="Home Address Line 2" v-model="form.home_address_2"></VInput>
                </div>
                <div class="col-lg-12">
                  <VInput :error="form.getError('city')" label="Town / City" v-model="form.city"></VInput>
                </div>


              </div>

            </div>

            <div class="col-lg-6">

              <div class="row">
                <div class="col-lg-12">
                  <VInput :error="form.getError('phone_mobile')" label="Contact Number - Mobile"
                    v-model="form.phone_mobile"></VInput>
                </div>
                <div class="col-lg-12">
                  <VInput label="Contact Number - Home" v-model="form.phone_home"></VInput>
                </div>
                <div class="col-lg-7">
                  <Counties :error="form.getError('county')" label="County" v-model="form.county">
                  </Counties>
                </div>
                <div class="col-lg-5">
                  <VInput :error="form.getError('postcode')" label="Postcode" v-model="form.postcode"></VInput>
                </div>
              </div>

            </div>



          </div>


        </div>

      </section>




      <section class="col-lg-12">
        <div class="card card-application left">
          <div class="title">Education</div>

          <VSelect label="University" v-model="form.university_id" :error="form.getError('university_id')"
            :items="{{ $utils->universities() }}">
          </VSelect>

          <VDate :error="form.getError('entry_date')" label="Entry Date to Degree Course" v-model="form.entry_date">
          </VDate>

          <VDate :error="form.getError('completion_date')" label="Degree Course Completion"
            v-model="form.completion_date"></VDate>


          <VSwitchInline v-model="form.previous_training">
            <div>
              Previous Training
            </div>

            <template v-slot:extra>
              Details of Previous Training
            </template>

          </VSwitchInline>


      </section>


      {{-- Declarations --}}
      @include('application.steps.declarations_zero', ['disabled' => false])


      {{-- Nav Controls --}}

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
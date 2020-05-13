<div class="slide">

  <h4 class="step-title">Review your application and Complete Payment</h4>
  <div class="row">
    <div class="col-lg-7">

      <div class="row">
        <section class="col-lg-12">

          <div class="card card-application right">

            <div class="icon-edit" :class="{'edit': slider.edit }" @click="slider.setEditMode">
              <i v-if="slider.edit" class="fa fa-save"></i>
              <i v-else class="fa fa-pencil"></i>
            </div>
            <div class="title">
              Your Application
            </div>

            {{-- Name --}}
            <div class="row">
              <div class="col-lg-12 title-info">
                Profile
              </div>

              <div class="col-lg-3">Name</div>
              <div class="col-lg-9">
                <div class="row">
                  <div class="col-lg-6">
                    <VInput :disabled="true" v-model="form.forenames">
                    </VInput>
                  </div>
                  <div class="col-lg-6">
                    <VInput :disabled="true" v-model="form.surname"></VInput>
                  </div>
                </div>


              </div>
            </div>


            {{-- Address --}}
            <div class="row">
              <div class="col-lg-3">Address</div>
              <div class="col-lg-9">
                <VInput :disabled="true" v-model="form.home_address_1"></VInput>
              </div>
            </div>

            <div v-if="form.home_address_2 != null && form.home_address_2.length > 0" class="row">
              <div class="col-lg-3">Address Line 2</div>
              <div class="col-lg-9">
                <VInput :disabled="true" v-model="form.home_address_2"></VInput>
              </div>
            </div>

            <div class="row">
              <div class="col-lg-3">Postcode</div>
              <div class="col-lg-9">
                <VInput :disabled="true" v-model="form.postcode"></VInput>
              </div>
            </div>


            {{-- Birthdate --}}

            <div class="row">
              <div class="col-lg-3">Birthdate</div>
              <div class="col-lg-9">
                <VDate :disabled="true" :error="form.getError('date_of_birth')" v-model="form.date_of_birth"></VDate>
              </div>
            </div>



            <div class="row">
              <div class="col-lg-12 title-info">
                Education
              </div>

              <div class="col-lg-12">

                <VSelect :disabled="true" label="University" v-model="form.university_id"
                  :error="form.getError('university_id')" :items="{{ $utils->universities() }}">
                </VSelect>

                <VDate :disabled="true" :error="form.getError('entry_date')" label="Entry Date to Degree Course"
                  v-model="form.entry_date">
                </VDate>

                <VDate :disabled="true" :error="form.getError('completion_date')" label="Degree Course Completion"
                  v-model="form.completion_date"></VDate>

                <VSwitchInline :disabled="true" :error="form.getError('previous_training.checked')"
                  v-model="form.previous_training">
                  <div>
                    Previous Training
                  </div>

                  <template v-slot:extra>
                    Details of Previous Training
                  </template>

                </VSwitchInline>

              </div>
            </div>




            {{-- Placements --}}
            <div class="row" v-if=" form.pharmacies.length > 0">
              <div class="col-lg-12 title-info">
                Placements
              </div>
              <div class="col-lg-12">
                <form v-for="(pharmacie, index) in form.pharmacies" :key="index" class="mb-3">

                  <VSelect :disabled="true" label="Choose a Pharmacie" v-model="pharmacie.id"
                    :items="{{ $utils->pharmacies()}}">
                  </VSelect>
                  <VDate :disabled="true" label="Placement Start Date" v-model="pharmacie.placement_start"></VDate>
                  <VDate :disabled="true" label="Placement End Date" v-model="pharmacie.placement_end"></VDate>
                </form>
              </div>
            </div>


            {{-- Tutors --}}
            <div class="row" v-if=" form.tutors.length > 0">
              <div class="col-lg-12">
                Tutors
                <hr>
              </div>
              <div class="col-lg-12">
                <form v-for="(tutor, index) in form.tutors" :key="index" class="mb-3">
                  <VSelect :disabled="true" label="Choose a Tutor" v-model="tutor.id" :items="{{ $utils->tutors()}}">
                  </VSelect>
                  <VDate :disabled="true" label="Tutor Start Date" v-model="tutor.tutor_start"></VDate>
                  <VDate :disabled="true" label="Tutor End Date" v-model="tutor.tutor_end"></VDate>

                </form>

              </div>
            </div>


            {{-- Save Submit --}}
            <div class="row">
              <div class="col-lg-12 text-center">
                <button @click="submitApplication" class="btn btn-primary">SAVE APPLICATION</button>
              </div>
            </div>
          </div>
        </section>
      </div>


      <div class="row">

        @include('application.steps.declarations_zero', ['disabled' => true])

      </div>

      <div class="row">

        @include('application.steps.charater_declarations', ['disabled' => true])

      </div>

      <div class="row">

        @include('application.steps.health_declarations', ['disabled' => true])

      </div>
    </div>



    <div class="col-lg-5">

      <div class="row">
        <section class="col-lg-12">

          <div class="card card-application right">

            <div class="title">
              Payment
            </div>



            {{-- Declined --}}
            <div
              v-if="(form.payment.status === 'declined' || form.payment.status === 'created' || form.payment.status === null) && !paymentControlActive"
              class="row card-controls">

              <div v-if="form.payment.status === 'declined'" class="icons">
                <i class="fa fa-credit-card"></i>
                <i class="fa fa-ban"></i>
              </div>

              <div v-if="form.payment.status === 'created' || form.payment.status === null" class="icons">
                <i class="fa fa-credit-card"></i>
              </div>


              <div v-if="form.payment.status === 'declined' " class="payment-status">
                Your payment of 206 £ has been declined, please try again !
              </div>
              <div v-if="form.payment.status === 'created' || form.payment.status === null  " class="payment-status">
                To complete your application please complete Payment of 206 £ !
              </div>
              <div class="col-lg-12">
                <button class="btn btn-primary" @click="payNow">PAY NOW</button>
              </div>
            </div>

            {{-- Accepted --}}
            <div v-if="form.payment.status === 'accepted' && !paymentControlActive" class="row card-controls">

              <div class="icons">
                <i class="fa fa-credit-card"></i>
                <i class="fa fa-check"></i>
              </div>
              <div class="payment-status">
                Your payment of 206 £ has been successfull processed.
              </div>

            </div>



            <iframe id="payment-container" style="display:none;"></iframe>

        </section>
      </div>
    </div>
  </div>

  {{-- <div class="row">
    <section class="col-lg-12">
      <div class="card card-application right">
        <div class="section-controls">
          <input type="button" id="paymentButton" class="btn-invisbile" />
          <div class="btn btn-sm btn-primary btn-prev" @click="slider.prev()">
            <i class="fa fa-angle-left mr-1"></i>
            PREV</div>
          <div class="btn btn-sm btn-primary btn-next ml-1" @click="slider.next()">
            NEXT
            <i class="fa fa-angle-right ml-1"></i>
          </div>
        </div>
      </div>
  </div> --}}

</div>
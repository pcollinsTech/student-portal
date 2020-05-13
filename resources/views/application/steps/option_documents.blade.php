<div class="slide">


  <h4 class="step-title">Supporting Documents</h4>

  {{-- Original Birth Certificate --}}
  <div class="row">
    <div class="col-lg-12">
      <div class="card card-application right">
        <div class="title">
          Original Birth Certificate
        </div>
        <VUpload :error="form.getError('documents.birth_certificate')" label="Upload Original Birth Certificate"
          event="application-docs" data-type="birth_certificate">
        </VUpload>
        <small class="form-text text-error">
          @{{ form.getError('documents.birth_certificate') }}
        </small>

        
      </div>
    </div>
  </div>

  {{-- Proof of Identity Document --}}
  <div class="row">
    <div class="col-lg-12">
      <div class="card card-application right">
        <div class="title">
          Proof of Identity Document
        </div>
        <div class="description">
          A UK/EEA full or provisional photocard driving license, current valid passport (must show expiry and
          photo) or an EEA identity card will be accepted.
        </div>

        <VUpload label="Upload Proof of Identity Documen" event="application-docs" data-type="proof_identity">
        </VUpload>

        <small class="form-text text-error">
          @{{ form.getError('documents.proof_identity') }}
        </small>

      </div>
    </div>
  </div>

  {{--  Passport Photograph to Verify Identity --}}
  <div class="row">
    <div class="col-lg-12">
      <div class="card card-application right">
        <div class="title">
          Passport Photograph to Verify Identity
        </div>
        <div class="description">
          To accompany verification form
        </div>

        <VUpload label="Upload Passport Photograph to Verify Identity" event="application-docs"
          data-type="passport_photograph">
        </VUpload>

        <small class="form-text text-error">
          @{{ form.getError('documents.passport_photograph') }}
        </small>
      </div>
    </div>
  </div>

  {{--  Degree Certificate / OSPAP --}}
  <div class="row">
    <div class="col-lg-12">
      <div class="card card-application right">
        <div class="title">
          Degree Certificate / OSPAP
        </div>
        <div class="description">
          If in your possession. (You will have the ability to upload this at a later stage if not provided.)
        </div>

        <VUpload label="Upload Passport Photograph to Verify Identity" event="application-docs"
          data-type="degree_certificate">
        </VUpload>

        <small class="form-text text-error">
          @{{ form.getError('documents.degree_certificate') }}
        </small>

      </div>
    </div>
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
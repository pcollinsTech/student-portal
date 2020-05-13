<section class="col-lg-12">

  <div class="card card-application right">

    <div class="title">Declarations {{  $disabled }}</div>


    <VSwitchInline :disabled="{{ $disabled ? 'true' : 'false' }}" v-model="form.declaration_1">
      <div>
        I wish to become a registered trainee of the Pharmaceutical Society NI.
      </div>
    </VSwitchInline>

    <VSwitchInline :disabled="{{ $disabled ? 'true' : 'false' }}"  v-model="form.declaration_2">
      <div>
        I will abide by the Pharmaceutical Society's Code and I understand my obligations as detailed in the
        supplementary professional standards and guidance.
      </div>
      <small>Viewable at the following <a
          href="https://www.psni.org.uk/wp-content/uploads/2012/09/22504-PSNI-Code-of-Practice-Book-final.pdf"
          target="__blank">link</a></small>
    </VSwitchInline>


    <VSwitchInline :disabled="{{ $disabled ? 'true' : 'false' }}"  v-model="form.declaration_3">
      <div>
        I have read, understood and agree to adhere to the Pharmaceutical Society's Standards on Pre-registration
        Training.
      </div>
      <small>Viewable at the following <a
          href="https://www.psni.org.uk/wp-content/uploads/2012/10/PRE-REGISTRATION-STANDARDS-July-2012-revised-290419-FINAL.pdf"
          target="__blank">link</a></small>
    </VSwitchInline>


    <VSwitchInline :disabled="{{ $disabled ? 'true' : 'false' }}"  v-model="form.declaration_4">
      <div>
        I know of no reason that would prohibit me from becoming a registered trainee of the Pharmaceutical
        Society
        NI.
      </div>
    </VSwitchInline>


    <VSwitchInline :disabled="{{ $disabled ? 'true' : 'false' }}"  v-model="form.declaration_5">
      <div>
        I note the data protection statement below as it applies to relevant information held about me.
      </div>
    </VSwitchInline>


    <small class="form-text text-error text-right mr-3" v-if="form.hasError('declaration_1.checked') || 
              form.hasError('declaration_2.checked') ||
              form.hasError('declaration_3.checked') ||
              form.hasError('declaration_4.checked') ||
              form.hasError('declaration_5.checked') ||
              form.hasError('declaration_6.checked')">
      You Must Agree To The Above Statements
    </small>


  </div>



</section>
<section class="col-lg-12">
  <div class="card card-application right">

    <div class="title">
      Character Declarations
    </div>

    <div class="description">
      It is important that any graduate wishing to register as a trainee of the Pharmaceutical Society NI must be
      able to satisfy the Council of the Pharmaceutical Society of his/her good character.
    </div>

    <VSwitchInline :disabled="{{ $disabled ? 'true' : 'false' }}" v-model="form.character_declaration_1">
      <div>
        Have you been subject to any sanction under student Fitness to Practise procedures whilst studying at
        university? Further guidance about what is considered a sanction can be found at:
      </div>
      <small>Viewable at the following <a
          href="https://www.pharmacyregulation.org/sites/default/files/document/guidance_on_student_fitness_to_practise_procedures_in_schools_of_pharmacy_july_2018_.pdf"
          target="__blank">link</a></small>

      <template v-slot:extra>
        Provide any evidence that would help support your claim of good character for consideration by the
        registrar
        if not previously supplied.
      </template>
    </VSwitchInline>

    <VSwitchInline :disabled="{{ $disabled ? 'true' : 'false' }}" v-model="form.character_declaration_2">
      <div>
        Are you currently bound over or do you have any convictions, cautions or informed warnings in the UK or in
        any other country which are not deemed 'protected' under the Rehabilitation of Offenders (Exceptions)
        Order
        (NI) 1979 (as amended in 2014) or are not subject to 'filtering' under tge Police Act 1997 (as amended)?
        Guidance on 'protected' convictions and the 'filtering' scheme can be found at:
      </div>
      <small>Viewable at the following <a
          href="https://www.nidirect.gov.uk/articles/information-disclosed-in-a-criminal-record-check#toc-2"
          target="__blank">link</a></small>

      <template v-slot:extra>
        Provide any evidence that would help support your claim of good character for consideration by the
        registrar
        if not previously supplied.
      </template>
    </VSwitchInline>


    <VSwitchInline :disabled="{{ $disabled ? 'true' : 'false' }}" v-model="form.character_declaration_3">
      <div>
        Are you the subject of ongoing or pending criminal proceedings in the UK or elsewhere (other than a
        motoring offence not likely to result in a disqualification), about which you have not previously advised
        the registrar in writing?
      </div>
      <template v-slot:extra>
        Provide any evidence that would help support your claim of good character for consideration by the
        registrar
        if not previously supplied.
      </template>

    </VSwitchInline>


    <VSwitchInline :disabled="{{ $disabled ? 'true' : 'false' }}" v-model="form.character_declaration_4">
      <div>
        Have you agreed to pay a penalty under Section 109a of the Social Security Administration (Northern
        Ireland)
        Order 1992 (penalty as an alternative to prosecution) about which you have not previosuly advised the
        registrar in writing?
      </div>

      <template v-slot:extra>
        Provide any evidence that would help support your claim of good character for consideration by the
        registrar
        if not previously supplied.
      </template>
    </VSwitchInline>


    <VSwitchInline :disabled="{{ $disabled ? 'true' : 'false' }}" v-model="form.character_declaration_5">
      <div>
        Have you been notified by a regulatory body in the UK responsible under any statutory provision for the
        regulation of a health or social care profession of a determination to the effect that your fitness to
        practise is impaired, or a determination by a regulatory body elsewhere to the same effect, about which
        you
        have not previously advised the registrar in writing?
      </div>
      <template v-slot:extra>
        Provide any evidence that would help support your claim of good character for consideration by the
        registrar
        if not previously supplied.
      </template>

    </VSwitchInline>

    <VSwitchInline :disabled="{{ $disabled ? 'true' : 'false' }}" v-model="form.character_declaration_6">
      <div>
        Are you subject to an investigation by another regulatory body (other than the PSNI) about which you have
        not previously advised the registrar in writing?
      </div>
      <template v-slot:extra>
        Provide any evidence that would help support your claim of good character for consideration by the
        registrar
        if not previously supplied.
      </template>
    </VSwitchInline>


    <VSwitchInline :disabled="{{ $disabled ? 'true' : 'false' }}" v-model="form.character_declaration_7">
      <div>
        Are you the subject of any fraud investigation by an HSC body about with you have not previously advised
        the
        registrar in writing?
      </div>
      <template v-slot:extra>
        Provide any evidence that would help support your claim of good character for consideration by the
        registrar
        if not previously supplied.
      </template>
    </VSwitchInline>


    <VSwitchInline :disabled="{{ $disabled ? 'true' : 'false' }}" v-model="form.character_declaration_8">
      <div>
        Are you included in a barred list (within the meaning of the Safeguarding Vulnerable Groups Act 2006 or
        the
        Safeguarding Vulnerable Groups (Northern Ireland) Order 2007) about which you have not previously advised
        the registrar in writing?
      </div>
      <template v-slot:extra>
        Provide any evidence that would help support your claim of good character for consideration by the
        registrar
        if not previously supplied.
      </template>
    </VSwitchInline>

    <VSwitchInline :disabled="{{ $disabled ? 'true' : 'false' }}" v-model="form.character_declaration_9">
      <div>
        I declare that the information provided above is true. I know of NO REASON that might result in me being
        considered an unsuitable person to undertake pre-registration training.
      </div>

    </VSwitchInline>

    <small class="form-text text-error text-right mr-3" v-if="form.hasError('character_declaration_9.checked')">
      You Must Agree To The Above Statement
    </small>

</section>
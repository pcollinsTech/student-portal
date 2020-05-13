import { Pharmacie } from '../models/pharmacie'
import { Tutor } from '../models/tutor'

export class Application {

  constructor() {

    this.paynow = false;
    this.student = null;

    this.id = -1;
    this.user_id = null;
    this.title = '';
    this.forenames = '';
    this.surname = '';
    this.known_as = '';
    this.previous_name = '';
    this.email = '';
    this.date_of_birth = '';

    this.step = 0;

    this.home_address_1 = '';
    this.home_address_2 = '';
    this.city = '';
    this.county = '';
    this.postcode = '';
    this.country = '';
    this.phone_mobile = '';
    this.phone_home = '';

    this.university_id = '';
    this.entry_date = '';
    this.completion_date = '';

    this.previous_training = {
      checked: false,
      details: ''
    };

    this.password = '';
    this.password_confirmation = '';

    this.declaration_1 = {
      checked: null,
      details: null
    };

    this.declaration_2 = {
      checked: null,
      details: null
    };

    this.declaration_3 = {
      checked: null,
      details: null
    };

    this.declaration_4 = {
      checked: null,
      details: null
    };

    this.declaration_5 = {
      checked: null,
      details: null
    };

    this.documents = {
      birth_certificate: null,
      proof_identity: null,
      passport_photograph: null,
      degree_certificate: null,
    };

    this.pharmacies = [];
    this.tutors = [];

    this.payment = {
      status: null
    };


    this.pharmacies = [new Pharmacie(null)];

    this.tutors = [new Tutor(null)];

    this.character_declaration_1 = {
      checked: null,
      details: ''
    };

    this.character_declaration_2 = {
      checked: null,
      details: ''
    };

    this.character_declaration_3 = {
      checked: null,
      details: ''
    };

    this.character_declaration_4 = {
      checked: null,
      details: ''
    };

    this.character_declaration_5 = {
      checked: null,
      details: ''
    };

    this.character_declaration_6 = {
      checked: null,
      details: ''
    };

    this.character_declaration_7 = {
      checked: null,
      details: ''
    };

    this.character_declaration_8 = {
      checked: null,
      details: ''
    };

    this.character_declaration_9 = {
      checked: null,
      details: null
    };



    this.health_declaration_1 = {
      checked: null,
      details: null
    };

    this.health_declaration_2 = {
      checked: null,
      details: null
    };

    this.health_declaration_3 = {
      checked: null,
      details: null
    };

    this.health_declaration_4 = {
      checked: null,
      details: null
    };

    this.health_declaration_5 = {
      checked: null,
      details: null
    };

    this.health_declaration_6 = {
      checked: null,
      details: null
    };


  }


  bind(user) {

    window.user = user;
    this.student = user.student;

    // Alias student
    let student = this.student;

    this.id = student.id;
    this.user_id = user.id;
    this.title = student.title;
    this.forenames = student.forenames;
    this.surname = student.surname;
    this.email = user.email;
    this.date_of_birth = student.date_of_birth
    this.known_as = student.known_as;
    this.previous_name = student.previous_name;

    this.step = 0;

    this.home_address_1 = student.home_address_1;
    this.home_address_2 = student.home_address_2;
    this.city = student.city;
    this.county = student.county;
    this.postcode = student.postcode;;
    this.country = '';
    this.phone_mobile = student.phone_mobile;
    this.phone_home = student.phone_home;

    this.university_id = student.university_id;
    this.entry_date = student.entry_date;
    this.completion_date = student.completion_date;

    this.previous_training = {
      checked: student.previous_training === 1,
      details: student.previous_training_details
    };


    this.payment = user.payments.find(payment => {
      return payment.type === 'registraion/application'
    })


    this.pharmacies = student.pharmacies.map(pharmacie => {
      return {
        id: pharmacie.id,
        placement_start: pharmacie.pivot.placement_start,
        placement_end: pharmacie.pivot.placement_end,
      }
    })


    this.tutors = student.pharmacists.map(pharmacist => {
      return {
        id: pharmacist.id,
        tutor_start: pharmacist.pivot.tutor_start,
        tutor_end: pharmacist.pivot.tutor_end
      }
    })


    this.declaration_1 = {
      checked: true,
      details: null
    };

    this.declaration_2 = {
      checked: true,
      details: null
    };

    this.declaration_3 = {
      checked: true,
      details: null
    };

    this.declaration_4 = {
      checked: true,
      details: null
    };

    this.declaration_5 = {
      checked: true,
      details: null
    };



    let health_declarations = this.student.registration.health_declarations

    this.health_declaration_1 = {
      checked: health_declarations.health_declaration_1 === 'true',
      details: null
    };

    this.health_declaration_2 = {
      checked: health_declarations.health_declaration_2 === 'true',
      details: null
    };

    this.health_declaration_3 = {
      checked: health_declarations.health_declaration_3 === 'true',
      details: null
    };

    this.health_declaration_4 = {
      checked: health_declarations.health_declaration_4 === 'true',
      details: null
    };

    this.health_declaration_5 = {
      checked: health_declarations.health_declaration_5 === 'true',
      details: null
    };

    this.health_declaration_6 = {
      checked: health_declarations.health_declaration_6 === 'true',
      details: null
    };


    let character_declarations = this.student.registration.character_declarations

    let character_declarations_details = this.student.registration.character_declaration_details;

    this.character_declaration_1 = {
      checked: character_declarations.character_declaration_1 === 'true',
      details: character_declarations_details.character_declaration_1
    };


    this.character_declaration_2 = {
      checked: character_declarations.character_declaration_2 === 'true',
      details: character_declarations_details.character_declaration_2
    };

    this.character_declaration_3 = {
      checked: character_declarations.character_declaration_3 === 'true',
      details: character_declarations_details.character_declaration_3
    };

    this.character_declaration_4 = {
      checked: character_declarations.character_declaration_4 === 'true',
      details: character_declarations_details.character_declaration_4
    };

    this.character_declaration_5 = {
      checked: character_declarations.character_declaration_5 === 'true',
      details: character_declarations_details.character_declaration_5
    };

    this.character_declaration_6 = {
      checked: character_declarations.character_declaration_6 === 'true',
      details: character_declarations_details.character_declaration_6
    };

    this.character_declaration_7 = {
      checked: character_declarations.character_declaration_7 === 'true',
      details: character_declarations_details.character_declaration_7
    };

    this.character_declaration_8 = {
      checked: character_declarations.character_declaration_8 === 'true',
      details: character_declarations_details.character_declaration_8
    };

    this.character_declaration_9 = {
      checked: character_declarations.character_declaration_9 === 'true',
      details: character_declarations_details.character_declaration_9
    };


  }

}
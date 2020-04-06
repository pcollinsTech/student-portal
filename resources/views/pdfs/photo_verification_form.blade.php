
@extends('layouts.pdf')

@section('title')
   Photograph Verification Form
@stop

@section('header')
    <div class="topper">
        <h1>Photograph to verify identity of applicant</h1>
        <p>(Please complete in block capitals)</p>
    </div>

@stop

@section('content')
   <div class="row">
       
       <h3>Requirements for an appropriate officail</h3>
       <br/>
       <p>
           The counter signatory must be a professional person of some standing in the community (See A,11).
        </p>
        <br/>
        <p><strong>Further detail</strong></p>
        <ul>
            <li>They must have known you for at least 2 years</li>
            <li>They must be resident in the UK</li>
            <li>The must not be related to you by birth or marraige</li>
            <li>The should not be living at the same address or be in a personal relationship with you</li>
            <li>The must certify on the reverse side of the following handwritten declaration <strong><i>"I certify that this is a true and accurate likeness of (trainee's name)",</i></strong> it must also be <strong>signed and dated</strong> by the appropriate official.</li>
        </ul>
        <br/>
    </div>

    <div class="row">
        <h3>The Photograph</h3>
        <br/>
        <p>The same parameters which are required for a photograph presented in a passport apply to this application. The photograph must:
        <div class="col-6">
            <ul>
                <li>be the size of a standard passport photo</li>
                <li>be in colour</li>
                <li><u>not</u> be torn, creased or marked</li>
            </ul>
        </div>
        <div class="col-6">
            <ul>
                <li>have a plain cream or light grey background</li>
                <li>be printed on plain white photographic paper</li>
                <li><u>not</u> be trimmed or cut down from a larger photo</li>
            </ul>
        </div>
   </div>
   
   <div class="row">
       <h3>Your picture in photograph must:</h3>
       <br/>
       <div class="col-6">
           <ul>
               <li>be of you <u>alone</u> faceing forward</li>
               <li>be a clearly defined image</li>
               <li>show you with a neautral expression</li>
               <li>be taken without sunglasses or tinted glasses</li>
               <li>show your full head, with no covering of the face by hair etc</li>
           </ul>
       </div>
       <div class="col-6">
           <ul>
               <li>be a close up of your head and shoulders</li>
               <li>be taken in the last 4 weeks</li>
               <li>be taken with your eyes open and clearly visable</li>
               <li>be free from reflection/glare on spectacles</li>
           </ul>
       </div>
   </div>

   <div class="row">
       <h3>To be completed by the professional person signing the photograph (block capitals only)</h3>
        <div class="col-6">
            <label for="surname">Surname</label>
            <input type="text" name="surname" id="surname" ><br/>
        </div>
        <div class="col-6">
            
            <label for="first_name">First Name(s)</label>
            <input type="text" name="first_name" id="first_name" ><br/>
        </div>
        
        <label for="address">Address</label>
        <input type="text" name="address" id="address" ><br/>
        <input type="text" name="address" id="address" ><br/>
        <label for="postcode">Postcode</label>
        <input type="text" name="postcode" id="postcode" ><br/>
        <label for="phone">Telephone Number</label>
        <input type="text" name="phone" id="phone" ><br/>
        <label for="email">Email Address</label>
        <input type="text" name="email" id="email" ><br/>
        <label for="profession">Profession</label>
        <span>(inc professional registration number if applicapable)</span>
        <input type="text" name="profession" id="profession" ><br/>
    </div>

    <div class="row">
        <p>By countersigning this photograph I agree that the Pharmaceutical Society NI may contact me to verify that the information provided is correct.</p>
        <p>I declare that i have signed the photograph enclosed with this application form and that I have known the applicant {{$student->forenames}} {{$student->surname}}  for a period of <u>      </u> years and that the information provided is correct.</p>
        <br/>
        <div class="col-6">
            <label for="signature">Signed</label>
            <input type="text" name="signature" id="signature" ><br/>
            <label for="printed_signature">Print Name</label>
            <input type="text" name="printed_signature" id="printed_signature"><br/>
        </div>
        <div class="col-6">
            <label for="date">Date</label>
            <input type="text" name="date" id="date" ><br/>
        </div>
    </div>

@stop
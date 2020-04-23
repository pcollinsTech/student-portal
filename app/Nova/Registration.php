<?php

namespace App\Nova;

use Illuminate\Http\Request;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Textarea;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Http\Requests\NovaRequest;
use R64\NovaFields\JSON;

class Registration extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = 'App\Registration';

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'id';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'id',
    ];

    public static $displayInNavigation = false;

    /**
     * Get the fields displayed by the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function fields(Request $request)
    {
        return [
            ID::make()->sortable(),
            JSON::make('Health Declarations', [
                Boolean::make('I declare that all of the information I give in this form and in any supporting documents is accurate.', 'health_declaration_1'),
                Boolean::make('I undertake to comply with the principles of the code & supplementary professional standards and guidance published by the Pharmaceutical Society\'s Council.', 'health_declaration_2'),
                Boolean::make('I undertake to notify the registrar of any changes to my name, home address or other contact details.', 'health_declaration_3'),
                Boolean::make('I undertake to notify the registrar of any character / fitness to practise matters within 7 days of any occurrence throughout my pre-registration year.', 'health_declaration_4'),
                Boolean::make('I understand that if the declaration included in this application for pre-registration training is not completed to the satisfaction of the registrar, my application will not be processed.', 'health_declaration_5'),
                Boolean::make('I understand that if I am found to have given false or misleading information in connection with my registration on the trainee register, this may be treated as misconduct for the purposes of the Pharmacy (NI) Order 1976, which my result in my removal from the student register.', 'health_declaration_6'),
//                Boolean::make('7', 'health_declaration_7'),
            ], 'health_declarations')->showOnIndex(),
            JSON::make('Character Declarations', [
                Boolean::make('Have you been subject to any sanction under student Fitness to Practise procedures whilst studying at university? Further guidance about what is considered a sanction can be found at:', 'character_declaration_1'),
                Boolean::make('Are you currently bound over or do you have any convictions, cautions or informed warnings in the UK or in any other country which are not deemed \'protected\' under the Rehabilitation of Offenders (Exceptions) Order (NI) 1979 (as amended in 2014) or are not subject to \'filtering\' under tge Police Act 1997 (as amended)? Guidance on \'protected\' convictions and the \'filtering\' scheme can be found at:', 'character_declaration_2'),
                Boolean::make('Are you the subject of ongoing or pending criminal proceedings in the UK or elsewhere (other than a motoring offence not likely to result in a disqualification), about which you have not previously advised the registrar in writing?', 'character_declaration_3'),
                Boolean::make('Have you agreed to pay a penalty under Section 109a of the Social Security Administration (Northern Ireland) Order 1992 (penalty as an alternative to prosecution) about which you have not previosuly advised the registrar in writing?', 'character_declaration_4'),
                Boolean::make('Have you been notified by a regulatory body in the UK responsible under any statutory provision for the regulation of a health or social care profession of a determination to the effect that your fitness to practise is impaired, or a determination by a regulatory body elsewhere to the same effect, about which you have not previously advised the registrar in writing?', 'character_declaration_5'),
                Boolean::make('Are you subject to an investigation by another regulatory body (other than the PSNI) about which you have not previously advised the registrar in writing?', 'character_declaration_6'),
                Boolean::make('Are you the subject of any fraud investigation by an HSC body about with you have not previously advised the registrar in writing?', 'character_declaration_7'),
                Boolean::make('Are you included in a barred list (within the meaning of the Safeguarding Vulnerable Groups Act 2006 or the Safeguarding Vulnerable Groups (Northern Ireland) Order 2007) about which you have not previously advised the registrar in writing?', 'character_declaration_8'),
            ], 'character_declarations'),
            JSON::make('Character Declarations Details', [
                Textarea::make('1', 'character_declaration_1'),
                Textarea::make('2', 'character_declaration_2'),
                Textarea::make('3', 'character_declaration_3'),
                Textarea::make('4', 'character_declaration_4'),
                Textarea::make('5', 'character_declaration_5'),
                Textarea::make('6', 'character_declaration_6'),
                Textarea::make('7', 'character_declaration_7'),
                Textarea::make('8', 'character_declaration_8'),
            ], 'character_declaration_details'),
            HasMany::make('Documents')
        ];
    }

    /**
     * Get the cards available for the request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function cards(Request $request)
    {
        return [];
    }

    /**
     * Get the filters available for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function filters(Request $request)
    {
        return [];
    }

    /**
     * Get the lenses available for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function lenses(Request $request)
    {
        return [];
    }

    /**
     * Get the actions available for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function actions(Request $request)
    {
        return [];
    }
}

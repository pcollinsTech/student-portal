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
                Boolean::make('1', 'health_declaration_1'),
                Boolean::make('2', 'health_declaration_2'),
                Boolean::make('3', 'health_declaration_3'),
                Boolean::make('4', 'health_declaration_4'),
                Boolean::make('5', 'health_declaration_5'),
                Boolean::make('6', 'health_declaration_6'),
                Boolean::make('7', 'health_declaration_7'),
            ], 'health_declarations'),
            JSON::make('Character Declarations', [
                Boolean::make('1', 'character_declaration_1'),
                Boolean::make('2', 'character_declaration_2'),
                Boolean::make('3', 'character_declaration_3'),
                Boolean::make('4', 'character_declaration_4'),
                Boolean::make('5', 'character_declaration_5'),
                Boolean::make('6', 'character_declaration_6'),
                Boolean::make('7', 'character_declaration_7'),
                Boolean::make('8', 'character_declaration_8'),
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

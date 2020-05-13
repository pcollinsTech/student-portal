<?php

namespace App\Nova;

use Illuminate\Http\Request;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\DateTime;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Fields\BelongsToMany;
use Laravel\Nova\Fields\HasOne;
use App\Nova\Actions\PostStudent;
use Laravel\Nova\Fields\HasMany;

class Student extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = 'App\Student';

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'name';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'id',
    ];

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
            Select::make('Title')->options([
                'mr'        => 'Mr',
                'ms'        => 'Ms',
                'miss'      => 'Miss',
                'mrs'       => 'Mrs',
                'dr'        => 'Dr',
            ])->displayUsingLabels(),
            Text::make('Forenames')
                ->sortable(),
            Text::make('Surname')
                ->sortable(),
            Text::make('Known As', 'known_as')
                ->hideFromIndex()
                ->sortable(),
            Text::make('Address Line 1', 'home_address_1')
                ->hideFromIndex(),
            Text::make('Address Line 2', 'home_address_2')
                ->hideFromIndex(),
            Text::make('City', 'city')
                ->hideFromIndex(),
            Text::make('County', 'county')
                ->hideFromIndex(),
            Text::make('Post Code', 'postcode')
                ->hideFromIndex(),
            Text::make('Phone Mobile', 'phone_mobile')
                ->hideFromIndex(),
            Text::make('Phone Home', 'phone_home')
                ->hideFromIndex(),
            Text::make('University', 'university')->displayUsing(function ($university) {
                return $university->name;
            }),
            DateTime::make('Date of Birth', 'date_of_birth')
                ->format('D/M/Y')
                ->hideFromIndex(),
            DateTime::make('Degree Entry Date', 'entry_date')
                ->format('D/M/Y')
                ->hideFromIndex(),
            DateTime::make('Degree Completion Date', 'completion_date')
                ->format('D/M/Y')
                ->hideFromIndex(),
            Boolean::make('Previous Training', 'previous_training')
                ->hideFromIndex(),
            Text::make('Previous Training Details', 'previous_training_details'),
            HasOne::make('Registration'),

            BelongsToMany::make('Pharmacies')
                ->fields(function () {
                    return [
                        Boolean::make('active'),
                    ];
                }),
            BelongsToMany::make('Pharmacists')
                ->fields(function () {
                    return [
                        Boolean::make('active'),
                    ];
                }),
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
        return [
            new PostStudent
        ];
    }
}

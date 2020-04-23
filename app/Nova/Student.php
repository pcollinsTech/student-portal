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
                ->sortable(),
            Text::make('Address Line 1','home_address_1')
                ->hideFromIndex(),
            Text::make('Address Line 2','home_address_2')
                ->hideFromIndex(),
            Text::make('City','city')
                ->hideFromIndex(),
            Text::make('County','county')
                ->hideFromIndex(),
            Text::make('Post Code','postcode')
                ->hideFromIndex(),
            Text::make('Phone Mobile','phone_mobile')
                ->hideFromIndex(),
            Text::make('Phone Home','phone_home')
                ->hideFromIndex(),
            DateTime::make('Date of Birth', 'date_of_birth')
                ->hideFromIndex(),
            DateTime::make('Degree Entry Date', 'entry_date')
                ->hideFromIndex(),
            // DateTime::make('Degree Completion Date', 'completion_date')
            //     ->hideFromIndex(),
            Boolean::make('Previous Training', 'previous_training')
            ->hideFromIndex(),
            HasOne::make('Registration'),
            // Has::make('Document'),
            BelongsToMany::make('Pharmacies'),
            BelongsToMany::make('Pharmacists'),
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

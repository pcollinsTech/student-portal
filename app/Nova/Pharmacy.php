<?php

namespace App\Nova;

use Illuminate\Http\Request;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;

class Pharmacy extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = 'App\Pharmacy';

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'trading_name';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'id', 'registration_number', 'trading_name', 'post_code'
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
//            ID::make()->sortable(),
            Text::make('Registration Number', 'registration_number')
                ->sortable(),
            Text::make('Trading Name', 'trading_name')
                ->sortable(),
            Text::make('Address Line 1', 'address_1')
                ->hideFromIndex(),
            Text::make('Address Line 2', 'address_2'),
            Text::make('Town / City', 'town')
                ->sortable(),
            Text::make('County', 'county')
                ->hideFromIndex()
                ->sortable(),
            Text::make('Postcode', 'post_code')
                ->hideFromIndex(),
            Text::make('Email', 'email')
                ->hideFromIndex()
                ->rules('max:254'),
                Text::make('Website', 'website')
                ->hideFromIndex()
                ->rules('max:254'),
                Text::make('Phone Number', 'phone')
                ->hideFromIndex()
                ->rules('max:254'),
            Text::make('Verified'),
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

@extends('master')

@section('contents')

<div class="container">
  <VSlider inline-template>

    <div class="slider">


      {{-- Steps Menu --}}
      @include('application.steps.menu')

      {{-- Step Container  --}}
      <div class="slide-container">

        <Application v-if="ready" :step="step" :counties-data="{{ $utils->counties() }}" inline-template>
          <div class="wrapper" :class="'slide-' + step">
            {{-- Steps Partials --}}
            @include('application.steps.index')
          </div>
        </Application>

      </div>
    </div>

  </VSlider>
</div>

@endsection